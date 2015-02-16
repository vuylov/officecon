<?php
/**
 * Created by PhpStorm.
 * User: Vuilov
 * Date: 28.01.2015
 * Time: 17:09
 */

namespace app\components;
use Yii;

class TopMenu {
    public static function getItems()
    {
        $items =[
            [
                'label' => 'Главная',
                'url'   => ['site/index']
            ],
            [
                'label' => 'Каталог',
                'url'   => ['catalog/index']
            ],
            [
                'label' => 'Дизайн-проекты',
                'url'   => ['project/design']
            ],
            [
                'label' => 'Портфолио',
                'url'   => ['project/portfolio']
            ],
            [
                'label' => 'Контакты',
                'url'   => ['site/contact']
            ],
        ];

        if(!Yii::$app->user->isGuest){
            $items[] = [
                'label' => 'Админка',
                'url'   => ['admin/index']
            ];
            $items[] = [
                'label' => 'Выйти',
                'url'   => ['site/logout'],
                'linkOptions' => ['data-method' => 'post', 'class' => 'navbar-right']
            ];
        }else{
            $items[] = [
                'label' => 'Войти',
                'url'   => ['site/login'],

            ];
        }
        return $items;
    }
}