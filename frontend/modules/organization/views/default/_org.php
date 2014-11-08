<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 21.07.14
 * Time: 0:19
 */
use yii\helpers\Html;
use yii\helpers\Url;

$this->params['breadcrumbs'] = [
    ['label' => 'Организации', 'url' => null],
]; ?>
    <div class="organization-item">
        <div class="row">
            <div class="col-lg-2">

            </div>
            <div class="col-lg-10">
                <?= '<h3 class="title">'.$model->cat->name. " " . $model->name.'</h3>'?>

                <div class="description">
                    <?= $model->description; ?>
                </div>
                <p class="contact-info"><span>Адрес:</span> <?= $model->address ?></p>
                <p class="contact-info"><span>Тел:</span> <?= $model->phone ?></p>
            </div>
        </div>
    </div>