<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use metalguardian\fotorama\Fotorama;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить продукт',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Добавить артикул', ['item/create', 'product' => $model->id], ['class' => 'btn btn-success']);?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'label' => 'Продукт относится',
                'value' => ($model->parent->name)?$model->parent->name:'Корневой'
            ],
            [
                'label' => 'Поставщик',
                'value' => $model->manufacturer->name
            ],
            [
                'label' => 'Кталог',
                'value' => implode(', ', $catalogs)
            ],
            'description:html',
            [
                'label' => 'Отображение на сайте',
                'value' => ($model->active)?'Да':'Нет'
            ],
            [
                'label' => 'Продукт добавил',
                'value' => $model->user->name
            ],
            'create_at',
            'deactivate_at',
            'producer',
            [
                'label' => 'Артикулы',
                'value' => implode(', ', \yii\helpers\ArrayHelper::map($model->items, 'id', 'article'))
            ],
        ],
    ]) ?>

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
