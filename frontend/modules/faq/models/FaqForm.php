<?php

namespace frontend\modules\faq\models;

use common\modules\faq\models\Faq;
use common\modules\user\models\User;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FaqForm extends Model
{
    public $username;
    public $email;
    public $question;
    public $verifyCode;
    public $date;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['question', 'username', 'email'], 'required'],
            [['question'], 'string'],
            [['email'], 'email'],
            [['username'], 'string', 'max' => 512],
            ['verifyCode', 'captcha', 'captchaAction'=> '/faq/default/captcha']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'email' => 'EMail',
            'question' => 'Вопрос',
            'verifyCode' => 'Капча',
        ];
    }

    public function saveFaq() {
        $model = new Faq();

        $model->username = $this->username;
        $model->email = $this->email;
        $model->question = $this->question;
        $model->date = $this->date = time();

        if ($model->save()) {
            return Yii::$app->mail->compose(['html' => '/default/mail/new_question'], ['form' => $this])
                ->setFrom($this->email)
                ->setTo(Yii::$app->params['adminEmail'])
                ->setSubject("Новый вопрос от ".$this->username." ".date('d.m.Y', $this->date))
                ->send();
        }
        return false;
    }


}