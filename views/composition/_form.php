<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
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
        'readonly'  => true
    ]);?>

    <?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map(Product::find()->where('parent_id IS NULL')->all(), 'id', 'name'),[
        'readonly'  => true
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

    <?php if(count($model->files) > 0):?>
        <div class="product-images">
            <?php foreach($model->files as $img):?>
                <div class="image-item">
                    <?=Html::img('@web/'.$img->path, ['id' => 'file-'.$img->id, 'class' => 'file-preview-image', 'alt' => $img->name, 'data' => $img->id]);?>
                    <?=Html::a('Удалить', ['file/delete', 'id' => $img->id],[
                        'class' => 'btn btn-danger delete-image',
                        'onclick'   => "
                            $.ajax({
                                type: 'POST',
                                cache: false,
                                url: '".Url::to(['file/delete', 'id' => $img->id])."',
                                success: function(response){
                                    alert('Изображение удалено удален');
                                    location.reload();
                                }
                            });return false;
                        "
                    ]);?>
                </div>
            <?php endforeach;?>
        </div>
        <div class="clearfix"></div>
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
        <?=Html::a('Отмена',['catalog/view', 'id' => $product->catalog->id, 'product' => $product->id, '#' => 'compositions'],['class' => 'btn btn-primary']);?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div class="clearfix"></div>
