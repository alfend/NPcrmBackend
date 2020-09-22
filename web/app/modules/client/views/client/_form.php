<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_client')->textInput() ?>

    <?= $form->field($model, 'date_create')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address_client_street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address_client_house')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address_client_room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment_request')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'id_metering')->textInput() ?>

    <?= $form->field($model, 'date_metering_plan')->textInput() ?>

    <?= $form->field($model, 'date_metering')->textInput() ?>

    <?= $form->field($model, 'id_delivery')->textInput() ?>

    <?= $form->field($model, 'price_delivery')->textInput() ?>

    <?= $form->field($model, 'id_mounting')->textInput() ?>

    <?= $form->field($model, 'price_mounting')->textInput() ?>

    <?= $form->field($model, 'type_price')->textInput() ?>

    <?= $form->field($model, 'id_company')->textInput() ?>

    <?= $form->field($model, 'price_company')->textInput() ?>

    <?= $form->field($model, 'price_request')->textInput() ?>

    <?= $form->field($model, 'deposit_transfer')->textInput() ?>

    <?= $form->field($model, 'deposit_cash')->textInput() ?>

    <?= $form->field($model, 'type_deposit')->textInput() ?>

    <?= $form->field($model, 'status_price')->textInput() ?>

    <?= $form->field($model, 'status_request')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
