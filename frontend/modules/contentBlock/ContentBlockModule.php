<?php

namespace frontend\modules\contentBlock;
use common\componets\myModule;

class ContentBlockModule extends myModule
{
    public $controllerNamespace = 'frontend\modules\contentBlock\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    public function rules () {
        return [];
    }
}
