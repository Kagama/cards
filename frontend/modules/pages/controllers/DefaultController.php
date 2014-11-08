<?php

namespace frontend\modules\pages\controllers;

use common\modules\menu\models\Menu;
use common\modules\pages\models\Pages;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionShow($menu_url)
    {
        $menu = Menu::find()->where('url = :url', [':url' => $menu_url])->one();

        $model = Pages::findOne($menu->module_model_id);

        return $this->render('show', [
            'model' => $model,
            'menu' => $menu
        ]);
    }

    public function actionContact()
    {
        return $this->render('contact');
    }
}
