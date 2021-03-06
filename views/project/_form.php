<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use vova07\imperavi\Widget;
use app\models\Project;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin([
        'options'   => [
            'enctype'   => 'multipart/form-data'
        ]
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->widget(Widget::className(),[
        'settings'  => [
            'lang'          => 'ru',
            'minHeight'     => 200,
            'pastePlainText'=> true,
            'plugins'       => ['talbe', 'fullscreen', 'video', 'fontsize', 'fontcolor']
        ]
    ]);?>

    <?= $form->field($model, 'type')->dropDownList([Project::DESIGN => 'Дизайн-проект', Project::PORTFOLIO => 'Портфолио'], [
        'prompt' => 'Укажите тип проекта'
    ]) ?>

    <?= $form->field($model, 'keywords')->textarea(['row' => 5])->hint('Укажите ключевые слова через запятую');?>

    <?= $form->field($model, 'description_seo')->textarea(['row' => 5]);?>

    <?php if(count($model->files) > 0):?>
        <div class="product-images">
            <?php foreach($model->files as $img):?>
                <div class="image-item">
                    <?php $class = ($model->thumb_id === $img->id) ? 'start-image':'';?>
                    <?=Html::img('@web/'.$img->path, ['id' => 'file-'.$img->id, 'class' => 'file-preview-image '.$class, 'alt' => $img->name, 'data' => $img->id]);?>
                    <div class="manage-buttons-img">
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
                        <?php if($model->thumb_id !== $img->id):?>
                            <?=Html::a('Сделать главной', ['project/defaultimg', 'model' => $model->id, 'id' => $img->id],[
                                'class' => 'btn btn-success',
                                'onclick'   => "
                                $.ajax({
                                    type: 'POST',
                                    cache: false,
                                    url: '".Url::to(['project/defaultimg', 'model' => $model->id, 'id' => $img->id])."',
                                    success: function(response){
                                        alert(response);
                                        location.reload();
                                    }
                                });return false;
                            "
                            ]);?>
                        <?php endif;?>
                    </div>
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
    </div>

    <?php ActiveForm::end(); ?>

</div>
