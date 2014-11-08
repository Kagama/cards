<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->registerAssetBundle('backend\assets\PostModuleAsset', \yii\web\View::POS_HEAD);

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\modules\menu\models\search\MenuGroupSearch $searchModel
 */

$this->title = 'Группа меню';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-group-index padding020 widget">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать группу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'position',
            [
                'attribute' => 'section_position',
                'value' => function ($model, $index) {
                    return $model->section_position_arr[$model->section_position];
                },
                'filter' => ['Шапка', 'Правый блок', 'Левый блок', 'Подвал']

            ],
            [
                'attribute' => 'active_status',
                'value' => function ($model, $index) {
                        return $model->active_status == 0 ? "Нет" : "Да";
                    },
                'filter' => ['Нет', 'Да'],

            ],
            [
                'label' => 'Меню',
                'value' => function ($model, $index) {
                        return Html::a('Управление пукнтами меню', ['/menu/item/index', 'group_id' => $model->id]);
                    },
                'format' => 'html'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
