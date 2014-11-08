<?php

namespace common\modules\menu\models;

use common\helpers\CString;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "t_kg_menu".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $alt_name
 * @property string $url
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 * @property integer $group_id
 * @property integer $position
 * @property integer $level
 * @property integer $module_id
 * @property integer $module_model_id
 * @property string $template
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kg_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'group_id', 'position', 'module_id', 'module_model_id'], 'integer'],
            [['name', 'alt_name', 'group_id'], 'required'],
            [['seo_description', 'template'], 'string'],
            [['name', 'alt_name', 'url', 'seo_title', 'seo_keywords'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Владелец',
            'name' => 'Название',
            'alt_name' => 'Альтернативное название',
            'url' => 'Url',
            'seo_title' => 'SEO Заголовок',
            'seo_keywords' => 'SEO Ключевые слова',
            'seo_description' => 'SEO Описание',
            'group_id' => 'Название группы меню',
            'position' => 'Позиция',
            'level' => 'Level',
            'module_id' => 'Номер модуля',
            'module_model_id' => 'Номер модели модуля',
            'template' => 'Шаблон вывода (HTML)'
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->alt_name = CString::translitTo($this->name);
            $path = "";
            if ($this->parent_id != null) {
                $obj = Menu::findOne($this->parent_id);
                $this->level = empty($obj) ? 0 : ($obj->level + 1);
                $path = $obj->url;
            }
            $path = ($path != "" ? $path . '/' : "");
            /**
             * Если модуль равен -1 значит это главная страница
             * Путь к главной странице равен "" смотрите конфиг файл urlManager->rules
             */
            if ($this->module_id != -1) {
                $path = ($path != "" ? $path . '/' : "");
                $path .= $path . $this->alt_name;
            } else {
                $path = "/";
            }
            $this->url = $path;

            return true;
        }
        return false;
    }

//    public function afterSave($insert) {
//        $path = "";
//        if ($this->parent_id != null) {
//            $parentModel = Menu::findOne($this->parent_id);
//            $path = $parentModel->url;
//        } else {
//            $path = "";
//        }
////        $menu = Menu::findOne($this->getPrimaryKey());
//        $path = ($path != "" ? $path. '/' : "");
////        $menu->url =  $path . $this->alt_name;
//        $this->updateAttributes(['url' => $path . $this->alt_name]);
//
//        parent::afterSave($insert);
//    }

    public static function renderByTemplate($group_id)
    {
        $menuArr = static::find()->where('group_id = :id ', [':id' => $group_id])->orderBy('position ASC')->all();
        $html = "";
        foreach ($menuArr as $menu) {
            $html .= $menu->_render();
        }
        return $html;
    }

    private function _render()
    {
        $template = $this->template;
        $template = str_replace('{url}', Url::toRoute("/".$this->url), $template);
        $template = str_replace('{title}', $this->name, $template);
        return $template;
    }
}
