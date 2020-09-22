<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\City;


/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="request-form" novalidate class="form mt-2">

    <?php $form = ActiveForm::begin(); ?>


<!--    <form novalidate class="form mt-2"  action="/client/default/request-new-metering-address" method="post" >

'<span class="input-nao__content">Укажите улицу</span>',['class' => 'input-nao__label','for' =>"address"]

                        <input class="input-nao__field valid" type="text" id="address" value="">
                        <label class="input-nao__label" for="address">
                            Укажите улицу
                        </label>

                        <input class="input-nao__field valid" type="text" id="address" value="">
-->


    <div class="container container-xs px-3">

            <?php //картинка карандаша и линия
            $svg='<svg class="input-nao__graphic" width="300%" height="100%"
                             viewBox="0 0 1200 60" preserveAspectRatio="none">
                            <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"></path>
                        </svg>';
            ?>

            <?php //скрытые поля
            ?>
            <?= $form->field($model, 'id_client')->label(false)->hiddenInput(['value' => Yii::$app->user->getId()]) ?>

            <?= $form->field($model, 'date_create')->label(false)->hiddenInput(['value' => (new \DateTime('now', new \DateTimeZone('Europe/Moscow')))->format('Y-m-d H:i:s')]) ?>

            <?php
            $city= new City();
            $city_name=$city->getCityById(Yii::$app->user->identity->id_city)->name;
            ?>

            <?= $form->field($model, 'id_city')->label(false)->hiddenInput(['value' => Yii::$app->user->identity->id_city]);?>

            <?= $form->field($model, 'status_request')->label(false)->hiddenInput(['value' => \app\models\Request::STATUS_METERING_BEFORE])   ?>


            <?php // $form->field($model, 'date_metering_plan')->textInput(['value' => date('Y-m-d')]);//['value' => (new \DateTime('now', new \DateTimeZone('Europe/Moscow')))->format('Y-m-d H:i:s')])
            ?>

            <button type="button" class="btn btn-primary btn-block">Дата: <?= Yii::$app->request->POST('date'); ?> Время: <?= str_replace(';',':00 ', Yii::$app->request->POST('my_range')).':00'; ?></button>

            <span class="input-nao">
                <?= $form->field($model, 'address_client_street', ['template' => "{input}\n{label}\n $svg \n{error}{hint}"])->textInput(['class' => 'input-nao__field valid'])->label('Укажите улицу',['class' => 'input-nao__label','for' =>"address"])?>
            </span>
        <span class="input-nao">
                <?= $form->field($model, 'address_client_house', ['template' => "{input}\n{label}\n $svg \n{error}{hint}"])->textInput(['class' => 'input-nao__field valid'])->label('Укажите номер дома',['class' => 'input-nao__label','for' =>"address"])?>
            </span>

        <span class="input-nao">
                <?= $form->field($model, 'address_client_room', ['template' => "{input}\n{label}\n $svg \n{error}{hint}"])->textInput(['class' => 'input-nao__field valid'])->label('Укажите номер квартиры',['class' => 'input-nao__label','for' =>"address"])?>
            </span>




    <?php
 /*



 <?= $form->field($model, 'address')->textInput(['value' => Yii::$app->user->identity->address, 'class' => 'input-nao__content']) ?>

    $form->field($model, 'date')->widget(
        DatePicker::className()
    );
 /*   echo $form->field($model, 'datetime_1')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Enter event time ...'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]);

/*      DateTimePicker::widget([
        'name' => 'datetime_10',
        'options' => ['placeholder' => 'Select operating time ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'd-M-Y g:i A',
            'startDate' => '01-Mar-2014 12:00 AM',
            'todayHighlight' => true
        ]
    ]);
 */
 ?>

    <div class="text-center mt-3">
        <?= Html::submitButton('Записаться на замер', ['class' => 'btn btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
    </section>
