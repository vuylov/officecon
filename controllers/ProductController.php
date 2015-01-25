<?php

namespace app\controllers;

use app\models\Catalog;
use app\models\File;
use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model      = $this->findModel($id);
        $catalogs   = ArrayHelper::getColumn($model->catalogs, 'name');

        return $this->render('view', [
            'model'     => $model,
            'catalogs'  => $catalogs
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model      = new Product();
        $catalog    = new Catalog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $catalogs = Yii::$app->request->post('Catalog');
            $model->insertProductToCatalog($catalogs['id']);

            $files = UploadedFile::getInstances($model, 'file');
            if(count($files) > 0)
            {
                File::saveImage(Product::FILE_TYPE, $files, $model);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model'     => $model,
                'catalog'   => $catalog
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model              = $this->findModel($id);
        $catalogChecked     = ArrayHelper::getColumn($model->catalogs, 'id');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->deleteProductToCatalog();
            $catalogs = Yii::$app->request->post('Catalog');
            $model->insertProductToCatalog($catalogs['id']);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model'     => $model,
                'catalogChecked'   => $catalogChecked
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::find()->where(['id' => $id])->with(['files'])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
