<?php

namespace common\modules\user\models;

use Yii;
use yii\base\Model;
use common\modules\organization\models\City;
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
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $approve_newsletter
 */
class RegisterForm extends Model
{
    public $password;
    public $auth_key;
    public $password_hash;
    public $phone;
    public $created_at;
    public $updated_at;
    public $password_repeat;
    public $car_number;
    public $username;
    public $surname;
    public $name;
    public $city;
    public $bank_card;

    public function rules()
    {
        return [
            [['phone', 'password', 'car_number', 'username', 'surname', 'name', 'city'], 'required'],
            [['phone'], 'integer'],
            [['password_hash', 'city'], 'string'],
            [['bank_card'], 'checkBankCard', 'message' => 'Номер введен неверно'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'phone' => 'Номер моб. телефона (без +7, пробелов и скобок)',
            'created_at' => 'Дата регистрации',
            'updated_at' => 'Дата обновления',
            'password_repeat' => 'Повторить пароль',
            'car_number' => 'Гос. номер автомобиля',
            'bank_card' => 'Номер банковской карты',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'city' => 'Город',
        ];
    }

    public static function register($model)
    {
        $user = new User();
        $user->username = $model->username;
        $user->phone = $model->phone;
        $user->password = $model->password;
        $user->car_number = $model->car_number;
        $user->name = $model->name;
        $user->surname = $model->surname;
        $user->bank_card = $model->bank_card;
        $city = new City;
        $user->city = $city->findByName($model->city);

        $user->setPassword($model->password);
        $user->generateAuthKey();
        if ($user->save()) {
            return true;
        } else {
            return print_r($user->getErrors());
        }
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
}