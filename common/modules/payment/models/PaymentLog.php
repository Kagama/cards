<?php

namespace common\modules\payment\models;

use Yii;

/**
 * This is the model class for table "{{%payment_log}}".
 *
 * @property integer $id
 * @property integer $sum
 * @property string $car_number
 * @property string $card_number
 * @property integer $date
 * @property string $status
 */
class PaymentLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%payment_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sum', 'car_number', 'card_number', 'date', 'status'], 'required'],
            [['sum', 'date'], 'integer'],
            [['car_number', 'card_number', 'status'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sum' => 'Сумма',
            'car_number' => 'Номер авто',
            'card_number' => 'Номер карты',
            'date' => 'Дата',
            'status' => 'Статус выполнения',
        ];
    }
}
