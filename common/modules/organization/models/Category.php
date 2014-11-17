<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 25.10.2014
 * Time: 0:12
 */
namespace common\modules\organization\models;

use common\helpers\CDirectory;
use yii\db\ActiveRecord;
use common\helpers\CString;
use yii\web\UploadedFile;

/*
 * @protected integer $id
 * @protected string $name
 * @protected string $alt_name
 * @property string $img
 * @protected string $seo_title
 * @protected string $seo_keywords
 * @protected string $seo_description
 * @protected string $text_before
 * @protected string $text_after
 */

class Category extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kg_org_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alt_name', 'seo_title', 'seo_keywords', 'seo_description'], 'required'],
            [['seo_description'], 'string'],
            [['name', 'alt_name', 'seo_title', 'seo_keywords', 'text_before', 'text_after'], 'string', 'max' => 254],
            [['img'], 'string', 'max' => 512],
            [['img'], 'file', 'extensions' => 'jpg, jpeg, gif, png', 'skipOnEmpty' => true]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'alt_name' => 'Альтернативное название',
            'text_before' => 'Текст до',
            'img' => 'Картинка',
            'text_after' => 'Текст после',
            'seo_title' => 'Seo Title',
            'seo_keywords' => 'Seo Keywords',
            'seo_description' => 'Seo Description',
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {

            $this->alt_name = CString::translitTo($this->name);

            return true;
        }
        return false;
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            return true;
        } else {
            return false;
        }
    }
}