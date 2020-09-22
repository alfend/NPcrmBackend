<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use app\models\Request;
use app\models\Response;

/* @var $this yii\web\View */
/* @var $model app\models\Request */

$this->title = 'Выбор замерщика';
$this->params['breadcrumbs'][] = ['label' => 'Заказ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php

    print('<h3> Исполнители </h3> <table border="1" width="100%"> <tr><th> ФИО </th><th> Дата замера </th><th> Отзывы </th><th> </th></tr>');

    foreach ($workers as $worker){
        //есть ли отклики на заказ

        $button_res=Html::a('Выбрать этого', ['/client/default/insert-company/'],['data-method' => 'POST', 'data-params' => ['id_request' => $worker['id_request'], 'id_workers' => $worker['id'], 'date_workers' => $worker['date_workers']]], ['class' => 'btn btn-primary']);


        print('<tr><td>'.$worker['company'].'</td><td> '.$worker['date_workers'].' </td><td> '.$worker['price'].' </td><td>'.$button_res.'</td></tr>');

    };
    print('<table>');
    ?>

</div>
