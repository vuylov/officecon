<?php
use yii\helpers\Html;
use yii\helpers\VarDumper;
?>
<div class="row">
    <div class="col-md-4">
        <?php foreach($catalogs as $catalog):?>
            <div><?=Html::a($catalog->name, ['catalog/view', 'id' => $catalog->id]);?></div>
        <?php endforeach;?>
    </div>
    <div class="col-md-8">
        <?php if(count($childs) > 0):?>
            <?php foreach($childs as $catalog):?>
                <div><?=Html::a($catalog->name, ['catalog/view', 'id' => $catalog->id]);?></div>
            <?php endforeach;?>
        <?endif;?>
        <hr>
        <?php if(count($model->products) > 0):?>
            <div>
                <h4><?=$model->name;?></h4>
                <ul>
                    <?php foreach($model->products as $product):?>

                        <li>
                            <?=Html::a($product->name, ['product/view', 'id' => $product->id]);?>
                            (<?=$product->parent->name;?>)
                        </li>
                        <?php //VarDumper::dump($product, 10, true);?>
                    <?php endforeach;?>
                </ul>
            </div>
        <?php endif;?>
    </div>
</div>
<?
$this->registerMetaTag(['name' => 'keywords', 'content' => $catalog->keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $catalog->description]);
$this->title = $catalog->name;
?>