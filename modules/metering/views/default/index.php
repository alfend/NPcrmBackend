<?php

use yii\helpers\Html;
use app\models\Request;
use yii\widgets\Pjax;
?>


<?php
//Список заказов на замер

$script = <<< JS
$(document).ready(function() {
    setInterval(function(){
        $('#refreshButton').click();
    }, 3000);
});
JS;
$this->registerJs($script);
?>

<?php Pjax::begin(); ?>

<?php
//кол-во заявок
$count_request=0;
//кол-во замеров
$count_request_metering=0;
//кол-во заказов
$count_request_zakaz=0;
//кол-во сообщений
$count_message=0;
//кол-во сообщений непрочитаных
$count_message_not_read=0;
//кол-во задач
$count_task=0;
//кол-во не выполненных задач
$count_task_not_read=0;
//баланс вытянуть из бд
$balance=0;

$array_request = new Request();

foreach ($request_client as $request){
    $count_request++;
    if(in_array($request['status_request'], array($array_request::STATUS_METERING_BEFORE,$array_request::STATUS_METERING_RUN)))
    {
        $count_request_metering++;
    };

    if(in_array($request['status_request'], array(
        $array_request::STATUS_COMPANY_BEFORE,$array_request::STATUS_COMPANY_RUN,
        $array_request::STATUS_COMPANY_AFTER,$array_request::STATUS_DELIVERY_BEFORE,$array_request::STATUS_DELIVERY_RUN,$array_request::STATUS_DELIVERY_AFTER,
        $array_request::STATUS_MOUNTING_BEFORE,$array_request::STATUS_MOUNTING_RUN,$array_request::STATUS_MOUNTING_AFTER,
        $array_request::STATUS_FINISH)))
    {
        $count_request_zakaz++;
    };

};

if($count_request==0)
{
    $procent_metering=100;
    $procent_zakaz=100;
} else {
    $procent_metering=$count_request_metering/$count_request*100;
    $procent_zakaz=$count_request_zakaz/$count_request*100;
}
if($count_message==0)
{
    $procent_message=100;
} else{
    $procent_message=$count_message_not_read/$count_message*100;
}
if($count_task==0)
{
    $procent_task=100;
} else {
    $procent_task=$count_task_not_read/$count_task*100;
}

?>
<section class="sec sec-header">

    <div class="container container-xs px-0" id="counters">

        <div class="row flex-nowrap">

            <div class="col-3 pb-1">
                <h6 class="color-dark text-uppercase text-center">Замеров</h6>
                <div class="counter m-2">
                    <?= //Html::a('Обновить',['/client'], ['class' => 'btn btn-lg btn-primary hidden', 'id' => 'refreshButton']);/* ,'style' => "display:none" */
                    '';
                    ?>

                    <svg class="counter__circle" viewBox="0 0 35 35" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" style="position:absolute;">
                        <circle class="counter__background" stroke="transparent" stroke-width="1" fill="none" stroke-linecap="round" stroke-dasharray="100,100" cx="17.5" cy="17.5" r="15.91549431"/>
                        <circle class="counter__circle-value" stroke="#000000" stroke-width="1" stroke-dasharray="<?= $procent_metering; ?>, 100" stroke-dashoffset="<?= $procent_metering; ?>" stroke-linecap="round" fill="none" cx="17.5" cy="17.5" r="15.91549431" />
                    </svg>
                    <div class="counter__value"><span><?= $count_request_metering; ?></span></div>
                </div>
                <!-- /.counter -->
            </div>
            <!-- /.col -->

            <div class="col-3 pb-1">
                <h6 class="color-dark text-uppercase text-center">Заказов</h6>

                <div class="counter m-2">
                    <svg class="counter__circle" viewBox="0 0 35 35" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" style="position:absolute;">
                        <circle class="counter__background" stroke="transparent" stroke-width="1" fill="none" stroke-linecap="round" stroke-dasharray="100,100" cx="17.5" cy="17.5" r="15.91549431"/>
                        <circle class="counter__circle-value" stroke="#000000" stroke-width="1" stroke-dasharray="<?= $procent_zakaz; ?>, 100" stroke-dashoffset="<?= $procent_zakaz; ?>" stroke-linecap="round" fill="none" cx="17.5" cy="17.5" r="15.91549431" />
                    </svg>
                    <div class="counter__value"><span><?= $count_request_zakaz; ?></span></div>
                </div>
                <!-- /.counter -->
            </div>
            <!-- /.col -->

            <div class="col-3 pb-1">
                <h6 class="color-dark text-uppercase text-center">Писем</h6>

                <div class="counter m-2">
                    <svg class="counter__circle" viewBox="0 0 35 35" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" style="position:absolute;">
                        <circle class="counter__background" stroke="transparent" stroke-width="1" fill="none" stroke-linecap="round" stroke-dasharray="100,100" cx="17.5" cy="17.5" r="15.91549431"/>
                        <circle class="counter__circle-value" stroke="#000000" stroke-width="1" stroke-dasharray="<?= $procent_message; ?>, 100" stroke-dashoffset="<?= $procent_message; ?>" stroke-linecap="round" fill="none" cx="17.5" cy="17.5" r="15.91549431" />
                    </svg>
                    <div class="counter__value"><span><?= $count_message_not_read; ?></span></div>
                </div>
                <!-- /.counter -->
            </div>
            <!-- /.col -->

            <div class="col-3 pb-1">
                <h6 class="color-dark text-uppercase text-center">Задач</h6>

                <div class="counter m-2">
                    <svg class="counter__circle" viewBox="0 0 35 35" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" style="position:absolute;">
                        <circle class="counter__background" stroke="transparent" stroke-width="1" fill="none" stroke-linecap="round" stroke-dasharray="100,100" cx="17.5" cy="17.5" r="15.91549431"/>
                        <circle class="counter__circle-value" stroke="#000000" stroke-width="1" stroke-dasharray="<?= $procent_task; ?>, 100" stroke-dashoffset="<?= $procent_task; ?>" stroke-linecap="round" fill="none" cx="17.5" cy="17.5" r="15.91549431" />
                    </svg>

                    <div class="counter__value"><span><?= $count_task_not_read; ?></span></div>
                </div>
                <!-- /.counter -->

            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

