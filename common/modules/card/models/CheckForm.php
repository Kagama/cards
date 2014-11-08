<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 31.10.2014
 * Time: 2:09
 */
namespace common\modules\card\models;

use yii\base\Model;

class CheckForm extends Model
{
    public $number;

    public function rules()
    {
        return [
            [['number'], 'string']  //сделать валидацию - либо банк. карточка, либо номера авто
        ];
    }

    public function attributeLabels()
    {
        return [
            'number' => 'Введите номер Вашей карточки или гос. номер автомобиля: '
        ];
    }

    public function checkCard($number)
    {
        $model = Card::findOne(['car_number' => $number]); //как искать или - или
        if (!$model)
            $model = Card::findOne(['bank_card' => $number]);
        if ($model)
        {
            //превратить месяци в целочисленный формат
            return date('d.m.Y, H:i',$model->created_at);
        }
        return false;
    }
}