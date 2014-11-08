<?php

namespace frontend\modules\user;

class UserModule extends \common\modules\user\UserModule
{
    public $controllerNamespace = 'frontend\modules\user\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
