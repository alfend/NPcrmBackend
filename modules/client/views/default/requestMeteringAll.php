<?php

use yii\helpers\Html;
use app\models\Request;
use app\models\Response;
use app\models\User;
use yii\widgets\Pjax;
use yii\widgets\HeaderBalans;
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

<?= \app\widgets\HeaderBalans::widget() ?>

<section class="sec sec-main">
    <section class="sec sec-breadcrumbs" data-sticky-breadcrumbs="">

        <div class="container container-xs px-0">

            <div class="row justify-content-end">
                <div class="col">

                    <div class="breadcrumbs ml-3">
                        <ul>
                            <li>
                                <a href="/client/default/request-metering-all">Мои замеры</a>
                            </li>
                            <li>
                                <span>замер</span>
                            </li>
                        </ul>
                    </div>
                    <!-- /.breadcrumbs -->

                </div>
                <div class="col-auto pl-0 fs-0">

                    <a href="/client/default/request-new-metering-address">
                        <svg class="svg-plus mr-3" width="27" height="27">
                            <use xlink:href="/web/img/svg/sprite.svg#plus"></use>
                        </svg>
                    </a>

                </div>
                <!-- /.col-auto -->

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </section>
    <!-- /.sec-breadcrumbs -->

    <div class="container container-xs px-0">
        <?= Html::a('Обновить', ['/client/default/request-metering-all'], [
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
                        Request::STATUS_CREATE,
                        Request::STATUS_METERING_BEFORE,
                        Request::STATUS_METERING_RUN,
                        Request::STATUS_METERING_AFTER
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
                                <p class="font-weight-bold"><span
                                            class="color-light">Дата заказа:</span><?= $request['date_create'] ?></p>
                                <p class="font-weight-bold"><span
                                            class="color-light">Адрес:</span> <?= $request['address'] ?></p>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <?php
                                //if($response->findResponseByRequest($request['id'],User::TYPE_METERING)){}
                                if (in_array($request['status_request'],
                                    [Request::STATUS_CREATE, Request::STATUS_METERING_BEFORE])) {
                                    print(Html::a('
                                    <svg class="svg-arrow-right" width="27" height="27">
                                        <use xlink:href="/web/img/svg/sprite.svg#hourglass"></use>
                                    </svg>
                                    ', ['/client/default/select-metering'], [
                                        'data-method' => 'POST',
                                        'data-params' => [
                                            'id_request' => $request['id'],
                                            'type_workers' => User::TYPE_METERING
                                        ]
                                    ]));
                                } else {
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
