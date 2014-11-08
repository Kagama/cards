<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->registerAssetBundle('backend\assets\PostModuleAsset', \yii\web\View::POS_HEAD);

/**
 * @var yii\web\View $this
 * @var common\modules\menu\models\Menu $model
 */

$group_id = Yii::$app->request->get('group_id');
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Меню', 'url' => ['index', 'group_id' => $group_id]];
$this->params['breadcrumbs'][] = $this->title;

$group_id = Yii::$app->request->get('group_id');
?>
<div class="menu-view padding020 widget">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Список', ['index', 'group_id' => $group_id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Создать', ['create', 'group_id' => $group_id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Обновить', ['update', 'id' => $model->id, 'group_id' => $group_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id, 'group_id' => $group_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'parent_id',
            'name',
            'alt_name',
            'url:url',
            'seo_title',
            'seo_keywords',
            'seo_description:ntext',
            'group_id',
            'position',
            'level',
            'module_id',
            'module_model_id',
        ],
    ]) ?>

</div>
