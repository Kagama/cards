<?php

namespace frontend\modules\main;

use common\componets\myModule;

class MainModule extends myModule
{
    public $controllerNamespace = 'frontend\modules\main\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function rules () {

        $ruleArr = [
            '/' => 'main/default/index',
            'review/all'=>'main/review/index',
        ];
        return $ruleArr;
    }
}
