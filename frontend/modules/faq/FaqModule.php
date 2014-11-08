<?php

namespace frontend\modules\faq;

use common\componets\myModule;
use common\modules\appmodule\models\Module;
use common\modules\menu\models\Menu;

class FaqModule extends myModule
{
    public $controllerNamespace = 'frontend\modules\faq\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function rules()
    {
        $module = Module::find()->where('module_name = :name', [':name' => "faq"])->one();
        $menuArr = Menu::find()->where('module_id = :m_id', ['m_id' => $module->id])->all();

        $url = "";
        foreach ($menuArr as $menu) {
            $url .= (empty($str) ? "" : "|" ).$menu->alt_name;
        }
        $ruleArr = [
            '<menu_alt_name:('.($url == "" ? "faq" : $url).')>' => 'faq/default/index',
            '<menu_alt_name:('.($url == "" ? "faq" : $url).')>/<cat_alt:\w+>' => "faq/default/index",
            'faq/captcha' => 'faq/default/captcha',
        ];
        return $ruleArr;
    }
}
