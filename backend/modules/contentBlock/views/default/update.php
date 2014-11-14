<?php

use yii\helpers\Html;


$this->registerAssetBundle('backend\assets\PostModuleAsset', \yii\web\View::POS_HEAD);
/* @var $this yii\web\View */
/* @var $model common\modules\contentBlock\models\ContentBlock */

$this->title = 'Обновить: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Информационный блок', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="content-block-update padding020 widget">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
