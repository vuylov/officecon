<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Product;
?>

<div class="add-color-product-form">
    <?php $form = ActiveForm::begin([]);?>

        <?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map(Product::find()->where('manufacturer_id = :m', [':m' => $product->manufacturer_id])->all(), 'id', 'name'),[
        'readonly' => true,
    ]);?>

    <?php if(isset($checked)):?>
        <?= Html::checkboxList('ProductColors[color_id]', $checked, ArrayHelper::map($colors, 'id', 'name'), []);?>
    <?php else:?>
        <?= $form->field($model, 'color_id')->checkboxList(ArrayHelper::map($colors, 'id', 'name'), [
            'separator' => '<br>'
        ]); ?>
    <?php endif;?>
    <div class="buttons-group pull-right">
        <?=Html::submitButton(($checked)?'Изменить':'Добавить', ['class' => ($checked)?'btn btn-primary':'btn btn-success']);?>
    </div>
    <?php ActiveForm::end();?>
</div>