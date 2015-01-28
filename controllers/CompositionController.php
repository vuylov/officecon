<?php

namespace app\controllers;

use Yii;
use app\models\Composition;
use app\models\CompositionSearch;
use app\models\File;
use app\models\Product;
use app\models\CompositionItem;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompositionController implements the CRUD actions for Composition model.
 */
class CompositionController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Composition models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompositionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Composition model.
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
     * Creates a new Composition model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Composition();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            File::saveUploadedImage($model, 'file');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Composition model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Composition model.
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
     * Add product in Composition
     * @param integer $id ID composition
     * @throws MethodNotAllowedHttpException
     * @return mixed
     */
    public function actionAdd($id = null)
    {
        if(!$id)
            throw new MethodNotAllowedHttpException("ID not found");

        //$products       = Product::find()->where('manufacturer_id = :m', [':m' => $composition->manufacturer_id])->orderBy('name')->all();
        $model          = new CompositionItem();

        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['view', 'id' => $model->composition_id]);
        }else {
            $model->composition_id  = $id;
            return $this->render('//compositionItem/create', [
               'model'          => $model,
            ]);
        }
    }

    /**
     * Update product model
     * @param integer $id ID item composition
     * @throws MethodNotAllowedHttpException
     * @return mixed
     */
    public function actionIupdate($id = null)
    {
        if(!$id)
            throw new MethodNotAllowedHttpException("Composition item not found");
        $model = $this->findItemModel($id);

        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['view', 'id' => $model->composition_id]);
        }else{
            return $this->render('//compositionItem/update', [
                'model' => $model
            ]);
        }
    }

    /**
     * Delete item product from composition
     * @param integer $id ID item composition
     * @throws NotFoundHttpException
     * @return mixed
     */
    public function actionIdelete($id)
    {
        $item = $this->findItemModel($id);
        if($item !== null){
            $composition = $item->composition_id;
            $item->delete();

            return $this->redirect(['view', 'id' => $composition]);
        }else{
            throw new NotFoundHttpException('The ID item not exist already');
        }
    }

    /**
     * Finds the Composition model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Composition the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Composition::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findItemModel($id)
    {
        if (($model = CompositionItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
