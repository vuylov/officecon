<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */
?>
<div class="site-contact">
    <h1>Контакты:</h1>
    <hr>
    <div class="row">
        <div class="col-md-7">
            <h4>Схема проезда</h4>
            <p>
                <script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=8cK1d605fqpOjKOMQWORPBRDpFwfCZ7T&width=600&height=450"></script>
            </p>
        </div>
        <div class="col-md-5">
            <p><span class="glyphicon glyphicon-calendar"></span><strong>Режим работы</strong>: с 09:00 до 18:00, без перерыва. <strong>Выходной</strong>: суббота, воскресенье</p>
            <p><span class="glyphicon glyphicon-map-marker"></span><strong>Адрес</strong>: 400080 Волгоград ул.Командира Рудь 1«А» офис 415</p>
            <p>
                <span class="glyphicon glyphicon-earphone"></span><strong>Тел:</strong>
                <b>8 (8442) 65-00-85</b> <br>
                +7-902-362-57-94  Глеб<br>
                +7-902-658-00-34  Андрей

            </p>
            <p><span class="glyphicon glyphicon-envelope"></span><strong>Email: </strong><a href="mailto:gleb-smu@yandex.ru">gleb-smu@yandex.ru</a></p>
        </div>
    </div>
</div>
<?php $this->title = 'Контакты офискон';?>