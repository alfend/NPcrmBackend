<?php

namespace app\modules\client\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\Request;
use app\models\Response;
use app\models\DataMetering;


/**
 * Default controller for the `client` module
 */
class Rest2Controller extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */


    //проверка отклика  ChekResponse post(id_request,type_workers) вернет $response если нашел
    public function actionChekResponse()
    {
        $this->layout = '';
        $id_request = Yii::$app->request->post('id_request');;
        $id_workers = Yii::$app->user->getId();
        $type_workers = Yii::$app->request->post('type_workers');;
        $response = new Request();
        return $this->asJson(cheсkResponse($id_request, $id_workers, $type_workers));
    }

    //все отклики для заказа по ид, post(id_request,type_workers) вернет $response если нашел
    public function actionGetResponseByRequest()
    {
        $this->layout = '';
        $id_request = Yii::$app->request->post('id_request');;
        $type_workers = Yii::$app->request->post('type_workers');;
        $response = new Request();
        return $this->asJson(findResponseByRequest($id_request, $type_workers));
    }

    //список откликнувшихся для заказа по ид, post(id_request,type_workers) вернет $response если нашел
    public function actionGetWorkersByRequest()
    {
        $this->layout = '';
        $id_request = Yii::$app->request->post('id_request');;
        $type_workers = Yii::$app->request->post('type_workers');;
        $response = new Request();
        return $this->asJson(findWorkers($id_request, $type_workers));
    }


    //список откликнувшихся для заказа по ид, post(id_request,type_workers,date_workers,price) вернет $response если нашел
    public function actionCreateResponse()
    {
        $this->layout = '';
        $id_request = Yii::$app->request->post('id_request');
        $id_workers = Yii::$app->user->getId();
        $type_workers = Yii::$app->request->post('type_workers');
        $date_workers = Yii::$app->request->post('date_workers');
        $price = Yii::$app->request->post('price');
        $response = new Request();

        return $this->asJson($response->createResponse($id_request, $id_workers, $type_workers, $date_workers, $price));
    }


}