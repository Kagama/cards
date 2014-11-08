<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 20.07.14
 * Time: 23:32
 */
?>
<!--<div class="container">-->
<div class="row">
    <h1 style="margin-left: 20px; padding-bottom: 10px;">Список организаций: </h1>
    <div class="col-lg-9">
        <div class="row">
            <?=
            \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'layout' => '<div class="col-lg-12">{items}</div> <div class="clearfix"></div> <div class="col-lg-12">{pager}</div>',
                'itemView' => '_org',
                'emptyText' => '- Нет организаций -',
//                'viewParams' => ['menu' => $menu],
                'showOnEmpty' => '-',
//            'itemOptions' => [
//                'tag' => 'article'
//            ],
                'pager' => [
                    'prevPageLabel' => '&nbsp;',
                    'nextPageLabel' => '&nbsp;'
                ]
            ])
            ?>
        </div>

    </div>
</div>
<!--</div>-->