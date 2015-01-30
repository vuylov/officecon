<?php

use yii\helpers\Html;
use metalguardian\fotorama\Fotorama;
use yii\bootstrap\Tabs;
use app\components\DataProductItems;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name.': '.$model->catalog->name;
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['catalog/index']];
$this->params['breadcrumbs'][] = ['label' => $model->catalog->name, 'url' => ['catalog/view', 'id' => $model->catalog->id]];
if(!is_null($model->parent_id)){
    $this->params['breadcrumbs'][] = ['label' => $model->parent->name, 'url' => ['catalog/view', 'id' => $model->catalog->id, 'product' => $model->parent->id]];
}
$this->params['breadcrumbs'][] = $model->name;
?>
    <?php if(!Yii::$app->user->isGuest):?>
        <div class="pull-right" style="position: fixed; right: 100px; width: 100px">
            <?= Html::a('Изменить', ['product/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['product/delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены что хотите удалить продукт',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('Добавить продукт', ['product/create', 'catalog'=>$model->catalog->id, 'product' => $model->id], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="clearfix"></div>
    <?php endif;?>
    <div class="product-detail <?=(!Yii::$app->user->isGuest)?'edit-product':''; ?>">
        <h1><?= Html::encode($model->name) ?></h1>

        <?php if(count($model->files) > 0):?>
            <div>
                <?php $fotorama = Fotorama::begin([
                    'options'    => [
                        'loop'   => 'true',
                        //'hash'   => 'true',
                        'width'  => 600,
                        'height' => 400,
                        'allowfullscreen' => 'native',
                        'autoplay'=> 5000
                    ] ,
                    'spinner'   => [
                        'lines' => 20,
                    ]
                ]);?>
                <?php foreach($model->files as $img):?>
                    <?= Yii::$app->formatter->asImage('@web/'.$img->path, ['title' => $img->name, 'alt' => $img->name]);?>
                <?php endforeach;?>
                <?php $fotorama->end();?>
            </div>
        <?php endif;?>

        <?= Tabs::widget([
            'items' => DataProductItems::getItems($model),
        ]);?>
    </div>
<?
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $model->description_seo]);
//$this->title = $model->name;
?>