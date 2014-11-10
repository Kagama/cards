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

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-index padding020 widget">
    <h1><?= Html::encode($this->title) ?></h1>

<!--    <p>-->
<!--        --><?//= Html::a('Добавить организацию', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'username',
                'value' => function ($model) {
                    return $model->username == null ? "-" : $model->username;
                }
            ],
            [
                'attribute' => 'surname',
                'value' => function ($model) {
                    return $model->surname == null ? "-" : $model->surname;
                }
            ],
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return $model->name == null ? "-" : $model->name;
                }
            ],
            [
                'attribute' => 'discount_card',
                'value' => function ($model) {
                    return $model->discount_card == null ? "-" : $model->discount_card;
                }
            ],
            [
                'attribute' => 'car_number',
                'value' => function ($model) {
                    return $model->car_number == null ? "-" : $model->car_number;
                }
            ],
            [
                'attribute' => 'city',
                'value' => function ($model) {
                    return $model->city == null ? "-" : $model->city;
                },
                'filter' => \yii\helpers\ArrayHelper::map(\common\modules\organization\models\City::find()->all(), 'id', 'name')

            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>