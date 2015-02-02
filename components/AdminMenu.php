<?php
/**
 * Created by PhpStorm.
 * User: Vuilov
 * Date: 28.01.2015
 * Time: 17:09
 */

namespace app\components;
use Yii;

class AdminMenu {
    public static function getItems()
    {
        $items =[
            [
                'label' => 'Поставщики',
                'url'   => ['manufacturer/index']
            ],
            [
                'label' => 'Цвета',
                'url'   => ['color/index']
            ]
        ];
        return $items;
    }
}