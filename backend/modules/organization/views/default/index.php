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

$this->title = 'Организации';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="organization-index padding020 widget">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить организацию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'phone',
            [
                'attribute' => 'city',
                'value' => function ($model) {
                    return ($model->cityObj == null ? "-" : $model->cityObj->name);
                },
                'filter' => \yii\helpers\ArrayHelper::map(\common\modules\organization\models\City::find()->all(), 'id', 'name')
            ],
            [
                'attribute' => 'category',
                'value' => function ($model) {
                    return ($model->cat == null ? "-" : $model->cat->name);
                },
                'filter' => \yii\helpers\ArrayHelper::map(\common\modules\organization\models\Category::find()->all(), 'id', 'name')

            ],
            'address',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>