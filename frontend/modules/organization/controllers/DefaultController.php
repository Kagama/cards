<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 24.10.2014
 * Time: 13:40
 */
namespace frontend\modules\organization\controllers;

use common\modules\menu\models\Menu;
use common\modules\organization\models\Category;
use common\modules\organization\models\Organization;
use common\modules\organization\models\OrgSearch;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{
    public function actionIndex($menu_url)
    {
        $menu = Menu::find()->where(['url' => $menu_url])->one();

        $searchModel = new OrgSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        $dataProvider->pagination->pageSize = 9;
        return $this->render('index', [
            'menu' => $menu,
            'category' => null,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCategory($menu_url, $category_name)
    {
        $menu = Menu::find()->where(['url' => $menu_url])->one();
        $category = Category::find()->where(['alt_name' => $category_name])->one();

        $searchModel = new OrgSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        $dataProvider->query->andFilterWhere(['category' => $category->id]);
        $dataProvider->pagination->pageSize = 9;

        return $this->render('index', [
            'category' => $category,
            'menu' => $menu,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionShow($menu_url, $id, $alt_name)
    {
        $menu = Menu::find()->where(['url' => $menu_url])->one();

        $model = Organization::findOne((int) $id);
        if (empty($model))
            throw new NotFoundHttpException('Страница не найдена.');

        return $this->render('show', [
            'model' => $model,
            'menu' => $menu
        ]);
    }
}