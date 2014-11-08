<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 16.05.14
 * Time: 19:37
 */
namespace backend\themes\lightblue\assets;

use Yii;
use yii\web\AssetBundle;

class LightBlueAsset extends AssetBundle {
    public $sourcePath = '@backend/themes/lightblue/assets/source';
    public $css = [
        'css/application.min.css',
    ];
    public $js = [
        'lib/jquery/jquery-2.0.3.min.js',
        'lib/jquery-pjax/jquery.pjax.js',
        'lib/icheck.js/jquery.icheck.js',
        'lib/sparkline/jquery.sparkline.js',
        'lib/jquery-ui-1.10.3.custom.js',
        'lib/jquery.slimscroll.js',
        'lib/nvd3/lib/d3.v2.js',
        'lib/nvd3/nv.d3.custom.js',
        'lib/nvd3/src/models/scatter.js'
    ];
    public $depends = [
//        'yii\web\JqueryAsset',
    ];
}