</section>
<!-- /.sec-header -->

<?php Pjax::end(); ?>
<section class="sec sec-negative">

    <div class="container container-xs px-0">

        <div class="card">

            <div class="card-body">

                <div class="media">

                    <div class="media-body">

                        <div class="row flex-nowrap">

                            <div class="col-auto">
                                <h4>Текущий баланс</h4>
                                <p class="card-number"><b><?= $balance; ?> ₽</b></p>
                                <h4>Текущих заказов</h4>
                                <p class="card-number"><b><?= $count_request_zakaz; ?></b></p>
                                <a href="#" class="btn btn-sm btn-primary">выполнить</a>
                            </div>
                            <!-- /.col -->

                            <div class="col">

                                <form novalidate class="form card-switcher text-right">

                                        		<span class="switch switch-sm">
                                    <input type="checkbox" class="switch" id="switch-sm" checked>
                                    <label for="switch-sm"></label>
                                  </span>
                                    <!-- /.switch -->

                                </form>
                                <!-- /.form -->

                                <div class="chart card-chart ml-auto mr-auto mt-n3" id="chart"></div>
                                <!-- /.chart -->

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
<!-- /.sec-negative -->


<section class="sec sec-main">

    <div class="container container-xs px-0">

        <ul class="list-items">

            <li class="list-item">
                <div class="row">
                    <div class="col-auto d-flex align-items-center">
                        <object type="image/svg+xml" data="/web/img/svg/pencil.svg" class="svg-icon"></object>
                    </div>
                    <div class="col d-flex flex-column justify-content-center py-1">
                        <h5 class="mb-1 text-uppercase">Мои Замеры</h5>
                        <div class="row">
                            <div class="col-6 col-sm-5"><span class="text-nowrap font-weight-bold">Оформлено: <a href=""><?= $count_request_metering; ?></a></span></div>
                            <div class="col-6 col-sm-5"><span class="text-nowrap font-weight-bold">В работе: <a href=""><?= $count_request_metering; ?></a></span></div>
                        </div>
                    </div>
                    <div class="col-auto d-flex align-items-center">
                        <a href="">
                            <svg class="svg-menu-dots" width="3" height="19">
                                <use xlink:href="/web/img/svg/sprite.svg#menu-dots"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </li>
            <!-- /.list-item	-->

            <li class="list-item">
                <div class="row">
                    <div class="col-auto d-flex align-items-center">
                        <object type="image/svg+xml" data="/web/img/svg/task.svg" class="svg-icon"></object>
                    </div>
                    <div class="col d-flex flex-column justify-content-center py-1">
                        <h5 class="mb-1 text-uppercase">Мои заказы</h5>
                        <div class="row">
                            <div class="col-6 col-sm-5"><span class="text-nowrap font-weight-bold">Оформлено: <a href=""><?= $count_request_zakaz; ?></a></span></div>
                            <div class="col-6 col-sm-5"><span class="text-nowrap font-weight-bold">В работе: <a href=""><?= $count_request_zakaz; ?></a></span></div>
                        </div>
                    </div>
                    <div class="col-auto d-flex align-items-center">
                        <a href="">
                            <svg class="svg-menu-dots" width="3" height="19">
                                <use xlink:href="/web/img/svg/sprite.svg#menu-dots"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </li>
            <!-- /.list-item	-->

            <li class="list-item">
                <div class="row">
                    <div class="col-auto d-flex align-items-center">
                        <object type="image/svg+xml" data="/web/img/svg/notification.svg" class="svg-icon"></object>
                    </div>
                    <div class="col d-flex flex-column justify-content-center py-1">
                        <h5 class="mb-1 text-uppercase">Уведомления</h5>
                        <div class="row">
                            <div class="col-6 col-sm-5"><span class="text-nowrap font-weight-bold">Не прочитано: <a href=""><?= $count_message_not_read; ?></a></span></div>
                        </div>
                    </div>
                    <div class="col-auto d-flex align-items-center">
                        <a href="">
                            <svg class="svg-menu-dots" width="3" height="19">
                                <use xlink:href="/web/img/svg/sprite.svg#menu-dots"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </li>
            <!-- /.list-item	-->

        </ul>
        <!-- /.list-items -->

    </div>
    <!-- /.container -->

</section>
<!-- /.sec-main -->
