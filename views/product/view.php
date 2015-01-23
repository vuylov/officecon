<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
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
        ],
    ]) ?>

</div>
