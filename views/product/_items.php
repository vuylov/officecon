<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="product-items">
    <?php foreach($model->childs as $child):?>
            <a href="<?=Url::to(['catalog/view', 'id' => $child->catalog->id, 'product' => $child->id]); ?>" style="display: block">
                <div class="item">
                    <?php if($child->files):?>
                        <?php $img = $child->files;?>
                        <div class="image-item"><img src = '<?= Yii::$app->homeUrl.'/'.$img[0]->path;?>' width="33%"></div>
                    <?php endif;?>
                    <br>
                    <span class="item-name"><?= $child->name ?></span>
                    <br>
                    <span class="item-name"><?= $child->article ?></span>
                </div>
            </a>

    <?php endforeach;?>
</div>
<div class="clearfix"></div>