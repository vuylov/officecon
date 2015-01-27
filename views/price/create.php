<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductPrice */

$this->title = 'Добавление цены артикулу';
$this->params['breadcrumbs'][] = ['label' => 'Цены', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
