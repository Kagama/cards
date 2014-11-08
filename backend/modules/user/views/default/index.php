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
            'username',
            'surname',
            'name',
            'discount_card',
            'car_number',
            [
                'attribute' => 'city',
                'value' => function ($model) {
                    var_dump($model->city->name);
                    return $model->city->name;
                },
                'filter' => \yii\helpers\ArrayHelper::map(\common\modules\organization\models\City::find()->all(), 'id', 'name')

            ],
            'phone',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>