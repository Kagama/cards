<?php
use backend\modules\admin\assets\AdminModuleAsset;
use yii\helpers\Url;

AdminModuleAsset::register($this);
// page specific js
//Yii::$app->view->registerAssetBundle('backend\modules\admin\assets\AdminModuleAsset', \yii\web\View::POS_END);
//$publish = Yii::$app->assetManager->publish(
//    Yii::getAlias('@app/web/js/lightblue')
//);
//print_r($publish);
//Yii::$app->view->jsFiles['backend\modules\admin\assets\AdminModuleAsset'] = 'js/lightblue/index.js';
//$this->registerJsFile($publish[1].'/index.js');
//$this->registerJsFile($publish[1].'/chat.js');
?>



<div class="content container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-title">Административная панель</h2>
        </div>
    </div>
</div>
