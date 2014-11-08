<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 17.05.14
 * Time: 13:26
 */
namespace backend\assets;

use Yii;
use yii\web\AssetBundle;
class BaseAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/lightblue/application.min.css',
        'css/site.css',
    ];
    public $js = [
        'lib/lightblue/jquery/jquery-2.0.3.min.js',
        'lib/lightblue/jquery-pjax/jquery.pjax.js',
        'lib/lightblue/icheck.js/jquery.icheck.js',
        'lib/lightblue/sparkline/jquery.sparkline.js',
        'lib/lightblue/jquery-ui-1.10.3.custom.js',

        'lib/lightblue/bootstrap/transition.js',
        'lib/lightblue/bootstrap/collapse.js',
        'lib/lightblue/bootstrap/alert.js',
        'lib/lightblue/bootstrap/tooltip.js',
        'lib/lightblue/bootstrap/popover.js',
        'lib/lightblue/bootstrap/button.js',
        'lib/lightblue/bootstrap/tab.js',
        'lib/lightblue/bootstrap/dropdown.js',
        'lib/lightblue/bootstrap/modal.js',
        'lib/lightblue/bootstrap/carousel.js',
        'lib/lightblue/bootstrap-datepicker.js',
        'lib/lightblue/bootstrap-select/bootstrap-select.js',
        'lib/lightblue/bootstrap-datepicker.js',
        'lib/lightblue/bootstrap-select/bootstrap-select.js',
        'lib/lightblue/bootstrap-switch.js',
        'lib/lightblue/bootstrap-colorpicker.js',
        "lib/lightblue/jquery-maskedinput/jquery.maskedinput.js",


        'lib/lightblue/wysihtml5/wysihtml5-0.3.0_rc2.js',
        'lib/lightblue/bootstrap-wysihtml5/bootstrap-wysihtml5.js'

    ];
    public $depends = [
//        'backend\assets\BaseAsset',
    ];
}