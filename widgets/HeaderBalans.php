<?php
/**
 * Created by PhpStorm.
 * User: Гейдебрехт ПВ
 * Date: 29.11.2019
 * Time: 11:49
 */
namespace app\widgets;

use Yii;
use app\models\Request;
use yii\widgets\Pjax;

class HeaderBalans extends \yii\bootstrap\Widget
{

    public function init()
    {

    }

    public function run()
    {

        $request_array = new Request();
        $request_array = $request_array->getRequestByClientAndStatus( Yii::$app->user->getId(), [
            Request::STATUS_CREATE,Request::STATUS_METERING_BEFORE,
            Request::STATUS_METERING_RUN,Request::STATUS_METERING_AFTER,
            Request::STATUS_COMPANY_BEFORE,Request::STATUS_COMPANY_RUN,
            Request::STATUS_COMPANY_AFTER,Request::STATUS_DELIVERY_BEFORE,Request::STATUS_DELIVERY_RUN,Request::STATUS_DELIVERY_AFTER,
            Request::STATUS_MOUNTING_BEFORE,Request::STATUS_MOUNTING_RUN,Request::STATUS_MOUNTING_AFTER,
            Request::STATUS_FINISH]);



        Pjax::begin();

//кол-во заявок
        $count_request=0;
//кол-во замеров
        $count_request_array=0;
//кол-во заказов
        $count_request_zakaz=0;
//баланс вытянуть из бд
        $balance=0;

        $array_request = new Request();

        foreach ($request_array as $request){
            $count_request++;
            if(in_array($request['status_request'], array($array_request::STATUS_METERING_BEFORE,$array_request::STATUS_METERING_RUN)))
            {
                $count_request_array++;
            };

            if(in_array($request['status_request'], array($array_request::STATUS_METERING_AFTER,
                $array_request::STATUS_COMPANY_BEFORE,$array_request::STATUS_COMPANY_RUN,
                $array_request::STATUS_COMPANY_AFTER,$array_request::STATUS_DELIVERY_BEFORE,$array_request::STATUS_DELIVERY_RUN,$array_request::STATUS_DELIVERY_AFTER,
                $array_request::STATUS_MOUNTING_BEFORE,$array_request::STATUS_MOUNTING_RUN,$array_request::STATUS_MOUNTING_AFTER)))
            {
                $count_request_zakaz++;
            };

        };


        ?>


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

                                    <div class="col">
                                        <form novalidate class="form card-switcher text-right">
                                    <span class="switch switch-sm">
                                        <input type="checkbox" class="switch" id="switch-sm" checked>
                                    <label for="switch-sm"></label>
                                  </span>
                                        </form>
                                        <div class="chart card-chart ml-auto mr-auto mt-n3" id="chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
