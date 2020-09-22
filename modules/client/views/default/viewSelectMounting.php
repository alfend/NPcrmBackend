<?php

use yii\helpers\Html;
use app\models\Request;
use app\models\Response;
use app\models\User;
use yii\widgets\Pjax;

?>

<?php
//Список заказов на замер

$script = <<< JS
$(document).ready(function() {
    setInterval(function(){
        $('#refreshButton').click();
    }, 5000);
});
JS;
$this->registerJs($script);
?>

<?php Pjax::begin(); ?>


<section class="sec sec-negative sec-error">

    <div class="container container-xs px-0">

        <div class="card">

            <div class="card-body">

                <div class="media">

                    <div class="media-body">

                        <div class="row flex-nowrap">

                            <div class="col">
                                <h4>Получено предложений</h4>
                                <p class="card-number"><b>6</b></p>
                                <h4>Стоимость монтажа</h4>
                                <p class="card-number"><b>3 800 ₽</b><b class="dot-dot-dot">......</b><b>5 800 ₽</b></p>
                            </div>
                            <!-- /.col -->

                            <div class="col-auto">

                                <form novalidate class="form card-switcher text-right mb-3">

                                            <span class="switch switch-sm">
                                                <input type="checkbox" class="switch" id="switch-sm" checked>
                                                <label for="switch-sm"></label>
                                              </span>
                                    <!-- /.switch -->

                                </form>
                                <!-- /.form -->

                                <a href="" class="btn-tooltip">
                                    <figure>
                                        <object type="image/svg+xml" data="/web/img/svg/warning.svg"
                                                class="svg-icon svg-icon-error"></object>
                                    </figure>
                                </a>
                                <!-- /.btn-tooltip -->

                                <div class="tooltip" data-tooltip="left">
                                    <span>Монтаж.</span>
                                </div>
                                <!-- /.tooltip -->


                            </div>
                            <!-- /.col-auto -->

                        </div>
                        <!-- /.row -->

                    </div>
                    <!-- /.media-body -->

                </div>
                <!-- /.media -->

            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->

    </div>
    <!-- /.container -->

</section>


<section class="sec sec-main">

    <section class="sec sec-breadcrumbs" data-sticky-breadcrumbs>

        <div class="container container-xs px-0">

            <div class="row">

                <div class="col">

                    <div class="breadcrumbs ml-3">

                        <ul>
                            <li>
                                <a href="/client/default/request-metering-all">Мои замеры</a>
                            </li>
                            <li>
                                <a href="/client/default/request-order-all">Монтаж</a>
                            </li>
                            <li>
                                <span>Выбор монтажника</span>
                            </li>
                        </ul>

                    </div>
                    <!-- /.breadcrumbs -->

                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </section>
    <!-- /.sec-breadcrumbs -->

    <?= Html::a('Обновить', ['/client/default/select-mounting'],

        [
            'data-method' => 'POST',
            'data-params' => ['id_request' => $id_request, 'type_workers' => User::TYPE_MOUNTING],
            'class' => 'btn btn-lg btn-primary hidden',
            'id' => 'refreshButton',
            'style' => "display:none"
        ]);/* ,'style' => "display:none" */
    ?>

    <div class="container container-xs px-3">



        <div class="slider">
            <hr class="hr">
            <?php

            foreach ($workers as $worker) {


                ?>
                <div class="slider-nav">
                    <div class="text-center">
                        <picture class="slick-img-small">
                            <img src="/web/img/content/expert<?= $worker['foto'] ?>.png" alt="">
                        </picture>
                        <h4><?= $worker['price'] ?> ₽</h4>
                    </div>
                </div>

                <?php
            }
            ?>


            <hr class="hr">
            <div class="slider-for">
                <?php foreach ($workers as $worker) {
                    ?>
                    <div>
                        <div class="row justify-content-center my-3">

                            <div class="col-auto">

                                <div class="media align-items-center">

                                    <picture class="flex-shrink-0 mr-3">
                                        <img src="/web/img/content/expert<?= $worker['foto'] ?>.png" alt=""
                                             data-aos="fade-zoom-in" data-aos-duration="500" data-aos-delay="100">
                                    </picture>

                                    <div class="media-body">

                                        <h4 data-aos="fade-left" data-aos-duration="500"
                                            data-aos-delay="150"> <?= $worker['lastname'] . ' ' . $worker['firstname'] . ' ' . $worker['secondname']; ?></h4>

                                        <div class="rating p-0 my-1" data="45" data-rating-output data-aos="fade-left"
                                             data-aos-duration="500" data-aos-delay="200"></div>
                                        <!-- /.rating -->
                                        <h4 class="color-light" data-aos="fade-left" data-aos-duration="500"
                                            data-aos-delay="250">Стоимость монтажных работ:</h4>
                                        <p class="card-number mb-0" data-aos="fade-left" data-aos-duration="500"
                                           data-aos-delay="300"><?= $worker['price'] ?> ₽</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <form novalidate class="form">

                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary btn-min-lg">Назначить на монтаж</button>
                            </div>

                        </form>

                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

</section>

<?php Pjax::end(); ?>
