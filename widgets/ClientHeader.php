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

class ClientHeader extends \yii\bootstrap\Widget
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



//Список заказов на замер
/*
$script = <<< JS
$(document).ready(function() {
    setInterval(function(){
        $('#refreshButton').click();
    }, 3000);
});
JS;
$this->registerJs($script);
*/
Pjax::begin();

//кол-во заявок
$count_request=0;
//кол-во замеров
$count_request_array=0;
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

if($count_request==0)
{
    $procent_metering=100;
    $procent_zakaz=100;
} else {
    $procent_metering=$count_request_array/$count_request*100;
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
                    <svg class="counter__circle" viewBox="0 0 35 35" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" style="position:absolute;">
                        <circle class="counter__background" stroke="transparent" stroke-width="1" fill="none" stroke-linecap="round" stroke-dasharray="100,100" cx="17.5" cy="17.5" r="15.91549431"/>
                        <circle class="counter__circle-value" stroke="#000000" stroke-width="1" stroke-dasharray="<?= $procent_metering; ?>, 100" stroke-dashoffset="<?= $procent_metering; ?>" stroke-linecap="round" fill="none" cx="17.5" cy="17.5" r="15.91549431" />
                    </svg>
                    <div class="counter__value"><span><?= $count_request_array; ?></span></div>
                </div>
            </div>

            <div class="col-3 pb-1">
                <h6 class="color-dark text-uppercase text-center">Заказов</h6>

                <div class="counter m-2">
                    <svg class="counter__circle" viewBox="0 0 35 35" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" style="position:absolute;">
                        <circle class="counter__background" stroke="transparent" stroke-width="1" fill="none" stroke-linecap="round" stroke-dasharray="100,100" cx="17.5" cy="17.5" r="15.91549431"/>
                        <circle class="counter__circle-value" stroke="#000000" stroke-width="1" stroke-dasharray="<?= $procent_zakaz; ?>, 100" stroke-dashoffset="<?= $procent_zakaz; ?>" stroke-linecap="round" fill="none" cx="17.5" cy="17.5" r="15.91549431" />
                    </svg>
                    <div class="counter__value"><span><?= $count_request_zakaz; ?></span></div>
                </div>
            </div>

            <div class="col-3 pb-1">
                <h6 class="color-dark text-uppercase text-center">Писем</h6>
                <div class="counter m-2">
                    <svg class="counter__circle" viewBox="0 0 35 35" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" style="position:absolute;">
                        <circle class="counter__background" stroke="transparent" stroke-width="1" fill="none" stroke-linecap="round" stroke-dasharray="100,100" cx="17.5" cy="17.5" r="15.91549431"/>
                        <circle class="counter__circle-value" stroke="#000000" stroke-width="1" stroke-dasharray="<?= $procent_message; ?>, 100" stroke-dashoffset="<?= $procent_message; ?>" stroke-linecap="round" fill="none" cx="17.5" cy="17.5" r="15.91549431" />
                    </svg>
                    <div class="counter__value"><span><?= $count_message_not_read; ?></span></div>
                </div>
            </div>

            <div class="col-3 pb-1">
                <h6 class="color-dark text-uppercase text-center">Задач</h6>

                <div class="counter m-2">
                    <svg class="counter__circle" viewBox="0 0 35 35" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" style="position:absolute;">
                        <circle class="counter__background" stroke="transparent" stroke-width="1" fill="none" stroke-linecap="round" stroke-dasharray="100,100" cx="17.5" cy="17.5" r="15.91549431"/>
                        <circle class="counter__circle-value" stroke="#000000" stroke-width="1" stroke-dasharray="<?= $procent_task; ?>, 100" stroke-dashoffset="<?= $procent_task; ?>" stroke-linecap="round" fill="none" cx="17.5" cy="17.5" r="15.91549431" />
                    </svg>

                    <div class="counter__value"><span><?= $count_task_not_read; ?></span></div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
    }
}