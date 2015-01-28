<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Composition */

$this->title = 'Добавление продукта в комплект';
$this->params['breadcrumbs'][] = ['label' => 'Компоновки', 'url' => ['composition/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="composition-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('//compositionItem/_form', [
        'model' => $model,
    ]) ?>

</div>