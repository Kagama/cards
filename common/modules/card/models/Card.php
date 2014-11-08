<?php

namespace common\modules\card\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "t_kg_card".
 *
 * @property integer $id
 * @property string $phone
 * @property string $car_number
 * @property string $bank_card
 * @property integer $month
 * @property integer $card_number
 * @property integer $created_at
 */
class Card extends ActiveRecord
{
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
            ['month', 'required'],
            [['month', 'card_number'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Контактный номер телефона',
            'car_number' => 'Гос. номер автомобиля (цифры и строчные русские буквы)',
            'bank_card' => 'Номер банковской карты',
            'month' => 'Количество месяцев',
            'created_at' => 'Дата активации',
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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
//                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
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
