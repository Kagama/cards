<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 15.09.14
 * Time: 2:23
 */

namespace backend\modules\organization\controllers;

use common\helpers\CDirectory;
use common\helpers\CString;
use common\modules\organization\models\Category;
use common\modules\organization\models\CatSearch;
use common\modules\user\models\User;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use yii\web\UploadedFile;

class CategoryController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'delete' => ['post'],
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
        $searchModel = new CatSearch();
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
        $model = new Category();
        if ($model->load(\Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'img');
            if (!empty($file))
                $model->img = $file;
            
            if ($file instanceof UploadedFile) {
                $model->img = $file;

                if (($model->img instanceof UploadedFile ) && $model->img->size > 0) {

                    $path = "images/organization/category";

                    CDirectory::createDir($path);
                    $dir = \Yii::$app->basePath . "/../" . $path;

                    $imageName = CString::translitTo($model->alt_name). "." . $model->img->getExtension();

                    $model->img->saveAs($dir . "/" . $imageName);

                    $model->img = $path . "/" . $imageName;
                }
            }

            if ($model->save()) {

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $file = UploadedFile::getInstance($model, 'img');
//            var_dump($file);
//            die();
            if ($file instanceof UploadedFile) {
                $model->img = $file;

                if (($model->img instanceof UploadedFile ) && $model->img->size > 0) {

                    $path = "images/organization/category";

                    CDirectory::createDir($path);
                    $dir = \Yii::$app->basePath . "/../" . $path;

                    $imageName = CString::translitTo($model->alt_name). "." . $model->img->getExtension();

                    $model->img->saveAs($dir . "/" . $imageName);

                    $model->img = $path . "/" . $imageName;
                }
            } else {
                $model->img = $model->getOldAttribute('img');
            }

            if ($model->save()) {

                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
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
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}