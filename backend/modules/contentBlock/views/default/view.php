<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->registerAssetBundle('backend\assets\PostModuleAsset', \yii\web\View::POS_HEAD);

/* @var $this yii\web\View */
/* @var $model common\modules\contentBlock\models\ContentBlock */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Информационный блок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-block-view padding020 widget">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Список', ['create'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Создать информационный блок', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'content:html',
            'visible',
        ],
    ]) ?>

</div>
