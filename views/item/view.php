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
        <?=Html::a('Вернуться к продукту',['product/view', 'id' => $model->product_id],['class' => 'btn btn-success']);?>
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
        <table class="table table-bordered">
            <thead><tr><th>Цена</th><th>Валюта</th><th>Пояснение</th><th>Управление</th></tr></thead>
                <tbody>
                <?php foreach($model->prices as $price):?>
                    <tr>
                        <td><?=$price->value?></td><td><?=$price->currency->name?></td><td><?=$price->cause?></td>
                        <td>
                            <?=Html::a('Изменить', ['price/update', 'id' => $price->id],['class' => 'btn btn-primary']);?>
                            <?=Html::a('Удалить',['price/delete', 'id' => $price->id],['class' => 'btn btn-danger'])?>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
        </table>
    </div>
    <?php else:?>
        <div class="alert alert-danger">Цены не загружены</div>
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
