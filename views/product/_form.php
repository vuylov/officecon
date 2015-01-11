<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\Catalog;
use app\models\Manufacturer;
use app\models\Product;
?>

<?php $form = ActiveForm::begin([
    'id'    => 'product-form',
    'options' => ['class' => 'form-horizontal'],
]);?>

<?= $form->field($product, 'name');?>
<?= $form->field($product, 'description')->textarea();?>
<?= $form->field($product, 'user_id');?>
<?= $form->field($product, 'parent_id')->dropDownList(ArrayHelper::map(Product::find()->where('parent_id IS NULL')->all(),'id','name'));?>
<?= $form->field($product, 'manufacturer_id')->dropDownList(ArrayHelper::map(Manufacturer::find()->all(), 'id', 'name'));?>
<?= $form->field($catalog, 'id')->checkboxList(ArrayHelper::map(Catalog::find()->all(), 'id', 'name'));?>

<div class="pull-right">
    <?= Html::submitButton(($product->isNewRecord)?"Добавить":"Обновить", ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end();?>