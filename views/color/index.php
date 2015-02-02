<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Цвета';
$this->params['breadcrumbs'][] = ['label' => 'Управление', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="color-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= GridView::widget([
        'summary'       => '<div class="summary pull-right">Найдено :<span class="badge">{totalCount}</span></div><div class="clearfix"></div>',
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'manufacturer.name',
            'name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <p class="pull-right">
        <?= Html::a('Добавить цвет', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
