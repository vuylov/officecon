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

<?= $form->field($model, 'name')->hint('Введите название ктаегории');?>
<?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(Catalog::find()->all(), 'id', 'name'),[
    'prompt'    => 'Корень'
]);?>
<?= $form->field($model, 'level')->hint('Установите уровень категории(например, 1, 2, 3, 4 и т.д.)');?>
<?= $form->field($model, 'sort')->hint('Введите число для сортировки');?>
<?= $form->field($model, 'keywords')->textarea()->hint('Укажите через запятую ключевые слова для поисковиков');?>
<?= $form->field($model, 'description')->textarea()->hint('Укажите словесное описание категории для поисковиков');?>
<?= $form->field($model, 'visible')->checkbox()->hint('Показывать в каталоге или нет');?>


<div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>