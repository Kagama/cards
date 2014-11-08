<?php

namespace common\modules\appmodule\models;

use Yii;

/**
 * This is the model class for table "t_kg_module".
 *
 * @property integer $id
 * @property string $name
 * @property string $module_name
 * @property string $object_name
 * @property integer $subentries
 */
class Module extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kg_module';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subentries'], 'integer'],
            [['name', 'module_name', 'object_name'], 'string', 'max' => 512]
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
            'module_name' => 'Модуль',
            'object_name' => 'Модель',
            'subentries' => 'Вложенные записи',
        ];
    }
}
