<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Product;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin([
        'options'   => [
            'enctype'   => 'multipart/form-data'
        ]
    ]); ?>

   <?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map(Product::find()->where(['id' => $model->product_id])->all(), 'id', 'name'),[
       'readonly'   => true
   ]);?>

    <?= $form->field($model, 'article')->textInput(['maxlength' => 255]); ?>

    <?= $form->field($model, 'size')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->field($model, 'volume')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'description')->widget(Widget::className(),[
        'settings'  => [
            'lang'          => 'ru',
            'minHeight'     => 200,
            'pastePlainText'=> true,
            'plugins'       => ['talbe', 'fullscreen', 'video', 'fontsize', 'fontcolor']
        ]
    ]);?>

    <?php if(count($model->files) > 0):?>
        <div class="product-images">
            <?php foreach($model->files as $img):?>
                <div class="image-item">
                    <?=Html::img('@web/'.$img->path, ['id' => 'file-'.$img->id, 'class' => 'file-preview-image', 'alt' => $img->name, 'data' => $img->id]);?>
                    <?=Html::a('Удалить', ['file/delete', 'id' => $img->id],[
                        'class' => 'btn btn-danger delete-image',
                        'data' => [
                            'confirm' => 'Вы уверены что хотите удалить изображение',
                            'method' => 'post',
                        ],
                    ]);?>
                </div>
            <?php endforeach;?>
        </div>
    <?php endif;?>

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
