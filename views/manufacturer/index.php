<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поставщики';
$this->params['breadcrumbs'][] = ['label' => 'Управление', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= GridView::widget([
        'summary'       => '<div class="summary pull-right">Найдено :<span class="badge">{totalCount}</span></div><div class="clearfix"></div>',
        'dataProvider'  => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'name',
            //'image',
            'url:url',
            'country',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <p class="pull-right">
        <?= Html::a('Добавить поставщика', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
