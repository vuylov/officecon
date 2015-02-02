<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\AdminMenu;

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
                <div style="text-align: center; font-weight: bold; font-size: 20px">8 (8442) 65-00-85</div>
                <div style="text-align: center;font-size: 16px">+7 (902) 362-57-94</div>
            </div>
            <div class="col-md-4">
                <div>ул. Командира Рудь 1"А"</div>
                <div>Смотреть на карте</div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="wrap">
        <?php
        NavBar::begin([
            //'brandLabel' => 'ОфисКон',
            //'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse green-layout',
            ],
        ]);
        echo Nav::widget([
            'options'           => ['class' => 'navbar-nav', 'id' => 'header-menu'],
            'activateParents'   => true,
            'route'  => 'admin/index',
            'items' => [
                ['label' => 'Главная', 'url' => ['/site/index']],
                ['label' => 'Каталог', 'url' => ['catalog/index']],
                ['label' => 'Дизайн-проекты', 'url' => ['/designs/index']],
                ['label' => 'Портфолио', 'url' => ['/projects/index']],
                ['label' => 'О компании', 'url' => ['/site/about']],
                ['label' => 'Контакты', 'url' => ['/site/contact']],

                Yii::$app->user->isGuest ?
                    ['label' => 'Войти', 'url' => ['/site/login']] :
                    ['label' => 'Выйти (' . Yii::$app->user->identity->name . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']],
            ],
        ]);
        NavBar::end();
        ?>
        <div class="content">
            <div class="row">
                <div class="col-md-3 sidebar">
                    <ul class="nav nav-sidebar">
                        <?php echo \yii\bootstrap\Nav::widget([
                            'id'    => 'catalog-menu',
                            'encodeLabels' => false,
                            'items' => AdminMenu::getItems(),
                            'options'   => ['class' => 'nav-pills nav-stacked']
                        ]);?>
                    </ul>

                </div>
                <div class="col-md-9">
                    <div class="product-view">
                        <div>
                            <?= Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                'homeLink' => ['label' => 'Главная', 'url' => Yii::$app->homeUrl],
                            ]) ?>
                        </div>
                        <div class="content">
                            <?= $content ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer green-layout">
        <div class="container">
            <p class="pull-left">&copy; ОфисКон <?= date('Y') ?></p>
        </div>
    </footer>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
