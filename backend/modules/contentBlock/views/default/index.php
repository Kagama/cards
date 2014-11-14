<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->registerAssetBundle('backend\assets\PostModuleAsset', \yii\web\View::POS_HEAD);

/* @var $this yii\web\View */
/* @var $searchModel common\modules\contentBlock\models\search\ContentBlockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Информационный блок';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-block-index padding020 widget">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать информационный блок', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
//            'content:html',
            [
                'attribute' => 'visible',
                'value' => function ($model, $action) {
                    return ($model->visible == 1 ? "Отобразить" : "Скрыть");
                },
                'filter' => ["Скрыть", "Отобразить"]
            ],
//            'visible',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
