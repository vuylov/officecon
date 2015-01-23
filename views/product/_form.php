<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Product;
use app\models\Catalog;
use app\models\Manufacturer;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(Product::find()->where('parent_id IS NULL')->all(), 'id', 'name'), [
        'prompt'    => 'Добавить в корень'
    ]); ?>

    <?= $form->field($model, 'manufacturer_id')->dropDownList(ArrayHelper::map(Manufacturer::find()->all(), 'id', 'name'), [
        'prompt'    => 'Укажите поставщика'
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'producer')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->widget(Widget::className(),[
        'settings'  => [
            'lang'          => 'ru',
            'minHeight'     => 200,
            'pastePlainText'=> true,
            'plugins'       => ['talbe', 'fullscreen', 'video', 'fontsize', 'fontcolor']
        ]
    ]);?>

    <?php if($model->isNewRecord):?>
        <?= $form->field($catalog, 'id')->checkboxList(ArrayHelper::map(Catalog::find()->all(), 'id', 'name'),[
            'separator' => '<br>'
        ]); ?>
    <?php else:?>
        <?= Html::checkboxList('Catalog[id]', $catalogChecked, ArrayHelper::map(Catalog::find()->all(), 'id', 'name'), [
            'separator' => '<br>'
        ]);?>
    <?php endif;?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добваить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
