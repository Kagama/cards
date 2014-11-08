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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [
        'lib/lightblue/jquery.slimscroll.js',
        'lib/lightblue/nvd3/lib/d3.v2.js',
        'lib/lightblue/nvd3/nv.d3.custom.js',
        'lib/lightblue/nvd3/src/models/scatter.js',
        'lib/lightblue/nvd3/src/models/axis.js',
        'lib/lightblue/nvd3/src/models/legend.js',
        'lib/lightblue/nvd3/src/models/multiBar.js',
        'lib/lightblue/nvd3/src/models/multiBarChart.js',
        'lib/lightblue/nvd3/src/models/line.js',
        'lib/lightblue/nvd3/src/models/lineChart.js',
        'lib/lightblue/nvd3/stream_layers.js',
        'lib/lightblue/backbone/underscore-min.js',
        'lib/lightblue/backbone/backbone-min.js',
        'lib/lightblue/backbone/backbone.localStorage-min.js',

        'js/lightblue/app.js',
        'js/lightblue/settings.js'
    ];
    public $depends = [
        'backend\assets\BaseAsset',
    ];
}
