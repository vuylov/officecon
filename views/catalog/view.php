<?php
use yii\helpers\Html;
use yii\helpers\VarDumper;
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
<div>
    <?php if(count($model->products) > 0):?>
    <div>
        <ul>
            <?php foreach($model->products as $product):?>
                <?php if(is_null($product->parent_id)):?>
                    <li>
                        <?=Html::a($product->name, ['catalog/view', 'id' => $model->id, 'product' => $product->id]);?>
                    </li>
                <?php endif;?>
            <?php endforeach;?>
        </ul>
    </div>
    <?php endif;?>
</div>
<?php
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $model->description]);
$this->title = $model->name;
?>