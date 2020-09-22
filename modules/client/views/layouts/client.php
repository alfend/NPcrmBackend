<?php

/* @var $this \yii\web\View */

/* @var $content string */

namespace app\components;

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\Menu;
use app\models\User;
use Yii;

//Если не клиент перенаправляем на главную
if (!(User::getRole(Yii::$app->user->getId()) == User::TYPE_CLIENT)) {
    Yii::$app->getResponse()->redirect(Yii::$app->getUser()->loginUrl);
}


AppAsset::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">


<!-- HEAD -->
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?= Html::csrfMetaTags() ?>

    <link rel="manifest" href="/web/js/manifest.json">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="/web/img/favicon.ico">
    <!-- END FAVICON -->
    <link rel="stylesheet" href="/web/libs/calendar/jquery-range-calendar/css/rangecalendar.css">
    <!-- range slider -->
    <link rel="stylesheet" href="/web/libs/ion.rangeSlider/css/ion.rangeSlider.min.css"/>

    <!-- BOOTSTRAP STYLE -->
    <!--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
    <!-- END BOOTSTRAP STYLE -->

    <!-- монтажник выбор -->
    <link rel="stylesheet" href="/web/libs/slick/css/slick.css">
    <link rel="stylesheet" href="/web/libs/aos-animate/aos.css">
    <link rel="stylesheet" href="/web/libs/rateYo/jquery.rateyo.min.css">

    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="/web/css/main.css">
    <!-- END MAIN STYLE -->

</head>
<title><?= Html::encode($this->title) ?></title>
<!-- END HEAD -->


<?php $this->beginBody() ?>
<body>

<!-- PRELOADER -->
<div class="preloader loading">
    <svg width="60" height="15">
        <use xlink:href="/web/img/svg/sprite.svg#loading"></use>
    </svg>
</div>
<!-- END PRELOADER -->

<main class="wrap-container full-screen">

    <!-- HEADER -->
    <header class="header sticky">
        <div class="container container-xs px-0">
            <div class="row align-items-center">
                <div class="col">
                    <button class="action action--open" aria-label="Open Menu">
                        <svg class="svg-bars_menu" width="32" height="24">
                            <use xlink:href="/web/img/svg/sprite.svg#bars_menu"></use>
                        </svg>
                    </button>
                </div>
                <div class="col-auto">
                    <a href="">
                        <svg class="svg-user" width="23" height="24">
                            <use xlink:href="/web/img/svg/sprite.svg#user"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <!-- END HEADER -->

    <!-- NAV -->
    <nav id="ml-menu" class="menu">
        <button class="action action--close" aria-label="Close Menu">
            <svg class="svg-close" width="14" height="14">
                <use xlink:href="/web/img/svg/sprite.svg#close"></use>
            </svg>
        </button>
        <div class="menu__wrap">
            <ul data-menu="main" class="menu__level">
                <li class="menu__item">
                    <a class="menu__link" data-submenu="submenu-1" href="/client/default/index">Главная</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" data-submenu="submenu-2" href="#">Мои замеры</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" data-submenu="submenu-3" href="#">Мои заказы</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" data-submenu="submenu-4" href="#">Уведомления</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" data-submenu="submenu-5" href="#">чат</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" data-submenu="submenu-6" href="#">баланс</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" data-submenu="submenu-7" href="#">мои задачи</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" data-submenu="submenu-8" href="#">соглашения</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" data-submenu="submenu-9" href="#">календарь заказов</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" data-submenu="submenu-10" href="#">мои данные</a>
                </li>
            </ul>
            <!-- Submenu 2 -->
            <ul data-menu="submenu-2" class="menu__level">
                <li class="menu__item">
                    <a class="menu__link" href="/client/default/request-new-metering-date">новый замер</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="/client/default/request-metering-all">мои замеры</a>
                </li>
            </ul>
            <!-- Submenu 3 -->
            <ul data-menu="submenu-3" class="menu__level">
                <li class="menu__item">
                    <a class="menu__link" href="#">мои потолки</a>
                </li>
            </ul>
            <!-- Submenu 6 -->
            <ul data-menu="submenu-6" class="menu__level">
                <li class="menu__item">
                    <a class="menu__link" href="#">история баланса</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">операции с балансом</a>
                </li>
            </ul>
            <!-- Submenu 8 -->
            <ul data-menu="submenu-8" class="menu__level">
                <li class="menu__item">
                    <a class="menu__link" href="#">условие соглашения</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">пользовательское соглашение</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">публичная оферта</a>
                </li>
            </ul>
            <!-- Submenu 10 -->
            <ul data-menu="submenu-10" class="menu__level">
                <li class="menu__item">
                    <a class="menu__link" href="#">личные данные</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">банковские реквизиты</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END NAV -->
    <?= \app\widgets\ClientHeader::widget() ?>
    <?= $content ?>

    <?= \app\widgets\ClientFooter::widget() ?>

