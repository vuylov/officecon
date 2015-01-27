<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Composition */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Комплектации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="composition-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы увереные что хотите удалить компоновку?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Добавить продукт',[''],['']);?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description',
            'price',
            'manufacturer_id',
        ],
    ]) ?>



</div>
