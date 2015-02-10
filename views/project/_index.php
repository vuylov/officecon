<?php
use yii\helpers\Url;
use app\models\Project;
if($type === Project::DESIGN){
    $keywords = 'дизайн-проект, дизайн-проекты, дизайнпроект, дизайн проект, дизайн проекты в волгограде, сделать дизайн проект, нарисовать дизайг проект в волгограде, скачать дизайн проект';
    $description = 'Офискон предоставляет услуги по разработке дизайн-проектов любой сложности. Нами разработаны и реализованы проекты по VIP-номерам в отелях, офисы, актовые залы, банки, диспетческие, операторные, конференц-залы';
    $this->title = 'Дизайн-проекты компании ОфисКон';
}else{
    $keywords = 'портфолио офискон, выполненные работы офискон, отзывы офискон, офискон отзывы, отзыв офискон, решения';
    $description = 'Офискон имеет опыт работы с крупными заказчиками. Нашими клиентами являются: Лукойл, Лукойл-Информ, Лукойл-Транс, Сбербанк, ВолГУ, ВолГТУ и другие.';
    $this->title = 'Портфолио компании ОФисКон, выполненные проекты ОфисКон';
}
?>
    <div class="row projects">
        <?php foreach($projects as $project):?>
            <div class="col-xs-6 col-md-3 project-thumb">
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
<?php
$this->registerMetaTag(['name' => 'keywords', 'content' => $keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $description]);
?>