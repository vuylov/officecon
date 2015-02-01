<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->parent_id ? 'Добавление продукта в '. $model->parent->name : 'Создание нового продукта';
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['catalog/index']];
$this->params['breadcrumbs'][] = ['label' => $catalog->name, 'url' => ['catalog/view', 'id' => $catalog->id]];
if($model->parent_id){
    $this->params['breadcrumbs'][] = ['label' => $model->parent->name, 'url' => ['catalog/view', 'id' => $catalog->id, 'product' => $model->parent->id]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'     => $model,
    ]) ?>

</div>
