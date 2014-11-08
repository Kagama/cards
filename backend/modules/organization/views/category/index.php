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

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="category-index padding020 widget">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>