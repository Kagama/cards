<?php
/**
 * Created by PhpStorm.
 * User: pashaevs
 * Date: 17.11.14
 * Time: 20:08
 */

namespace frontend\modules\user\models;

use yii\base\Model;

class ClientRegForm extends Model
{
    public $card_number;
    public $car_number;
    public $phone;
    public $month;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['card_number', 'car_number', 'phone'], 'required'],
            [['card_number', 'month'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'card_number' => 'Номер карты',
            'car_number' => 'Номер авто',
            'phone' => 'Контактный номер телефона',
            'month' => 'Месяц'
        ];
    }
}