<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 25.06.14
 * Time: 15:27
 */


$this->title = $menu->seo_title . " - " . Yii::$app->params['seo_title'];
Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $menu->seo_keywords]);
Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $menu->seo_description]);
?>
<!-- Контент -->
<section class="why-we">
    <div class="container">
        <div class="sixteen collumns">
<!--            <h1>--><?//=$model->title?><!--</h1>-->
            <?= $model->text ?>
            <?php
            if ($menu->url == "koordinacija_po_vashemu_zabolevaniju") {
                echo \frontend\modules\main\widget\ContactForm::widget();
            }
            ?>
        </div>
    </div>
</section>