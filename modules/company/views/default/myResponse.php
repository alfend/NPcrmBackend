<?php

use yii\helpers\Html;
use yii\grid\GridView;
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
    //Вывод
    $request = new Request();
    $array_request = $request->getRequestByStatus( Yii::$app->user->identity->id_city, $request::STATUS_COMPANY_BEFORE);

    print('<h3> Отклики на изготовление </h3> <table border="1" width="100%"> <tr><th> Адрес </th><th> Стоимость </th><th> Дата изготовления </th><th></th></tr>');
    foreach ($array_request as $request){
        $response = new Response();
        if($response->cheсkResponse($request['id'],Yii::$app->user->getId(),User::TYPE_COMPANY)) {
            $response = $response->cheсkResponse($request['id'],Yii::$app->user->getId(),User::TYPE_COMPANY);
            $button_res=Html::a('Отказаться', ['/company/default/delete-response/'],['data-method' => 'POST', 'data-params' => ['id_request' => $request['id'], 'id_workers' => Yii::$app->user->getId(), 'type_workers' => User::TYPE_COMPANY]], ['class' => 'btn btn-primary']);
            print('<tr><td>'.$request['address'].'</td>'.'<td>'.$response['price'].'</td>'.'<td>'.$response['date_workers'].'</td><td>'.$button_res.'</td></tr>');
        }
    };

    print('</table>');

    ?>

</div>
