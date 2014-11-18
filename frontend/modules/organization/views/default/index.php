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
        <?php $form = \yii\widgets\ActiveForm::begin([
            'id' => "searchOrg",
            'method' => 'get',
            'action' => \yii\helpers\Url::to(['/'.$menu->url])
        ])?>
        <div class="item one-third column">
            <label for="">Город</label>
            <?php
            $city_var = Yii::$app->request->get('city');
            ?>
            <?= \yii\helpers\Html::dropDownList('city', $city_var, \yii\helpers\ArrayHelper::map(\common\modules\organization\models\City::find()->all(), "id", 'name'), ['prompt' => '---']) ?>
        </div>
        <div class="item one-third column">
            <label for="">Тип организации</label>
            <?php
            $category_var = Yii::$app->request->get('category');
            ?>
            <?= \yii\helpers\Html::dropDownList('category', $category_var, \yii\helpers\ArrayHelper::map(\common\modules\organization\models\Category::find()->all(), 'alt_name', 'name'), ['prompt' => '---']) ?>
        </div>
        <div class="item one-third column">
            <div class="button" onclick="$('#searchOrg').submit();">Показать</div>
        </div>
        <?php \yii\widgets\ActiveForm::end(); ?>
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