<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Composition;
use app\models\Product;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\Composition */
?>
    <div class="add-product-to-composition-form">
        <?php $form = ActiveForm::begin();?>
        <?= $form->field($model, 'composition_id')
            ->dropDownList(ArrayHelper::map(Composition::find()->all(), 'id', 'name'), [
                'readonly' => true
            ]);?>

        <?= $form->field($model, 'product_id')
                ->dropDownList(ArrayHelper::map(Product::find()->where('parent_id = :p', [':p' => $composition->product_id])->all(), 'id', 'productFullName'),[
            'prompt'    => 'Выберите артикул'
        ]);?>

        <?= $form->field($model, 'amount')->textInput()->hint('Укажите количество');?>

        <div class="form-group pull-right">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?=Html::a('Отмена',['catalog/view', 'id' => $composition->product->catalog->id, 'product' => $composition->product->id],['class' => 'btn btn-primary']);?>
        </div>

        <?php ActiveForm::end();?>
    </div>