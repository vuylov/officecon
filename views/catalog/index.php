<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
?>
<h1>Каталог</h1>
<?php foreach($catalogs as $catalog):?>
    <div>
        <?=Html::a($catalog->name, ['catalog/view', 'id' => $catalog->id]);?>
        <?php if(count($catalog->childs) > 0):?>
            <ul>
                <?php foreach($catalog->childs as $subcatalog):?>
                    <li><?=Html::a($subcatalog->name, ['catalog/view', 'id' => $subcatalog->id]);?></li>
                <?php endforeach;?>
            </ul>
        <?php endif;?>
    </div>
<?php endforeach;?>