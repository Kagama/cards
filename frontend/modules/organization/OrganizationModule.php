<?php

namespace frontend\modules\organization;

use common\componets\myModule;
use common\modules\appmodule\models\Module;
use common\modules\menu\models\Menu;

class OrganizationModule extends myModule
{
    public $controllerNamespace = 'frontend\modules\organization\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function rules () {

        $module = Module::find()->where('module_name = :name', [':name' => "organization"])->one();
        $menuArr = Menu::find()->where('module_id = :m_id', ['m_id' => $module->id])->all();

        $url = "";
        $ruleArr = [];
        foreach ($menuArr as $item) {
            $ruleArr['<menu_url:('.str_replace("/", "\/",$item->url).')>'] = 'organization/default/index';
//            $ruleArr['<menu_url:('.str_replace("/", "\/",$item->url).')>/<category_name:\w+>'] = 'organization/default/category';
            $ruleArr['<menu_url:('.str_replace("/", "\/",$item->url).')>/<id:\d+>/<alt_name:\w+>'] = 'organization/default/show';
        }

        return $ruleArr;
    }
}
