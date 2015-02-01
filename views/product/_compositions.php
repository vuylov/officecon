<?php
use yii\helpers\Html;
use yii\jui\Accordion;

$items = [];
foreach($model->compositions as $composition){

    (!Yii::$app->user->isGuest)?
        $buttons = '<span class="pull-right">'.Html::a('Изменить', ['composition/update', 'id' => $composition->id], ['class' => 'btn btn-primary']).Html::a('Удалить', ['composition/delete', 'id' => $composition->id], ['class' => 'btn btn-danger']).'</span><span class="clearfix"></span>':
        $buttons = '';



    $items[] = [
        'header' => $composition->name.' '.$buttons,
        'content'=> $composition->description
    ];
}
?>

<div class="product-compositions">
    <?= Accordion::widget([
        'items' => $items,
        'clientOptions' => [
            'collapsible'   => false,
            'heightStyle'   => 'content',
            'icons'         => 'icons'
        ],
    ]);?>
</div>