<?php
/* @var $this yii\web\View */
use app\assets\DivasSliderAsset;

$this->title = 'Офискон: конструируем офинсое пространство';
DivasSliderAsset::register($this);
?>
<div class="site-index">
    <div class="sliders">
        <div id="slider" class="divas-slider">
            <ul class="divas-slide-container">
                <li class="divas-slide"><img src="<?=Yii::$app->homeUrl?>img/slides/placeholder.gif" alt="" data-src="<?=Yii::$app->homeUrl?>img/slides/slide1.jpg" /></li>
                <li class="divas-slide"><img src="<?=Yii::$app->homeUrl?>img/slides/placeholder.gif" alt="" data-src="<?=Yii::$app->homeUrl?>img/slides/slide2.jpg" /></li>
                <li class="divas-slide"><img src="<?=Yii::$app->homeUrl?>img/slides/placeholder.gif" alt="" data-src="<?=Yii::$app->homeUrl?>img/slides/slide3.jpg" /></li>
                <li class="divas-slide"><img src="<?=Yii::$app->homeUrl?>img/slides/placeholder.gif" alt="" data-src="<?=Yii::$app->homeUrl?>img/slides/slide4.jpg" /></li>
                <li class="divas-slide"><img src="<?=Yii::$app->homeUrl?>img/slides/placeholder.gif" alt="" data-src="<?=Yii::$app->homeUrl?>img/slides/slide5.jpg" /></li>
            </ul>
            <div class="divas-navigation">
                <span class="divas-prev">&nbsp;</span>
                <span class="divas-next">&nbsp;</span>
            </div>
            <div class="divas-controls">
                <span class="divas-start"><i class="fa fa-play"></i></span>
                <span class="divas-stop"><i class="fa fa-pause"></i></span>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="section-header-line">
            <div class="section-header">Мы работаем так</div>
        </div>
        <ul class="list-inline work">
            <li class="work-phone"><img src="<?=Yii::$app->homeUrl?>img/phone.png" width="100" class="img-responsive"></li>
            <li class="work-divider"><img src="<?=Yii::$app->homeUrl?>img/pointer.png" class="img-responsive"></li>
            <li class="work-phone"><img src="<?=Yii::$app->homeUrl?>img/lamp.png" width="100" class="img-responsive"></li>
            <li class="work-divider"><img src="<?=Yii::$app->homeUrl?>img/pointer.png"  class="img-responsive"></li>
            <li class="work-phone"><img src="<?=Yii::$app->homeUrl?>img/demonstrate.png" width="100" class="img-responsive"></li>
            <li class="work-divider"><img src="<?=Yii::$app->homeUrl?>img/pointer.png" class="img-responsive"></li>
            <li class="work-phone"><img src="<?=Yii::$app->homeUrl?>img/hands.png" width="100" class="img-responsive"></li>
            <li class="work-divider"><img src="<?=Yii::$app->homeUrl?>img/pointer.png" class="img-responsive"></li>
            <li class="work-phone"><img src="<?=Yii::$app->homeUrl?>img/truck.png" class="img-responsive"></li>
        </ul>
        <div class="clearfix"></div>
        <div class="section-header-line">
            <div class="section-header">Наши заказчики</div>
        </div>
    </div>
</div>
