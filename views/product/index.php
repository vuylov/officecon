<?php
/* @var $this yii\web\View */
?>
<h1>product/index</h1>

<div>
    <?php foreach($products as $product):?>
        <?= $product->name;?>
        <?php foreach($product->catalogs as $catalog):?>
            <?=$catalog->name;?>
        <?php endforeach;?>
    <?php endforeach;?>
</div>