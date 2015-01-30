<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Catalog;
$this->title = 'Каталог продукции Офискон';
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['index']];
?>
<div class="catalog-update">
    <?= $this->render('_form', [
        'model'     => $model,
    ]) ?>
</div>
