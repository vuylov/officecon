<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductPrice */

$this->title = 'Update Product Price: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-price-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
