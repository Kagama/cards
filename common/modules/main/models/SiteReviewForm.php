<?php

namespace common\modules\main\models;

use common\modules\main\models\SiteReview;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class SiteReviewForm extends Model
{
    public $text;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text'], 'string'],
            //['verifyCode', 'captcha', 'captchaAction'=> '/comment/default/captcha']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'text' => 'Текст',
        ];
    }

    public function saveReview() {
        $model = new SiteReview();

        $model->user_id = Yii::$app->user->getId();
        $model->text = $this->text;
        $model->date = time();
        $model->publish = 0;

        return $model->save();
    }


}