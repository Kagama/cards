<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 24.10.2014
 * Time: 13:40
 */
namespace frontend\modules\organization\controllers;

use common\modules\organization\models\OrgSearch;
use yii\web\Controller;
use Yii;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new OrgSearch();
        $dataProvider = $searchModel -> search(Yii::$app->request->getQueryParams());
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}