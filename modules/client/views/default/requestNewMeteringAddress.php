<?php

use yii\helpers\Html;
use app\models\Request;
use app\models\Response;
use app\models\User;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Request */

$this->title = 'Заказать замер';
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
//Список заказов на замер
?>
<?= \app\widgets\HeaderBalans::widget() ?>

<section class="sec sec-breadcrumbs">

    <div class="container container-xs px-0">

        <div class="row">

            <div class="col">

                <div class="breadcrumbs ml-3">
                    <ul>
                        <li>
                            <a href="/client/default">Мои замеры</a>
                        </li>
                        <li>
                            <a href="/client/default/request-new-metering-date">Новый заказ</a>
                        </li>
                        <li>
                            <span>Выбор адреса</span>
                        </li>
                    </ul>
                </div>
                <!-- /.breadcrumbs -->

            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

</section>
<!-- /.sec-breadcrumbs -->

<?= $this->render('_formRequest', [
    'model' => $model,
]) ?>
</section>
</div>


</main>
<!-- /.wrap-container -->
