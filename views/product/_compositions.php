<?php
use yii\helpers\Html;
use yii\jui\Accordion;

$items = [];
foreach($model->compositions as $composition){

    (!Yii::$app->user->isGuest)?
        $buttons = '<span class="pull-right">'.
            Html::a('Изменить', ['composition/update', 'id' => $composition->id], ['class' => 'btn btn-primary']).
            Html::a('Удалить', ['composition/delete', 'id' => $composition->id], ['class' => 'btn btn-danger']).
            Html::a('Добавить продукт', ['composition/add', 'id' => $composition->id], ['class' => 'btn btn-success']).
            '</span><span class="clearfix"></span>':
        $buttons = '';

    $content = '';
    $content .= '<div class="pull-right">'.$buttons.'</div><div class="clearfix"></div>';
    $content .= '<div>'.$composition->description.'</div>';//insert img here

    if($composition->compositionItems){
        $content.='<table class="table"><tr><th>Наименование продукта</th><th>Управление</th></tr>';
        foreach($composition->compositionItems as $item){
            $content.='<tr><td>'.$item->product->name.'</td><td>'.$item->amount.'</td></tr>';
        }
        $content.='</table>';
    }

    $items[] = [
        'header' => $composition->name,
        'content'=> $content,
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