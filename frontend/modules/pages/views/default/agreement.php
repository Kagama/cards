<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 25.06.14
 * Time: 15:27
 */


$this->title = $page->seo_title . " - " . Yii::$app->params['seo_title'];
Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $page->seo_keywords]);
Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $page->seo_description]);
?>
<!-- Контент -->
<section class="why-we">
    <div class="container">
        <div class="sixteen collumns">
            <!--            <h1>--><?//=$model->title?><!--</h1>-->
            <?= $page->text ?>
        </div>
    </div>
</section>