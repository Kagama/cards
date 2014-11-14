<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 17.05.14
 * Time: 13:26
 */
namespace backend\modules\layoutEditor\assets;

use Yii;
use yii\web\AssetBundle;

class AceEditorAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/ace/noconflict/ace.js'
    ];
    public $depends = [
        'backend\assets\AppAsset',
    ];
}