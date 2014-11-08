<?php

namespace backend\modules\pages;

class PagesModule extends \common\modules\pages\PagesModule
{
    public $controllerNamespace = 'backend\modules\pages\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
//            echo $action->id;
            // your custom code here
            return true;  // or false if needed
        } else {
            return false;
        }
    }
}
