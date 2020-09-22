<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Request */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_client',
            'date_create',
            'address',
            'address_client_street',
            'address_client_house',
            'address_client_room',
            'comment_request:ntext',
            'id_metering',
            'date_metering_plan',
            'date_metering',
            'id_delivery',
            'price_delivery',
            'id_mounting',
            'price_mounting',
            'type_price',
            'id_company',
            'price_company',
            'price_request',
            'deposit_transfer',
            'deposit_cash',
            'type_deposit',
            'status_price',
            'status_request',
        ],
    ]) ?>

</div>
