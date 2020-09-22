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

<main class="wrap-container">



                    <?= $content ?>

</main>
<!-- /.wrap-container -->

<!-- Scripts -->
<!-- jQuery -->
<script src="/web/libs/jquery/jquery-3.4.1.min.js"></script>
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


