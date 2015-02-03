<?php

namespace app\controllers;

use app\models\Catalog;
use app\models\Color;
use app\models\File;
use app\models\ProductColors;
use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    public $layout = 'catalog';
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
                'only'  => ['create', 'update', 'delete'],
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

        $this->redirect(['catalog/view', 'id' => $model->catalog->id, 'product' => $model->id]);
        /*
        return $this->render('view', [
            'model'     => $model,
        ]);*/
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @throws NotFoundHttpException
     * @return mixed
     */
    public function actionCreate($catalog = null, $product = null)
    {
        if($catalog === null)
            throw new NotFoundHttpException('Catalog not found');

        $model              = new Product();
        $catalog            = Catalog::findOne($catalog);
        $model->catalog_id  = $catalog->id;

        if($product !== null)
            $product                = $this->findModel($product);
            $model->parent_id       = $product->id;
            $model->manufacturer_id = $product->manufacturer_id;


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            File::saveUploadedImage($model, 'file');

            return $this->redirect(['catalog/view', 'id' => $catalog->id]);
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
        $model              = Product::find()->with(['catalog', 'files'])->where('id = :id', ['id' => $id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            File::saveUploadedImage($model, 'file');

            return $this->redirect(['catalog/view', 'id' => $model->catalog->id, 'product' => $model->id]);
        } else {
            return $this->render('update', [
                'model'     => $model,
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
        $product = Product::findOne($id);
        $catalog = $product->catalog_id;
        $product->delete();

        return $this->redirect(['catalog/view', 'id' => $catalog->id]);
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
        if (($model = Product::find()->where(['id' => $id])->with(['files', 'prices', 'catalog', 'compositions'])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddColor($id = null)
    {
        $model         = new ProductColors();
        $product       = $this->findModel($id);
        $colors        = Color::find()->where('manufacturer_id = :m', [':m' => $model->manufacturer_id])->all();

        if($model->load(Yii::$app->request->post())){

        }else{
            $this->render('addcolor', [
                'product'   => $product,
                'model'     => $model,
                'colors'    => $colors
            ]);
        }
    }
}
