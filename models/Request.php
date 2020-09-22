<?php

namespace app\models;

use app\controllers\RestController;
use app\models\Response;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int $id_client
 * @property string $date_create
 * @property string $address
 * @property string $address_client_street
 * @property string $address_client_house
 * @property string $address_client_room
 * @property string $comment_request
 * @property int $id_metering
 * @property string $date_metering_plan
 * @property string $date_metering
 * @property int $id_delivery
 * @property int $price_delivery
 * @property int $id_mounting
 * @property int $price_mounting
 * @property int $type_price
 * @property int $id_company
 * @property double $price_company
 * @property double $price_request
 * @property double $deposit_transfer
 * @property double $deposit_cash
 * @property int $type_deposit
 * @property int $status_price
 * @property int $status_request
 */
class Request extends \yii\db\ActiveRecord
{

    const STATUS_DELETED = -1; //удален или отменен
    const STATUS_CREATE = 0; //только создан
    const STATUS_METERING_BEFORE = 1; //на стадии выбора замерщика
    const STATUS_METERING_RUN = 2; //внесение замера
    const STATUS_METERING_AFTER = 3; //подтверждение замера--  выбираются изготовитель, курьер и монтажник
    const STATUS_COMPANY_BEFORE = 4; //ожидается оплата
    const STATUS_COMPANY_RUN = 5; //изготавливается потолок
    const STATUS_COMPANY_AFTER = 6; //о передаче курьеру
    const STATUS_DELIVERY_BEFORE = 7; // курьер забрал
    const STATUS_DELIVERY_RUN = 8; //курьер доставил
    const STATUS_DELIVERY_AFTER = 9;//подтверждение доставки
    const STATUS_MOUNTING_BEFORE = 10; //монтажник ожидает
    const STATUS_MOUNTING_RUN = 11; // монтажник подтвердил выполнение
    const STATUS_MOUNTING_AFTER = 12; //клиент подтвердил монтаж
    const STATUS_FINISH = 15; //отзывы

    const TYPE_STANDARD = 1; // стандартный по всем стадиям
    const TYPE_TURN_KEY = 2; // под ключ


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_client', 'date_create',  'status_request','address_client_street', 'address_client_house'], 'required' , 'message' => 'Обязательное поле.'],
            //'date_metering_plan',
            [['id_client','id_city', 'id_metering', 'id_delivery', 'price_delivery', 'id_mounting', 'price_mounting', 'type_price', 'id_company', 'type_deposit', 'status_price', 'status_request'], 'integer' , 'message' => 'Число.'],
            [['date_create', 'date_metering_plan', 'date_metering'], 'safe'], //,'date' , 'format'=>'Y-m-d'
            [['comment_request'], 'string'],
            [['price_company', 'price_request', 'deposit_transfer', 'deposit_cash'], 'number'],
            [['address'], 'string', 'max' => 255],
            [['address_client_street', 'address_client_house', 'address_client_room'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_client' => 'ID Клиента',
            'date_create' => 'Дата создания',
            'id_city' => 'Город',
            'type' => 'Тип заказа',
            'address' => 'Адрес',
            'address_client_street' => 'Улица',
            'address_client_house' => 'Дом',
            'address_client_room' => 'Квартира',
            'comment_request' => 'Комментарий',
            'id_metering' => 'Замерщик',
            'date_metering_plan' => 'Дата замера',
            'time_from_metering_plan' => 'Время замера от',
            'time_to_metering_plan' => 'Время замера до',
            'date_metering' => 'Дата замера',
            'id_delivery' => 'Доставщик',
            'price_delivery' => 'Стоимость доставки',
            'id_mounting' => 'Монтажник',
            'date_mounting' => 'Дата монтажа',
            'price_mounting' => 'Стоимость монтажа',
            'type_price' => 'Тип цены',
            'id_company' => 'Изготовитель',
            'price_company' => 'Стоимость изготовления',
            'price_request' => 'Стоимость заказа',
            'deposit_transfer' => 'Deposit Transfer',
            'deposit_cash' => 'Deposit Cash',
            'type_deposit' => 'Тип оплаты',
            'status_price' => 'Статус оплаты',
            'status_request' => 'Статус заказа',
        ];
    }

