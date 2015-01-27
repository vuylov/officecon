<?php

namespace app\controllers;

use Yii;
use app\models\Price;
use app\models\PriceSearch;
use app\models\Item;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PriceController implements the CRUD actions for ProductPrice model.
 */
class PriceController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['get', 'post'],
                ],
            ],
            'access'    => [
                'class' => AccessControl::className(),
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
     * Lists all ProductPrice models.
     * @return mixed
     * @throws MethodNotAllowedHttpException
     */
    public function actionIndex()
    {
        throw new MethodNotAllowedHttpException("Method not allow");
        /*$searchModel = new PriceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
    }

    /**
     * Displays a single ProductPrice model.
     * @param integer $id
     * @return mixed
     * @throws MethodNotAllowedHttpException
     */
    public function actionView($id)
    {
        throw new MethodNotAllowedHttpException("Method not allow");
        /*
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);*/
    }

    /**
     * Creates a new ProductPrice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param int $item item id
     * @return mixed
     * @throws MethodNotAllowedHttpException
     */
    public function actionCreate($item = null)
    {
        if($item === null)
            throw new MethodNotAllowedHttpException("Not given item in request");

        $item  = Item::findOne($item);
        if($item === null)
            throw new MethodNotAllowedHttpException("Item not found");

        $model = new Price();
        $model->productItem_id = $item->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['item/view', 'id' => $item->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProductPrice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['item/view', 'id' => $model->productItem_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProductPrice model.
     * If deletion is successful, the browser will be redirected to the Item page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $price  = $this->findModel($id);
        $item   = $price->productItem_id;
        $price->delete();

        return $this->redirect(['item/view', 'id' => $item]);
    }

    /**
     * Finds the ProductPrice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductPrice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Price::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
