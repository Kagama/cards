<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 25.06.14
 * Time: 15:27
 */


$this->title = $menu->seo_title." - ".Yii::$app->params['seo_title'];
Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $menu->seo_keywords]);
Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $menu->seo_description]);
?>
<!-- Контент -->
<div class="content">
    <div class="wrapper">

        <!-- Правая колонка -->
        <div class="right_cont">

            <h1>Контакты</h1>

            <?php

            $menus = \common\modules\menu\models\Menu::find()->where('group_id = 3')->orderBy('position ASC')->all();

            foreach ($menus as $index => $_menu) {
                ?>
                <div class="cont_block <?=($index == 0 ? "ruk" : "")?>">
                    <?php
                    if ($index == 0) {
                        ?>
                        <img src="/img/doc.png" alt=""/>
                    <?php
                    }
                    ?>
                    <a href="<?=\yii\helpers\Url::toRoute("/".$_menu->url)?>"><?=$_menu->name?></a>
                </div>
            <?php
            }
            ?>


            <?= \frontend\modules\review\widget\ReviewWidget::widget(); ?>

        </div>
        <!-- Конец правой колонки -->

        <div class="left_cont">

            <div class="big_info">
                <div class="title">
                    <?php
                    $titleArr = explode(' ',$model->title);
                    if (count($titleArr) > 2) {
                        foreach ($titleArr as $title) {
                            $str_len = strlen($title);
                            ?>
                            <span <?= (($str_len > 8 && $str_len < 20) ? "style='font-size:60%; line-height: 50px;'" : ($str_len > 20 ? "style='font-size:50%; line-height: 50px;'" : "")) ?>><?=$title?></span>
                        <?php
                        }
                    } else {
                        $str_len = strlen($model->title);
                    ?>
                        <span <?= (($str_len < 10) ? "style='font-size:60%; line-height: 50px;'" : ($str_len > 20 ? "style='font-size:50%; line-height: 50px;'" : "")) ?>><?=$model->title?></span>
                    <?php
                    }
                    ?>



                </div>
                <?php
                $string = strip_tags($model->small_text);
                $str_len = strlen($string);
                ?>
                <div class="desc" >

                    <p <?= ($str_len > 200 ? "style='font-size:12px; font-weight:normal;'" : "")?>>

                        <?= $string?>
<!--                        Заболевание, требующее экстренного оказания медицинской помощи-->
                    </p>
                </div>
            </div>

            <div class="article">

                <?=$model->text?>

                <?php
                if ($menu->url == "koordinacija_po_vashemu_zabolevaniju") {
                    echo \frontend\modules\main\widget\ContactForm::widget();
                }
                ?>

            </div>

        </div>

    </div>
</div>