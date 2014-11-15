<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 24.10.2014
 * Time: 13:40
 */
namespace backend\modules\card\controllers;

use common\modules\card\models\CardSearch;
use common\modules\card\models\Card;
use common\modules\user\models\User;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
                'only' => ['index', 'view', 'create', 'create_many', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'create_many', 'update', 'delete'],
//                        'roles' => ['@']
                        'matchCallback' => function ($rule, $action) {
                            $model = User::findIdentity(Yii::$app->user->getId());
                            if (!empty($model)) {
                                return $model->role->id == 1; // Администратор
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
        $searchModel = new CardSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Card();
        if ($model->load(\Yii::$app->request->post()))
            if ($model->validate()) {
                if ($model->user_id) {
                    $model->active = true;
                    $model->registration_date = time();
                    $user = User::findOne($model->user_id);
                    $user->discount_card = $model->id;
                    $user->save();
                }
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateMany()
    {
        $model = new Card();
        if (Yii::$app->request->post($model->from) || Yii::$app->request->post($model->to))
        {
            $cards = Yii::$app->request->post($model->from);
            $from = $cards['Card']['from'];
            $to = $cards['Card']['to'];
            if ($from < $to)
            {
                $model->createCards($from, $to);
                return $this->redirect(['index']);
            } else
                Yii::$app->getSession()->setFlash('error', 'Введите правильные значения.');
        }
        return $this->render('create-many', [
            'model' => $model,
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
        $user_id = $model->user_id;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Card::changeDiscountCard($user_id, $model);

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
        $model = Card::findOne($id);
        $model->changeDiscountCard($model->user_id);
//        if ($model->user_id)
//        {
//            $user = User::findOne($model->user_id);
//            $user->discount_card = null;
//        }

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Card model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Card the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Card::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}