    //все заказы на клиента
    public function getRequestByClientAndStatus($id_client, $status)
    {
        return static::find()->where(['id_client' => $id_client])->andWhere(['in','status_request',$status])->asArray()->all(); //, 'status' => self::STATUS_ACTIVE]
    }

    //все заказы для замера
    public function getRequestForWorkerMetering($id_city, $status)
    {
        return static::find()->where(['id_city' => $id_city, 'id_metering' => null])->andWhere([
            'in',
            'status_request',
            $status
        ])->asArray()->all(); //, 'status' => self::STATUS_ACTIVE]
    }

    //все заказы для доставки
    public function getRequestForWorkerDelivery($id_city, $status)
    {
        return static::find()->where(['id_city' => $id_city, 'id_delivery' => null])->andWhere([
            'in',
            'status_request',
            $status
        ])->asArray()->all(); //, 'status' => self::STATUS_ACTIVE]
    }

    //все заказы для изготовления
    public function getRequestForWorkerCompany($id_city, $status)
    {
        return static::find()->where(['id_city' => $id_city, 'id_company' => null])->andWhere([
            'in',
            'status_request',
            $status
        ])->asArray()->all(); //, 'status' => self::STATUS_ACTIVE]
    }

    //все заказы для монтажа
    public function getRequestForWorkerMounting($id_city, $status)
    {
        return static::find()->where(['id_city' => $id_city, 'id_mounting' => null])->andWhere([
            'in',
            'status_request',
            $status
        ])->asArray()->all(); //, 'status' => self::STATUS_ACTIVE]
    }


    //все заказы на замер рабтника
    public function getRequestByWorkerAndStatusMetering($id_worker, $status)
    {
        return static::find()->where(['id_metering' => $id_worker])->andWhere(['in','status_request',$status])->asArray()->all(); //, 'status' => self::STATUS_ACTIVE]
    }

    //все заказы на доставку рабтника
    public function getRequestByWorkerAndStatusDelivery($id_worker, $status)
    {
        return static::find()->where(['id_delivery' => $id_worker])->andWhere(['in','status_request',$status])->asArray()->all(); //, 'status' => self::STATUS_ACTIVE]
    }

    //все заказы на изготовление
    public function getRequestByWorkerAndStatusCompany($id_worker, $status)
    {
        return static::find()->where(['id_company' => $id_worker])->andWhere(['in','status_request',$status])->asArray()->all(); //, 'status' => self::STATUS_ACTIVE]
    }

    //все заказы на монтаж
    public function getRequestByWorkerAndStatusMounting($id_worker, $status)
    {
        return static::find()->where(['id_mounting' => $id_worker])->andWhere(['in','status_request',$status])->asArray()->all(); //, 'status' => self::STATUS_ACTIVE]
    }


    //все заказы на отклик
    public function getRequestByStatus($id_city,$status)
    {
        return static::find()->where(['id_city' => $id_city, 'status_request' => $status])->asArray()->all(); //, 'status' => self::STATUS_ACTIVE]
    }

    //все заказы на отклик по типу
    public function getRequestByStatusType($id_city,$status,$type)
    {
        return static::find()->where(['id_city' => $id_city,'type' => $type])->andWhere(['in','status_request',$status])->asArray()->all(); //, 'status' => self::STATUS_ACTIVE]
    }


    public function getDeliveryPrice($id_request)
    {

        $request=new Request();
        $request = $request -> getRequestById($id_request);

        $company = User::findIdentity($request['id_company']);

        $from =City::getCityNameById($request['id_city']).' '.$company['address_delivery'];
        $to = City::getCityNameById($request['id_city']).' '.$request['address'];// address_delivery

        $from = urlencode($from);
        $to = urlencode($to);

        $data = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?key=AIzaSyDfkmms4L0P9EKZnmDdesNkArqGORwbDew&origins=$from&destinations=$to&language=ru-RU&sensor=false");

        $data = json_decode($data);

        return ($data->rows[0]->elements[0]->distance->value / 1000);
    }

