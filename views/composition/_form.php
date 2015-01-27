<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Product;
use app\models\Manufacturer;
use vova07\imperavi\Widget;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Composition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="composition-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>

    <?= $form->field($model, 'manufacturer_id')->dropDownList(ArrayHelper::map(Manufacturer::find()->all(), 'id', 'name'), [
        'prompt'    => 'Выберите поставщика'
    ]);?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->widget(Widget::className(), [
        'settings'  => [
            'lang'          => 'ru',
            'minHeight'     => 200,
            'pastePlainText'=> true,
            'plugins'       => ['talbe', 'fullscreen', 'video', 'fontsize', 'fontcolor']
        ]
    ]); ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?php echo $form->field($model, 'file[]')->widget(FileInput::classname(),[
        'options'       => [
            'accept' => 'image/*',
            'multiple' => true
        ],
        'pluginOptions' => [
            'showUpload'        => false,
            'browseLabel'       => 'Обзор',
            'removeLabel'       => 'Удалить',
            'overwriteInitial'  => true,
        ],
    ]);
    ?>

    <div class="form-group pull-right">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
