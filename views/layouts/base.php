<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <a href="<?=Yii::getAlias('@web');?>">
                    <img src="<?=Yii::$app->homeUrl?>img/logo.png">
                </a>
            </div>
            <div class="col-md-4">
                <div class="header-center-block">
                    <div style="text-align: center; font-weight: bold; font-size: 24px"><span class="glyphicon glyphicon-phone-alt"></span> 8 (8442) 65-00-85</div>
                    <div style="text-align: center;font-size: 16px"><span class="glyphicon glyphicon-earphone"></span>+7 (902) 362-57-94</div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="header-center-block">
                    <div><span class="glyphicon glyphicon-map-marker"></span><strong>Адрес</strong>: <?=Html::a('ул.Командира Рудь 1«А» офис 415', ['site/contact']);?></div>
                    <div><span class="glyphicon glyphicon-envelope"></span> <strong>Email: </strong><a href="mailto:gleb-smu@yandex.ru">gleb-smu@yandex.ru</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="wrap">
        <?php
        NavBar::begin([
            'options' => [
                'class' => 'navbar-inverse green-layout',
            ],
        ]);
        echo Nav::widget([
            'options'           => ['class' => 'navbar-nav', 'id' => 'header-menu'],
            'activateParents'   => true,
            'items' => [
                ['label' => 'Главная', 'url' => ['/site/index']],
                ['label' => 'Каталог', 'url' => ['catalog/index']],
                ['label' => 'Дизайн-проекты', 'url' => ['/project/design']],
                ['label' => 'Портфолио', 'url' => ['/project/portfolio']],
                ['label' => 'Контакты', 'url' => ['/site/contact']],
                Yii::$app->user->isGuest ?
                    ['label' => 'Войти', 'url' => ['/site/login']] :
                    ['label' => 'Выйти (' . Yii::$app->user->identity->name . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post', 'class' => 'navbar-right']],
            ],
        ]);
        NavBar::end();
        ?>
        <div class="content">
                <?= $content ?>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; ОфисКон <?= date('Y') ?></p>
        </div>
    </footer>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
