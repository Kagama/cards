<?php

namespace common\modules\menu\models;

use Yii;

/**
 * This is the model class for table "t_kg_menu_group".
 *
 * @property integer $id
 * @property string $name
 * @property integer $position
 * @property integer $section_position
 * @property integer $active_status
 */
class MenuGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $section_position_arr = ['Шапка', 'Правый блок', 'Левый блок', 'Подвал'];

    public static function tableName()
    {
        return 't_kg_menu_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'section_position'], 'required'],
            [['position', 'section_position', 'active_status'], 'integer'],
            [['name'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название группы',
            'position' => 'Позиция',
            'section_position' => 'Позиция в секции',
            'active_status' => 'Активный',
        ];
    }

    public  function sections() {
        return $this->section_position_arr;
    }
}
