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
            $items[] = [
                'label'     => 'Компоновки',
                'content'   => Yii::$app->view->render('//product/_compositions', ['model' => $model]),
                'options'   => [
                    'id'    => 'composition'
                ],
            ];
        }


        return $items;
    }

}