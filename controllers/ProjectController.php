<?php

namespace app\controllers;

use Yii;
use app\models\Project;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\File;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{
    public $layout = 'admin';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access'    => [
                'class' => AccessControl::className(),
                'only'  => ['create', 'update', 'delete', 'index', 'defaultimg'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
        ];
    }

    /**
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Project::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    public function actionDesign($id = null)
    {
        $this->layout = 'main';
        if($id === null){
            $models = Project::find()->where('type = '.Project::DESIGN)->all();
            return $this->render('_index', [
                'projects'  => $models,
                'type'      => Project::DESIGN
            ]);
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    public function actionPortfolio($id = null)
    {
        $this->layout = 'main';
        if($id === null){
            $models = Project::find()->where('type = '.Project::PORTFOLIO)->all();
            return $this->render('_index', [
                'projects'  => $models,
                'type'      => Project::PORTFOLIO
            ]);
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id)
            ]);
        }
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Project();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            File::saveUploadedImage($model, 'file');
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            File::saveUploadedImage($model, 'file');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Project model.
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
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDefaultimg($model = null, $id = null)
    {
        if($id === null && $model === null){
            echo 'Ошибка: не передан ID моделе или изображения';
        }

        $model  = $this->findModel($model);
        $file   = File::findOne($id);

        $model->thumb_id    = $file->id;
        $model->thumb_path  = $file->path;
        if($model->save()){
            echo 'Изображение для заставки установлено';
        }else{
            var_dump($model->errors);
        }
    }
}
