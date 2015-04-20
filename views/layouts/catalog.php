<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\CatalogMenu;
use app\components\TopMenu;
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
            //'brandLabel' => 'ОфисКон',
            //'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse green-layout',
            ],
        ]);
        echo Nav::widget([
            'options'           => ['class' => 'navbar-nav', 'id' => 'header-menu'],
            'activateParents'   => true,
            'route'  => 'catalog/index',
            'items' => TopMenu::getItems()
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
                            'items' => CatalogMenu::getItems(),
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
        <div style="margin-top: 20px">
            <img src="<?=Yii::$app->homeUrl.'img/why.png';?>" class="img-responsive" style="float: right">
            <span class="clearfix"></span>
        </div>
    </div>
    <div class="row footer">
        <div class="col-md-10">
            <div>&copy; ОфисКон <?= date('Y') ?></div>
            <div>Все права защищены и охраняются законом. Использование материалов сайта разрешено только с письменного разрешения ООО «ОфисКон». Информация, размещенная на сайте, не является публичной офертой. За дополнительной информацией обращайтесь по вышеуказанным телефонам</div>
        </div>
        <div class="col-md-2 text-center">
            <a href="http://www.volsu.ru"><?= Html::img('@web/img/banners/volsu_grad.jpg', ['class' => 'img-thumbnail']);?></a>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
