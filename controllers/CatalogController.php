<?php

namespace app\controllers;
use app\models\Catalog;
use app\models\Product;
use Yii;
use yii\web\Controller;
use yii\helpers\VarDumper;

class CatalogController extends Controller
{
    public function actionIndex()
    {
        $catalogs = Catalog::find()->where(['parent_id' => null])->all();
        return $this->render('index', compact('catalogs'));
    }

    public function actionView($id = null)
    {
        if($id === null){
            $this->redirect(['catalog/index']);
        }

        $catalogs    = Catalog::find()->where(['parent_id' => null])->all();
        $childs     = Catalog::find()->where(['parent_id' => $id])->all();
        $model      = Catalog::findOne($id);

        return $this->render('view', compact(['childs', 'model', 'catalogs']));
    }

    public function actionAdd()
    {
        $model = new Catalog();

        if($model->load(Yii::$app->request->post()) && $model->save()){
            $this->redirect(['catalog/add']);
        }
        else{
            return $this->render('add', compact('model'));
        }
    }

}
