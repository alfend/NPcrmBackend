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

//Если не замерщик перенаправляем на главную
if((Yii::$app->user->isGuest)or!(User::getRole(Yii::$app->user->getId())==User::TYPE_METERING)){
    Yii::$app->getResponse()->redirect(Yii::$app->getUser()->loginUrl);
}

AppAsset::register($this);

?>
<?php $this->beginPage();
/*

?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<!-- HEAD -->

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->head() ?>
    <link rel="manifest" href="/web/js/manifest.json">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="/web/img/favicon.ico">
    <!-- END FAVICON -->

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="/web/css/main.css">
    <link rel="stylesheet" href="/web/css/site.css">
    <!-- END MAIN STYLE -->
</head>

<!-- END HEAD -->

<body>
<?php $this->beginBody() ?>
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
                    <a class="menu__link" data-submenu="submenu-1" href="#">Vegetables</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" data-submenu="submenu-2" href="#">Fruits</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" data-submenu="submenu-3" href="#">Grains</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" data-submenu="submenu-4" href="#">Mylk &amp; Drinks</a>
                </li>
            </ul>
            <!-- Submenu 1 -->
            <ul data-menu="submenu-1" class="menu__level">
                <li class="menu__item">
                    <a class="menu__link" href="#">Stalk Vegetables</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Roots &amp; Seeds</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Cabbages</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Salad Greens</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Mushrooms</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" data-submenu="submenu-1-1" href="#">Sale %</a>
                </li>
            </ul>
            <!-- Submenu 1-1 -->
            <ul data-menu="submenu-1-1" class="menu__level">
                <li class="menu__item">
                    <a class="menu__link" href="#">Fair Trade Roots</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Dried Veggies</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Our Brand</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Homemade</a>
                </li>
            </ul>
            <!-- Submenu 2 -->
            <ul data-menu="submenu-2" class="menu__level">
                <li class="menu__item">
                    <a class="menu__link" href="#">Citrus Fruits</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Berries</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" data-submenu="submenu-2-1" href="#">Special Selection</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Tropical Fruits</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Melons</a>
                </li>
            </ul>
            <!-- Submenu 2-1 -->
            <ul data-menu="submenu-2-1" class="menu__level">
                <li class="menu__item">
                    <a class="menu__link" href="#">Exotic Mixes</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Wild Pick</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Vitamin Boosters</a>
                </li>
            </ul>
            <!-- Submenu 3 -->
            <ul data-menu="submenu-3" class="menu__level">
                <li class="menu__item">
                    <a class="menu__link" href="#">Buckwheat</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Millet</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Quinoa</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Wild Rice</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Durum Wheat</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" data-submenu="submenu-3-1" href="#">Promo Packs</a>
                </li>
            </ul>
            <!-- Submenu 3-1 -->
            <ul data-menu="submenu-3-1" class="menu__level">
                <li class="menu__item">
                    <a class="menu__link" href="#">Starter Kit</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">The Essential 8</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Bolivian Secrets</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Flour Packs</a>
                </li>
            </ul>
            <!-- Submenu 4 -->
            <ul data-menu="submenu-4" class="menu__level">
                <li class="menu__item">
                    <a class="menu__link" href="#">Grain Mylks</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Seed Mylks</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Nut Mylks</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Nutri Drinks</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" data-submenu="submenu-4-1" href="#">Selection</a>
                </li>
            </ul>
            <!-- Submenu 4-1 -->
            <ul data-menu="submenu-4-1" class="menu__level">
                <li class="menu__item">
                    <a class="menu__link" href="#">Nut Mylk Packs</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Amino Acid Heaven</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Allergy Free</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END NAV -->


    <?= $content ?>

    <!-- TAB BAR -->
    <nav class="tab-bar tab-bar-bottom">
        <div class="container container-xs px-0">
            <div class="row flex-nowrap">
                <div class="col">
                    <a href="" class="tab-bar__btn">
                        <span class="tab-bar__label">мои заказы</span>
                        <svg class="tab-bar__icon svg-add-to-basket" width="31" height="31">
                            <use xlink:href="/web/img/svg/sprite.svg#add-to-basket"></use>
                        </svg>
                    </a>
                </div>
                <div class="col">
                    <a href="" class="tab-bar__btn active">
                        <span class="tab-bar__label">уведомления</span>
                        <svg class="tab-bar__icon svg-browser" width="31" height="31">
                            <use xlink:href="/web/img/svg/sprite.svg#browser"></use>
                        </svg>
                    </a>
                </div>
                <div class="col">
                    <a href="" class="tab-bar__btn">
                        <span class="tab-bar__label">чат</span>
                        <svg class="tab-bar__icon svg-mail" width="37" height="31">
                            <use xlink:href="/web/img/svg/sprite.svg#mail"></use>
                        </svg>
                    </a>
                </div>
                <div class="col">
                    <a href="" class="tab-bar__btn">
                        <span class="tab-bar__label">новые заказы</span>
                        <svg class="tab-bar__icon svg-pencil-rule" width="31" height="31">
                            <use xlink:href="/web/img/svg/sprite.svg#pencil-rule"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- END TAB BAR -->

</main>
<!-- /.wrap-container -->

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

</body>
<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
<?php
*/
//Для телефона или планшета:
if(\Yii::$app->mobileDetect->isMobile() or \Yii::$app->mobileDetect->isTablet()) {
    ?>

    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <script src="https://api-maps.yandex.ru/2.1/?apikey=c428abb7-ad0d-41cf-84cd-59f900d74c5b&lang=ru_RU" type="text/javascript">
        </script>

    </head>
    <body style="background-image: url('../web/uploads/images/mobile/background.jpg'); background-repeat: no-repeat" >
    <?php //убрать  background в css
    $this->beginBody();
    ///web/uploads/images/mobile/background.jpg

    print('<div class="wrap">');

        NavBar::begin([
            'options' => [
                'class' => 'navbar-inverse',
            ],
        ]);

        $menuItems = [
            ['label' => 'Новые заказы', 'url' => ['/metering/default/new-request']],
            ['label' => 'Мои заказы', 'url' => ['/metering/default/my-request']],
            ['label' => 'Мои отклики', 'url' => ['/metering/default/my-response']],
            ['label' => 'Мои данные', 'url' => ['/metering/default/update-user']],
//            ['label' => 'Уведомления', 'url' => ['#']],
//            ['label' => 'Документы', 'url' => ['#']],
            ['label' => 'Баланс', 'url' => ['#']],
        ];

        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Зарегистрироваться', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
        } else {
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->email . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => $menuItems,
        ]);

        NavBar::end();


        $this->registerCssFile('/web/css/css-circle/css/circle.css');
    ?>

    <div class="row">
        <div class="col-xs-3">
            <strong> Заказов </strong>
            <div class="c100 p25 small">
                <span>25%</span>
                <div class="slice">
                    <div class="bar"></div>
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <strong>Активность</strong>
            <div class="c100 p40 small">
                <span>40%</span>
                <div class="slice">
                    <div class="bar"></div>
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <strong>Конверсия</strong>
            <div class="c100 p50 small">
                <span>50%</span>
                <div class="slice">
                    <div class="bar"></div>
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <strong>Задач</strong>
            <div class="c100 p25 small">
                <span>2</span>
                <div class="slice">
                    <div class="bar"></div>
                </div>
            </div>
        </div>
    </div>



    <div class="block-info">
        <div class="row">
            <div class="col-xs-6">
                Баланс:
                </br>
                </br>
                Текущих заказов:
                </br>
                </br>
            </div>
            <div class="col-xs-3">
                <img class="mr-3" src="/web/uploads/images/mobile/request-diagram.jpg" >
            </div>

        </div>
    </div>



    <div class="container">
        <div class="col-sm-6">
            <?= $content ?>
        </div>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php
};








