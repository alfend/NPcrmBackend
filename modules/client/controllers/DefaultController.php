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
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $request_client = new Request();
        $request_client = $request_client->getRequestByClientAndStatus(Yii::$app->user->getId(), [
            Request::STATUS_CREATE,
            Request::STATUS_METERING_BEFORE,
            Request::STATUS_METERING_RUN,
            Request::STATUS_METERING_AFTER,
            Request::STATUS_COMPANY_BEFORE,
            Request::STATUS_COMPANY_RUN,
            Request::STATUS_COMPANY_AFTER,
            Request::STATUS_DELIVERY_BEFORE,
            Request::STATUS_DELIVERY_RUN,
            Request::STATUS_DELIVERY_AFTER,
            Request::STATUS_MOUNTING_BEFORE,
            Request::STATUS_MOUNTING_RUN,
            Request::STATUS_MOUNTING_AFTER,
            Request::STATUS_FINISH
        ]);

        return $this->render('index', ['request_client' => $request_client]);
    }

    //все замеры
    public function actionRequestMeteringAll()
    {
        $request_metering = new Request();
        $request_metering = $request_metering->getRequestByClientAndStatus(Yii::$app->user->getId(), [
            Request::STATUS_CREATE,
            Request::STATUS_METERING_BEFORE,
            Request::STATUS_METERING_RUN,
            Request::STATUS_METERING_AFTER,
            Request::STATUS_COMPANY_BEFORE,
            Request::STATUS_COMPANY_RUN,
            Request::STATUS_COMPANY_AFTER,
            Request::STATUS_DELIVERY_BEFORE,
            Request::STATUS_DELIVERY_RUN,
            Request::STATUS_DELIVERY_AFTER,
            Request::STATUS_MOUNTING_BEFORE,
            Request::STATUS_MOUNTING_RUN,
            Request::STATUS_MOUNTING_AFTER,
            Request::STATUS_FINISH

        ]);

        return $this->render('requestMeteringAll', ['request_metering' => $request_metering]);
    }


    public function actionRequestOrderAll()
    {
        $request_metering = new Request();
        $request_metering = $request_metering->getRequestByClientAndStatus(Yii::$app->user->getId(), [
            Request::STATUS_CREATE,
            Request::STATUS_METERING_BEFORE,
            Request::STATUS_METERING_RUN,
            Request::STATUS_METERING_AFTER,
            Request::STATUS_COMPANY_BEFORE,
            Request::STATUS_COMPANY_RUN,
            Request::STATUS_COMPANY_AFTER,
            Request::STATUS_DELIVERY_BEFORE,
            Request::STATUS_DELIVERY_RUN,
            Request::STATUS_DELIVERY_AFTER,
            Request::STATUS_MOUNTING_BEFORE,
            Request::STATUS_MOUNTING_RUN,
            Request::STATUS_MOUNTING_AFTER,
            Request::STATUS_FINISH

        ]);

        return $this->render('requestOrderAll', ['request_metering' => $request_metering]);
    }

    //вывод замера
    public function actionRequestMeteringId()
    {
        $this->layout = 'clientNoHeader';
        $id_request = Yii::$app->request->get('id_request');;
        $request_metering = new Request();
        $request_metering = $request_metering->getRequestById($id_request);
        $response = new Response();
        $count_workers = count($response->findWorkers($id_request, User::TYPE_METERING));
        $worker = User::findIdentity($request_metering['id_metering']);
        $data_metering=new DataMetering();
        $data_metering=$data_metering->cheсkDataMetering($id_request, $worker['id']);
        if($request_metering['id_client']==Yii::$app->user->getId()) {
           return $this->render('requestMeteringId', ['request_metering' => $request_metering,'count_workers'=>$count_workers,'worker'=>$worker,'data_metering'=>$data_metering]);
        }
    }

    //вывод заказа
    public function actionRequestOrderId()
    {



        $price = $city['price_metering']+$request['price_delivery'] + $request['price_mounting']*(1+$city['commission'])*(1+$city['coefficient']) + $request['price_company'];

        $this->layout = 'clientNoHeader';
        $id_request = Yii::$app->request->get('id_request');;
        $request = new Request();
        $request = $request->getRequestById($id_request);
        $city = new City();
        $city = $city->getCityById($request['id_city']);
        $response = new Response();
        $count_workers = count($response->findWorkers($id_request, User::TYPE_MOUNTING));
        $worker = User::findIdentity($request['id_metering']);
        $data_metering=new DataMetering();
        $data_metering=$data_metering->cheсkDataMetering($id_request, $worker['id']);

        $price = $city['price_metering']+$request['price_delivery'] + $request['price_mounting']*(1+$city['commission'])*(1+$city['coefficient']) + $request['price_company'];
        $prepayment=$price*$city['prepayment'];

        if($request['id_client']==Yii::$app->user->getId()) {
            return $this->render('requestOrderId', ['request' => $request,'count_workers'=>$count_workers,'worker'=>$worker,'data_metering'=>$data_metering,'price'=>$price, 'prepayment'=>$prepayment]);
        }
    }

    //выбор даты для нового замера
    public function actionRequestNewMeteringDate()
    {
        return $this->render('requestNewMeteringDate');
    }

    //Для нового замера доввести адрес
    public function actionRequestNewMeteringAddress()
    {
        $model = new Request();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->address = $model->address_client_street . ', ' . $model->address_client_house . ', ' . $model->address_client_room;
            $model->save();
            return $this->redirect(['/client/default/request-metering-all']);
        }
        return $this->render('requestNewMeteringAddress', ['model' => $model]);

    }


    //список откликнвшихся
    public function actionSelectMetering()
    {
        //параметры из пост
        $id_request = Yii::$app->request->post('id_request', null);;
        $type_workers = Yii::$app->request->post('type_workers', null);;
        $response = new Response();
        $workers = $response->findWorkers($id_request, $type_workers);
       // var_dump(Yii::$app->request->post());
        return $this->render('viewSelectMetering', ['workers' => $workers, 'id_request' => $id_request]);
    }

    //список откликнвшихся
    public function actionInsertMetering()
    {
        //параметры из пост

        $id_request = Yii::$app->request->post('id_request', null);;
        $id_workers = Yii::$app->request->post('id_workers', null);;
        $date_workers = Yii::$app->request->post('date_workers', null);;

        $request = new Request();
        $request->getRequestById($id_request);

        $request->setInsertMetering($id_request, $id_workers, $date_workers);
        $request->setStatus($id_request, Request::STATUS_METERING_BEFORE, Request::STATUS_METERING_RUN);

        return $this->redirect('/client/default/request-metering-all');
    }

    public function actionSelectCompany()
    {
        //параметры из пост
        $id_request = Yii::$app->request->post('id_request', null);;
        $type_workers = Yii::$app->request->post('type_workers', null);;
        $response = new Response();
        $workers = $response->findWorkers($id_request, $type_workers);
        return $this->render('viewSelectCompany', ['workers' => $workers]);
    }

    //список откликнвшихся
    public function actionInsertCompany()
    {
        //параметры из пост
        $id_request = Yii::$app->request->post('id_request', null);;
        $id_workers = Yii::$app->request->post('id_workers', null);;
        $price = Yii::$app->request->post('price', null);;

        $request = new Request();
        $request->getRequestById($id_request);
        $request->setInsertCompany($id_request, $id_workers, $price);
        $request->setStatus($id_request, Request::STATUS_COMPANY_BEFORE, Request::STATUS_COMPANY_RUN);
        return $this->redirect('/client/request/index');
    }

    // Подтвердить заявку что доставил
    public function actionMountingBefore()
    {
        //параметры из пост
        $id_request = Yii::$app->request->post('id_request', null);;

        $request = new Request();
        $request->getRequestById($id_request);
        $request->setStatus($id_request, Request::STATUS_DELIVERY_AFTER, Request::STATUS_MOUNTING_BEFORE);
        //print_r($request);
        return $this->redirect('/client/request/index');
    }

    public function actionMountingAfter()
    {
        //параметры из пост
        $id_request = Yii::$app->request->post('id_request', null);;

        $request = new Request();
        $request->getRequestById($id_request);
        $request->setStatus($id_request, Request::STATUS_MOUNTING_AFTER, Request::STATUS_FINISH);
        //print_r($request);
        return $this->redirect('/client/request/index');
    }


    public function actionSelectMounting()
    {
        //параметры из пост
        $id_request = Yii::$app->request->post('id_request', null);;
        $type_workers = Yii::$app->request->post('type_workers', null);;
        $response = new Response();
        $workers = $response->findWorkers($id_request, $type_workers);
        return $this->render('viewSelectMounting', ['workers' => $workers]);
    }

    public function actionInsertMounting()
    {
        //параметры из пост
        $id_request = Yii::$app->request->post('id_request', null);;
        $id_workers = Yii::$app->request->post('id_workers', null);;
        $price = Yii::$app->request->post('price', null);;

        $request = new Request();
        $request->getRequestById($id_request);
        $request->setInsertMounting($id_request, $id_workers, $price);
        $request->setStatus($id_request, Request::STATUS_MOUNTING_BEFORE, Request::STATUS_MOUNTING_RUN);
        return $this->redirect('/client/request/index');
    }
}
