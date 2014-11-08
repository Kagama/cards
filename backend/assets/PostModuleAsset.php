<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PostModuleAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'lib/lightblue/jquery-maskedinput/jquery.maskedinput.js',
        'lib/lightblue/parsley/parsley.js',
        'lib/lightblue/icheck.js/jquery.icheck.js',
        'lib/lightblue/select2.js',
        'lib/lightblue/backbone/underscore-min.js',
        'js/lightblue/forms.js',
    ];
    public $depends = [
        'backend\assets\AppAsset',
    ];
}
