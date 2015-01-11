<?php
use yii\helpers\Html;
use yii\helpers\VarDumper;
?>

<h1><?=$product->name?></h1>
<div>Категория:
    <?php foreach($product->catalogs as $catalog):?>
        <span><?=Html::a($catalog->name, ['catalog/view', 'id' => $catalog->id])?></span>
    <?endforeach;?>
</div>
<div>
    <?=$product->description?>
</div>
<?php if(count($items) > 0):?>
<div>
    <hr>
    <?php foreach($items as $item):?>
        <div>
            <?=$item->name;?>
            <br><small><?=$item->description; ?></small>
        </div>
    <?php endforeach;?>
</div>
<?php endif;?>
<?php //VarDumper::dump($product, 10, true);?>