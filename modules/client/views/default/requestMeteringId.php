<?php

use yii\helpers\Html;
use app\models\Request;
use app\models\Response;
use app\models\User;
use yii\widgets\Pjax;

?>

<?php
//Список заказов на замер
?>


<!-- HEADER -->
<header class="header sticky">
    <div class="container container-md">
        <div class="row align-items-center">
            <div class="col">
                <a href="/client/default/request-metering-all">
                    <svg class="svg-undo" width="33" height="24">
                        <use xlink:href="/web/img/svg/sprite.svg#undo"></use>
                    </svg>
                </a>
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


<section class="sec-inner">

    <div class="container container-sm px-0">

        <div class="card bg-opacity">

            <figure class="card-logo fs-0">
                <object type="image/svg+xml" data="/web/img/svg/task.svg" class="svg-icon"></object>
            </figure>

            <div class="card-body">

                <div class="row justify-content-end mb-3">
                    <div class="col-auto">
                        <button type="button" class="mt-1">
                            <svg class="svg-menu-dots" width="3" height="19">
                                <use xlink:href="/web/img/svg/sprite.svg#menu-dots"></use>
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- /.row -->

                <div class="mb-3 accordion">
                    <h4 class="color-primary text-uppercase accordion__header mb-1">Общая информация</h4>
                    <div class="ml-3 accordion__body">
                        <p class="font-weight-bold"><span class="color-light">Заказ:</span> № <?= $request_metering['id'] ?></p>
                        <p class="font-weight-bold"><span class="color-light">Дата заказа:</span> <?= substr($request_metering['date_create'],0,10) ?></p>
                        <p class="font-weight-bold"><span class="color-light">Время заказа:</span> <?= substr($request_metering['date_create'],11,8) ?></p>
                        <p class="font-weight-bold"><span class="color-light">Адрес:</span> <?= $request_metering['address'] ?></p>
                    </div>
                </div>

                <div class="mb-3 accordion">
                    <h4 class="color-primary text-uppercase accordion__header mb-1">Информация о замерщике</h4>
                    <div class="ml-3 accordion__body">
                        <p class="font-weight-bold"><span class="color-light">Получено преложений:</span> <?= $count_workers ?> </p>
                        <p class="font-weight-bold"><span class="color-light">Замерщик:</span><?= $worker['lastname'].' '.$worker['firstname'] ?></p>
                        <p class="font-weight-bold"><span class="color-light">Телефон:</span> <a href="tel:88005052728">8 (800) 505-27-28</a> (доб. <?= $worker['id'] ?>)</p>
                    </div>
                </div>

                <div class="mb-3 accordion">
                    <h4 class="color-primary text-uppercase accordion__header mb-1">Информация по замеру</h4>
                    <div class="ml-3 accordion__body">
                        <p class="font-weight-bold"><span class="color-light">Количество потолков:</span> <?= $data_metering['count_ceiling'] ?></p>
                        <p class="font-weight-bold"><span class="color-light">Общая площадь:</span> <?= $data_metering['area'] ?></p>
                        <p class="font-weight-bold"><span class="color-light">Периметр:</span> <?= $data_metering['perimeter'] ?></p>
                        <p class="font-weight-bold"><span class="color-light">Точечные светильники:</span> <?= $data_metering['spot'] ?></p>
                        <p class="font-weight-bold"><span class="color-light">Люстр:</span> <?= $data_metering['luster'] ?></p>
                        <p class="font-weight-bold"><span class="color-light">Гардин:</span> <?= $data_metering['curtain'] ?></p>
                        <p class="font-weight-bold"><span class="color-light">Обход труб:</span> <?= $data_metering['cut_pipe'] ?></p>
                    </div>
                </div>

                <div class="mb-3 accordion">
                    <h4 class="color-primary text-uppercase accordion__header mb-1">информация по заказу</h4>
                    <div class="ml-3 accordion__body">
                        <p class="font-weight-bold"><span class="color-light">Статус заказа:</span> <?php
                            switch ($request_metering['status_request']) {
                                case Request::STATUS_CREATE:
                                case Request::STATUS_METERING_BEFORE:
                                case Request::STATUS_METERING_RUN:
                                    print "В стадии замера";
                                    break;
                                case Request::STATUS_METERING_AFTER:
                                    print "Ожидает оплаты";
                                    break;
                                case Request::STATUS_DELIVERY_BEFORE:
                                case Request::STATUS_DELIVERY_RUN:
                                case Request::STATUS_DELIVERY_AFTER:
                                    print "В стадии доставки";
                                    break;
                                case Request::STATUS_COMPANY_BEFORE:
                                case Request::STATUS_COMPANY_RUN:
                                case Request::STATUS_COMPANY_AFTER:
                                    print "В стадии Изготовления";
                                    break;
                                case Request::STATUS_MOUNTING_BEFORE:
                                case Request::STATUS_MOUNTING_RUN:
                                case Request::STATUS_MOUNTING_AFTER:
                                    print "На стадии монтаж";
                                    break;
                                case Request::STATUS_FINISH:
                                    print "Завершено";
                                    break;
                                default:
                                    print 'В работе';
                                    break;
                            }
                            ?>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->

    </div>
    <!-- /.container -->

</section>
<!-- /.sec-inner -->
