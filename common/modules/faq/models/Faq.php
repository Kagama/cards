<?php

namespace common\modules\faq\models;

use Yii;

/**
 * This is the model class for table "t_kg_faq".
 *
 * @property integer $id
 * @property string $title
 * @property string $question
 * @property string $answer
 * @property integer $date
 * @property string $username
 * @property string $email
 * @property integer $answer_date
 * @property integer $menu_id
 * @property integer $publish
 * @property integer $category_id
 */
class Faq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 't_kg_faq';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question', 'date', 'username', 'email'], 'required'],
            [['question', 'answer'], 'string'],
            [['date', 'answer_date', 'menu_id', 'publish', 'category_id'], 'integer'],
            [['title', 'username'], 'string', 'max' => 512],
            [['email'], 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'question' => 'Вопрос',
            'answer' => 'Ответ',
            'date' => 'Дата',
            'username' => 'Пользователь',
            'email' => 'EMail',
            'answer_date' => 'Дата ответа',
            'menu_id' => 'Меню',
            'publish' => 'Публиковать',
            'category_id' => 'Категория',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(FaqCategory::className(), ['id' => 'category_id']);
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {

            $this->date = strtotime($this->date);
            $this->answer_date = time();

            return true;
        }
        return false;
    }

    public function afterSave($insert)
    {
        if ($this->getOldAttribute('answer') != $this->answer) {
            Yii::$app->mail->compose(['html' => '/default/mail/sent_answer'], ['form' => $this])
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo($this->email)
                ->setSubject("Ответ на вопрос от ".$this->username." ".date('d.m.Y', $this->date))
                ->send();
        }

        parent::afterSave($insert);
    }

    public function afterFind()
    {
        $this->date = date("d-m-Y", $this->date);
        $this->answer_date = date("d-m-Y", $this->answer_date);
    }
}
