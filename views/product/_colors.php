<?php
use yii\helpers\Html;
?>
<?php if($model->productColors):?>
    <?php foreach($model->productColors as $color):?>
        <div class="col-xs-6 col-md-3">
            <?=Html::a(Html::img(Yii::$app->homeUrl.$color->baseColor->path, ['class' => 'img-responsive img-thumbnail color-image', 'alt' => $color->baseColor->name]).'<div class="img-color-name">'.$color->baseColor->name.'</div>',Yii::$app->homeUrl.$color->baseColor->path,['rel' => 'fancybox', 'class' => 'color-link']);?>
        </div>
    <?php endforeach;?>
<?php endif;?>
<?php if(!Yii::$app->user->isGuest):?>
    <div class="clearfix"></div>
    <div class="pull-right">
        <?php if($model->productColors):?>
            <?=Html::a('Изменить',['product/colors', 'id' => $model->id],['class' => 'btn btn-primary']);?>
        <?php endif;?>
            <?=Html::a('Добавить цвет',['product/colors', 'id' => $model->id],['class' => 'btn btn-success']);?>
    </div>
    <div class="clearfix"></div>
<?php endif;?>