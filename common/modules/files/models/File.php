<?php

namespace common\modules\files\models;

use Yii;

/**
 * This is the model class for table "t_kg_file".
 *
 * @property integer $id
 * @property string $model_name
 * @property integer $model_id
 * @property string $name
 * @property integer $src
 * @property string $mime_type
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kg_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_name', 'model_id', 'name', 'src', 'mime_type'], 'required'],
            [['model_id'], 'integer'],
            [['model_name', 'src'], 'string', 'max' => 512],
            [['name'], 'image', 'extensions' => 'jpeg, jpg, png, gif', 'on' => 'image', 'maxSize' => 52428800],
            [['name'], 'file', 'extensions' => 'doc, docx, xls, xlsx, txt, pdf', 'on' => 'doc', 'maxSize' => 20971520],
            [['mime_type'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model_name' => 'Название модели',
            'model_id' => 'Номер модели',
            'name' => 'Имя файлв',
            'src' => 'Путь к файлу',
            'mime_type' => 'Тип файла',
        ];
    }

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'common\behaviors\CachedImageResolution',
                'attr_src' => 'src',
                'attr_img_name' => 'name',
            ]
        ];
    }
}
