<?php
/**
 * Created by PhpStorm.
 * User: pashaevs
 * Date: 21.11.14
 * Time: 19:06
 */

namespace frontend\modules\payment;

use common\componets\myModule;

class PaymentModule extends myModule
{
    public $controllerNamespace = 'frontend\modules\payment\controllers';

    public function init()
    {
        parent::init();
    }

    public function rules()
    {
        $ruleArr = [];
        $ruleArr['payment/success'] = 'payment/default/success';
        $ruleArr['payment/failed'] = 'payment/default/failed';
//        $ruleArr['reg/client'] = 'payment/default/do-pay';
        return $ruleArr;
    }
}