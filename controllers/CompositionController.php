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
use yii\filters\AccessControl;

/**
 * CompositionController implements the CRUD actions for Composition model.
 */
class CompositionController extends Controller
{
    public $layout = 'catalog';
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post', 'get'],
                ],
            ],
            'access'    => [
                'class' => AccessControl::className(),
                'only'  => ['create', 'update', 'delete', 'index', 'idelete'],
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
     * @param integer $product Product Id
     * @throws NotFoundHttpException
     * @return mixed
     */
    public function actionCreate($product = null)
    {
        if($product === null)
            throw new NotFoundHttpException('Product ID not found');

        $product = Product::findOne($product);
        $model = new Composition();
        $model->product_id      = $product->id;
        $model->manufacturer_id = $product->manufacturer_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            File::saveUploadedImage($model, 'file');
            return $this->redirect(['catalog/view', 'id' => $product->catalog->id, 'product' => $product->id]);
        } else {
            return $this->render('create', [
                'model'     => $model,
                'product'   => $product
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
        $model      = $this->findModel($id);
        $product    = Product::findOne($model->product_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            File::saveUploadedImage($model, 'file');
            return $this->redirect(['catalog/view', 'id' => $model->product->catalog->id, 'product' => $model->product->id, '#' => 'compositions']);
        } else {
            return $this->render('update', [
                'model'     => $model,
                'product'   => $product
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
        $model      = $this->findModel($id);
        $product    = Product::findOne($model->product_id);
        $model->delete();

        return $this->redirect(['catalog/view', 'id' => $product->catalog->id, 'product' => $product->id, '#' => 'compositions']);
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
        $composition    = Composition::findOne($id);

        if($model->load(Yii::$app->request->post()) && $model->save()){
            $product = $composition->product;
            return $this->redirect(['catalog/view', 'id' => $product->catalog->id, 'product' => $product->id]);
        }else {
            $model->composition_id  = $id;
            return $this->render('//compositionItem/create', [
               'composition'    => $composition,
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
        if($item->delete()){
            echo 'Продукт удален из компоновки';
        }else{
            echo $item->errors;
        }

        /*if($item !== null){
            $composition = $item->composition_id;
            $item->delete();

            return $this->redirect(['view', 'id' => $composition]);
        }else{
            throw new NotFoundHttpException('The ID item not exist already');
        }*/
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
