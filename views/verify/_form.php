<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Verify */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="verify-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_request')->textInput() ?>

    <?= $form->field($model, 'id_from_user')->textInput() ?>

    <?= $form->field($model, 'id_to_user')->textInput() ?>

    <?= $form->field($model, 'verify_to_user')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
