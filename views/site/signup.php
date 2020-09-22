<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\City;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Пожалуйста заполните следующие поля:</p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'date_create')->label(false)->hiddenInput(['value' => (new \DateTime('now', new \DateTimeZone('Europe/Moscow')))->format('Y-m-d H:i:s')]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label('Email:') ?>
            <?= $form->field($model, 'tel')->textInput(['maxlength' => true])->label('Телефон:') ?>
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])->label('Пароль:') ?>
            <?= $form->field($model, 'lastname')->textInput(['maxlength' => true])->label('Фамилия:') ?>
            <?= $form->field($model, 'firstname')->textInput(['maxlength' => true])->label('Имя:') ?>
            <?= $form->field($model, 'secondname')->textInput(['maxlength' => true])->label('Отчество:') ?>
            <?= $form->field($model, 'birthday')->textInput(['value' => '2000-01-01'])->label('Дата рождения'); ?>

            <?php
            //определение ИД города
                $city= new City();
                $city_name=$city->getCityByIp($_SERVER['REMOTE_ADDR']);
                $idCity=$city->getCityByName($city_name)->id;
            ?>

            <?= $form->field($model, 'id_city')->dropDownList(\yii\helpers\ArrayHelper::map(City::find()->all(), 'id', 'name'),
                ['options' => [$idCity => ['Selected' => true]]])->label('Город');?>
            <h6>Город <?=$city_name;?> мы определили автоматически на основе вашего IP адреса,
                если он определен не верно просим выбрать правильно. </h6>
            <?= $form->field($model, 'address')->textInput(['maxlength' => true])->label('Адрес:') ?>

            <?= $form->field($model, 'status')->label(false)->hiddenInput(['value' => '0'])?>

            <?php
            //echo $form->field($model, 'uploadFile[]')->fileInput(['multiple'=>'multiple']);
            ?>
                <div class="form-group">
                    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>