<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_client') ?>

    <?= $form->field($model, 'date_create') ?>

    <?= $form->field($model, 'id_city') ?>

    <?= $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'address_client_street') ?>

    <?php // echo $form->field($model, 'address_client_house') ?>

    <?php // echo $form->field($model, 'address_client_room') ?>

    <?php // echo $form->field($model, 'comment_request') ?>

    <?php // echo $form->field($model, 'id_metering') ?>

    <?php // echo $form->field($model, 'date_metering_plan') ?>

    <?php // echo $form->field($model, 'time_from_metering_plan') ?>

    <?php // echo $form->field($model, 'time_to_metering_plan') ?>

    <?php // echo $form->field($model, 'date_metering') ?>

    <?php // echo $form->field($model, 'id_delivery') ?>

    <?php // echo $form->field($model, 'price_delivery') ?>

    <?php // echo $form->field($model, 'id_mounting') ?>

    <?php // echo $form->field($model, 'price_mounting') ?>

    <?php // echo $form->field($model, 'type_price') ?>

    <?php // echo $form->field($model, 'id_company') ?>

    <?php // echo $form->field($model, 'price_company') ?>

    <?php // echo $form->field($model, 'price_request') ?>

    <?php // echo $form->field($model, 'deposit_transfer') ?>

    <?php // echo $form->field($model, 'deposit_cash') ?>

    <?php // echo $form->field($model, 'type_deposit') ?>

    <?php // echo $form->field($model, 'status_price') ?>

    <?php // echo $form->field($model, 'status_request') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
