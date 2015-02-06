<?php
/* @var $this yii\web\View */
use app\assets\RoundaboutAsset;
use yii\helpers\Html;

$this->title = 'Офискон: конструируем офинсое пространство';
RoundaboutAsset::register($this);
?>
<div class="site-index">
    <div id="slider">
        <ul class="slider-container">
            <li style="background-color: rgba(0,0,0,0.5)">
                <img src="<?=Yii::$app->homeUrl?>img/slides/slide1.jpg" />
            </li>
            <li><img src="<?=Yii::$app->homeUrl?>img/slides/slide2.jpg" /></li>
            <li><img src="<?=Yii::$app->homeUrl?>img/slides/slide3.jpg" /></li>
            <li><img src="<?=Yii::$app->homeUrl?>img/slides/slide4.jpg" /></li>
            <li><img src="<?=Yii::$app->homeUrl?>img/slides/slide5.jpg" /></li>
        </ul>
        <!--<div id="roundabout-prev"></div>
        <div id="roundabout-next"></div>-->
    </div>
    <div class="container">

        <div class="section-header">
            <hr>
            <div class="section-header-title">Наш бизнес-процесс</div>
        </div>

        <ul class="list-inline work">
            <li><?= Html::img(Yii::$app->homeUrl.'img/steps/phone_g.png', ['class' => 'step', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Большой текст, большой большой большой большой еще больше еще больше еще больше']);?></li>
            <li><?= Html::img(Yii::$app->homeUrl.'img/steps/pointer.png');?></li>
            <li><?= Html::img(Yii::$app->homeUrl.'img/steps/lamp_g.png', ['class' => 'step','data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'HIIHIHI']);?></li>
            <li><?= Html::img(Yii::$app->homeUrl.'img/steps/pointer.png');?></li>
            <li><?= Html::img(Yii::$app->homeUrl.'img/steps/demon_g.png', ['class' => 'step','data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'HIIHIHI']);?></li>
            <li><?= Html::img(Yii::$app->homeUrl.'img/steps/pointer.png');?></li>
            <li><?= Html::img(Yii::$app->homeUrl.'img/steps/hand_g.png', ['class' => 'step','data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'HIIHIHI']);?></li>
            <li><?= Html::img(Yii::$app->homeUrl.'img/steps/pointer.png');?></li>
            <li><?= Html::img(Yii::$app->homeUrl.'img/steps/truck_g.png', ['class' => 'step','data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'HIIHIHI']);?></li>
        </ul>
        <div class="clearfix"></div>
        <div class="section-header">
            <hr>
            <div class="section-header-title">Наши заказчики</div>
        </div>
        <ul class="list-inline banners">
            <li><?= Html::img(Yii::$app->homeUrl.'img/banners/logo-lukiol.gif');?></li>
            <li><?= Html::img(Yii::$app->homeUrl.'img/banners/logo_luk_inform.jpg');?></li>
            <li><?= Html::img(Yii::$app->homeUrl.'img/banners/lukoil_trans.png');?></li>
            <li><?= Html::img(Yii::$app->homeUrl.'img/banners/logo_nalog.JPG');?></li>
            <li><?= Html::img(Yii::$app->homeUrl.'img/banners/braun-logo.jpg');?></li>
            <li><?= Html::img(Yii::$app->homeUrl.'img/banners/tecnicas-reunidas.jpg');?></li>
            <li><?= Html::img(Yii::$app->homeUrl.'img/banners/logo_sberbank.jpg');?></li>
            <li><?= Html::img(Yii::$app->homeUrl.'img/banners/volsu.png');?></li>
            <li><?= Html::img(Yii::$app->homeUrl.'img/banners/logo_vstu.gif');?></li>
            <li><?= Html::img(Yii::$app->homeUrl.'img/banners/garnizon.jpg');?></li>
        </ul>
    </div>
</div>
