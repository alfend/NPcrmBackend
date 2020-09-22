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

<?= \app\widgets\HeaderBalans::widget() ?>

<?php Pjax::begin(); ?>

<section class="sec sec-main">
    <section class="sec sec-breadcrumbs" data-sticky-breadcrumbs="">

        <div class="container container-xs px-0">

            <div class="row justify-content-end">
                <div class="col">

                    <div class="breadcrumbs ml-3">
                        <ul>
                            <li>
                                <a href="/client/default/request-order-all">Мои заказы</a>
                            </li>
                            <li>
                                <span>Монтаж</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-auto pl-0 fs-0">

                        <a href="">
                            <svg class="svg-list mr-3" width="32" height="19">
                                <use xlink:href="img/svg/sprite.svg#list"></use>
                            </svg>
                        </a>

                    </div>
                    <!-- /.breadcrumbs -->

                </div>
            </div>
        </div>
    </section>

    <div class="container container-xs px-0">
        <?= Html::a('Обновить', ['/client/default/request-order-all'], [
            'class' => 'btn btn-lg btn-primary hidden',
            'id' => 'refreshButton',
            'style' => "display:none"
        ]);/* ,'style' => "display:none" */
        ?>

        <ul class="list-items">
            <?php
            //

            foreach ($request_metering as $request) {
                if (in_array($request['status_request'],
                    [
                        Request::STATUS_METERING_AFTER,
                        Request::STATUS_COMPANY_BEFORE,
                        Request::STATUS_COMPANY_RUN,
                        Request::STATUS_COMPANY_AFTER,
                        Request::STATUS_DELIVERY_BEFORE,
                        Request::STATUS_DELIVERY_RUN,
                        Request::STATUS_DELIVERY_AFTER,
                        Request::STATUS_MOUNTING_BEFORE,
                        Request::STATUS_MOUNTING_RUN,
                        Request::STATUS_MOUNTING_AFTER,
                        Request::STATUS_FINISH
                    ])) {
                    //есть ли отклики на заказ
                    $response = new Response();
                    ?>

                    <li class="list-item">
                        <div class="row">
                            <div class="col-auto d-flex align-items-center">
                                <object type="image/svg+xml" data="/web/img/svg/task.svg" class="svg-icon"></object>
                            </div>

                            <div class="col d-flex flex-column justify-content-center py-1">
                                <h5><a href="">Заказ № <?= $request['id'] ?></a></h5>
                                <p class="font-weight-bold"><span class="color-light">Дата монтажа:</span><?= $request['date_mounting'] ?></p>
                                <p class="font-weight-bold"><span class="color-light">Адрес:</span> <?= $request['address'] ?></p>
                                <p class="font-weight-bold"><span class="color-light">Итоговая стоимость:</span> <?= $request['price_request'] ?></p>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <div class="counter">
                                <?php


                                //if($response->findResponseByRequest($request['id'],User::TYPE_METERING)){}
                                //if (in_array($request['status_request'],[Request::STATUS_CREATE, Request::STATUS_METERING_BEFORE]))
                                {
                                    print(Html::a('
                                     <svg class="counter__circle" viewBox="0 0 35 35" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" style="position:absolute;">
                                        <circle class="counter__background" stroke="transparent" stroke-width="1" fill="none" stroke-linecap="round" stroke-dasharray="100,100" cx="17.5" cy="17.5" r="15.91549431"/>
                                        <circle class="counter__circle-value" stroke="#000000" stroke-width="1" stroke-dasharray="75, 100" stroke-dashoffset="75" stroke-linecap="round" fill="none" cx="17.5" cy="17.5" r="15.91549431" />
                                    </svg>
                                    
                                    <div class="counter__value" >

                                        <span class="counter__output">75</span>%
                                    <!-- /.counter__output -->
                                    </div>
                                    
                                    ', ['/client/default/request-order-id','id_request'=>$request['id']], [
                                        'data-method' => 'POST',
                                        'data-params' => [
                                            'id_request' => $request['id'],
                                            'type_workers' => User::TYPE_MOUNTING
                                        ]
                                    ]));
                                };/* else {
                                    print(Html::a('
                                    <svg class="svg-arrow-right" width="27" height="27">
                                        <use xlink:href="/web/img/svg/sprite.svg#arrow-right"></use>
                                    </svg>
                                    ', ['/client/default/request-metering-id','id_request'=>$request['id']], [
                                        'data-method' => 'POST',
                                        'data-params' => [
                                            'id_request' => $request['id'],
                                            'type_workers' => User::TYPE_METERING
                                        ]
                                    ]));
                                }

                                /*

                                                                <a href=<?= ($response->findResponseByRequest($request['id'],User::TYPE_METERING)) ? '"/client/default/select-metering"' : '"/client/default/select-metering"'; ?>>
                                                                    <svg class="svg-arrow-right" width="27" height="27">
                                                                        <use xlink:href=<?= ($response->findResponseByRequest($request['id'],User::TYPE_METERING)) ? '"/web/img/svg/sprite.svg#arrow-right"' : '"/web/img/svg/sprite.svg#hourglass"'; ?>></use>
                                                                    </svg>
                                                                </a>

                                */
                                ?>
                                </div>
                            </div>
                        </div>
                    </li>



                    <!-- /.list-item -->
                <?php };
            }; ?>
        </ul>
        <!-- /.list-items -->

    </div>
    <!-- /.container -->
</section>
<!-- /.sec-main -->


<?php Pjax::end(); ?>


</main>
<!-- /.wrap-container -->
