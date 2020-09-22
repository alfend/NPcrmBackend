<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Request;
use app\models\User;
use app\models\Response;
use app\models\DataMetering;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы на изготовление';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    //Список заказов на замер
    $request = new Request();
    $array_request = $request->getRequestByStatus( Yii::$app->user->identity->id_city, $request::STATUS_COMPANY_BEFORE);

    print('<h3> Заказы  на изготовление </h3> ');


    //ранее в табличном виде
    /*print('<table border="1" width="100%"> <tr><th> Дата создания </th><th> Адрес </th><th> Дата замера </th><th></th></tr>');
    print('<tr><td>'.$request['date_create'].'</td>'.'<td>'.$request['address'].'</td>'.'<td>'.$request['date_metering_plan'].'</td><td>'.$button_res.'</td></tr>');
    print('</table>');
    */

    foreach ($array_request as $request){
        $response = new Response();
        //если еще не откликался
        if(!$response->cheсkResponse($request['id'],Yii::$app->user->getId(),User::TYPE_COMPANY)) {
            print(' <div class="row"> <div class="col-sm-6"> ');
            print('Адрес заказа: '.$request['address'].'</br>');
            //получение данных замера
            $dataMetering = new DataMetering();
            $dataMetering=$dataMetering->cheсkDataMetering($request['id'], $request['id_metering']);
            print('Кол-во потолков: '.$dataMetering['count_ceiling'].'</br>');
            print('Общая площадь: '.$dataMetering['area'].'</br>');
            print('Периметр: '.$dataMetering['perimeter'].'</br>');
            print('Кол-во светильников: '.$dataMetering['spot'].'</br>');
            print('Кол-во люстр: '.$dataMetering['luster'].'</br>');
            print('Кол-во гардин: '.$dataMetering['curtain'].'</br>');
            print('Обводов труб: '.$dataMetering['cut_pipe'].'</br>');
            print(' </div> </div> ');

            print(Html::beginForm(['/company/default/create-response/', 'id_request' => $request['id']], 'post').
                Html::input('hidden', 'id_request', $request['id']).
                Html::input('hidden', 'id_workers', Yii::$app->user->getId()).
                Html::input('hidden', 'type_workers', User::TYPE_COMPANY).
                HTML::label('Дата изготовления: ').
                Html::input('text', 'date_workers','2000-01-01').'</br>'.
                HTML::label('Стоимость: ').
                Html::input('text', 'price', Yii::$app->request->post('price')).'</br>'.

                Html::submitButton('предложить условия', ['class' => 'btn btn-lg btn-primary', 'name' => 'hash-button']).
            Html::endForm());
            /*
            'id_request' => $request['id'], 'id_workers' => Yii::$app->user->getId(), 'type_workers' => User::TYPE_COMPANY,'date_workers' => $request['date_metering_plan']

            $id_request=Yii::$app->request->post('id_request', null);
            $id_workers=Yii::$app->request->post('id_workers', null);
            $type_workers=Yii::$app->request->post('type_workers', null);
            $date_workers=Yii::$app->request->post('date_workers', null);
            $price=Yii::$app->request->post('date_workers', null);



            //$button_res=Html::a('предложить условия', ['/company/default/create-response/'],['data-method' => 'POST', 'data-params' => ['id_request' => $request['id'], 'id_workers' => Yii::$app->user->getId(), 'type_workers' => User::TYPE_COMPANY,'date_workers' => $request['date_metering_plan']]], ['class' => 'btn btn-primary']);
            */
        }
    };
    ?>



</div>
