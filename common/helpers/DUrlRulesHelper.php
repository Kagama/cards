<?php
namespace common\helpers;
/**
 * Created by JetBrains PhpStorm.
 * User: Мухтар
 * Date: 03.10.13
 * Time: 17:35
 * To change this template use File | Settings | File Templates.
 */

use Yii;
/**
 * Class DUrlRulesHelper
 * This is class for import url rules which module
 */
class DUrlRulesHelper
{
    /**
     * @var
     */
    protected static $data = array();

    /**
     * @param $moduleName
     */
    public static function import($moduleName)
    {

        if($moduleName && Yii::$app->hasModule($moduleName))
        {

            if (!isset(self::$data[$moduleName]))
            {

                $class = ucfirst($moduleName).'Module';
//                var_dump($moduleName . '/' . $class);
//                var_dump(Yii::$app->getModule($moduleName)->rules());
//                die();
//                Yii::import($moduleName . '.' . $class);
                if (Yii::$app->hasModule($moduleName)) {

                    if ($moduleName == 'debug') return;
                    $rules = Yii::$app->getModule($moduleName)->rules();
                    $urlManager = Yii::$app->getUrlManager();
//                var_dump($urlManager->className());
//                die();
                    if (!empty($rules))
                    {
                        $urlManager->addRules($rules, true);
                    }
                    self::$data[$moduleName] = true;
                }

            }
        }

    }





}