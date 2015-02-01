<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Composition */

$this->title = 'Изменение компоновки: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['catalog/index']];
$this->params['breadcrumbs'][] = ['label' => $product->catalog->name, 'url' => ['catalog/view', 'id' => $product->catalog->id]];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['catalog/view', 'id' => $product->catalog->id, 'product' => $product->id]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['catalog/view', 'id' => $product->catalog->id, 'product' => $product->id, '#' => 'compositions']];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="composition-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'     => $model,
        'product'   => $product
    ]) ?>

</div>