</main>




<script src="/web/libs/slick/js/slick.min.js"></script>
<!-- rating -->
<script src="/web/libs/rateYo/jquery.rateyo.min.js"></script>


<!-- Scripts -->
<!-- jQuery -->
<script src="/web/libs/jquery/jquery-3.4.1.min.js"></script>
<!-- anim nav menu -->
<script src="/web/libs/metaProduct/modernizr-custom.js"></script>
<script src="/web/libs/metaProduct/classie.js"></script>
<script src="/web/libs/metaProduct/dummydata.js"></script>
<script src="/web/libs/metaProduct/main.js"></script>
<script src="/web/libs/metaProduct/init.js"></script>
<!-- jquery.rangecalendar -->
<script src="/web/libs/calendar/jquery-ui/jquery-ui-1.12.1.min.js"></script>
<script type="text/javascript"
        src="/web/libs/calendar/touch-punch/touch-punch.js"></script>

<script type="text/javascript" src="/web/libs/calendar/moment/moment-with-langs.min.js"></script>
<script type="text/javascript" src="/web/libs/calendar/jquery-range-calendar/js/jquery.rangecalendar.js"></script>
<!-- rangeSlider -->
<script src="/web/libs/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
<!-- highcharts -->
<script src="/web/libs/highcharts/highcharts.js"></script>
<!-- svg polyfill for old browsers -->
<script src="/web/libs/polyfills/svg4everybody.min.js"></script>
<!-- main script -->
<script src="/web/js/main.js"></script>

<?php /*
    <!-- Scripts -->
    <!-- jQuery -->
        <script src="/web/libs/jquery/jquery-3.4.1.min.js"></script>
        <!-- anim nav menu -->
        <script src="/web/libs/metaProduct/modernizr-custom.js"></script>
        <script src="/web/libs/metaProduct/classie.js"></script>
        <script src="/web/libs/metaProduct/dummydata.js"></script>
        <script src="/web/libs/metaProduct/main.js"></script>
        <script src="/web/libs/metaProduct/init.js"></script>
        <!-- highcharts -->
        <script src="/web/libs/highcharts/highcharts.js"></script>
        <!-- svg polyfill for old browsers -->
        <script src="/web/libs/polyfills/svg4everybody.min.js"></script>
        <!-- main script -->
        <script src="/web/js/main.js"></script>
    <script src="/web/libs/calendar/jquery-ui/jquery-ui-1.12.1.min.js"></script>
    <script type="text/javascript"
            src="/web/libs/calendar/touch-punch/touch-punch.js"></script>

    <script type="text/javascript"
            src="/web/libs/calendar/moment/moment-with-langs.min.js"></script>
    <script type="text/javascript" src="/web/libs/calendar/jquery-range-calendar/js/jquery.rangecalendar.js"></script>
    <script src="/web/libs/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
 */ ?>
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>


