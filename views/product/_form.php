<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Product;
use app\models\Catalog;
use app\models\Type;
use app\models\Manufacturer;
use vova07\imperavi\Widget;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'options'   => [
            'enctype'   => 'multipart/form-data'
        ]
    ]); ?>

    <?= $form->field($model, 'catalog_id')->dropDownList(ArrayHelper::map(Catalog::find()->all(), 'id', 'name'), [
        'readonly' => true
    ]);?>

    <?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(Product::find()->where('parent_id IS NULL')->all(), 'id', 'name'), [
        'prompt'    => 'Добавить в корень'
    ]); ?>

    <?= $form->field($model, 'manufacturer_id')->dropDownList(ArrayHelper::map(Manufacturer::find()->all(), 'id', 'name'), [
        'prompt'    => 'Укажите поставщика'
    ]); ?>

    <?= $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(Type::find()->all(), 'id', 'name'), [
        'prompt'    => 'Укажите тип'
    ])->hint('Укажите тип (опционально)'); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255])->hint('Укажите нимаенование продукта'); ?>

    <?= $form->field($model, 'producer')->textInput(['maxlength' => 255])->hint('Укажите страну производителя'); ?>

    <?= $form->field($model, 'article')->textInput(['maxlength' => 255])->hint('Укажите артикул (опционально)'); ?>

    <?= $form->field($model, 'size')->textInput(['maxlength' => 255])->hint('Укажите размер (опционально)'); ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => 255])->hint('Укажите вес (опционально)'); ?>

    <?= $form->field($model, 'volume')->textInput(['maxlength' => 255])->hint('Укажите объем (опционально)'); ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => 255])->hint('Укажите количество в упаковке (опционально)'); ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => 255])->hint('Укажите цену (опционально)'); ?>

    <?= $form->field($model, 'description')->widget(Widget::className(),[
        'settings'  => [
            'lang'          => 'ru',
            'minHeight'     => 200,
            'pastePlainText'=> true,
            'plugins'       => ['talbe', 'fullscreen', 'video', 'fontsize', 'fontcolor']
        ]
    ]);?>

    <?= $form->field($model, 'keywords')->textarea();?>
    <?= $form->field($model, 'description_seo')->textarea();?>

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
                                    alert('Изображение удалено');
                                    location.reload();
                                }
                            });return false;
                        "
                    ]);?>
                </div>
            <?php endforeach;?>
        </div>
    <?php endif;?>
    <div class="clearfix"></div>
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
        <?= Html::a('Отмена',['catalog/view', 'id' => $model->catalog->id, 'product' => $model->id],['class' => 'btn btn-primary']);?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
