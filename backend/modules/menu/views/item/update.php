<?php

use yii\helpers\Html;

$this->registerAssetBundle('backend\assets\FileUploadAsset', \yii\web\View::POS_HEAD);

/**
 * @var yii\web\View $this
 * @var common\modules\menu\models\Menu $model
 */

$this->title = 'Обновить меню: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Меню', 'url' => ['index', 'group_id' => $group_id]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'group_id' => $group_id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="menu-update padding020">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
