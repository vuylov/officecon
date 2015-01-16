<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\Catalog;
use app\models\Manufacturer;
use app\models\Product;
use vova07\imperavi\Widget;
use yii\bootstrap\Modal;
?>

<?php $form = ActiveForm::begin([
    'id'    => 'product-form',
    'options' => ['class' => 'form-horizontal'],
]);?>

<?= $form->field($product, 'name');?>

<?//= $form->field($product, 'description')->textarea();?>
<?= $form->field($product, 'description')->widget(Widget::className(),[
    'settings' => [
        'lang'         => 'ru',
        'minHeight'     => 200,
        'pastePlainText'=> true,
        'plugins'   => ['table','fullscreen','video', 'fontsize', 'fontcolor']
    ]
]);?>
<?= $form->field($product, 'user_id');?>
<?= $form->field($product, 'parent_id')->dropDownList(ArrayHelper::map(Product::find()->where('parent_id IS NULL')->all(),'id','name'));?>
<?= $form->field($product, 'manufacturer_id')->dropDownList(ArrayHelper::map(Manufacturer::find()->all(), 'id', 'name'));?>
<?= $form->field($catalog, 'id')->checkboxList(ArrayHelper::map(Catalog::find()->all(), 'id', 'name'));?>

<?php
    Modal::begin([
        'toggleButton' => [
            'label' => '<i class="glyphicon glyphicon-plus"></i>Добавить',
            'class' => 'btn btn-success'
        ],
        'closeButton' => [
            'label' => 'Close',
            'class' => 'btn btn-danger btn-sm pull-right',
        ],
        'size' => 'modal-lg',
    ]);
    echo $this->render('/productItem/add', compact(['item']));
    Modal::end();
?>

<div class="pull-right">
    <?= Html::submitButton(($product->isNewRecord)?"Добавить":"Обновить", ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end();?>