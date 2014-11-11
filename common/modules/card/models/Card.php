<?php

namespace common\modules\card\models;

use Yii;
use yii\db\ActiveRecord;
use common\modules\user\models\User;

/**
 * This is the model class for table "t_kg_card".
 *
 * @property integer $id
 * @property integer $discount_card
 * @property integer $end_date
 * @property integer $registration_date
 * @property integer $last_payment
 * @property integer $user_id
 * @property boolean $active
 */
class Card extends ActiveRecord
{
    public $from;
    public $to;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kg_card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['discount_card', 'required'],
            [['end_date', 'registration_date', 'last_payment', 'user_id', 'discount_card'], 'integer'],
            ['active', 'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'discount_card' => 'Номер скидочной карты',
            'end_date' => 'Дата окончания действия скидки',
            'registration_date' => 'Дата регистрации карты',
            'last_payment' => 'Дата последней оплаты',
            'user_id' => 'ID пользователя',
            'active' => 'Используется'
        ];
    }

    public function createCards($from, $to)
    {
        for ($i = $from; $i <= $to; $i++){
            if (!(Card::findOne(['discount_card' => $i]))) {
                $card = new Card();
                $card->discount_card = $i;
                $card->save();
            }
        }
    }

    /**
     * @inheritdoc
     */
//    public function behaviors()
//    {
//        return [
//            'timestamp' => [
//                'class' => 'yii\behaviors\TimestampBehavior',
//                'attributes' => [
//                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
////                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
//                ],
//            ],
//        ];
//    }

    public static function changeDiscountCard($user_id, $model = 0)
    {
        // Проверяем, задан ли ID пользователя. Если да
        if ($model->user_id) {
            // Проверяем, был ли привязан к карте пользователь. Если да
            if ($model->user_id != $user_id) {
                // Устанавливаем параметры карты
                $model->registration_date = time();
                $model->active = true;

                // Находим предыдущего пользователя, если он был, и обнуляем номер карты
                if ($user_id) {
                    $user = User::findOne($user_id);
                    $user->discount_card = null;
                    $user->save();
                }

                // Находим нового пользователя и присваиваем ID карты
                $user = User::findOne($model->user_id);
                $user->discount_card = $model->id;
                $user->save();
            }
        }
        // Если ID пользователя не задан
        elseif ($user_id) {
            if ($model) {
                $model->active = false;
                $model->registration_date = null;
            }
            $user = User::findOne($user_id);
            $user->discount_card = null;
            $user->save();
        }
    }
}
