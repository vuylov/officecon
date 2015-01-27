<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Item;
use app\models\Currency;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\ProductPrice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-price-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'productItem_id')->textInput() ?>

    <?= $form->field($model, 'productItem_id')->dropDownList(ArrayHelper::map(Item::find()->all(), 'id', 'article'),[
        'readonly' => true
    ]);?>

    <?= $form->field($model, 'currency_id')->dropDownList(ArrayHelper::map(Currency::find()->all(), 'id', 'name'),[
        'prompt'    => 'Выберите валюту'
    ]) ?>

    <?= $form->field($model, 'value')->textInput()->hint('Укажите числовое значение') ?>

    <?= $form->field($model, 'cause')->widget(Widget::className(),[
        'settings'  => [
            'lang'          => 'ru',
            'minHeight'     => 200,
            'pastePlainText'=> true,
            'plugins'       => ['talbe', 'fullscreen', 'video', 'fontsize', 'fontcolor']
        ]
    ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Отмена', ['item/view', 'id' => $model->productItem_id], ['class' => 'btn btn-success']);?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
