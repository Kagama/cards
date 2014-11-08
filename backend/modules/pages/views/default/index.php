<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->registerAssetBundle('backend\assets\PostModuleAsset', \yii\web\View::POS_HEAD);

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\modules\pages\models\search\PagesSearch $searchModel
 */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index padding020 widget">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать страницу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'table table-striped dataTable', 'aria-describedby' => "datatable-table_info", 'id' => 'datatable-table'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'title',
//            'alt_title',
            'small_text:html',
//            'text:ntext',
            // 'seo_title',
            // 'seo_keywords',
            // 'seo_description:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                //'template' => '{view} {update} {delete}',
//                'buttons'=>[
//                    'view'=>function ($url, $model) {
//                            $customurl=Yii::$app->getUrlManager()->createUrl(['log/view','id'=>$model['id']]); //$model->id для AR
//                            return \yii\helpers\Html::a( '<span class="fa fa-edit"></span> aaaa', $customurl, ['title' => 'aaa', 'data-pjax' => '0']);
//                        }
//                ],
            ],
        ],
    ]); ?>

</div>
