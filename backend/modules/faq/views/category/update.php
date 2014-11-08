<?php

use yii\helpers\Html;
$this->registerAssetBundle('backend\assets\PostModuleAsset', \yii\web\View::POS_HEAD);


/**
 * @var yii\web\View $this
 * @var common\modules\faq\models\Faq $model
 */

$this->title = 'Обновить Категорию: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Вопрос-Ответ Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="faq-update padding020 widget">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
