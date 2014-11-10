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

$this->title = $model->discount_card;
$this->params['breadcrumbs'][] = ['label' => 'Карты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="card-view padding020 widget">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Все карты', ['index'], ['class' => 'btn btn-default']) ?>
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
                'active' => [
                    'label' => 'Используется',
                    'value' => $model->active == null ? "Нет" : "Да",
                ],
                'discount_card',
                'end_date' => [
                    'label' => 'Дата окончания действия скидки',
                    'value' => $model->end_date == null ? '-' : date('d.m.Y, H:i', $model->end_date),
                ],
                'user_id' => [
                    'label' => 'ID пользователя',
                    'value' => $model->user_id == null ? '-' : $model->user_id,
                ],
                'registration_date' => [
                    'label' => 'Дата регистрации карты',
                    'value' => $model->registration_date == null ? '-' : date('d.m.Y, H:i', $model->registration_date),
                ],
                'last_payment' => [
                    'label' => 'Дата последней оплаты',
                    'value' => $model->last_payment == null ? '-' : date('d.m.Y, H:i', $model->last_payment == null ? '-' : $model->last_payment),
                ],
            ]
        ]) ?>
    </p>
</div>