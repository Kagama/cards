<?php

namespace common\modules\user\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
//use yii\helpers\Security;
use yii\web\IdentityInterface;
use common\modules\organization\models\City;
use common\modules\card\models\Card;

/**
 * This is the model class for table "t_kg_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $phone
 * @property integer $role
 * @property integer $status
 * @property string $car_number
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $bank_card
 * @property integer $city
 * @property integer $discount_card
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kg_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'surname', 'name', 'phone', 'car_number', 'city'], 'required'],
            [['role', 'status', 'created_at', 'updated_at', 'city', 'discount_card', 'month'], 'integer'],
            [['username', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            ['car_number', 'match', 'pattern' => '/^(а|в|е|к|м|н|о|р|с|т|у|х){1}[0-9]{3}(а|в|е|к|м|н|о|р|с|т|у|х){2}[0-9]{2}$/i'],
            [['bank_card'], 'checkBankCard', 'message' => 'Номер введен неверно'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'password' => 'Пароль',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'phone' => 'Контактный номер телефона',
            'role' => 'Роль',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'approve_newsletter' => 'Approve Newsletter',
            'car_number' => 'Гос. номер автомобиля',
            'bank_card' => 'Номер банковской карты',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'city' => 'Город',
            'discount_card' => 'Номер скидочной карты',
            'month' => 'Количество месяцев',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }


    public static function create($attributes)
    {
        /** @var User $user */
        $user = new static();
        $user->setAttributes($attributes);
        $user->status = 1;
        $user->setPassword($attributes['password']);
        $user->generateAuthKey();
        if ($user->save()) {
            return $user;
        } else {
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => 1]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => 1,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->getSecurity()->generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->getSecurity()->generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getCityObj()
    {
        return $this->hasOne(City::className(), ['id' => 'city']);
    }

    public function checkBankCard($bank_card)
    {
        $length = strlen($bank_card);
        $sum = 0;
        for($i = $length-1; $i>=0; $i--)
        {
            if ($i % 2 == 0) {
                $product = $bank_card[$i] * 2;
                if ($product > 9)
                    $product -= 9;
                $sum += $product;
            }
            else
                $sum += $bank_card[$i];
        }
        if ($sum % 10 == 0)
            return true;
        else
            return false;
    }


    public static function getAllLikeJsList () {
        $temp_js_list = "";
        $tags = User::find()->where(['discount_card' => 0 ])->orderBy('name ASC')->all();
        foreach ($tags as $tag) {
            $temp_js_list .= (empty($temp_js_list) ? "" : ", ")." ".$tag->id." - ".$tag->username;
        }
        $temp_js_list = explode(",", $temp_js_list);
        return $temp_js_list;
    }


    public static function changeDiscountCard($discount_card, $model = 0){
        // Если номер скидочной карты задан
        if ($model->discount_card) {

            // Если номер скидочной карты изменился
            if ($model->discount_card != $discount_card) {

                // Находим предыдущую карту, если она была задана, и обнуляем ее значения
                if ($discount_card) {
                    $card = Card::findOne($model->discount_card);
                    $card->active = false;
                    $card->registration_date = null;
                    $card->user_id = null;
                    $card->save();
                }

                // Находим указанную карту и измняем параметры
                $card = Card::findOne($model->discount_card);
                $card->active = true;
                $card->registration_date = time();
                $card->user_id = $model->id;
                $card->save();
            }
        }
        // Если номер скидочной карты удален
        elseif ($discount_card) {
            $card = Card::findOne($discount_card);
            $card->active = false;
            $card->registration_date = null;
            $card->user_id = null;
            $card->save();
        }
    }
}
