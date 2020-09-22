<?php

use yii\helpers\Html;
use app\models\Request;
use app\models\Response;
use app\models\User;
use app\models\DataMetering;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы на изготовление';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php
    //Вывод заказов
    $request = new Request();
    $array_request = $request->getRequestByWorkerAndStatusCompany( Yii::$app->user->getId(), [$request::STATUS_COMPANY_RUN,$request::STATUS_COMPANY_AFTER,$request::STATUS_DELIVERY_BEFORE]);

    print('<h3> Заказы на изготовление </h3> <table border="1" width="100%"> <tr><th> Дата изготовления(план) </th><th> Адрес доставки </th><th> Дата замера </th><th> Доставщик </th><th></th></tr>');
    foreach ($array_request as $request){
        //для вывода замеров
        $dataMetering = new DataMetering();
        $dataMetering->cheсkDataMetering($request['id'],Yii::$app->user->getId());
        //изготовлено ли уже
        if($request['status_request'] == Request::STATUS_COMPANY_RUN) {

            $button_res=Html::a('Изготовлено', ['/company/default/company-run'],['data-method' => 'POST', 'data-params' => ['id_request' => $request['id']]], ['class' => 'btn btn-primary']);
        } elseif($request['status_request'] == Request::STATUS_COMPANY_AFTER) {
            $button_res='Ждите курьера';
        } else  if($request['status_request'] == Request::STATUS_DELIVERY_BEFORE){
            $button_res='Курьер назначен';
        }

        $response = new Response();
        $response = $response->cheсkResponse($request['id'],Yii::$app->user->getId(),User::TYPE_COMPANY);
        $delivery = new User();
        $delivery = $delivery->findIdentity($request['id_delivery']);
        print('<tr><td>'.$response['date_workers'].'</td><td>'.$request['address'].'</td><td>'.$request['date_metering_plan'].'</td><td> '.$delivery['lastname'].'</td><td> '.$button_res.'</td></tr>');
    };

    print('</table>');

    ?>

</div>
