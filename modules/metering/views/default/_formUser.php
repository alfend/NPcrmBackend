<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datetime\DateTimePicker;
use app\models\City;

$this->title = 'Мои данные';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'date_create')->label(false)->hiddenInput() ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'readOnly'=>true])->label('Email:') ?>
            <?= $form->field($model, 'password')->hiddenInput(['maxlength' => true])->label(false) ?>
            <?= $form->field($model, 'tel')->textInput(['maxlength' => true])->label('Телефон:') ?>
            <?= $form->field($model, 'lastname')->textInput(['maxlength' => true])->label('Фамилия:') ?>
            <?= $form->field($model, 'firstname')->textInput(['maxlength' => true])->label('Имя:') ?>
            <?= $form->field($model, 'secondname')->textInput(['maxlength' => true])->label('Отчество:') ?>
            <?= $form->field($model, 'birthday')->textInput(['value' => '2000-01-01'])->label('Дата рождения'); ?>


            <?= 'Для ввода даты, потом переделаю'.DateTimePicker::widget([
    'name' => 'datetime_10',
    'options' => ['placeholder' => 'Выбирите дату'],
    'convertFormat' => true,
    'pluginOptions' => [
        'format' => 'yyyy.MM.dd hh:i',
        'startDate' => '1900-01-01 00:00',
        'todayHighlight' => true
    ]
    ]); ?>


            <?= $form->field($model, 'id_city')->dropDownList(\yii\helpers\ArrayHelper::map(City::find()->all(), 'id', 'name')
                )->label('Город');
            //['options' => [$id_city => ['Selected' => true]]]
            ?>
            <?= $form->field($model, 'address')->textInput(['maxlength' => true])->label('Адрес:') ?>

            <?php
            //echo $form->field($model, 'uploadFile[]')->fileInput(['multiple'=>'multiple']);
            ?>
                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
