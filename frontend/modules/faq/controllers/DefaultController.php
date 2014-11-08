<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 22.07.14
 * Time: 22:43
 */


namespace frontend\modules\faq\controllers;


use common\modules\faq\models\FaqCategory;
use common\modules\faq\models\search\FaqSearch;
use common\modules\menu\models\Menu;
use frontend\modules\faq\models\FaqForm;
use Yii;
use yii\web\Controller;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;


class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function actionIndex($menu_alt_name, $cat_alt = null)
    {
        $faqForm = new FaqForm();
        $menu = Menu::find()->where('alt_name = :alt_name', [':alt_name' => $menu_alt_name])->one();

        // Категория
        if ($cat_alt == null) {
            $category = FaqCategory::findOne(1);
        } else {
            $category = FaqCategory::find()->where('alt_name = :alt', [':alt' => $cat_alt])->one();
        }




        $searchModel = new FaqSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        $dataProvider->query->andFilterWhere(['category_id' => $category->id]);
        $dataProvider->pagination->pageSize = 6;

        if ($faqForm->load(Yii::$app->request->post()) && $faqForm->saveFaq()) {
            Yii::$app->session->setFlash('faq_thanks_for_question', true);
            $faqForm = new FaqForm();
        }



        return $this->render('index', [
            'menu' => $menu,
            'faqForm' => $faqForm,
            'category' => $category,
            'dataProvider' => $dataProvider
        ]);
    }
}
