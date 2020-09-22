<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RequisitesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="requisites-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_user') ?>

    <?= $form->field($model, 'company') ?>

    <?= $form->field($model, 'inn') ?>

    <?= $form->field($model, 'kpp') ?>

    <?php // echo $form->field($model, 'bank_name') ?>

    <?php // echo $form->field($model, 'bank_bik') ?>

    <?php // echo $form->field($model, 'account_calc') ?>

    <?php // echo $form->field($model, 'account_cor') ?>

    <?php // echo $form->field($model, 'address_company') ?>

    <?php // echo $form->field($model, 'director') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
