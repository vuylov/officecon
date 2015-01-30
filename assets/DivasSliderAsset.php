<?php

namespace app\assets;
use yii\web\AssetBundle;

class DivasSliderAsset extends AssetBundle{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/divas_free_skin.css',
        'css/divas_free_skin.css'
    ];
    public $js = [
        'js/jquery.divas-1.1.min.js',
        'js/main.js'
    ];
    public $depends =[
        'yii\web\YiiAsset'
    ];
}