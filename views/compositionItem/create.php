<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Composition */

$this->title = 'Добавление продукта в комплект';
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['catalog/index']];
$this->params['breadcrumbs'][] = ['label' => $composition->product->catalog->name, 'url' => ['catalog/view', 'id' => $composition->product->catalog->id]];
$this->params['breadcrumbs'][] = ['label' => $composition->product->name, 'url' => ['catalog/view', 'id' => $composition->product->catalog->id, 'product' => $composition->product->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="composition-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('//compositionItem/_form', [
        'model' => $model,
        'composition' => $composition
    ]) ?>

</div>