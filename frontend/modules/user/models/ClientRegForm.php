<?php
/**
 * Created by PhpStorm.
 * User: pashaevs
 * Date: 17.11.14
 * Time: 20:08
 */

namespace frontend\modules\user\models;

use common\modules\card\models\Card;
use common\modules\user\models\User;
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
            [['card_number', 'car_number', 'phone'], 'required', 'message' => 'Необходимо заполнить поле'],
            [['card_number', 'month'], 'integer'],
            [['card_number'], 'match', 'pattern' => '/^(\d){6}$/i'],
            [['phone'], 'match', 'pattern' => '/^\+7 \([0-9]{3}\) [0-9]{3}\-[0-9]{2}\-[0-9]{2}$/i'],
            [['car_number'], 'match', 'pattern' => '/^(а|в|е|к|м|н|о|р|с|т|у|х){1}[0-9]{3}(а|в|е|к|м|н|о|р|с|т|у|х){2}(([0-9]{2})|([0-9]{3}))$/i', 'message' => 'Проверьте правильность заполнения поля. Буква должны написаны кириллицей.'],
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


    public function registration()
    {
        $card = Card::find()->where(['discount_card' => $this->card_number])->one();
        if (empty($card)) {
            $this->addError('card_number', 'Картка не существует');
            return false;
        } else if ($card->active == true && ($card->user->car_number != $this->car_number)) {
            $this->addError('card_number', 'Картка закреплена за другим пользователем.');
            return false;
        } else {


        }


        $user = User::find()->where(['car_number' => $this->car_number])->one();
        $user = ($user == null ? new User() : $user);

        $user->car_number = $this->car_number;
        $user->discount_card = $card->id;
        $user->phone = $this->phone;
        $user->role_id = 3;

        if ($user->save()) {
            $card->registration_date = time();
            $card->user_id = $user->getPrimaryKey();
            $card->save();
            return true;
        }
        return false;
    }
}