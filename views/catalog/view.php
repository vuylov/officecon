<?php
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\helpers\Url;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<?php if(!Yii::$app->user->isGuest): ?>
    <div class="management">
        <?= Html::a('Изменить каталог', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить каталог', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить каталог? Удаление каталога приведет к удалению всех имеющихся в нем продуктов!',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success']);?>
        <?= Html::a('Добавить продукт', ['product/create', 'catalog' => $model->id], ['class' => 'btn btn-success']);?>
    </div>
<?php endif;?>
<div class="row">
    <?php if(count($model->products) > 0):?>
        <?php foreach($model->products as $product):?>
            <?php if(is_null($product->parent_id)):?>
                <div class="col-xs-6 col-md-3">
                    <?php if(count($product->files) > 0):?>
                        <?php $imgArray = $product->files;?>
                        <a href="<?=Url::to(['catalog/view', 'id' => $model->id, 'product' => $product->id]); ?>" class="thumbnail color-link img-container" style="background-image: url('<?= Yii::$app->homeUrl.$imgArray[0]->path;?>')">
                            <div class="img-color-name"><?=$product->name;?></div>
                        </a>
                    <?php else:?>
                        <a href="<?=Url::to(['catalog/view', 'id' => $model->id, 'product' => $product->id]); ?>">
                            <?=$product->name;?>
                        </a>
                    <?php endif;?>
                </div>
            <?php endif;?>
        <?php endforeach;?>
    <?php endif;?>
</div>
<?php
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $model->description]);
$this->title = $model->name;
?>