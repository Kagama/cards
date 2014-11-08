<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <title><?= Html::encode($this->title) ?></title>
    <meta name="description" content="<?= "" ?>"/>
    <meta name="keywords" content="<?= "" ?>"/>
    <?php $this->head() ?>
    <?php
    if (Yii::$app->controller->action->id == 'contact') {
        ?>
        <script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <?php
    }
    ?>


</head>
<body>
<?php $this->beginBody() ?>

<?= Alert::widget() ?>
<div class="container">
<?= $content ?>

</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
