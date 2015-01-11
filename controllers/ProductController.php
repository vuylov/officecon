<?php

namespace app\controllers;
use app\models\Catalog;
use app\models\Product;
use Yii;
use yii\web\Controller;
use yii\helpers\VarDumper;

class ProductController extends Controller
{
    public function actionIndex()
    {
        $products = Product::find()->all();
        return $this->render('index', compact('products'));
    }

    public function actionView($id = null)
    {
        if($id === null){
            $this->redirect(['catalog/index']);
        }

        $product    = Product::findOne($id);
        $items      = Product::find()->where(['parent_id' => $product->id])->all();

        //VarDumper::dump($items, 10, true);

        return $this->render('view', compact('product', 'items'));
    }

    public function actionAdd()
    {

        $product = new Product();
        $catalog = new Catalog();

        $catalogIds = Yii::$app->request->post();
        //VarDumper::dump($pc['Catalog']['id'], 10, true);

        if($product->load(Yii::$app->request->post()))
        {

            $product->save();
            foreach($catalogIds['Catalog']['id'] as $id)
            {
                echo $id;
                $catalogDB = Catalog::find(['id' => $id])->one();
                //VarDumper::dump($catalogDB, 10 ,true);
                $product->link('catalogs', $catalogDB);

            }
            echo 'Done';
        }else{
            return $this->render('create', compact(['product', 'catalog']));
        }
    }
}
