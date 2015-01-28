<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Composition */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Комплектации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="composition-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы увереные что хотите удалить компоновку?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Добавить продукт',['add', 'id' => $model->id],['class' => 'btn btn-success']);?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'description:html',
            'price',
            [
                'label' => 'Поставщик',
                'value' => $model->manufacturer->name
            ]
        ],
    ]) ?>

    <?php if(count($model->compositionItems) > 0):?>
        <table class="table table-bordered">
            <thead>
                <tr><th>Артикул</th><th>Количество</th><th>Управление</th></tr>
            </thead>
            <tbody>
            <?php foreach($model->compositionItems as $item):?>
                <tr>
                    <td><?=$item->article->article?></td>
                    <td><?=$item->amount?></td>
                    <td>
                        <?=Html::a('Изменить',['composition/iupdate', 'id' => $item->id],['class' => 'btn btn-primary']);?>
                        <?=Html::a('Удалить',['composition/idelete', 'id' => $item->id],[
                            'class'  => 'btn btn-danger',
                            'data'  => [
                                'confirm'   => 'Вы уверены, что хотите удалить артикул?',
                                'method'    => 'post'
                            ]
                        ]);?>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    <?php else:?>
        <div class="alert-danger">Артикулы в компановку не добавлены</div>
    <?php endif;?>


</div>
