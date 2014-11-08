<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->registerAssetBundle('backend\assets\PostModuleAsset', \yii\web\View::POS_HEAD);

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\modules\faq\models\search\FaqSearch $searchModel
 */

$this->title = 'Вопрос ответ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-index padding020 widget">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'title',
            'question:ntext',
            'date:date',
            'answer:ntext',
            'answer_date:date',
            [
                'attribute' => 'category_id',
                'value' => function ($model, $index) {
                        return $model->category->name;
                    },
                'filter' => \yii\helpers\ArrayHelper::map(\common\modules\faq\models\FaqCategory::find()->all(), 'id', 'name')
            ],
            // 'user_id',
            // 'answer_date',
            // 'menu_id',
            // 'publish',
            // 'category_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
