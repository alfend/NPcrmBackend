<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DataMetering */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-metering-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'id_request')->label(false)->textInput(['value' => Yii::$app->request->post('id_request', null)]) ?>

    <?= $form->field($model, 'id_workers')->label(false)->hiddenInput(['value' => Yii::$app->user->getId()]) ?>

    <?= $form->field($model, 'count_ceiling')->textInput() ?>

    <?= $form->field($model, 'area')->textInput() ?> м2

    <?= $form->field($model, 'perimeter')->textInput() ?> м

    <?= $form->field($model, 'spot')->textInput(['value' => '0']) ?>

    <?= $form->field($model, 'luster')->textInput() ?>

    <?= $form->field($model, 'curtain')->textInput(['value' => '0']) ?>

    <?= $form->field($model, 'cut_pipe')->textInput(['value' => '0']) ?>

    <?= $form->field($model, 'images[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label('Загрузите схемы') ?>

    <?php
    if(!$model->isNewRecord){

        //вывод загруженных картинок

        //print(Yii::$app->request->post('id_request'));
        $dir = 'web/uploads/images/metering/11/'; // Папка с изображениями

        $cols = 3; // Количество столбцов в будущей таблице с картинками
        $files = scandir($dir); // Берём всё содержимое директории
        echo "<table border='0' width='100%'>"; // Начинаем таблицу
        $k = 0; // Вспомогательный счётчик для перехода на новые строки
        for ($i = 0; $i < count($files); $i++) { // Перебираем все файлы

            if (($files[$i] != ".") && ($files[$i] != "..")) { // Текущий каталог и родительский пропускаем

                if ($k % $cols == 0) echo "<tr>"; // Добавляем новую строку
                print "<td>"; // Начинаем столбец
                $path = $dir.$files[$i]; // Получаем путь к картинке
                print "<a href='/".$path."'>"; // Делаем ссылку на картинку
                print "<img src='/".$path."' alt='' width='100' />"; // Вывод превью картинки
                print "</a>"; // Закрываем ссылку
                print "</td>"; // Закрываем столбец
                /* Закрываем строку, если необходимое количество было выведено, либо данная итерация последняя */
                if ((($k + 1) % $cols == 0) || (($i + 1) == count($files))) echo "</tr>";
                $k++; // Увеличиваем вспомогательный счётчик
            }
        }
        print "</table>"; // Закрываем таблицу

    };
    ?>
    <?php // $form->field($model, 'file')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-block btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
