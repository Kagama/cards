<?php

namespace frontend\modules\pages;

use common\componets\myModule;
use common\modules\appmodule\models\Module;
use common\modules\menu\models\Menu;

class PagesModule extends myModule
{
    public $controllerNamespace = 'frontend\modules\pages\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function rules () {

        $module = Module::find()->where('module_name = :name', [':name' => "pages"])->one();
        $menuArr = Menu::find()->where('module_id = :m_id', ['m_id' => $module->id])->all();

        $url = "";
        $ruleArr = [];
        foreach ($menuArr as $item) {
            $ruleArr['<menu_url:('.str_replace("/", "\/",$item->url).')>'] = 'pages/default/show';
        }
        $ruleArr['contacts'] = 'pages/default/contact';
        return $ruleArr;
    }
}
