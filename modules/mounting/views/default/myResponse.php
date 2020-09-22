<?php

use yii\helpers\Html;
use app\models\Request;
use app\models\User;
use app\models\Response;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои отклики';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php
    //Вывод на замер
    $request = new Request();
    $array_request = $request->getRequestByWorkerAndStatusMounting( Yii::$app->user->getId(), $request::STATUS_METERING_BEFORE);

    print('<h3> Отклики на заказы </h3> <table border="1" width="100%"> <tr><th> Дата создания </th><th> Адрес </th><th> Дата замера </th><th></th></tr>');
    foreach ($array_request as $request){
        $response = new Response();
        if($response->cheсkResponse($request['id'],Yii::$app->user->getId(),User::TYPE_METERING)) {
            $button_res=Html::a('Отказаться', ['/mounting/default/delete-response/'],['data-method' => 'POST', 'data-params' => ['id_request' => $request['id'], 'id_workers' => Yii::$app->user->getId(), 'type_workers' => User::TYPE_MOUNTING]]);
            print('<tr><td>'.$request['date_create'].'</td>'.'<td>'.$request['address'].'</td>'.'<td>'.$request['date_metering_plan'].'</td><td>'.$button_res.'</td></tr>');
        }


    };

    print('</table>');

    ?>

        <?php
    //Вывод ДОДЕЛАТЬ
    $request = new Request();
    $array_request = $request->getRequestByStatus( Yii::$app->user->identity->id_city, $request::STATUS_MOUNTING_BEFORE);
    print('<h3> Отклики на заказы </h3> <table border="1" width="100%"> <tr><th> Дата создания </th><th> Адрес </th><th> Дата замера </th><th></th></tr>');
    foreach ($array_request as $request){
        $response = new Response();
        if($response->cheсkResponse($request['id'],Yii::$app->user->getId(),User::TYPE_MOUNTING)) {
            $button_res=Html::a('Отказаться', ['/mounting/default/delete-response/'],['data-method' => 'POST', 'data-params' => ['id_request' => $request['id'], 'id_workers' => Yii::$app->user->getId(), 'type_workers' => User::TYPE_COMPANY]]);
            print('<tr><td>'.$request['date_create'].'</td>'.'<td>'.$request['address'].'</td>'.'<td>'.$request['date_metering_plan'].'</td><td>'.$button_res.'</td></tr>');
        }



    };

    print('</table>');
    ?>

</div>
