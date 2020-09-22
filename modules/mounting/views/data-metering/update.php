<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DataMetering */

$this->title = 'Введите данные замера: ' . $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Data Meterings', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-metering-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
