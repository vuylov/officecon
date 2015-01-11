<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Catalog;

$form = ActiveForm::begin([
    'id' => 'add-from',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]);?>

<?= $form->field($model, 'name');?>
<?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(Catalog::find()->all(), 'id', 'name'),[
    'prompt'    => 'Корень'
]);?>
<?= $form->field($model, 'level');?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>