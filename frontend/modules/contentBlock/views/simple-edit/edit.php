<?php
use yii\helpers\Html;
//use yii\widgets\Breadcrumbs;
//use frontend\assets\AppAsset;
//use frontend\widgets\Alert;



//AppAsset::register($this);


//$this->registerAssetBundle('frontend\assets\AppAsset', \yii\web\View::POS_HEAD);
/**
 * @var yii\web\View $this
 * @var common\modules\post\models\Post $model
 */

?>
<?php //$this->beginPage() ?>
<!--<!DOCTYPE html>-->
<!--<html lang="--><?//= Yii::$app->language ?><!--">-->
<!--<head>-->
<!--    <meta charset="--><?//= Yii::$app->charset ?><!--"/>-->
<!--    <title>--><?//= Html::encode($this->title) ?><!--</title>-->
<!--    --><?php //$this->head() ?>
<!--</head>-->
<!--<body>-->
<?php //$this->beginBody() ?>
<div class="news-update padding020 widget">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= \frontend\widgets\Alert::widget() ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php //$this->endBody() ?>
<!--</body>-->
<!--</html>-->
<?php //$this->endPage() ?>


