<?php

namespace app\controllers;
use app\models\Catalog;
use app\models\Product;
use Yii;
use yii\web\Controller;
use yii\helpers\VarDumper;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class CatalogController extends Controller
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

    public function actionIndex()
    {
        $catalogs = Catalog::find()->where(['parent_id' => null, 'visible' => Catalog::VISIBLE])->orderBy('sort')->all();
        return $this->render('index', compact('catalogs'));
    }

    public function actionView($id = null, $product = null)
    {
        if($id === null){
            $this->redirect(['catalog/index']);
        }
        $model      = Catalog::find()->with(['products'])->where('id = :id', [':id' => $id])->one();

        if($product === null){
            return $this->render('view',['model' => $model]);
        }else {
            return $this->render('//product/view', [
                'model' => Product::find()->with(['childs', 'compositions', 'files', 'productColors'])->where('id = :id', [':id' => $product])->one(),
            ]);
        }

    }

    public function actionCreate()
    {
        $model = new Catalog();

        if($model->load(Yii::$app->request->post()) && $model->save()){
            $this->redirect(['index']);
        }
        else{
            return $this->render('create', compact('model'));
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post()) && $model->save()){
            $this->redirect(['view', 'id' => $model->id]);
        }else{
            return $this->render('update', [
                'model' => $model
            ]);
        }
    }

    public function actionDelete($id)
    {
        if(!$id && !is_int($id))
            throw new NotFoundHttpException('Bad ID parameter for request.');
        $this->findModel($id)->delete();
        $this->redirect(['catalog/index']);
    }

    protected function findModel($id)
    {
        if (($model = Catalog::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



}
