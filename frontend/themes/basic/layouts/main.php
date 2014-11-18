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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header>
    <div class="container">
        <div class="title six columns">

            <a href="/">КЛУБ ЧИСТЫХ АВТО</a>

        </div>
        <nav class="ten columns">
            <?php
            $menu = \common\modules\menu\models\Menu::find()->where(['group_id' => 1])->orderBy('position ASC')->all();
            ?>
            <ul>
                <?php
                foreach ($menu as $_m) {
                    echo Html::tag('li', Html::a($_m->name, \yii\helpers\Url::to(["/".$_m->url])));
                }
                ?>
<!--                <li><a href="">Главная</a></li>-->
<!--                <li><a href="">Организации</a></li>-->
<!--                <li><a href="">О клубе</a></li>-->
<!--                <li><a href="">Партнерам</a></li>-->
<!--                <li><a href="">Проверить карту</a></li>-->
            </ul>

        </nav>
    </div>
</header>

<?= Alert::widget() ?>
<?= $content ?>
<!-- Footer map -->

<section class="map-footer">


    <div id="fmap"></div>

    <div class="footinfo">
        <div class="container">
            <div class="info six columns">
                <h2>Клуб чистых авто</h2>
                <span>ул. Некрасова, 43/38</span>
                <span>Махачкала</span>
                <span>Республика Дагестан</span>
                <span class="phone">800 559 6580</span>
                <div class="socials">
                    <a class="i vk"></a>
                    <a class="i fb"></a>
                    <a class="i tw"></a>
                    <a class="i ok"></a>
                </div>
                <span class="cred">КЛУБ ЧИСТЫХ АВТО © 2014 • <a href="http://kagama.ru">KAGAMA</a></span>
            </div>
        </div>
    </div>

</section>

<!-- Javascript -->

<!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
