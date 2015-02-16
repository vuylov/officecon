<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="row">
    <?php foreach($model->childs as $child):?>
        <div class="col-xs-6 col-md-2">
            <a href="<?=Url::to(['catalog/view', 'id' => $child->catalog->id, 'product' => $child->id]); ?>" class="thumbnail">
                <?php if(count($child->files) > 0):?>
                    <?php $img = $child->files;?>
                    <img src = '<?= Yii::$app->homeUrl.$img[0]->path;?>' style="height: 100px; width: 100%; display: block">
                    <div class="small product-notice">
                        <p><?=($child->name) ? $child->name : '';?></p>
                        <p><?=($child->article) ? $child->article : '';?></p>
                        <p><?=($child->size) ? $child->size : '';?></p>
                    </div>
                <?php else:?>
                    <div class="jumbotron">Нет информации о комплектации</div>
                <?php endif;?>
            </a>
        </div>
    <?php endforeach;?>
</div>
<div class="clearfix"></div>