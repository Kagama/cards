<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 12.07.14
 * Time: 19:04
 */

namespace beckend\modules;

class AppModule extends \common\modules\appmodule\AppModule
{
    public $controllerNamespace = 'backend\modules\appmodule\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}