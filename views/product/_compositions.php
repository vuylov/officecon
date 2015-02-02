<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\Accordion;
use newerton\fancybox\FancyBox;

$items = [];
$catalog = $model->catalog;
foreach($model->compositions as $composition){

    (!Yii::$app->user->isGuest)?
        $buttons = '<span class="pull-right buttons-group">'.
            Html::a('Изменить компоновку', ['composition/update', 'id' => $composition->id], ['class' => 'btn btn-primary']).
            Html::a('Удалить компоновку', ['composition/delete', 'id' => $composition->id], ['class' => 'btn btn-danger']).
            Html::a('Добавить продукт', ['composition/add', 'id' => $composition->id], ['class' => 'btn btn-success']).
            '</span><span class="clearfix"></span>':
        $buttons = '';

    $content = '';
    $content .= '<div class="pull-right">'.$buttons.'</div><div class="clearfix"></div>';

    if($composition->files){
        $files = $composition->files;
        $content .= '<div class="composition-image-wrapper">';
        $content .= Html::a(Html::img(Yii::$app->homeUrl.'/'.$files[0]->path, ['class' => 'img-responsive img-thumbnail']),Yii::$app->homeUrl.'/'.$files[0]->path,['rel' => 'fancybox']);
        $content .= '</div>';
    }

    $content .= '<div>'.$composition->description.'</div><div class="clearfix"></div>';

    if($composition->compositionItems){
        $content.='<h5><b>Комплектующие:</b></h5><table class="table"><tr><th>Наименование/артикул</th><th>Количество</th>';
        (!Yii::$app->user->isGuest)?
            $content.= '<th>Управление</th></tr>':
            $content.= '</tr>';
        foreach($composition->compositionItems as $item){
            $product = $item->product;
            $content.='<tr><td>'.Html::a($product->name.' / '.$product->article,['catalog/view', 'id' => $catalog->id, 'product' => $product->id]).'</td><td>'.$item->amount.'</td>';
            (!Yii::$app->user->isGuest)?
                $content.='<td>'.Html::a('Удалить продукт из компоновки',['#'],[
                        'class' => 'btn btn-danger',
                        'onclick'   => "
                            $.ajax({
                                type: 'POST',
                                cache: false,
                                url: '".Url::to(['composition/idelete', 'id' => $item->id])."',
                                success: function(response){
                                    alert(response);
                                    location.reload();
                                }
                            });return false;
                        "
                    ]).'</td></tr>':
                $content.= '</tr>';
        }
        $content.='</table>';
    }

    $items[] = [
        'header' => $composition->name,
        'content'=> $content,
    ];
}
?>
<?= FancyBox::widget([
    'target' => 'a[rel=fancybox]',
    'helpers' => true,
    'mouse' => true,
    'config' => [
        'maxWidth' => '90%',
        'maxHeight' => '90%',
        //'playSpeed' => 7000,
        'arrows' => false,
        'padding' => 0,
        'fitToView' => false,
        'width' => '70%',
        'height' => '70%',
        'autoSize' => false,
        'closeClick' => false,
        'openEffect' => 'elastic',
        'closeEffect' => 'elastic',
        'prevEffect' => 'elastic',
        'nextEffect' => 'elastic',
        'closeBtn' => true,
        'openOpacity' => true,
        //'autoCenter'  => true,
        /*'helpers' => [
            'title' => ['type' => 'float'],
            'buttons' => [],
            'thumbs' => ['width' => 68, 'height' => 50],
            'overlay' => [
                'css' => [
                    'background' => 'rgba(0, 0, 0, 0.8)'
                ]
            ]*/
        ],
    ]);?>
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