<?php

use yii\helpers\Html;
use yii\helpers\Url;
use newerton\fancybox\FancyBox;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
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
        'helpers' => [
            'title' => ['type' => 'float'],
            'buttons' => [],
            'thumbs' => ['width' => 68, 'height' => 50],
            'overlay' => [
                'css' => [
                    'background' => 'rgba(0, 0, 0, 0.8)'
                ]
            ]
    ],
    ]]);?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(!Yii::$app->user->isGuest):?>
        <p>
            <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Удалить дизайн-проект?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif;?>

    <?php if(count($model->files) > 0):?>
        <?php foreach($model->files as $file):?>
            <div style="width: 250px;height: 180px; overflow: hidden; float: left">
                <a href="<?=Url::to(Yii::$app->homeUrl.$file->path);?>" rel="fancybox">
                    <?= Html::img(Yii::$app->homeUrl.$file->path); ['width' => '250']?>
                </a>
            </div>
        <?php endforeach;?>
        <div class="clearfix"></div>
    <?php else:?>
        <div class="alert alert-info">Изображения не добавлены</div>
    <?php endif;?>
</div>
<?php
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $model->description_seo]);
?>