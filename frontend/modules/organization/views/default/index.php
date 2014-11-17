<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 20.07.14
 * Time: 23:32
 */
?>
<!-- Org select -->

<section class="organizations">
    <div class="container">
        <h1>Организации</h1>
        <form action="">
            <div class="item one-third column">
                <label for="">Город</label>
                <?=\yii\helpers\Html::dropDownList('city', '', \yii\helpers\ArrayHelper::map(\common\modules\organization\models\City::find()->all(), "id", 'name'), ['prompt' => '---'])?>
            </div>
            <div class="item one-third column">
                <label for="">Тип организации</label>
                <?= \yii\helpers\Html::dropDownList('category', ($category == null ? '' : $category->alt_name), \yii\helpers\ArrayHelper::map(\common\modules\organization\models\Category::find()->all(), 'alt_name', 'name'), ['prompt' => '---'])?>
            </div>
            <div class="item one-third column">
                <label for=""></label>
                <div class="button">Показать все на карте</div>
            </div>
        </form>
    </div>
</section>

<!-- List -->

<section class="org-list">
    <div class="container">

            <?=
            \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'layout' => '<div >{items}</div> <br style="clear: both"/> {pager}',
                'itemView' => '_org',
                'emptyText' => '- Нет организаций -',
                'viewParams' => ['menu' => $menu],
                'showOnEmpty' => '-',
//            'itemOptions' => [
//                'tag' => 'article'
//            ],
                'pager' => [
                    'prevPageLabel' => '<<',
                    'nextPageLabel' => '>>'
                ]
            ])
            ?>

<!--        <div class="pager">-->
<!--            <div class="pg prev"><<</div>-->
<!--            <div class="pg active">1</div>-->
<!--            <div class="pg">2</div>-->
<!--            <div class="pg">3</div>-->
<!--            <div class="pg">4</div>-->
<!--            <div class="pg">5</div>-->
<!--            <div class="pg next">>></div>-->
<!--        </div>-->
    </div>
</section>