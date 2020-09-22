<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DataMetering */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-metering-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_request')->label(false)->hiddenInput(['value' => Yii::$app->request->post('id_request', null)]) ?>

    <?= $form->field($model, 'id_workers')->label(false)->hiddenInput(['value' => Yii::$app->user->getId()]) ?>

    <?= $form->field($model, 'count_ceiling')->textInput() ?>

    <?= $form->field($model, 'area')->textInput() ?> м2

    <?= $form->field($model, 'perimeter')->textInput() ?> м

    <?= $form->field($model, 'spot')->textInput() ?>

    <?= $form->field($model, 'luster')->textInput() ?>

    <?= $form->field($model, 'curtain')->textInput() ?>

    <?= $form->field($model, 'cut_pipe')->textInput() ?>

    <?php // $form->field($model, 'file')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
