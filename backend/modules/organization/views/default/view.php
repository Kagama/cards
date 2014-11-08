<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 26.10.2014
 * Time: 0:28
 */
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->registerAssetBundle('backend\assets\PostModuleAsset', \yii\web\View::POS_HEAD);

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="organization-view padding020 widget">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Все организации', ['index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить запись?',
                'method' => 'post',
            ],
        ]) ?>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                'category' => [
                    'label' => 'Категория',
                    'value' => $model->cat->name,
                ],
                'working_time',
                'phone',
                'address',
                'longitude',
                'latitude',
                'description',
                'created_at' => [
                  'label' => 'Дата создания',
                    'value' => date('d.m.Y, H:i',$model->created_at),
                ],
                'updated_at' => [
                    'label' => 'Дата обновления',
                    'value' => date('d.m.Y, H:i',$model->updated_at),
                ],
                'seo_title',
                'seo_keywords',
                'seo_description'
            ]
        ]) ?>
    </p>
</div>