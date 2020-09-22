<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Request;
use app\models\City;
use app\models\User;
use app\models\DataMetering;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы на замер';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">






<?php
    //Список заказов на замер

$script = <<< JS
$(document).ready(function() {
    setInterval(function(){
        $('#refreshButton').click();
    }, 1000);
});
JS;
$this->registerJs($script);
?>
    <?php Pjax::begin(); ?>

    <?= Html::a('Обновить',['default/my-request'], ['class' => 'btn btn-lg btn-primary hidden', 'id' => 'refreshButton']);?>

    <?php
    //Новые заказы', ['/metering/default/new-request']));
    if(\Yii::$app->mobileDetect->isMobile() or \Yii::$app->mobileDetect->isTablet()) {
        //для телефона
        foreach ($array_request as $request) {
            $dataMetering = new DataMetering();
            //вносил ли уже замеры
            if(!$dataMetering->cheсkDataMetering($request['id'],Yii::$app->user->getId())) {
                $button_res = Html::a('<span class="glyphicon glyphicon-plus"></span>', ['/metering/data-metering/create/'], [
                    'data-method' => 'POST',
                    'data-params' => ['id_request' => $request['id'],]
                ], ['class' => 'btn btn-primary']);
            } else {
                $button_res = Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['/metering/data-metering/update/'], [
                    'data-method' => 'GET',
                    'data-params' => ['id' => $dataMetering->cheсkDataMetering($request['id'],Yii::$app->user->getId())->id,]
                ], ['class' => 'btn btn-primary']);
            }
            print('
                <div class="media">
                    <div class="media-left">
                        <img class="mr-3" src="/web/uploads/images/mobile/item-request.jpg" >
                    </div>    
                    <div class="media-body">
                        <b>Заказ №:</b>'.$request['id'].'</br>
                        <b>Адрес:</b>'.$request['address'].'</br>
                        <b>Дата замера:</b> '.$request['date_metering_plan'].'</br>
                        <b>Стоимость:</b> '.'500'.'
                    </div>    
                    <div class="media-right">
                       </br></br>'.$button_res.'
                    </div>                        
                </div>
                </br></br>
                ');
        };

    } else {
        //для ПК
        print('<h3> Заказы на замер </h3> <table border="1" width="100%"> <tr><th> Заказ № </th><th> Адрес </th><th> Дата замера </th><th> Стоимость </th><th></th></tr>');
       foreach ($array_request as $request) {
            $dataMetering = new DataMetering();
            //вносил ли уже замеры
            if(!$dataMetering->cheсkDataMetering($request['id'],Yii::$app->user->getId())) {
                $button_res = Html::a('<span class="glyphicon glyphicon-plus"></span>', ['/metering/data-metering/create/'], [
                    'data-method' => 'POST',
                    'data-params' => ['id_request' => $request['id'],]
                ], ['class' => 'btn btn-primary']);
            } else {
                $button_res = Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['/metering/data-metering/update/'], [
                    'data-method' => 'POST',
                    'data-params' => ['id' => $dataMetering->cheсkDataMetering($request['id'],Yii::$app->user->getId())->id,]
                ], ['class' => 'btn btn-primary']);
            }
                print('<tr><td>' . $request['id'] . '</td>' . '<td>' . $request['address'] . '</td>' . '<td>' . $request['date_metering_plan'] . '</td><td>' . '500' . '</td><td>' . $button_res . '</td></tr>');
            }
       print('</table>');
    }

     ?>
    <?php Pjax::end(); ?>

    <!-- Яндекс карта -->
    <div id="map" style="width: 100%; height: 300px"></div>

    <!-- Прокладка маршрута -->
    <script type="text/javascript">
        ymaps.ready(init);

        function init () {
            /**
             * Создаем мультимаршрут.
             * Первым аргументом передаем модель либо объект описания модели.
             * Вторым аргументом передаем опции отображения мультимаршрута.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/multiRouter.MultiRoute.xml
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/multiRouter.MultiRouteModel.xml
             */
            var adresses = [
                "Оренбург, ул. Чкалова д 2 кв 102",
                "Оренбург, ул. Новая , д 12"
                ];

            var multiRoute = new ymaps.multiRouter.MultiRoute({
                // Описание опорных точек мультимаршрута.
                referencePoints: [
                    "Оренбург, ул. Толстого д 6",
                    "Оренбург, ул. Толстого д 8"
                    <?php
                    /*<?=  City::getCityNameById($request['id_city']).', '.$array_request['address'] ?>*/
                    ?>

                ],
                // Параметры маршрутизации.
                params: {
                    // Ограничение на максимальное количество маршрутов, возвращаемое маршрутизатором.
                    results: 2
                }
            }, {
                // Автоматически устанавливать границы карты так, чтобы маршрут был виден целиком.
                boundsAutoApply: true
            });

            // Создаем карту с добавленными на нее кнопками.
            var myMap = new ymaps.Map('map', {
                center: [55.750625, 37.626],
                zoom: 7,
            }, {
                buttonMaxWidth: 300
            });

            // К моменту попытки запросить маршруты маршрут не построился
            // var a = multiRoute.model.getRoutes();
            // Можно подписаться на событие успешного построения маршрута и когда маршрут построен получить результат
            multiRoute.model.events.add("requestsuccess", function(){
                //var a = multiRoute.model.getRoutes();
                console.log(multiRoute.getRoutes().get(0).properties.get('distance'));
            });

            // Добавляем мультимаршрут на карту.
            myMap.geoObjects.add(multiRoute);
        }


</script>

    <!-- AJAX
    var ob = {
    'id':3
    }

    $(".for_button").click(function() {
    $.ajax({

    type:'POST',
    url:'index.php',
    dataType:'json',
    data:"param="+JSON.stringify(ob),
    success:function(html) {
    $("<p class='for_content'>" + html['title'] + "</p>").
    prependTo(".content").
    hide().
    fadeIn(500);
    }
    });

    });
    -->
</div>