//Для компьютера
if(\Yii::$app->mobileDetect->isDesktop()) {
    ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <script src="https://api-maps.yandex.ru/2.1/?apikey=c428abb7-ad0d-41cf-84cd-59f900d74c5b&lang=ru_RU" type="text/javascript">
        </script>



    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

        $menuItems = [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'О нас', 'url' => ['/site/about']],
            ['label' => 'Контакты', 'url' => ['/site/contact']],
        ];

        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Зарегистрироваться', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
        } else {
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->email . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);

        NavBar::end();
        ?>


        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>

            <div class="row">
                <div class="col-sm-3">
                    <?php
                    echo Menu::widget([
                        'items' => [
                            ['label' => 'Новые заказы', 'url' => ['/metering/default/new-request']],
                            ['label' => 'Мои заказы', 'url' => ['/metering/default/my-request']],
                            ['label' => 'Мои отклики', 'url' => ['/metering/default/my-response']],
                            ['label' => 'Мои данные', 'url' => ['/metering/default/update-user']],
                            ['label' => 'Уведомления', 'url' => ['#']],
                            ['label' => 'Документы', 'url' => ['#']],
                            ['label' => 'Баланс', 'url' => ['#']],

                        ],
                    ]);
                    ?>
                </div>
                <div class="col-sm-9">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <p class="pull-left">Натяжные потолки <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>

    <?php };
$this->endPage();


?>
