<?php

namespace app\modules\delivery\controllers;

use Yii;
use yii\web\Controller;
use app\models\Request;

/**
 * Default controller for the `delivery` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    //новые заказы
    public function actionNewRequest()
    {
        return $this->render('newRequest');
    }
    //заказы мне
    public function actionMyRequest()
    {
        return $this->render('myRequest');
    }
    //мои отклики
    public function actionMyResponse()
    {
        return $this->render('myResponse');
    }

    //установить доставщиком
    public function actionInsertDelivery()
    {
        //параметры из пост
        $id_request=Yii::$app->request->post('id_request', null);;
        $id_workers=Yii::$app->request->post('id_workers', null);;

        $request = new Request();
        $request->getRequestById($id_request);
        $request->setInsertDelivery($id_request,$id_workers);
        $request->setStatus($id_request, Request::STATUS_COMPANY_AFTER, Request::STATUS_DELIVERY_BEFORE);

        return $this->redirect('/delivery/default/my-request');
    }

    //Доставил
    public function actionDeliveryRun()
    {
        //параметры из пост
        $id_request=Yii::$app->request->post('id_request', null);;

        $request = new Request();
        $request->getRequestById($id_request);
        $request->setStatus($id_request, Request::STATUS_DELIVERY_BEFORE, Request::STATUS_DELIVERY_RUN);

        return $this->redirect('/delivery/default/my-request');
    }

    // Отправить заявку что доставил
    public function actionDeliveryAfter()
    {
        //параметры из пост
        $id_request=Yii::$app->request->post('id_request', null);;

        $request = new Request();
        $request->getRequestById($id_request);
        $request->setStatus($id_request, Request::STATUS_DELIVERY_RUN, Request::STATUS_DELIVERY_AFTER);
        //print_r($request);
        return $this->redirect('/delivery/default/my-request');
    }
}
