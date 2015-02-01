<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="row">
    <?php foreach($model->childs as $child):?>
        <div class="col-xs-6 col-md-3">
            <a href="<?=Url::to(['catalog/view', 'id' => $child->catalog->id, 'product' => $child->id]); ?>" class="thumbnail">
                <?php $img = $child->files;?>
                <img src = '<?= Yii::$app->homeUrl.'/'.$img[0]->path;?>' style="height: 150px; width: 100%; display: block">
                <div class="small">
                    <p><?=$child->name;?></p>
                    <p><?=$child->article;?></p>
                </div>
            </a>
        </div>
    <?php endforeach;?>
</div>
<div class="clearfix"></div>