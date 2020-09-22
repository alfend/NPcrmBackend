<?php

namespace app\modules\mounting\controllers;

use Yii;
use yii\web\Controller;
use app\models\Response;
use app\models\Request;

/**
 * Default controller for the `metering` module
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

    public function actionNewRequest()
    {
        return $this->render('newRequest');
    }

    public function actionMyRequest()
    {
        return $this->render('myRequest');
    }

    public function actionMyResponse()
    {
        return $this->render('myResponse');
    }

    //создать отклик
    public function actionCreateResponse()
    {

        $id_request=Yii::$app->request->post('id_request', null);
        $id_workers=Yii::$app->request->post('id_workers', null);
        $type_workers=Yii::$app->request->post('type_workers', null);
        $date_workers=Yii::$app->request->post('date_workers', null);

        $response = new Response();
        $response -> createResponse($id_request, $id_workers, $type_workers,$date_workers);
        //print($id_request. $id_workers. $type_workers);
        return $this->redirect('/mounting/default/my-request');
    }

    //удалить отклик
    public function actionDeleteResponse()
    {

        $id_request=Yii::$app->request->post('id_request', null);
        $id_workers=Yii::$app->request->post('id_workers', null);
        $type_workers=Yii::$app->request->post('type_workers', null);
        $response = new Response();
        $response -> deleteResponse($id_request, $id_workers, $type_workers);
        return $this->redirect('/mounting/default/new-request');
    }


    //создать отклик
    public function actionCreateResponseMounting()
    {

        $id_request=Yii::$app->request->post('id_request', null);
        $id_workers=Yii::$app->request->post('id_workers', null);
        $type_workers=Yii::$app->request->post('type_workers', null);
        $date_workers=Yii::$app->request->post('date_workers', null);
        $price=Yii::$app->request->post('price', null);

        $response = new Response();
        $response -> createResponse($id_request, $id_workers, $type_workers, $date_workers, $price);
        //print($id_request.' '.$id_workers.' '.$type_workers.' '.$date_workers.' '.$price);
        return $this->redirect('/mounting/default/my-response');
    }

    //удалить отклик
    public function actionDeleteResponseMounting()
    {
        $id_request=Yii::$app->request->post('id_request', null);
        $id_workers=Yii::$app->request->post('id_workers', null);
        $type_workers=Yii::$app->request->post('type_workers', null);
        $response = new Response();
        $response -> deleteResponse($id_request, $id_workers, $type_workers);
        return $this->redirect('/mounting/default/new-request');
    }

    //выполнил
    public function actionMountingRun()
    {

        $id_request=Yii::$app->request->post('id_request', null);

        $request = new Request();
        $request -> setStatus($id_request, Request::STATUS_MOUNTING_RUN, Request::STATUS_MOUNTING_AFTER);
        return $this->redirect('/mounting/default/my-request');
    }

}
