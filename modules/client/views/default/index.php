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

<?= \app\widgets\HeaderBalans::widget() ?>

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

    if (in_array($request['status_request'], array(
        $array_request::STATUS_METERING_AFTER,
        $array_request::STATUS_COMPANY_BEFORE,
        $array_request::STATUS_COMPANY_RUN,
        $array_request::STATUS_COMPANY_AFTER,
        $array_request::STATUS_DELIVERY_BEFORE,
        $array_request::STATUS_DELIVERY_RUN,
        $array_request::STATUS_DELIVERY_AFTER,
        $array_request::STATUS_MOUNTING_BEFORE,
        $array_request::STATUS_MOUNTING_RUN,
        $array_request::STATUS_MOUNTING_AFTER
    ))) {
        $count_request_zakaz++;
    };

};


?>





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
                            <div class="col-6 col-sm-5"><span class="text-nowrap font-weight-bold">Оформлено: <a href="/client/default/request-metering-all"><?= $count_request_metering; ?></a></span></div>
                            <div class="col-6 col-sm-5"><span class="text-nowrap font-weight-bold">В работе: <a href="/client/default/request-metering-all"><?= $count_request_metering; ?></a></span></div>
                        </div>
                    </div>
                    <div class="col-auto d-flex align-items-center">
                        <a href="/client/default/request-metering-all">
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
                            <div class="col-6 col-sm-5"><span class="text-nowrap font-weight-bold">Оформлено: <a href="/client/default/request-order-all"><?= $count_request_zakaz; ?></a></span></div>
                            <div class="col-6 col-sm-5"><span class="text-nowrap font-weight-bold">В работе: <a href="/client/default/request-order-all"><?= $count_request_zakaz; ?></a></span></div>
                        </div>
                    </div>
                    <div class="col-auto d-flex align-items-center">
                        <a href="/client/default/request-order-all">
                            <svg class="svg-menu-dots" width="3" height="19">
                                <use xlink:href="/web/img/svg/sprite.svg#menu-dots"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </li>
            <!-- /.list-item	-->
        <?php /*
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
  */ ?>
            <!-- /.list-item	-->

        </ul>
        <!-- /.list-items -->

    </div>
    <!-- /.container -->

</section>
<!-- /.sec-main -->



</main>
<!-- /.wrap-container -->
<?php
$this->registerJs(
'$(document).load(function() {
setInterval(function(){ $("#refreshButton").trigger("click"); }, 3000);
});'
);
?>