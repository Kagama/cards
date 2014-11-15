<?php
/**
 * Created by PhpStorm.
 * User: pashaevs
 * Date: 04.11.14
 * Time: 18:06
 */
use yii\helpers\Html;

$this->registerAssetBundle('backend\assets\PostModuleAsset', \yii\web\View::POS_HEAD);

/* @var $this yii\web\View */

$this->title = 'Редактирование страниц';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="layout-editor-index padding020 widget">
    <h1><?= Html::encode($this->title) ?></h1>

    <ul>
        <li><span>Layout</span>
            <ul>
                <li><a href="<?=\yii\helpers\Url::to(['/layoutEditor/default/edit', 'file' => Yii::getAlias('@frontend/themes/basic/layouts/main.php')])?>" class="edit"><span class="fa  fa-edit"></span></a> main.php</li>
            </ul>
        </li>
        <li>
            <span>Модули</span>
            <ul>
                <li><span>Посты</span>
                    <ul>
                        <li><a href="<?=\yii\helpers\Url::to(['/layoutEditor/default/edit', 'file' => Yii::getAlias('@frontend/modules/post/views/default/all.php')])?>" class="edit"><span class="fa  fa-edit"></span></a> all.php</li>
                        <li><a href="<?=\yii\helpers\Url::to(['/layoutEditor/default/edit', 'file' => Yii::getAlias('@frontend/modules/post/views/default/category.php')])?>" class="edit"><span class="fa  fa-edit"></span></a> category.php</li>
                        <li><a href="<?=\yii\helpers\Url::to(['/layoutEditor/default/edit', 'file' => Yii::getAlias('@frontend/modules/post/views/default/index.php')])?>" class="edit"><span class="fa  fa-edit"></span></a> index.php</li>
                        <li><a href="<?=\yii\helpers\Url::to(['/layoutEditor/default/edit', 'file' => Yii::getAlias('@frontend/modules/post/views/default/show.php')])?>" class="edit"><span class="fa  fa-edit"></span></a> show.php</li>
                        <li><a href="<?=\yii\helpers\Url::to(['/layoutEditor/default/edit', 'file' => Yii::getAlias('@frontend/modules/post/views/default/_news_item.php')])?>" class="edit"><span class="fa  fa-edit"></span></a> _news_item.php</li>
                    </ul>
                </li>
            </ul>
            <ul>
                <li><span>Страницы</span>
                    <ul>
                        <li><a href="<?=\yii\helpers\Url::to(['/layoutEditor/default/edit', 'file' => Yii::getAlias('@frontend/modules/pages/views/default/contact.php')])?>" class="edit"><span class="fa  fa-edit"></span></a> contact.php</li>
                        <li><a href="<?=\yii\helpers\Url::to(['/layoutEditor/default/edit', 'file' => Yii::getAlias('@frontend/modules/pages/views/default/show.php')])?>" class="edit"><span class="fa  fa-edit"></span></a> show.php</li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</div>