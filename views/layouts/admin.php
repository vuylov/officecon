<?php $this->beginContent('@app/views/layouts/base.php'); ?>
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
<?php $this->endContent(); ?>
