<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Request', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_client',
            'date_create',
            'address',
            'address_client_street',
            //'address_client_house',
            //'address_client_room',
            //'comment_request:ntext',
            //'id_metering',
            //'date_metering_plan',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
