<?php

use yii\helpers\Html;

$this->registerAssetBundle('backend\assets\FileUploadAsset', \yii\web\View::POS_HEAD);

/**
 * @var yii\web\View $this
 * @var common\modules\menu\models\Menu $model
 */
$group_id = Yii::$app->request->get('group_id');

$this->title = 'Создать пукнт меню';
$this->params['breadcrumbs'][] = ['label' => 'Меню', 'url' => ['index', 'group_id' => $group_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create padding020 ">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
