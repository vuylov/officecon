<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Composition */

$this->title = 'Изменение продукта в комплекте';
$this->params['breadcrumbs'][] = ['label' => 'Компоновки', 'url' => ['composition/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="composition-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('//compositionItem/_form', [
        'model' => $model,
    ]) ?>

</div>