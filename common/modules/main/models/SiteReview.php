<?php

namespace common\modules\main\models;

use common\modules\user\models\User;
use Yii;

/**
 * This is the model class for table "t_kg_site_review".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $date
 * @property string $text
 * @property integer $publish
 */
class SiteReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kg_site_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'date', 'text'], 'required'],
            [['user_id', 'date', 'publish'], 'integer'],
            [['text'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'date' => 'Дата',
            'text' => 'Текст',
            'publish' => 'Публиковать',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getDate()
    {
        return date("d.m.Y", $this->date);
    }

    public function setDate($date)
    {
        $this->date = strtotime($date);
    }
}
