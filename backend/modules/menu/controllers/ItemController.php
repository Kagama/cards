<?php

namespace backend\modules\menu\controllers;

use common\modules\appmodule\models\Module;
use Yii;
use common\modules\menu\models\Menu;
use common\modules\menu\models\search\MenuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\modules\admin\models\AdminUsers;

/**
 * DefaultController implements the CRUD actions for Menu model.
 */
class ItemController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['get'],
                ],

            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'update-position'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'update-position'],
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

    /**
     * Update position
     * @param $id
     */
    public function actionUpdatePosition($id) {
        if (Yii::$app->request->isAjax) {
            $model = Menu::findOne((int) $id);
            $old_position = $model->position;
            $new_position = Yii::$app->request->post('new_pos');
            if ($old_position != $new_position) {
                $model->position = $new_position;
                if ($model->save()) {
                    echo json_encode(['error' => false]);
                } else {
                    echo json_encode(['error' => true]);
                }
            }
        }
    }

    /**
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MenuSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        if (Yii::$app->request->get('group_id') != null) {
            $dataProvider->query->andFilterWhere(['group_id' => Yii::$app->request->get('group_id')]);
        }
        $dataProvider->query->orderBy('position ASC');

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'models' => $dataProvider->query->all()
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Menu;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save())
                return $this->redirect(['view', 'id' => $model->id, 'group_id' => $model->group_id]);
        }



        $model->group_id = (empty($model->group_id) ? Yii::$app->request->get('group_id') : $model->group_id);


        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'group_id' => $model->group_id]);
        }


        $model->group_id = (empty($model->group_id) ? Yii::$app->request->get('group_id') : $model->group_id);
        return $this->render('update', [
            'model' => $model,
            'group_id' => $model->group_id
        ]);

    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
