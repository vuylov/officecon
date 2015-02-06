<?php
/**
 * Created by PhpStorm.
 * User: Vuilov
 * Date: 05.02.2015
 * Time: 12:12
 */

namespace app\assets;
use yii\web\AssetBundle;

class RoundaboutAsset extends AssetBundle{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/roundabout.css'
    ];
    public $js = [
        'js/jquery.roundabout.min.js',
        'js/main.js'
    ];
    public $depends =[
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset'
    ];
}