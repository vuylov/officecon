<?php
use yii\helpers\Html;
?>
<?php if($model->productColors):?>
    <?php foreach($model->productColors as $color):?>

    <?php endforeach;?>
<?php endif;?>
<?php if(!Yii::$app->user->isGuest):?>
    <div class="pull-right">
        <?=Html::a('Добавить цвет',['product/addColor', 'id' => $model->id],['class' => 'btn btn-success']);?>
    </div>
    <div class="clearfix"></div>
<?php endif;?>