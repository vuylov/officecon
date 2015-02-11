<?php

use yii\helpers\Html;
use metalguardian\fotorama\Fotorama;
use yii\bootstrap\Tabs;
use app\components\DataProductItems;
use newerton\fancybox\FancyBox;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name.': '.$model->catalog->name;
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['catalog/index']];
$this->params['breadcrumbs'][] = ['label' => $model->catalog->name, 'url' => ['catalog/view', 'id' => $model->catalog->id]];
if(!is_null($model->parent_id)){
    $this->params['breadcrumbs'][] = ['label' => $model->parent->name, 'url' => ['catalog/view', 'id' => $model->catalog->id, 'product' => $model->parent->id]];
}
$this->params['breadcrumbs'][] = $model->name;
echo FancyBox::widget([
    'target' => 'a[rel=fancybox]',
    'helpers' => true,
    'mouse' => true,
    'config' => [
        'maxWidth' => '90%',
        'maxHeight' => '90%',
        //'playSpeed' => 7000,
        'arrows' => false,
        'padding' => 0,
        'fitToView' => false,
        'width' => '70%',
        'height' => '70%',
        'autoSize' => false,
        'closeClick' => false,
        'openEffect' => 'elastic',
        'closeEffect' => 'elastic',
        'prevEffect' => 'elastic',
        'nextEffect' => 'elastic',
        'closeBtn' => true,
        'openOpacity' => true,
        //'autoCenter'  => true,
        /*'helpers' => [
            'title' => ['type' => 'float'],
            'buttons' => [],
            //'thumbs' => ['width' => 68, 'height' => 50],
            'overlay' => [
                'css' => [
                    'background' => 'rgba(0, 0, 0, 0.8)'
                ]
            ]
    ],*/
]]);?>
    <?php if(!Yii::$app->user->isGuest):?>
        <div class="pull-right fixed-right-menu">
            <?= Html::a('Изменить продукт', ['product/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить продукт', ['product/delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены что хотите удалить продукт',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('Добавить продукт', ['product/create', 'catalog'=>$model->catalog->id, 'product' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php if(!$model->parent_id):?>
                <?= Html::a('Добавить компоновку', ['composition/create', 'product' => $model->id], ['class' => 'btn btn-primary']);?>
            <?php endif;?>
        </div>
        <div class="clearfix"></div>
    <?php endif;?>
    <div class="product-detail <?=(!Yii::$app->user->isGuest)?'edit-product':''; ?>">
        <h1><?= Html::encode($model->name) ?></h1>

        <?php if(count($model->files) > 0):?>
            <div class="product-foto">
                <?php $fotorama = Fotorama::begin([
                    'options'    => [
                        'loop'   => 'true',
                        //'hash'   => 'true',
                        'width'  => 600,
                        'height' => 400,
                        'allowfullscreen' => 'native',
                        'autoplay'=> 5000,
                        'caption'   => true
                    ] ,
                    'spinner'   => [
                        'lines' => 20,
                    ]
                ]);?>

                <?php foreach($model->files as $img):?>
                    <?= Yii::$app->formatter->asImage('@web/'.$img->path, ['title' => $img->name, 'alt' => $img->name/*, 'data-caption' => 'Цена: 50000'*/]);?>

                <?php endforeach;?>
                <?php $fotorama->end();?>
            </div>
        <?php else:?>
            <?= Html::img(Yii::$app->homeUrl.'/img/nofoto.jpg', ['width' => '300px']);?>
        <?php endif;?>
        <div class="clearfix"></div>
        <?= Tabs::widget([
            'items' => DataProductItems::getItems($model),
        ]);?>
    </div>
<?php
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $model->description_seo]);
?>