<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 25.10.2014
 * Time: 14:22
 */
use yii\helpers\Html;
use yii\grid\GridView;

$this->registerAssetBundle('backend\assets\PostModuleAsset', \yii\web\View::POS_HEAD);

$this->title = 'Карты';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card-index padding020 widget">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить карту', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Добавить несколько карт', ['create-many'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'active',
                'value' => function ($model) {
                    return ($model->active == null ? "Нет" : "Да");
                },
                'filter' => [null => "Не используется", 1 => "Используется"],
            ],
            'discount_card',
            [
                'attribute' => 'end_date',
                'value' => function ($model) {
                    return ($model->end_date == null ? '-' : date('d.m.Y, H:i', $model->end_date));
                },
            ],
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return ($model->user_id == null ? '-' : $model->user_id);
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>