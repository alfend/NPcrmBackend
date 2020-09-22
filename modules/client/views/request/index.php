<?php

use yii\helpers\Html;
use app\models\User;
use app\models\Request;
use app\models\Response;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php

    $request_client = new Request();
    $array_request_client = $request_client->getRequestByClientAndStatus( Yii::$app->user->getId(), [$request_client::STATUS_CREATE,$request_client::STATUS_METERING_BEFORE,
        $request_client::STATUS_METERING_RUN,$request_client::STATUS_METERING_AFTER,
        $request_client::STATUS_COMPANY_BEFORE,$request_client::STATUS_COMPANY_RUN,
        $request_client::STATUS_COMPANY_AFTER,$request_client::STATUS_DELIVERY_BEFORE,$request_client::STATUS_DELIVERY_RUN,$request_client::STATUS_DELIVERY_AFTER,
        $request_client::STATUS_MOUNTING_BEFORE,$request_client::STATUS_MOUNTING_RUN,$request_client::STATUS_MOUNTING_AFTER,
        $request_client::STATUS_FINISH]);


    print('<h4> Заказы на замер </h4> <table border="1" width="100%"> <tr><th> Дата создания </th><th> Адрес </th><th> Дата замера </th><th></th></tr>');
    foreach ($array_request_client as $request){
        //есть ли отклики на заказ
        $response = new Response();
        print('');
        if($response->findResponseByRequest($request['id'],User::TYPE_METERING)) {
            $button_res=Html::a('Выбрать замерщика', ['/client/default/select-metering/'],['data-method' => 'POST', 'data-params' => ['id_request' => $request['id'], 'id_clients' => Yii::$app->user->getId(), 'type_workers' => User::TYPE_METERING]], ['class' => 'btn btn-primary']);
        } else {
            $button_res='Откликов пока нет';
        }
        print('<tr><td>'.$request['date_create'].'</td>'.'<td>'.$request['address'].'</td>'.'<td>'.$request['date_metering_plan'].'</td><td>'.$button_res.'</td></tr>');

    };

    //уже на замере
    $array_request_client = $request_client->getRequestByClientAndStatus( Yii::$app->user->getId(), [$request_client::STATUS_METERING_RUN,$request_client::STATUS_METERING_AFTER]);
    foreach ($array_request_client as $request){
        print('<tr><td>'.$request['date_create'].'</td>'.'<td>'.$request['address'].'</td>'.'<td>'.$request['date_metering'].'</td><td> Замерщик выбран </td></tr>');
    };

    print('</table>');
    ?>


    <?php
    //Заказы на изготовление
    $request_client = new Request();
    $array_request_client = $request_client->getRequestByClientAndStatus( Yii::$app->user->getId(), [$request_client::STATUS_COMPANY_BEFORE,$request_client::STATUS_COMPANY_RUN]);

    print('</br><h4> Заказы на изготовление </h4> <table border="1" width="100%"> <tr><th> Дата создания </th><th> Адрес </th><th> Дата замера </th><th></th></tr>');
    foreach ($array_request_client as $request){
        //есть ли отклики на заказ
        $response = new Response();
        print('');
        if($request['status_request'] == Request::STATUS_COMPANY_RUN) {
            $button_res='В процессе изготовления';
        } elseif($response->findResponseByRequest($request['id'],User::TYPE_COMPANY)) {
            $button_res=Html::a('Выбрать изготовителя', ['/client/default/select-company/'],['data-method' => 'POST', 'data-params' => ['id_request' => $request['id'], 'id_clients' => Yii::$app->user->getId(), 'type_workers' => User::TYPE_COMPANY]], ['class' => 'btn btn-primary']);
        } else {
            $button_res='Ожидаем отклик производителя';
        }
        print('<tr><td>'.$request['date_create'].'</td>'.'<td>'.$request['address'].'</td>'.'<td>'.$request['date_metering_plan'].'</td><td>'.$button_res.'</td></tr>');

    };
    print('</table>');
    ?>

    <?php
    //Заказы на доставку
    $request_client = new Request();
    $array_request_client = $request_client->getRequestByClientAndStatus( Yii::$app->user->getId(), [$request_client::STATUS_COMPANY_AFTER,$request_client::STATUS_DELIVERY_BEFORE,$request_client::STATUS_DELIVERY_RUN,$request_client::STATUS_DELIVERY_AFTER]);

    print('</br><h4> Заказы на доставку </h4> <table border="1" width="100%"> <tr><th> Дата изготовления </th><th> Адрес </th><th> изготовитель </th><th></th></tr>');
    foreach ($array_request_client as $request){
        //доставили ли уже
        if($request['status_request'] == Request::STATUS_COMPANY_AFTER) {
            $button_res='Ожидаем назначение курьера';
        } elseif ($request['status_request'] == Request::STATUS_DELIVERY_BEFORE) {
            $button_res='Курьер назначен';
        } else if ($request['status_request'] == Request::STATUS_DELIVERY_RUN){
            $button_res='Курьер забрал потолок';
        } else if ($request['status_request'] == Request::STATUS_DELIVERY_AFTER){
            $button_res=Html::a('Доставили?', ['/client/default/mounting-before/'],['data-method' => 'POST', 'data-params' => ['id_request' => $request['id']]], ['class' => 'btn btn-primary']);
        }
        $company = new User();
        $company=User::findIdentity($request['id_company']);

        print('<tr><td>'.$request['date_create'].'</td>'.'<td>'.$request['address'].'</td><td>'.$company['company'].' по адресу '.$company['address'].' </td><td> '.$button_res.' </td></tr>');
    };
    print('</table>');
    ?>

    <?php
    //Заказы на монтаж
    $request_client = new Request();
    $array_request_client = $request_client->getRequestByClientAndStatus( Yii::$app->user->getId(), [$request_client::STATUS_MOUNTING_BEFORE,$request_client::STATUS_MOUNTING_RUN,$request_client::STATUS_MOUNTING_AFTER]);
    print('</br><h4> Заказы на монтаж </h4> <table border="1" width="100%"> <tr><th> Дата создания </th><th> Адрес </th><th> Дата замера </th><th></th></tr>');
    foreach ($array_request_client as $request){
        //есть ли отклики на заказ
        $response = new Response();
        if($request['status_request'] == Request::STATUS_MOUNTING_BEFORE) {
            $button_res=Html::a('Выбрать монтажника', ['/client/default/select-mounting/'],['data-method' => 'POST', 'data-params' => ['id_request' => $request['id'], 'id_clients' => Yii::$app->user->getId(), 'type_workers' => User::TYPE_MOUNTING]], ['class' => 'btn btn-primary']);
        } elseif($request['status_request'] == Request::STATUS_MOUNTING_RUN) {
            $button_res='В процессе монтажа';
        } else {
            $button_res=Html::a('Установили?', ['/client/default/mounting-after/'],['data-method' => 'POST', 'data-params' => ['id_request' => $request['id']]], ['class' => 'btn btn-primary']);
        }
        print('<tr><td>'.$request['date_create'].'</td>'.'<td>'.$request['address'].'</td>'.'<td>'.$request['date_metering_plan'].'</td><td>'.$button_res.'</td></tr>');

    };
    print('</table>');
    ?>

    <?php
    //Заказы на монтаж
    $request_client = new Request();
    $array_request_client = $request_client->getRequestByClientAndStatus( Yii::$app->user->getId(), [$request_client::STATUS_FINISH]);
    print('</br><h4> Заказы выполненные </h4> <table border="1" width="100%"> <tr><th> Дата создания </th><th> Адрес </th><th> Дата замера </th><th></th></tr>');
    foreach ($array_request_client as $request){
        //есть ли отклики на заказ
        print('<tr><td>'.$request['date_create'].'</td>'.'<td>'.$request['address'].'</td>'.'<td>'.$request['date_metering_plan'].'</td><td>Завершен</td></tr>');

    };
    print('</table>');
    ?>



    <?php
    /*
    print('Все:');

        GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'id_client',
            'date_create',
            'address',
            'date_metering_plan',
            'comment_request:ntext',

            //'address_client_street',
            //'address_client_house',
            //'address_client_room',
            //
            //'id_metering',
            //
            //'date_metering',
            //'id_delivery',
            //'price_delivery',
            //'id_mounting',
            //'price_mounting',
            //'type_price',
            //'id_company',
            //'price_company',
            //'price_request',
            //'deposit_transfer',
            //'deposit_cash',
            //'type_deposit',
            //'status_price',
            //'status_request',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */
    ?>


</div>
