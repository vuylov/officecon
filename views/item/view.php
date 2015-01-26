<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use metalguardian\fotorama\Fotorama;

/* @var $this yii\web\View */
/* @var $model app\models\Item */

$this->title = $model->article;
$this->params['breadcrumbs'][] = ['label' => 'Артикулы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?=Html::a('Добавить цену',['price/create', 'item' => $model->id], ['class' => 'btn btn-success']);?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'product_id',
            [
                'label'     => 'Продукт',
                'value'     => $model->product->name
            ],
            'article',
            'size',
            'weight',
            'volume',
            'amount',
            'description:html',
        ],
    ]) ?>

    <?php if(count($model->prices) > 0): ?>
    <div class="item-prices">
        <h2>Цены</h2>
        <?php foreach($model->prices as $price):?>
            <div>
                <?=$price->value.'('.$price->cause.')';?>
            </div>
        <?php endforeach;?>
    </div>
    <?php else:?>
        <div>Цены не загружены</div>
    <?php endif;?>

    <?php if(count($model->files) > 0):?>
        <div>
            <?php $fotorama = Fotorama::begin([
                'options'    => [
                    'loop'   => true,
                    'hash'   => true,
                    'width'  => 600,
                    'height' => 400,
                    'allowfullscreen' => 'native'
                ] ,
                'spinner'   => [
                    'lines' => 20,
                ]
            ]);?>
            <?php foreach($model->files as $img):?>
                <?= Yii::$app->formatter->asImage('@web/'.$img->path, ['title' => $img->name, 'alt' => $img->name]);?>
            <?php endforeach;?>
            <?php $fotorama->end();?>
        </div>
    <?php endif;?>

</div>
