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

$this->title = 'Логи оплаты';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="payment-index padding020 widget">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'status',
            'sum',
            'car_number',
            'card_number',
            [
                'attribute'=> 'date',
                'value' => function ($model) {
                    return date('d.m.Y, H:i', $model->date);
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
            ],

        ],
    ]);
    ?>
</div>