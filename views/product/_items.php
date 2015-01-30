<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="product-items">
    <?php foreach($model->childs as $child):?>
        <a href="<?=Url::to(['catalog/view', 'id' => $child->catalog->id, 'product'=> $child->id]) ?>"
            <div class="item">
                <?php if($child->files):?>
                    <?php $img = $child->files;?>
                    <img src = '<?= Yii::$app->homeUrl.'/'.$img[0]->path;?>' width="33%">
                <?php endif;?>
                <?= $child->name ?>
            </div>
        </a>
    <?php endforeach;?>
</div>
<div class="clearfix"></div>