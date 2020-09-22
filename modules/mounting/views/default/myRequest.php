<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Request;
use app\models\User;
use app\models\DataMetering;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы на замер';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php
    //Вывод заказов на замер
    $request = new Request();
    $array_request = $request->getRequestByWorkerAndStatusMetering( Yii::$app->user->getId(), $request::STATUS_METERING_AFTER);

    print('<h3> Заказы на замер </h3> <table border="1" width="100%"> <tr><th> Дата создания </th><th> Адрес </th><th> Дата замера </th><th></th></tr>');
    foreach ($array_request as $request){

        $dataMetering = new DataMetering();
        //вносил ли уже замеры
        if(!$dataMetering->cheсkDataMetering($request['id'],Yii::$app->user->getId())) {
            $button_res=Html::a('Ввести замер', ['/metering/data-metering/create'],['data-method' => 'POST', 'data-params' => ['id_request' => $request['id']]], ['class' => 'btn btn-primary']);
        } else {
            $button_res=Html::a('Изменить замер', ['/metering/data-metering/update', 'id' => $dataMetering->cheсkDataMetering($request['id'],Yii::$app->user->getId())->id],['data-method' => 'POST', 'data-params' => ['id_request' => $request['id']]], ['class' => 'btn btn-primary']);
        }



        print('<tr><td>'.$request['date_create'].'</td>'.'<td>'.$request['address'].'</td>'.'<td>'.$request['date_metering_plan'].'</td><td> '.$button_res.'</td></tr>');
    };

    print('</table>');

    ?>

    <?php
    //Вывод заказов на монтаж
    $request = new Request();
    $array_request = $request->getRequestByWorkerAndStatusMounting( Yii::$app->user->getId(), [$request::STATUS_MOUNTING_RUN,$request::STATUS_MOUNTING_AFTER]);

    print('<h3> Заказы на монтаж </h3> <table border="1" width="100%"> <tr><th> Дата создания </th><th> Адрес </th><th> Дата замера </th><th></th></tr>');
    foreach ($array_request as $request){

        $dataMetering = new DataMetering();
        $button_res='';

        //вносил ли уже замеры
    if($request['status_request'] == Request::STATUS_MOUNTING_RUN) {
        $button_res = Html::a('Исполнено', ['/mounting/default/mounting-run'],
            ['data-method' => 'POST', 'data-params' => ['id_request' => $request['id']]],
            ['class' => 'btn btn-primary']);
    } if($request['status_request'] == Request::STATUS_MOUNTING_AFTER) {
            $button_res='Ждите подтверждение клиента';
    }

        print('<tr><td>'.$request['date_create'].'</td>'.'<td>'.$request['address'].'</td>'.'<td>'.$request['date_metering_plan'].'</td><td> '.$button_res.'</td></tr>');
    };

    print('</table>');

    ?>

</div>