    //стоимость заказа
    public function getRequestPrice($id_request)
    {
        $request = new Request();
        $request = $request->getRequestById($id_request);

        $city = new City();
        $city = $city->getCityById($request['id_city']);

        //коэф из user если не установлен то из города
        $koef = $city['coefficient'];
        if (Yii::$app->user->identity['coefficient'] > 0) {
            $koef = Yii::$app->user->identity['coefficient'];
        };

        //если нет цены монтажника, брать мин в откликах
        $response = new response();

        if (isset($request['price_mounting'])) {
            $minMount = $request['price_mounting'];
        } else {
            $minMount = $response->findWorkersMin($id_request, User::TYPE_MOUNTING)['price'];
        }

        //если нет цены изготовителя, брать мин в откликах
        $response = new response();

        if (isset($request['price_company'])) {
            // в цену изготовителя включить цену доставки
            $minCompany = $request['price_company'];
            $DeliveryPrice = $request['price_delivery'];
        } else {
            $request=new Request();
            $request = $request -> getRequestById($id_request);
            // в цену изготовителя включить цену доставки
            $DeliveryPrice = $request->getDeliveryPrice($id_request)*20;
            if($DeliveryPrice<=0 or $DeliveryPrice>$city['price_metering']*10){
                $DeliveryPrice = $city['price_metering'];
            }
            $minCompany =  $response->findWorkersMin($id_request, User::TYPE_COMPANY)['price'];
        }

        return ($city['price_metering']  + round($DeliveryPrice) + $minMount * (1 + $koef) + $minCompany * (1 + $koef)); //*(1+$city['commission'])
    }

    //аванс заказа
    public function getRequestPrepayment($id_request)
    {
        $request = new Request();
        $request = $request->getRequestById($id_request);

        $city = new City();
        $city = $city->getCityById($request['id_city']);

        //цена заказа
        $price = Request::getRequestPrice($id_request);

        //аванас макс(из цены изготовителя или процента в городе
        $prepayment = 0;

        //если нет цены изготовителя, брать мин в откликах
        $response = new response();

        if ($request['price_company'] > 0) {
            $minCompany = $request['price_company'];
        } else {
            $minCompany = $response->findWorkersMin($id_request, User::TYPE_COMPANY)['price'];
        }

        if ($price * $city['prepayment'] >= $minCompany) {
            $prepayment = $price * $city['prepayment'];

        } else {
            $prepayment = $minCompany;
        }
        return $prepayment;
    }

    //проверка оформления заказа
    public function checkRequestRun($id_request)
    {
        $request_error = '';
        $request = new Request();
        $response = new response();
        $request = $request->getRequestById($id_request);

        $city = new City();
        $city = $city->getCityById($request['id_city']);

        //есть ли монтажники
        if (!isset($request['id_mounting'])) {
            if (count($response->findWorkers($id_request, User::TYPE_MOUNTING)) == 0) {
                $request_error .= 'Нет откликов от монтажника. ';
            };
        }

        //есть ли изготовители
        if (!isset($request['id_company']) and ($request['type'] == Request::TYPE_STANDARD or $request['type'] == null)) {
            if (count($response->findWorkers($id_request, User::TYPE_COMPANY)) == 0) {
                $request_error .= 'Нет откликов от изготовителей. ';
            };
        }

        //аванс заказа
        $balance = new Balance();
        $balanceSum = $balance->getBalance($request['id_client'])['balance'];
        $prepayment = $request->getRequestPrepayment($id_request);
        $oplata = $prepayment - $balanceSum - $request['deposit_transfer'] - $request['deposit_cash'];
        if ($oplata > 0) {
            $request_error .= 'Не хватает оплатить ' . $oplata . '. ';
        }

        return $request_error;
    }

