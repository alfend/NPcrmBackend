<?php

use yii\helpers\Html;
use app\models\Request;
use app\models\User;
use app\models\Response;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы на замер';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    //Список заказов на замер
    $request = new Request();
    $array_request = $request->getRequestByStatus( Yii::$app->user->identity->id_city, $request::STATUS_METERING_BEFORE);

    print('<h3> Заказы на замер </h3> <table border="1" width="100%"> <tr><th> Дата создания </th><th> Адрес </th><th> Дата замера </th><th></th></tr>');
    foreach ($array_request as $request){
        $response = new Response();
        //если еще не откликался
        if(!$response->cheсkResponse($request['id'],Yii::$app->user->getId(),User::TYPE_METERING)) {
            $button_res=Html::a('Откликнуться', ['/mounting/default/create-response/'],['data-method' => 'POST', 'data-params' => ['id_request' => $request['id'], 'id_workers' => Yii::$app->user->getId(), 'type_workers' => User::TYPE_METERING,'date_workers' => $request['date_metering_plan']]], ['class' => 'btn btn-primary']);
            print('<tr><td>'.$request['date_create'].'</td>'.'<td>'.$request['address'].'</td>'.'<td>'.$request['date_metering_plan'].'</td><td>'.$button_res.'</td></tr>');
        }
    };

    print('</table>');

    ?>

    <?php
    //Список заказов на монтаж
    $request = new Request();
    $array_request = $request->getRequestByStatus( Yii::$app->user->identity->id_city, $request::STATUS_MOUNTING_BEFORE);

    print('<h3> Заказы на монтаж </h3> <table border="1" width="100%"> <tr><th> Дата создания </th><th> Адрес </th><th> Дата замера </th><th></th></tr>');
    foreach ($array_request as $request){
        $response = new Response();
        //если еще не откликался
        if(!$response->cheсkResponse($request['id'],Yii::$app->user->getId(),User::TYPE_MOUNTING)) {
            $button_res=Html::a('Откликнуться', ['/mounting/default/create-response-mounting/'],['data-method' => 'POST', 'data-params' => ['id_request' => $request['id'], 'id_workers' => Yii::$app->user->getId(), 'type_workers' => User::TYPE_MOUNTING,'date_workers' => $request['date_metering_plan']]], ['class' => 'btn btn-primary']);
            print('<tr><td>'.$request['date_create'].'</td>'.'<td>'.$request['address'].'</td>'.'<td>'.$request['date_metering_plan'].'</td><td>'.$button_res.'</td></tr>');
        }
    };

    print('</table>');

    ?>

</div>
