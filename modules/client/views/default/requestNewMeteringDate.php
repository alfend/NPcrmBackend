<?php

use yii\helpers\Html;
use app\models\Request;
use app\models\Response;
use app\models\User;
use yii\widgets\Pjax;
?>




</section>
<!-- /.sec-negative -->
<!-- END CARD WITH CHART -->

<section class="sec sec-main">

    <section class="sec sec-breadcrumbs" data-sticky-breadcrumbs>

        <div class="container container-xs px-0">

            <div class="row">

                <div class="col">

                    <div class="breadcrumbs ml-3">
                        <ul>
                            <li>
                                <a href="">Мои замеры</a>
                            </li>
                            <li>
                                <a href="">Новый заказ</a>
                            </li>
                            <li>
                                <span>Выбор даты</span>
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

    <div class="container container-xs px-0">

        <form novalidate class="form" action="/client/default/request-new-metering-address" method="post">

            <div class="form-group">

                <div class="range-calendar pt-0" id="range-calendar"></div>
                <!-- /.range-calendar -->

            </div>
            <!-- /.form-group -->

            <div class="form-group mb-2">

                <input type="text" class="custom-range js-range-slider" name="my_range" value=""/>
                <!-- /.custom-range -->

            </div>
            <!-- /.form-group -->

            <!--  проверка токена-->
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-min-lg">Далее</button>
            </div>

        </form>
        <!-- /.form -->

    </div>
    <!-- /.container -->


</section>
<!-- /.sec-main -->
