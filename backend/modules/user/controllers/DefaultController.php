<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 24.10.2014
 * Time: 13:40
 */
namespace backend\modules\user\controllers;

use common\modules\card\models\Card;
use common\modules\user\models\User;
use common\modules\user\models\UserSearch;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\modules\admin\models\AdminUsers;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'delete' => ['post'],
                ],

            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
//                        'roles' => ['@']
                        'matchCallback' => function ($rule, $action) {
                            $model = AdminUsers::findIdentity(Yii::$app->user->getId());
                            if (!empty($model)) {
                                return $model->getRoleId() == 1; // Администратор
                            }
                            return false;
                        }
                    ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $searchModel = new UserSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing Organization model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $discount_card = $model->discount_card;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            User::changeDiscountCard($discount_card, $model);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Organization model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = User::findOne($id);
        User::changeDiscountCard($model->discount_card);
//        if ($model->discount_card)
//        {
//            $card = Card::findOne($model->discount_card);
//            $card->active = false;
//            $card->registration_date = null;
//            $card->user_id = null;
//            $card->save();
//        }
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}