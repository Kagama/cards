<?php
namespace common\behaviors;

use common\helpers\DUrlRulesHelper;
use yii\web\Application;

/**
 * Created by JetBrains PhpStorm.
 * User: Мухтар
 * Date: 03.10.13
 * Time: 16:21
 * To change this template use File | Settings | File Templates.
 */

class DModuleUrlRulesBehavior extends \yii\base\Behavior
{
    public $beforeCurrentModule = array();
    public $afterCurrentModule = array();

    public function events()
    {
        return [
            Application::EVENT_BEFORE_REQUEST => 'myBeginRequest',
        ];
    }

    public function myBeginRequest()
    {
        $dirs = scandir(dirname(__FILE__).'/../modules');

        $modules = array();
        foreach($dirs as $name)
        {
            if($name[0] != '.')
                $modules[$name] = ['class'=>'frontend\\modules\\'.$name."\\".ucfirst($name).'Module'];
        }


//        foreach(\Yii::$app->getModules() as $m_name => $name) {
//            print_r(dirname(__FILE__).'/../modules');
//            echo "<br />";
//        }
        foreach(\Yii::$app->getModules() as $m_name => $name) {
            if ($m_name != 'gii' &&  $m_name != 'redactor') {
                DUrlRulesHelper::import($m_name);
            }
        }

        /*
        $module = $this->_getModuleName();
        $list = array_merge(
            $this->beforeCurrentModule,
            array($module),
            $this->afterCurrentModule
        );

        foreach($list as $name) {
            DUrlRulesHelper::import($name);
        }
        */

    }

    protected function _getModuleName()
    {
        $route = Yii::app()->getRequest()->getPathInfo();
        $domains = explode('/',$route);
        $moduleName = array_shift($domains);
        return $moduleName;
    }

}