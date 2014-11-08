<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 24.08.14
 * Time: 19:35
 */

namespace common\helpers;

use yii\bootstrap\Nav;

class MyNav extends Nav
{

    public function run()
    {
        echo $this->renderItems();
    }
}