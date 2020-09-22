<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DataMetering */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Data Meterings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="data-metering-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /* Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])*/ ?>
    </p>

    <?php /* DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_request',
            'id_workers',
            'count_ceiling',
            'area',
            'perimeter',
            'spot',
            'luster',
            'curtain',
            'cut_pipe',
            'file',
        ],
    ]) */ ?>

</div>
