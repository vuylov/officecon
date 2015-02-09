<?php
use yii\helpers\Url;
use app\models\Project;
?>

<div class="row projects">
    <?php foreach($projects as $project):?>
        <div class="col-xs-6 col-md-3 project-detail">
            <?php $src = ($project->thumb_id) ? Yii::getAlias('@web').'/'.$project->thumb_path : Yii::getAlias('@web').'/img/nofoto.jpg' ?>
            <a href="<?=Url::to(['project/'.($project->type === Project::DESIGN) ? 'design' : 'portfolio', 'id' => $project->id])?>" class="color-link">
                <img src="<?=$src?>" class="img-responsive img-thumbnail color-image">
                <div class="img-color-name">
                    <?=$project->name?>
                </div>
            </a>
        </div>
    <?php endforeach;?>
</div>