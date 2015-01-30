<?php
/**
 * Created by PhpStorm.
 * User: Vuilov
 * Date: 28.01.2015
 * Time: 17:09
 */

namespace app\components;
use Yii;
use app\models\Catalog;

class CatalogMenu {
    public static function getItems()
    {
        $items = [];
        $query = Catalog::find()->where(['parent_id' => null]);
        if(Yii::$app->user->isGuest){
            $query->andWhere('visible = :v', [':v' => Catalog::VISIBLE]);
        }
        $catalogs = $query->orderBy('sort')->all();
        foreach ($catalogs as $catalog) {
            $items[] = [
                'label' => $catalog->name,
                'url'   => ['catalog/view', 'id' => $catalog->id],
                'linkOptions'   => [
                    'class' => $catalog->visible ? 'item-invisible' : 'item-visible'
                ]
            ];
        }
        return $items;
    }

}