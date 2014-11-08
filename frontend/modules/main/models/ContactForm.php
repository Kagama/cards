<?php
namespace frontend\modules\main\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ContactForm extends Model
{
    public $flp;
    public $phone;
    public $email;
    public $text;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['flp', 'phone', 'email', 'text'], 'required'],
            // rememberMe must be a boolean value
            ['email', 'email'],
            // password is validated by validatePassword()
            ['text', 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'flp' => 'ФИО',
            'phone' => 'Номер телефона',
            'email' => 'Email',
            'text' => 'Описание проблемы',
        ];
    }

    public function sendMessageTo()
    {
        return Yii::$app->mail->compose('email-contact-form-tpl', ['contactForm' => $this])
            ->setFrom($this->email)
            ->setTo(Yii::$app->params['doctorEmail'])
            ->setSubject('Новое сообщение от посетителя сайта')
            ->send();
    }
}
