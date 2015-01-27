<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductPrice */

$this->title = 'Изменение цены:';
$this->params['breadcrumbs'][] = ['label' => 'Цены', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->item->article, 'url' => ['item/view', 'id' => $model->productItem_id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="product-price-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
