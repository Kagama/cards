<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 26.10.2014
 * Time: 0:28
 */


use yii\helpers\Html;

$this->registerAssetBundle('backend\assets\PostModuleAsset', \yii\web\View::POS_HEAD);

$this->title = 'Обновить категорию: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => 'Обновить'];
?>
<div class="cat-update padding020 widget">
    <h1><?= Html::encode($this->title) ?> </h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>