    //оформление заказа
    public function RequestRun($id_request)
    {
        $request_error = '';
        $request = new Request();
        $request = $request->getRequestById($id_request);
        $response = new response();
        $request = $request->getRequestById($id_request);
        if ($request->checkRequestRun($id_request) == '') {

            $city = new City();
            $city = $city->getCityById($request['id_city']);

            //назначить монтажника
            if (!isset($request['id_mounting'])) {
                //установить монтажника
                $response = new Response();
                $response = $response->findWorkersMin($id_request, User::TYPE_MOUNTING);
                $request->setInsertMounting($id_request, $response['id'], $response['price'], $response['date_workers']);
            }

            //есть ли изготовители
            if (!isset($request['id_company']) and ($request['type'] == Request::TYPE_STANDARD or $request['type'] == null)) {
                //установить изготовителя
                $response = new Response();
                $response = $response->findWorkersMin($id_request, User::TYPE_COMPANY);
                $request->setInsertCompany($id_request, $response['id'], $response['price'], $response['date_workers']);

                $request=new Request();
                $request = $request -> getRequestById($id_request);

                // просчет цены доставки
                $DeliveryPrice = $request->getDeliveryPrice($id_request)*20;
                if($DeliveryPrice<=0 or $DeliveryPrice>$city['price_metering']*10){
                    $DeliveryPrice = $city['price_metering'];
                };
                if (!isset($request['price_delivery'])){
                    $request->price_delivery=round($DeliveryPrice);
                    $request->save();
                }
            }

            //вычесть с баланса

            $balance = new Balance();
            $balanceSum = $balance->getBalance($request['id_client'])['balance'];
            $prepayment = $request->getRequestPrepayment($id_request);
            $oplata = $prepayment - $request['deposit_transfer'] - $request['deposit_cash'];

            if (($oplata <= $balanceSum )) {
                $balance->updateBalance($request['id_client'], -1 * $oplata);
                $request = $request->getRequestById($id_request);
                $request->setStatus($id_request, Request::STATUS_METERING_AFTER, Request::STATUS_COMPANY_BEFORE);
                $request->deposit_cash = $request->deposit_cash + $oplata;
                $request->price_request = $request->getRequestPrice($id_request);
                $request->save();
            };
        }

        return true;
    }

    //заказ по ид
    public function getRequestById($id)
    {
        return static::find()->where(['id' => $id])->one();
    }

    //статус заказа
    public function getStatus($id)
    {
        return static::find()->where(['id' => $id])->one()->status_request;
    }

    //установить замерщика
    public function setInsertMetering($id, $id_user,$date_metering)
    {
        $request = new Request();
        $request = $this->find()->where(['id' => $id])->one();
        $request->id_metering = $id_user;
        $request->date_metering = $date_metering;
        if($request->save()) {
            return true;
        } else {
            return false;
        }

    }

    //установить компанию
    public function setInsertCompany($id, $id_user,$price)
    {
        $request = new Request();
        $request = $this->find()->where(['id' => $id])->one();
        $request->id_company = $id_user;
        $request->price_company = $price;
        if($request->save()) {
            return true;
        } else {
            return false;
        }
    }

    //установить доставщика
    public function setInsertDelivery($id, $id_user)
    {
        $request = new Request();
        $request = $this->find()->where(['id' => $id])->one();
        $request->id_delivery = $id_user;

        if($request->save()) {
            return true;
        } else {
            return false;
        }

    }

    //установить монтажника
    public function setInsertMounting($id, $id_user = null,$price = null,$date_mounting = null)
    {
        $request = new Request();
        $request = $this->find()->where(['id' => $id])->one();
        if (isset($id_user)) {
            $request->id_mounting = $id_user;
        }
        if (isset($price)) {
            $request->price_mounting = $price;
        }
        if (isset($date_mounting)) {
            $request->date_mounting = $date_mounting;
        }
        if($request->save()) {
            return true;
        } else {
            return false;
        }
    }

    //изменить статус
    public function setStatus($id, $status_old, $status_new)
    {
        $request = new Request();
        $request = $this->find()->where(['id' => $id])->andWhere(['status_request'=>$status_old])->one();
        if(!isset($request)){
            return false;
        }
        $request->status_request = $status_new;
        if($request->save()) {
            return true;
        } else {
            return false;
        }
    }
}
