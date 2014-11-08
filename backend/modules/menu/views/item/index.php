<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\widget\TreeViewWidget;

$this->registerAssetBundle('backend\assets\PostModuleAsset', \yii\web\View::POS_HEAD);

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\modules\menu\models\search\MenuSearch $searchModel
 */

$this->title = 'Меню';
$this->params['breadcrumbs'][] = $this->title;

$group_id = Yii::$app->request->get('group_id');
?>
<div class="menu-index padding020">
    <section class="widget">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::a('Создать', ['create', 'group_id' => $group_id], ['class' => 'btn btn-success']) ?>
        </p>

        <?=
        TreeViewWidget::widget([
            'model' => new \common\modules\menu\models\Menu(),
            'data' => $models,
            'options' => ['style' => 'width:100%;', 'class' => 'table table-bordered'],
            'columns' => [
                'id',
                'name',
                'position' => [
                    'field' => TreeViewWidget::INPUT_TEXT,
                    'ajaxUpdateUrl' => \yii\helpers\Url::to(['/menu/item/update-position']),
                    'options' => ['style' => 'width:40px;', 'maxlength' => '3', 'class' => 'position_input_update']
                ]
            ],
            'buttons' => [
                'update' => [
                    'title' => '<i class="fa fa-pencil"></i>',
                    'url' => '/menu/item/update',
                    'options' => ['class' => 'btn btn-default btn-xs']

                ],
                'view' => [
                    'title' => '<i class="fa fa-search"></i>',
                    'url' => '/menu/item/view',
                    'options' => ['class' => 'btn btn-primary btn-xs']
                ],
                'delete' => [
                    'title' => '<i class="fa fa-trash-o"></i>',
                    'url' => '/menu/item/delete',
                    'options' => [
                        'class' => 'btn btn-danger btn-xs',
                        'data' => [
                            'confirm' => 'Вы действительно хотите удалить запись?',
                            'method' => 'post',
                        ]
                    ]
                ]
            ]
        ]); ?>
    </section>
</div>
