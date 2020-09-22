<?php

namespace app\controllers;

use app\models\Balance;
use app\models\Debit;
use app\models\Credit;
use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\Request;
use app\models\Response;
use app\models\DataMetering;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\City;
use app\models\LoginForm;
use app\models\Verify;
use app\models\Requisites;


/**
 * Default controller for the `client` module
 */
class RestController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    // ДОБАВИТЬ ВЕЗДЕ \yii\helpers\Html::encode($username)

    //получить id пользователя
    //http://np.im56.ru/rest/get-user-id
    public function actionGetUserId()
    {
        $this->layout = '';
        $id = User::findUserByToken(Yii::$app->request->post('auth_key'));//User::findUserByToken(Yii::$app->request->post('auth_key'));
        return $this->asJson($id);
    }

    //получить id пользователя
    //http://np.im56.ru/rest/get-city-name
    public function actionGetCityName()
    {
        $this->layout = '';
        $user = User::findIdentity(User::findUserByToken(Yii::$app->request->post('auth_key')));//Yii::$app->user->identity
        $city = new City();


        return $this->asJson($city->getCityNameById($user['id_city']));
    }

    //получить роль пользователя
    //http://np.im56.ru/rest/get-role-user
    public function actionGetRoleUser()
    {
        $this->layout = '';
        $id = User::getRole(User::findUserByToken(Yii::$app->request->post('auth_key')));
        return $this->asJson($id);
    }

    //зарегистрировать пользователя post(email,tel,password,lastname,firstname,id_city,user_type)
    //http://np.im56.ru/rest/create-user
    public function actionCreateUser()
    {

        $this->layout = '';

        $user = new User();
        $user->email = Yii::$app->request->post('email');
        $user->setPassword(Yii::$app->request->post('password'));
        $user->generateAuthKey();
        $user->tel = Yii::$app->request->post('tel');
        $user->lastname = Yii::$app->request->post('lastname');
        $user->firstname = Yii::$app->request->post('firstname');
        $user->secondname = '';
        $user->id_city = Yii::$app->request->post('id_city');
        $user->status = User::STATUS_ACTIVE;
        $user->type = Yii::$app->request->post('user_type');
        if ($user->save()) {

            $model = new LoginForm();
            $model->tel = Yii::$app->request->post('tel');
            $model->password = Yii::$app->request->post('password');
            $model->login();

            return $this->asJson($user);
        } else {
            return $this->asJson(null);
        }
    }

    //войти
    //http://np.im56.ru/rest/login
    public function actionLogin()
    {
        $this->layout = '';

        $model = new LoginForm();

        $model->tel = Yii::$app->request->post('tel');
        $model->password = Yii::$app->request->post('password');


        if ($model->validate()){

            $user = User::findByTel($model->tel);


            return $this->asJson($user->auth_key);

        } else {
            return $this->asJson(null);
        }
        /*

        if ($model->login()) {
            return $this->asJson(User::findIdentity(User::findUserByToken(Yii::$app->request->post('auth_key'))));
        } else {
            return $this->asJson(null);
        }
        */
    }




    //получить все данные по пользователю по id пользователя post(id)
    //http://np.im56.ru/rest/get-user-by-id?id=1
    public function actionGetUserById()
    {
        $this->layout = '';
        //$id = User::findUserByToken(Yii::$app->request->post('auth_key'));
        $id = Yii::$app->request->get('id');
        $user = User::findIdentity($id);//Yii::$app->user->identity
        return $this->asJson($user);
    }

    //изменить все данные по пользователю по id пользователя post(email,lastname,firstname,birthday,tel,password)
    //http://np.im56.ru/rest/set-user
    public function actionSetUser()
    {
        $this->layout = '';
        $id = User::findUserByToken(Yii::$app->request->post('auth_key'));//Yii::$app->request->post('id');
        $email = Yii::$app->request->post('email');
        $lastname =  Yii::$app->request->post('lastname');
        $firstname = Yii::$app->request->post('firstname');
        $birthday = Yii::$app->request->post('birthday');
        $tel = Yii::$app->request->post('tel');
        $password = Yii::$app->request->post('password');
        $sys_notice = Yii::$app->request->post('sys_notice');
        $news_notice = Yii::$app->request->post('news_notice');


        $user=new User();
        return $this->asJson($user->setUser($id,$email,$lastname,$firstname,$birthday,$tel,$password,$sys_notice, $news_notice));
    }

    //активность количество откликов от пользователя 35  разделить / на количество заказов (85) умножить * 100% = активность
    //http://np.im56.ru/rest/get-activeness type_workers=4 TYPE_MOUNTING
    public function actionGetActiveness()
    {
        $this->layout = '';
        $id_user = User::findUserByToken(Yii::$app->request->post('auth_key'));
        $type_workers = Yii::$app->request->post('type_workers');;

        $status_request = [Request::STATUS_METERING_AFTER,
            Request::STATUS_COMPANY_BEFORE,Request::STATUS_COMPANY_RUN,Request::STATUS_COMPANY_AFTER,
            Request::STATUS_DELIVERY_BEFORE,Request::STATUS_DELIVERY_RUN,Request::STATUS_DELIVERY_AFTER,
            Request::STATUS_MOUNTING_BEFORE,Request::STATUS_MOUNTING_RUN,Request::STATUS_MOUNTING_AFTER,
            Request::STATUS_FINISH
        ];//  Yii::$app->request->post('status_request');;
        $status_response= [0,1];
        $request=new Request();
        $response=new Response();
        $count_request = count($request -> getRequestByStatus(User::findIdentity($id_user)['id_city'], $status_request));
        $count_response = count($response -> findResponseByWorkers($id_user, $type_workers,$status_response));

        if($count_request==0) {
            $count_request = 1;
        };

        return $this->asJson(round($count_response/$count_request*100));
    }

    //конверсия количество выполненных заказов(32) разделить / на количество откликов (58) умножить * на 100%
    //http://np.im56.ru/rest/get-conversion type_workers=4 TYPE_MOUNTING
    public function actionGetConversion()
    {
        $this->layout = '';
        $id_user = User::findUserByToken(Yii::$app->request->post('auth_key'));
        $type_workers = 4;//Yii::$app->request->post('type_workers');;
        //если заказ выполнен посностью, возможно будет выполнение только стадии?
        $status_request = [Request::STATUS_FINISH];//  Yii::$app->request->post('status_request');;
        $status_response= [0,1];
        $request=new Request();
        $response=new Response();
        $count_request=0;
        $request_finish = $request -> getRequestByStatus(User::findIdentity($id_user)['id_city'], $status_request);

        //$id_user ли был назначен работником в заказе
        foreach ($request_finish as $request) {

            if ($type_workers == User::TYPE_METERING and $request['id_metering'] == $id_user) {
                $count_request++;
            };
            if ($type_workers == User::TYPE_DELIVERY and $request['id_delivery'] == $id_user) {
                $count_request++;
            };
            if ($type_workers == User::TYPE_MOUNTING and $request['id_mounting'] == $id_user) {
                $count_request++;
            };
            if ($type_workers == User::TYPE_COMPANY and $request['id_company'] == $id_user) {
                $count_request++;
            };
        }

        $count_response = count($response -> findResponseByWorkers($id_user, $type_workers,$status_response));

        if($count_response==0) {
            $count_response = 1;
        };

        return $this->asJson(round($count_request/$count_response*100));
    }


    //все замеры и заказы для клиента  по статусу post(status_request)
    public function actionGetRequestByClientAndStatus()
    {
        $this->layout = '';
        $id_client = User::findUserByToken(Yii::$app->request->post('auth_key'));
        $status_request = Request::STATUS_METERING_BEFORE;// Yii::$app->request->post('status_request');;
        $request=new Request();
        $request = $request -> getRequestByClientAndStatus($id_client, $status_request);
        return $this->asJson(   $request);
    }

    //все доступные для замер для замерщика post() get-request-for-worker-metering
    public function actionGetRequestForWorkerMetering()
    {
        $this->layout = '';
        $user = User::findIdentity(User::findUserByToken(Yii::$app->request->post('auth_key')));//Yii::$app->user->identity
        $status_request = [
            Request::STATUS_METERING_BEFORE,
            Request::STATUS_METERING_RUN,
            Request::STATUS_METERING_AFTER
        ];
        //все запросы
        $request = new Request();
        $requestAll = $request->getRequestForWorkerMetering($user['id_city'], $status_request);
        //убрать на которые есть активный отклик
        $response = new response();
        foreach ($requestAll as $key => $request) {
            if ($response->cheсkResponse($request['id'], $user['id'], User::TYPE_METERING)) {
                unset($requestAll[$key]);

            }
        }
        return $this->asJson($requestAll);
    }

    //все доступные для доставки post() get-request-for-worker-delivery
    public function actionGetRequestForWorkerDelivery()
    {
        $this->layout = '';
        $user = User::findIdentity(User::findUserByToken(Yii::$app->request->post('auth_key')));//Yii::$app->user->identity
        $status_request = [
            Request::STATUS_COMPANY_BEFORE,
            Request::STATUS_COMPANY_RUN,
            Request::STATUS_COMPANY_AFTER,
            Request::STATUS_DELIVERY_BEFORE,
            Request::STATUS_DELIVERY_RUN
        ];

        $request = new Request();
        $requestAll = $request->getRequestForWorkerDelivery($user['id_city'], $status_request);

        return $this->asJson($requestAll);
    }

    //все доступные для изготовления для монтажника post() get-request-for-worker-company
    public function actionGetRequestForWorkerCompany()
    {
        $this->layout = '';
        $user = User::findIdentity(User::findUserByToken(Yii::$app->request->post('auth_key')));//Yii::$app->user->identity
        $status_request = [
            Request::STATUS_METERING_AFTER,
            Request::STATUS_COMPANY_BEFORE,
            Request::STATUS_COMPANY_RUN,
            Request::STATUS_COMPANY_AFTER
        ];
        //все запросы
        $request = new Request();
        $requestAll = $request->getRequestForWorkerCompany($user['id_city'], $status_request);
        //убрать на которые есть активный отклик
        $response = new response();

        foreach ($requestAll as $key => $request) {
            if ($response->cheсkResponse($request['id'], $user['id'], User::TYPE_COMPANY)) {
                unset($requestAll[$key]);

            }
        }
        return $this->asJson($requestAll);
    }

    //все доступные для монтаж для монтажника post() get-request-for-worker-mounting
    public function actionGetRequestForWorkerMounting()
    {
        $this->layout = '';
        $user = User::findIdentity(User::findUserByToken(Yii::$app->request->post('auth_key')));//Yii::$app->user->identity
        $status_request = [
            Request::STATUS_METERING_AFTER,
            Request::STATUS_COMPANY_BEFORE,
            Request::STATUS_COMPANY_RUN,
            Request::STATUS_COMPANY_AFTER,
            Request::STATUS_DELIVERY_BEFORE,
            Request::STATUS_DELIVERY_RUN,
            Request::STATUS_DELIVERY_AFTER,
            Request::STATUS_MOUNTING_BEFORE,
            Request::STATUS_MOUNTING_RUN,
            Request::STATUS_MOUNTING_AFTER
        ];
        //все запросы
        $request = new Request();
        $requestAll = $request->getRequestForWorkerMounting($user['id_city'], $status_request);
        //убрать на которые есть активный отклик
        $response = new response();
        foreach ($requestAll as $key => $request) {
            if ($response->cheсkResponse($request['id'], $user['id'], User::TYPE_MOUNTING)) {
                unset($requestAll[$key]);

            }
        }
        return $this->asJson($requestAll);
    }

    //все заказы на замер для замерщика по статусу post(status_request)
    public function actionGetRequestByWorkerAndStatusMetering()
    {
        $this->layout = '';
        $id_worker = User::findUserByToken(Yii::$app->request->post('auth_key'));
        $status_request = Yii::$app->request->post('status_request'); //['1','4']
        $request=new Request();
        $request = $request -> getRequestByWorkerAndStatusMetering($id_worker, $status_request);
        return $this->asJson($request);
    }

    //все заказы на доставку для курьера по статусу post(status_request)
    public function actionGetRequestByWorkerAndStatusDelivery()
    {
        $this->layout = '';
        $id_worker = User::findUserByToken(Yii::$app->request->post('auth_key'));
        $status_request = Yii::$app->request->post('status_request');
        $request=new Request();
        $request = $request -> getRequestByWorkerAndStatusDelivery($id_worker, $status_request);
        return $this->asJson($request);
    }

    //все заказы на изготовление для производителя по статусу post(status_request)
    public function actionGetRequestByWorkerAndStatusCompany()
    {
        $this->layout = '';
        $id_worker = User::findUserByToken(Yii::$app->request->post('auth_key'));
        $status_request = Yii::$app->request->post('status_request');
        $request=new Request();
        $request = $request -> getRequestByWorkerAndStatusCompany($id_worker, $status_request);
        return $this->asJson($request);
    }

    //все заказы на монтаж для монтажника по статусу post(status_request)
    public function actionGetRequestByWorkerAndStatusMounting()
    {
        $this->layout = '';
        $id_worker = User::findUserByToken(Yii::$app->request->post('auth_key'));
        $status_request = Yii::$app->request->post('status_request');
        $request=new Request();
        $request = $request -> getRequestByWorkerAndStatusMounting($id_worker, $status_request);
        return $this->asJson($request);
    }

    //все заказы по статусу post(status_request)
    public function actionGetRequestByStatus()
    {
        $this->layout = '';
        $id_city = User::findIdentity(User::findUserByToken(Yii::$app->request->post('auth_key')))['id_city'];
        $status_request = Yii::$app->request->post('status_request');
        $request=new Request();
        $request = $request -> getRequestByStatus($id_city, $status_request);
        return $this->asJson($request);
    }


    //все заказы по статусу и типу post(status_request)
    public function actionGetRequestByStatusType()
    {
        $this->layout = '';
        $id_city = User::findIdentity(User::findUserByToken(Yii::$app->request->post('auth_key')))['id_city'];
        $status_request = Yii::$app->request->post('status_request');
        $type = Yii::$app->request->post('type');
        $request=new Request();
        $request = $request -> getRequestByStatusType($id_city, $status_request,$type);
        return $this->asJson($request);
    }


    //заказ по ИД get(id_request)
    //http://np.im56.ru/rest/get-request-by-id?id_request=2
    public function actionGetRequestById()
    {
        $this->layout = '';
        $id_request = Yii::$app->request->get('id_request');
        $request=new Request();
        $request = $request -> getRequestById($id_request);
        return $this->asJson($request);
    }

    //установить замерщика для заказа по ид, post(id_request,date_metering,id_worker) вернет true если записал
    public function actionSetInsertMetering()
    {
        $this->layout = '';
        $id_request = Yii::$app->request->post('id_request');
        $id_user = Yii::$app->request->post('id_worker');
        $date_metering = Yii::$app->request->post('date_metering');
        $request=new Request();

        return $this->asJson($request -> setInsertMetering($id_request, $id_user, $date_metering));
    }

    //установить изготовителя для заказа по ид, post(id_request,price,id_worker) вернет true если записал
    public function actionSetInsertCompany()
    {
        $this->layout = '';
        $id_request = Yii::$app->request->post('id_request');
        $id_user = Yii::$app->request->post('id_worker');
        $price = Yii::$app->request->post('price');
        $request=new Request();
        return $this->asJson($request -> setInsertCompany($id_request, $id_user, $price));
    }

    //установить доставщика для заказа по ид, post(id_request,id_worker) вернет true если записал
    public function actionSetInsertDelivery()
    {


        $this->layout = '';
        $id_request = Yii::$app->request->post('id_request');
        $id_user = Yii::$app->request->post('id_worker');
        $request=new Request();
        $request -> getRequestById($id_request);
        return $this->asJson($request -> setInsertDelivery($id_request, $id_user));
    }

    //установить монтажника для заказа по ид, post(id_request,price,date_mounting,id_worker) вернет true если записал
    //http://np.im56.ru/rest/set-insert-mounting
    public function actionSetInsertMounting()
    {
        $this->layout = '';
        $id_request = Yii::$app->request->post('id_request');
        $id_user = Yii::$app->request->post('id_worker');
        $price = Yii::$app->request->post('price');
        $date_mounting = Yii::$app->request->post('date_mounting');
        $request=new Request();

        return $this->asJson($request -> setInsertMounting($id_request, $id_user,$price,$date_mounting));
    }

    //получить процент выолнения по ИД post(id_request)
    //http://np.im56.ru/rest/get-request-status-percent
    public function actionGetRequestStatusPercent()
    {
        $this->layout = '';
        $id_request = Yii::$app->request->post('id_request');
        $request=new Request();
        $request = $request -> getRequestById($id_request);
        $procent=0;

        switch ($request['status_request']){
            case Request::STATUS_METERING_BEFORE:
            case Request::STATUS_METERING_RUN:
            case Request::STATUS_METERING_AFTER:
                $procent=25;
                break;
            case Request::STATUS_COMPANY_BEFORE:
            case Request::STATUS_COMPANY_RUN:
            case Request::STATUS_COMPANY_AFTER:
            case Request::STATUS_DELIVERY_BEFORE:
            case Request::STATUS_DELIVERY_RUN:
            case Request::STATUS_DELIVERY_AFTER:

                $procent=50;
                break;
            case Request::STATUS_MOUNTING_BEFORE:
            case Request::STATUS_MOUNTING_RUN:
            case Request::STATUS_MOUNTING_AFTER:
                $procent=75;
                break;
            case Request::STATUS_FINISH:
                $procent=100;
                break;
        }


        return $this->asJson($procent);
    }

    //установить статус для заказа по ид, post(id_request, status_old,status_new) вернет true если записал
    public function actionSetStatus()
    {
        $this->layout = '';
        $id_request = Yii::$app->request->post('id_request');
        $status_old = Yii::$app->request->post('status_old');
        $status_new = Yii::$app->request->post('status_new');
        $request=new Request();

        return $this->asJson($request -> setStatus($id_request, $status_old,$status_new));
    }

    //проверка отклика  ChekResponse post(id_request,type_workers) вернет $response если нашел
    public function actionChekResponse()
    {
        $this->layout = '';
        $id_request = Yii::$app->request->post('id_request');;
        $id_workers = User::findUserByToken(Yii::$app->request->post('auth_key'));
        $type_workers = Yii::$app->request->post('type_workers');;
        $response = new response();
        return $this->asJson($response -> cheсkResponse($id_request, $id_workers, $type_workers));
    }

    //поиск откликов post(type_workers,status)  response-all-by-status-and-worker
    public function actionResponseAllByStatusAndWorker()
    {
        $this->layout = '';
        $worker = User::findUserByToken(Yii::$app->request->post('auth_key'));
        $type_workers = Yii::$app->request->post('type_workers');;
        $status= Yii::$app->request->post('status');
        $response = new response();
        return $this->asJson($response -> findResponseAllByStatusAndWorker($worker,$type_workers,$status));
    }


    //все отклики для заказа по ид, post(id_request,type_workers) вернет $response если нашел
    public function actionGetResponseByRequest()
    {
        $this->layout = '';
        $id_request = Yii::$app->request->post('id_request');;
        $type_workers = Yii::$app->request->post('type_workers');;
        $response = new response();
        return $this->asJson($response ->findResponseByRequest($id_request, $type_workers));
    }

    //список откликнувшихся для заказа по ид, post(id_request,type_workers) вернет $response если нашел
    public function actionGetWorkersByRequest()
    {
        $this->layout = '';
        $id_request = Yii::$app->request->post('id_request');;
        $type_workers = Yii::$app->request->post('type_workers');;
        $response = new response();
        return $this->asJson($response ->findWorkers($id_request, $type_workers));
    }

    //список откликнувшихся для заказа по ид, post(id_request,type_workers) вернет $response если нашел
    public function actionGetWorkersByRequestMin()
    {
        $this->layout = '';
        $id_request = Yii::$app->request->post('id_request');;
        $type_workers = Yii::$app->request->post('type_workers');;
        $response = new response();
        return $this->asJson($response->findWorkersMin($id_request, $type_workers));
    }


    //создать отклик по ид, post(id_request,type_workers,date_workers,price) вернет $response если нашел
    public function actionCreateResponse()
    {
        $this->layout = '';
        $id_request = Yii::$app->request->post('id_request');
        $id_workers = User::findUserByToken(Yii::$app->request->post('auth_key'));
        $type_workers = Yii::$app->request->post('type_workers');
        $date_workers = Yii::$app->request->post('date_workers');
        $price = Yii::$app->request->post('price');
        $response = new response();

        //print_r($response->createResponse($id_request, $id_workers, $type_workers, $date_workers, $price));
        return $this->asJson($response->createResponse($id_request, $id_workers, $type_workers, $date_workers, $price));
    }

    //изменить отклик по ид, post(id_request,type_workers,date_workers,price) вернет $response если нашел
    public function actionUpdateResponse()
    {
        $this->layout = '';
        $id_request = Yii::$app->request->post('id_request');
        $id_workers = User::findUserByToken(Yii::$app->request->post('auth_key'));
        $type_workers = Yii::$app->request->post('type_workers');
        $date_workers = Yii::$app->request->post('date_workers');
        $price = Yii::$app->request->post('price');
        $response = new response();

        return $this->asJson($response->updateResponse($id_request, $id_workers, $type_workers, $date_workers, $price));
    }


    //добавить новый замер post(date_metering_plan,date_metering_plan,address_client_house,address_client_room)
    public function actionAddRequestNewMetering()
    {


        $model = new Request();
        $model->id_client=User::findUserByToken(Yii::$app->request->post('auth_key'));
        $date=new \DateTime('now', new \DateTimeZone('Europe/Moscow'));
        $model->date_create=$date->format('Y-m-d H:i:s');
        $model->id_city = User::findIdentity(User::findUserByToken(Yii::$app->request->post('auth_key')))['id_city'];
        $model->status_request = Request::STATUS_METERING_BEFORE;
        $model->date_metering_plan = Yii::$app->request->post('date_metering_plan');
        $model->address_client_street = Yii::$app->request->post('address_client_street');
        $model->address_client_house = Yii::$app->request->post('address_client_house');
        $model->address_client_room = Yii::$app->request->post('address_client_room');

        // print_r(Yii::$app->request->post());

        $model->address = $model->address_client_street . ', ' . $model->address_client_house . ', ' . $model->address_client_room;
        $model->status_request = Request::STATUS_METERING_BEFORE;

        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

    //данные по замеру post($id_request,  $id_workers,$count_ceiling,$area,$perimeter,$spot,$luster,$curtain,$cut_pipe)
    public function actionCreateDataMetering()
    {
        $id_request = Yii::$app->request->post('id_request');
        $id_workers = Yii::$app->request->post('id_workers');
        $count_ceiling = Yii::$app->request->post('count_ceiling');
        $area = Yii::$app->request->post('area');
        $perimeter = Yii::$app->request->post('perimeter');
        $spot = Yii::$app->request->post('spot');
        $luster = Yii::$app->request->post('luster');
        $curtain = Yii::$app->request->post('curtain');
        $cut_pipe = Yii::$app->request->post('cut_pipe');
        $data_metering=new DataMetering();
        $data_metering=$data_metering->createDataMetering($id_request,  $id_workers,$count_ceiling,$area,$perimeter,$spot,$luster,$curtain,$cut_pipe);
        return $this->asJson($data_metering);
    }


    //данные по замеру post($id_request,  $id_workers,$count_ceiling,$area,$perimeter,$spot,$luster,$curtain,$cut_pipe)
    public function actionUpdateDataMetering()
    {
        $id_request = Yii::$app->request->post('id_request');
        $id_workers = Yii::$app->request->post('id_workers');
        $count_ceiling = Yii::$app->request->post('count_ceiling');
        $area = Yii::$app->request->post('area');
        $perimeter = Yii::$app->request->post('perimeter');
        $spot = Yii::$app->request->post('spot');
        $luster = Yii::$app->request->post('luster');
        $curtain = Yii::$app->request->post('curtain');
        $cut_pipe = Yii::$app->request->post('cut_pipe');
        $data_metering=new DataMetering();
        $data_metering=$data_metering->updateDataMetering($id_request,  $id_workers,$count_ceiling,$area,$perimeter,$spot,$luster,$curtain,$cut_pipe);
        return $this->asJson($data_metering);
    }

    //данные по замеру post(id_request, id_workers)
    public function actionGetDataMeteringById()
    {
        $id_request = Yii::$app->request->post('id_request');
        $id_workers = Yii::$app->request->post('id_workers');

        $data_metering=new DataMetering();
        $data_metering=$data_metering->cheсkDataMetering($id_request,  $id_workers);


        return $this->asJson($data_metering);
    }

    //проверка для оформление заказа post(id_request)
    public function actionCheckRequestRun()
    {
        $id_request = Yii::$app->request->post('id_request');
        $request = new Request();
        $strCheck = $request->checkRequestRun($id_request);
        return $this->asJson([$strCheck]);
    }

    //оформление заказа post(id_request)
    public function actionRequestRun()
    {
        $id_request = Yii::$app->request->post('id_request');
        $request = new Request();
        if($request->checkRequestRun($id_request)==''){
            return $this->asJson($request->RequestRun($id_request));
        }
        return $this->asJson(false);
    }

    //стоимость заказа post(id_request)
    public function actionGetRequestPriceById()
    {
        $id_request = Yii::$app->request->post('id_request');
        $request = new Request();
        return $this->asJson($request->getRequestPrice($id_request));
    }

    //стоимость аванса post(id_request)
    public function actionGetRequestPrepaymentById()
    {
        $id_request = Yii::$app->request->post('id_request');

        $request = new Request();
        return $this->asJson($request->getRequestPrepayment($id_request));
    }

    //все параметры филиала-города post(id_city)
    public function actionGetCityById()
    {
        $id_city = Yii::$app->request->post('id_city');

        $city = new City();
        $city = $city->getCityById($id_city);

        return $this->asJson($city);
    }


    //получение подтверждания по id post(id)
    public function actionGetVerifyById()
    {
        $id = Yii::$app->request->post('id');
        $verify=new Verify();
        $verify=$verify->getVerifyById($id);
        return $this->asJson($verify);

    }

    //получение подтвержданий по id post(id_request)
    public function actionGetVerifyByIdRequest()
    {
        $id_request = Yii::$app->request->post('id_request');
        $verify=new Verify();
        $verify=$verify->getVerifyByIdRequest($id_request);
        return $this->asJson($verify);

    }

    //получение подтвержданий назначенных пользователю post()
    public function actionGetVerifyByIdTo()
    {
        $id_user = User::findUserByToken(Yii::$app->request->post('auth_key'));
        $verify=new Verify();
        $verify=$verify->getVerifyByIdTo($id_user);
        return $this->asJson($verify);

    }

    //создание уведомления по id post($text,$id_to_user)
    public function actionCreateMessage()
    {
        $text = Yii::$app->request->post('text');
        $id_to_user = Yii::$app->request->post('id_to_user');
        $id_from_user = null;
        $message=new Message();
        return $this->asJson($message->createMessage($text, $id_from_user, $id_to_user));

    }

    //получение уведомлений для пользователя
    public function actionGetMessageForUser()
    {
        $id_user = User::findUserByToken(Yii::$app->request->post('auth_key'));
        $message=new Message();
        return $this->asJson($message->getMessageForUser($id_user));

    }

    //уведомление прочитано
    public function actionSetMessageRead()
    {
        $id_message = Yii::$app->request->post('id_message');
        $message=new Message();
        return $this->asJson($message->setMessageRead($id_message));

    }

    //создание подтверждания по id post(id_request,id_to_user, id_from_user)
    public function actionCreateVerify()
    {
        $id_request = Yii::$app->request->post('id_request');
        $id_to_user = Yii::$app->request->post('id_to_user');
        $id_from_user = Yii::$app->request->post('id_from_user');
        $text = Yii::$app->request->post('text');
        $verify=new Verify();
        return $this->asJson($verify->createVerify($id_request,$id_to_user, $id_from_user,$text));

    }

    //установка  подтверждания yes по id post(id_request,id_to_user, id_from_user)
    public function actionSetVerifyYes()
    {
        $id_request = Yii::$app->request->post('id_request');
        $id_to_user = Yii::$app->request->post('id_to_user');
        $id_from_user = Yii::$app->request->post('id_from_user');
        $verify=new Verify();
        $verify=$verify->setVerifyYes($id_request,$id_to_user, $id_from_user);
        return $this->asJson($verify);

    }

    //отмена подтверждания no по id post(id_request,id_to_user, id_from_user)
    public function actionSetVerifyNo()
    {
        $id_request = Yii::$app->request->post('id_request');
        $id_to_user = Yii::$app->request->post('id_to_user');
        $id_from_user = Yii::$app->request->post('id_from_user');
        $verify=new Verify();
        $verify=$verify->setVerifyNo($id_request,$id_to_user, $id_from_user);
        return $this->asJson($verify);

    }

    //получение подтвержданий назначенных пользователю post(id_user)
    public function actionRequisitesByUserId()
    {
        $id_user = Yii::$app->request->post('id_user');
        $requisites=new Requisites();

        return $this->asJson($requisites->getRequisitesByUserId($id_user));

    }

    //изменить реквезиты пользователя post($company,$inn,$kpp,$bank_name,$bank_bik,$account_calc,$account_cor,$address_company,$director)
    //http://np.im56.ru/rest/set-requisites
    public function actionSetRequisites()
    {
        $this->layout = '';
        $id_user = User::findUserByToken(Yii::$app->request->post('auth_key'));;//Yii::$app->request->post('id_user');
        $company = Yii::$app->request->post('company');
        $inn = Yii::$app->request->post('inn');
        $kpp = Yii::$app->request->post('kpp');
        $bank_name = Yii::$app->request->post('bank_name');
        $bank_bik = Yii::$app->request->post('bank_bik');
        $account_calc = Yii::$app->request->post('account_calc');
        $account_cor = Yii::$app->request->post('account_cor');
        $address_company = Yii::$app->request->post('address_company');
        $director = Yii::$app->request->post('director');

        return $this->asJson(Requisites::setRequisites($id_user,$company,$inn,$kpp,$bank_name,$bank_bik,$account_calc,$account_cor,$address_company,$director));
    }

    //получить компанию по инн
    //http://np.im56.ru/rest/get-company-dadata
    public function actionGetCompanyDadata()
    {
        $this->layout = '';
        $inn = Yii::$app->request->get('inn');

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/party');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{ \"query\": \"$inn\" }");

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: _ENV["Token 3f4dca33d5046584ca2e5fb89c65f33d0aec43fe"]';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $this->asJson($result);

    }

    //получить компанию по kpp
    //http://np.im56.ru/rest/get-bank-dadata?bic=044525225
    public function actionGetBankDadata()
    {
        $this->layout = '';
        $bic = Yii::$app->request->get('bic');

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/bank');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{ \"query\": \"$bic\" }");

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: _ENV["Token 3f4dca33d5046584ca2e5fb89c65f33d0aec43fe"]';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $this->asJson($result);

    }

    //доставка по гугл картам
    public function actionGetDeliveryPrice()
    {

        $this->layout = '';

        $id_request = Yii::$app->request->post('id_request');
        $request=new Request();
        $request = $request -> getRequestById($id_request);

        $company = User::findIdentity($request['id_company']);

        $from = $company['address'];
        $to = $request['address'];

        $from = urlencode($from);
        $to = urlencode($to);

        $data = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?key=AIzaSyDfkmms4L0P9EKZnmDdesNkArqGORwbDew&origins=$from&destinations=$to&language=ru-RU&sensor=false");
        //AIzaSyDfkmms4L0P9EKZnmDdesNkArqGORwbDew
        $data = json_decode($data);
        /*        echo "Откуда: ".$data->destination_addresses[0] . "<br/>" .
                    "Куда: ". $data->origin_addresses[0] . "<br/>" .
                    "Время: ". $data->rows[0]->elements[0]->distance->text . "<br/>" .
                    "Путь: ".$data->rows[0]->elements[0]->duration->text;
                */
        print_r($data);
    }

    //получить компанию по kpp
    //http://np.im56.ru/rest/get-delivery-puth
    public function actionGetDeliveryPuth()
    {
        $this->layout = '';
        $id_request = 1;//Yii::$app->request->post('id_request');
        $request=new Request();
        $request = $request -> getRequestById($id_request);

        $company = User::findIdentity($request['id_company']);

        print(City::getCityNameById($request['id_city']).','.$company['address']."</br>");
        print(City::getCityNameById($request['id_city']).','.$request['address']."</br>");
        ?>
        <script src="https://api-maps.yandex.ru/2.1/?apikey=c428abb7-ad0d-41cf-84cd-59f900d74c5b&lang=ru_RU" type="text/javascript">
        </script>

        <div id="map" style="width: 100%; height: 300px;"></div>
        <div id="puth"> </div>
        <!-- Прокладка маршрута -->
        <script type="text/javascript">
            ymaps.ready(init);

            function init () {
                /**
                 * Создаем мультимаршрут.
                 * Первым аргументом передаем модель либо объект описания модели.
                 * Вторым аргументом передаем опции отображения мультимаршрута.
                 * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/multiRouter.MultiRoute.xml
                 * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/multiRouter.MultiRouteModel.xml
                 */

                var multiRoute = new ymaps.multiRouter.MultiRoute({
                    // Описание опорных точек мультимаршрута.
                    referencePoints: [
                        "<?= City::getCityNameById($request['id_city']).','.$company['address'] ?>",

                        "<?= City::getCityNameById($request['id_city']).','.$request['address'] ?>"
                        <?php
                        /*<?=  City::getCityNameById($request['id_city']).', '.$array_request['address'] ?>*/
                        ?>

                    ],
                    // Параметры маршрутизации.
                    params: {
                        // Ограничение на максимальное количество маршрутов, возвращаемое маршрутизатором.
                        results: 2
                    }
                }, {
                    // Автоматически устанавливать границы карты так, чтобы маршрут был виден целиком.
                    boundsAutoApply: true
                });
                // Создаем карту с добавленными на нее кнопками.
                var myMap = new ymaps.Map('map', {
                    center: [55.750625, 37.626],
                    zoom: 7,
                }, {
                    buttonMaxWidth: 300
                });

                // К моменту попытки запросить маршруты маршрут не построился
                // var a = multiRoute.model.getRoutes();
                // Можно подписаться на событие успешного построения маршрута и когда маршрут построен получить результат
                multiRoute.model.events.add("requestsuccess", function(){
                    //var a = multiRoute.model.getRoutes();
                    var activeRoute = multiRoute.getActiveRoute();

                    console.log(multiRoute.getRoutes().get(0).properties.get('distance'));
                    document.getElementById('puth').innerHTML = multiRoute.getRoutes().get(0).properties.get('distance');

                });

                // Добавляем мультимаршрут на карту.
                myMap.geoObjects.add(multiRoute);
            }


        </script>

        <?php

        /*
        $URL = "https://api.routing.yandex.net/v1.0.0/distancematrix?origins=55.7538127,37.5755189|55.7539127,37.5655189&destinations=55.7489841,37.564189&mode=transit&apikey=c428abb7-ad0d-41cf-84cd-59f900d74c5b";
        $Data = json_decode(file_get_contents($URL));

        print_r($Data);

        /*
        $URL = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".urlencode($a)."&destinations=".urlencode($b)."&key=AIzaSyDNxR4BxYmGbYofycjUflUB2c2N4wvdA2w";
        $Data = json_decode(file_get_contents($URL));

        print_r($Data);

        /*
        $from = "Санкт-Петергубг Ленина 5";
        $to = "Выборг Ленина 20";

        $from = urlencode($from);
        $to = urlencode($to);

        $data = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?sensor=false&address="Оренбург Толстого 6"&key=");

        print(123);
         $data = json_decode($data);
        print_r($data);
        /* echo "Откуда: " . $data->destination_addresses[0] . "<br/>" .
            "Куда: " . $data->origin_addresses[0] . "<br/>" .
            "Время: " . $data->rows[0]->elements[0]->distance->text . "<br/>" .
            "Путь: " . $data->rows[0]->elements[0]->duration->text;
        */

    }

    //получение схем замера post(id_request)
    //http://np.im56.ru/rest/get-shema-request
    public function actionGetShemaRequest()
    {
        $id_request = Yii::$app->request->post('id_request');

        $files = scandir('web/uploads/images/metering/'.$id_request.'/');
        unset($files[0],$files[1]);
        return $this->asJson($files);

    }

    //задолженность перед нами
    public function actionGetDolg()
    {
        $this->layout = '';
        $user_id = User::findUserByToken(Yii::$app->request->post('auth_key'));//Yii::$app->user->identity

        $debitAll = Debit::getDebitAllByUser($user_id);
        $creditAll = Debit::getCreditAllByUser($user_id);
        $dolg = 0;
        // наличные взял исполнитель
        foreach ($debitAll as $debit) {
            if ($debit['sum_dolg'] > 0) {
                $dolg = $dolg + $debit['sum_dolg'];
            }
        }

        //деньги у изготовителя за еще не сделанный заказ
        foreach ($creditAll as $credit) {

            $request = Request::getRequestById($credit['id_request']);
            if ($request['status'] <= Request::STATUS_COMPANY_AFTER and $user_id == $request['id_company']) {
                $dolg = $dolg + $request['price_company'];
            }
        }
        return $this->asJson($dolg);
    }

    //создать баланс
    public function actionCreateBalance()
    {
        $user_id = User::findUserByToken(Yii::$app->request->post('auth_key'));//Yii::$app->user->identity
        $balance = new Balance();
        return $balance->createBalance($user_id);
    }

    //получить баланс
    public function actionGetBalance()
    {
        $user_id = User::findUserByToken(Yii::$app->request->post('auth_key'));//Yii::$app->user->identity
        return Balance::getBalance($user_id)['balance'];
    }

    //создать поступление средств post($id_request, $sum)
    public function actionCreateDebit()
    {
        $id_request = Yii::$app->request->post('id_request');
        $id_user = User::findUserByToken(Yii::$app->request->post('auth_key'));
        $type_user = User::findIdentity(User::findUserByToken(Yii::$app->request->post('auth_key')))['type'];
        $sum = Yii::$app->request->post('sum');
        $debit = new Debit();
        $bool = $debit->createDebit($id_request, $id_user, $type_user, $sum);
        $debit->payDebit($id_request, $id_user);
        return $bool;
    }

    //создать запись для оплаты post($id_request, $sum)
    public function actionCreateCredit()
    {
        $id_request = Yii::$app->request->post('id_request');
        $id_user = Yii::$app->request->post('id_user');
        $type_user = Yii::$app->request->post('type_user');//User::findIdentity(User::findUserByToken(Yii::$app->request->post('auth_key')))['type'];
        $sum = Yii::$app->request->post('sum');
        $credit = new Credit();
        $bool = $credit->createCredit($id_request, $id_user, $type_user, $sum);
        $credit->payCredit($id_request, $id_user);
        return $bool;

    }
    /*
        //списать с баланса средства post($id_request)
        public function actionPayDebit()
        {
            //переодически запускаямая функция
            //проверить поступление денег
            $id_request = Yii::$app->request->post('id_request');
            $id_user=User::findUserByToken(Yii::$app->request->post('auth_key'));
            return Debit::payDebit($id_request,$id_user);
        }

        //зачислить поступление средств на карту post($id_request)
        public function actionPayCredit()
        {
            $id_request = Yii::$app->request->post('id_request');
            $id_user=User::findUserByToken(Yii::$app->request->post('auth_key'));
            return Debit::payCredit($id_request,$id_user);
        }
    */

}

