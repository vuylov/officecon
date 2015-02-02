<?php
/**
 * Created by PhpStorm.
 * User: Vuilov
 * Date: 29.01.2015
 * Time: 16:12
 */

namespace app\components;
use Yii;
use app\models\Product;
use app\models\Composition;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

class DataProductItems {

    public static function getItems(ActiveRecord $model)
    {
        $items = [];
        $items[] = [
            'label'     => 'Характеристики',
            'content'   => $model->description,
            'options'   => [
                'id'    => 'detail'
            ],
        ];

        if($model->childs){
            $items[] = [
                'label'     => 'Комплектация',
                'content'   => Yii::$app->view->render('//product/_items', ['model' => $model]),
                'options'   => [
                'id'    => 'items'
                ],
            ];
        }

        if($model->compositions){
            //$model = Product::find()->with('compositions')->where('id = :id', [':id' => $model->id])->one();
            $items[] = [
                'label'     => 'Компоновки',
                'content'   => Yii::$app->view->render('//product/_compositions', ['model' => $model]),
                'options'   => [
                    'id'    => 'compositions'
                ],
            ];
        }

        if($model->productColors || !Yii::$app->user->isGuest){
            $items[] = [
                'label'     => 'Цвета',
                'content'   => Yii::$app->view->render('//product/_colors', ['model' => $model]),
                'options'   => [
                    'id'    => 'colors'
                ],
            ];
        }

        return $items;
    }

}