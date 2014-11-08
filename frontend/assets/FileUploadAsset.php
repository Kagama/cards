<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class FileUploadAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [
        'lib/lightblue/jquery-pjax/jquery.pjax.js',
        'lib/lightblue/vendor/jquery.ui.widget.js',
        'lib/lightblue/vendor/http_blueimp.github.io_JavaScript-Templates_js_tmpl.js',
        'lib/lightblue/vendor/http_blueimp.github.io_JavaScript-Load-Image_js_load-image.js',
        'lib/lightblue/vendor/http_blueimp.github.io_JavaScript-Canvas-to-Blob_js_canvas-to-blob.js',
        'lib/lightblue/jquery.iframe-transport.js',
        'lib/lightblue/jquery.fileupload.js',
        'lib/lightblue/jquery.fileupload-fp.js',
        'lib/lightblue/jquery.fileupload-ui.js',
        'lib/lightblue/parsley/parsley.js',
        'lib/lightblue/select2.js',
        'js/lightblue/fileupload.js',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
