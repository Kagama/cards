<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/fancySelect.css'
    ];
    public $js = [
        'js/jquery.MultiFile.js',
        'js/fancySelect.js',
        'js/FileUpload/jquery.ui.widget.js',
        'js/FileUpload/jquery.iframe-transport.js',
        'js/FileUpload/jquery.fileupload.js',
        'js/scripts.js',


//        'js/ajaxFormSubmit.js'
//        'js/jquery-fileupload.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
