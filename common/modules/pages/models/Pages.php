<?php

namespace common\modules\pages\models;

use Yii;
use common\helpers\CString;

/**
 * This is the model class for table "t_kg_pages".
 *
 * @property integer $id
 * @property string $title
 * @property string $alt_title
 * @property string $small_text
 * @property string $text
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kg_pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['small_text', 'text', 'seo_description'], 'string'],
            [['title', 'alt_title', 'seo_title', 'seo_keywords'], 'string', 'max' => 512],
            [['small_text', 'text', 'seo_description'], 'string', 'max' => 9999999]
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
            'alt_title' => 'Alt Заголовок',
            'small_text' => 'Краткое описание',
            'text' => 'Полный текст',
            'seo_title' => 'Seo Заголовок',
            'seo_keywords' => 'Seo Ключевые слова',
            'seo_description' => 'Seo Описение',
        ];
    }

    public function beforeValidate() {
        if (parent::beforeValidate()) {
            $this->alt_title = CString::translitTo($this->title);
            return true;
        }
        return false;
    }
}
