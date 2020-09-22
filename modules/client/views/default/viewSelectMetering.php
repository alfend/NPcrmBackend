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


    <section class="sec sec-calendar mb-0">

        <div class="container container-xs px-0">
            <form class="form mt-2">

                <div class="form-group">

                    <div class="range-calendar pt-0" id="range-calendar"></div>
                    <!-- /.range-calendar -->

                    <hr class="hr m-0">

                </div>
                <!-- /.form-group -->

            </form>
            <!-- /.form -->

        </div>
        <!-- /.container -->

    </section>
    <!-- /.sec-calendar -->

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
                                    <a href="/default/request-new-metering-date">Новый заказ</a>
                                </li>
                                <li>
                                    <span>Выбор замерщика</span>
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

        <div class="container container-xs px-0">
            <?= Html::a('Обновить', ['/client/default/select-metering'],

                ['data-method' => 'POST',
                    'data-params' => ['id_request' => $id_request,'type_workers' => User::TYPE_METERING],
                'class' => 'btn btn-lg btn-primary hidden',
                'id' => 'refreshButton',
                'style' => "display:none"
            ]);/* ,'style' => "display:none" */
            ?>
            <ul class="list-items">

                <?php

                foreach ($workers as $worker) {


                    ?>
                    <li class="list-item">
                        <div class="row">
                            <div class="col-auto d-flex align-items-center">
                                <picture class="img-icon">
                                    <img src="/web/img/content/expert.png" alt="">
                                </picture>
                            </div>
                            <div class="col d-flex flex-column justify-content-center py-1">
                                <p class="font-weight-bold"><span
                                            class="color-light">Замерщик:</span> <?= $worker['lastname'] . ' ' . $worker['firstname'] . ' ' . $worker['secondname']; ?>
                                </p>
                                <p class="font-weight-bold"><span
                                            class="color-light">Дата замера:</span> <?= $worker['date_workers'] ?>
                                </p>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <?=
                                    Html::a('
                                    <svg class="svg-arrow-right" width="27" height="27">
                                        <use xlink:href="/web/img/svg/sprite.svg#arrow-right"></use>
                                    </svg>
                                    ', ['/client/default/insert-metering/'], ['data-method' => 'POST', 'data-params' => ['id_request' => $worker['id_request'],'id_workers' => $worker['id'],'date_workers' => $worker['date_workers']]]);
                                ?>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>

            </ul>
        </div>
    </section>


<?php Pjax::end(); ?>


    </main>
    <!-- /.wrap-container -->
<?php
;
/*
foreach ($workers as $worker){

        $button_res=Html::a('Выбрать этого', ['/client/default/insert-metering/'],['data-method' => 'POST', 'data-params' => ['id_request' => $worker['id_request'], 'id_workers' => $worker['id'], 'date_workers' => $worker['date_workers']]], ['class' => 'btn btn-primary']);
        print('<tr><td>'.$worker['lastname'].' '.$worker['firstname'].' '.$worker['secondname'].'</td><td> '.$worker['date_workers'].' </td><td> </td><td>'.$button_res.'</td></tr>');

*/
?>