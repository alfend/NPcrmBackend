
<?php


/* константы */
//Статусы пользователей:
const STATUS_DELETED = -1;
const STATUS_REGISTERED = 0;
const STATUS_ACTIVE = 1;
const STATUS_ALLOWED = 2;
// Роли пользователе
const TYPE_CLIENT = 1; // client - клиент
const TYPE_METERING = 2; //metering - замерщик
const TYPE_DELIVERY = 3; //delivery - доставщик
const TYPE_MOUNTING = 4; //mounting - монтажник
const TYPE_COMPANY = 5; //company - изготовитель
// Статусы заказа
const STATUS_DELETED = -1; //удален или отменен
const STATUS_CREATE = 0; //только создан
const STATUS_METERING_BEFORE = 1; //на стадии выбора замерщика
const STATUS_METERING_RUN = 2; //внесение замера
const STATUS_METERING_AFTER = 3; //выбираются изготовитель, курьер и монтажник
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


/*
//создание
$url='/rest/create-user';
$input=[
		'email',
		'tel',
		'password',
		'lastname',
		'firstname',
		'id_city',
		'user_type'
		];

$input2=[
		'alfend@ya.ru',
		'89501869241',
		'123456',
		'Фамилия',
		'Имя',
		'106',
		'1'
		];
		
//логин		
$url='/rest/login';
$input=[
		'tel',
		'password'
		];

//баланс создать
$url='/rest/create-balance';
$input=[

];
// создание заказа
$url='/rest/add-request-new-metering';
$input=[
		'date_metering_plan',
		'address_client_street',
		'address_client_house',
		'address_client_room'
		];
// 2020-02-25 00:00:01		
	


//авторизация под замерщиком
$url='/rest/login';
$input=[
		'tel',
		'password'
		];

//список для замерщика
$url='/rest/get-request-by-status';
$input=[
		'status_request'
		];
// или
$url='/rest/get-request-for-worker-metering';
$input=[
		];

//список заказов назначенных замерщику
$url='/rest/get-request-by-worker-and-status-metering';
$input=[
		'status_request'
		];		 

//создание отклика
$url='/rest/create-response';
$input=[
		'id_request',
		'type_workers',
		'date_workers',
		'price'
		];

//price из
$url='/rest/get-city-by-id';
$input=[
		'id_city'
		];

//откликнувшиеся на замер
$url='/rest/get-workers-by-request';
$input=[
    'id_request',
    'type_workers'
];

// установить замерщика
$url='/rest/set-insert-metering';
$input=[
        'id_request',
        'date_metering',
        'id_worker'
];

//статус в следующий STATUS_METERING_BEFORE, STATUS_METERING_RUN
$url='/rest/set-status';
$input=[
    'id_request',
    'status_old',
    'status_new'
];



//данные замера
$url='/rest/create-data-metering';
$input=[
    'id_request',
    'id_workers',
    'count_ceiling',
    'area',
    'perimeter',
    'spot',
    'luster',
    'curtain',
    'cut_pipe'
];

//создание подтверждения от замерщика к клиенту
$url='/rest/create-verify';
$input=[
    'id_request',
    'id_from_user',
    'id_to_user'
];

//получение всех подтверждений
$url='/rest/get-verify-by-id-to';
$input=[
];

//подтверждение ответа
$url='/rest/set-verify-yes';
$input=[
    'id_request',
    'id_from_user',
    'id_to_user'
];

//если подтверждение yes статус в следующий STATUS_METERING_RUN, STATUS_METERING_AFTER
$url='/rest/set-status';
$input=[
    'id_request',
    'status_old',
    'status_new'
];

//логин войти монтажником
$url='/rest/login';
$input=[
    'tel',
    'password'
];

//данные по замеру
$url='/rest/get-data-metering-by-id';
$input=[
    'id_request',
    'id_workers'
];

//для монтажа
$url='/rest/get-request-for-worker-mounting';
$input=[
];

//создание отклика
$url='/rest/create-response';
$input=[
    'id_request',
    'type_workers',
    'date_workers',
    'price'
];

//логин войти изг
$url='/rest/login';
$input=[
    'tel',
    'password'
];

//для изготовителя
$url='/rest/get-request-for-worker-company';
$input=[
];

//создание отклика
$url='/rest/create-response';
$input=[
    'id_request',
    'type_workers',
    'date_workers',
    'price'
];

//оплата замерщику в случае если $request['id_metering']<>$request['id_mounting'], sum = $city['price_metering'], id_user=$request['id_metering'], type_user=2
$url='/rest/create-credit';
$input=[
    'id_request',
    'id_user',
    'type_user',
    'sum'
];


//Выгодный изготовитель или монтажник
$url='/rest/get-workers-by-request-min';
$input=[
    'id_request',
    'type_workers'
];

//Аванс
$url='/rest/get-request-prepayment-by-id';
$input=[
    'id_request'
];

//стоимость
$url='/rest/get-request-prepayment-by-id';
$input=[
    'id_request'
];



//выполнение заказа (здесь назначаются монтажник изготовитель, производится списаниеаванса и перевод в след стадию)
$url='/rest/request-run';
$input=[
    'id_request'
];


//оплата изготовителю , sum = $request['price_company'], id_user=$request['id_company'], type_user=TYPE_COMPANY=5
$url='/rest/create-credit';
$input=[
    'id_request',
    'id_user',
    'type_user',
    'sum'
];

//все заказы у изготовителя
$url='/rest/get-request-by-worker-and-status-company';
$input=[
    'status_request'
];

//создание подтверждения от изготовителя к курьеру
$url='/rest/create-verify';
$input=[
    'id_request',
    'id_from_user',
    'id_to_user'
];

//статус в следующий STATUS_COMPANY_BEFORE, STATUS_COMPANY_RUN
$url='/rest/set-status';
$input=[
    'id_request',
    'status_old',
    'status_new'
];


//получение всех подтверждений
$url='/rest/get-verify-by-id-to';
$input=[
];


//подтверждение ответа, курьером если забрал у изготовителя полотно
$url='/rest/set-verify-yes';
$input=[
    'id_request',
    'id_from_user',
    'id_to_user'
];

//если подтверждение yes статус в следующий STATUS_COMPANY_RUN, STATUS_COMPANY_AFTER
$url='/rest/set-status';
$input=[
    'id_request',
    'status_old',
    'status_new'
];

//назначение курьером монтажника, если согласился
$url='/rest/set-insert-delivery';
$input=[
    'id_request',
    'id_worker'
];

//если подтверждение yes статус в следующий STATUS_COMPANY_AFTER, STATUS_DELIVERY_BEFORE
$url='/rest/set-status';
$input=[
    'id_request',
    'status_old',
    'status_new'
];





//назначиь дату монтажа id_request
$url='/rest/set-insert-mounting';
$input=[
    'id_request',
    'date_workers'
];




//если $request['id_delivery']=$request['id_mounting'](пока такой сценарий, возможно когда то будет курьер отдельно) статус в следующий STATUS_DELIVERY_BEFORE, STATUS_MOUNTING_BEFORE
$url='/rest/set-status';
$input=[
    'id_request',
    'status_old',
    'status_new'
];



//создание подтверждения от монтажника клиенту
$url='/rest/create-verify';
$input=[
    'id_request',
    'id_from_user',
    'id_to_user'
];




//статус в следующий STATUS_MOUNTING_BEFORE, STATUS_MOUNTING_RUN
$url='/rest/set-status';
$input=[
    'id_request',
    'status_old',
    'status_new'
];

//получение всех подтверждений
$url='/rest/get-verify-by-id-to';
$input=[
];





//подтверждение ответа, клиентом если смонтировано нормально
$url='/rest/set-verify-yes';
$input=[
    'id_request',
    'id_from_user',
    'id_to_user'
];

*/

//статус в следующий STATUS_MOUNTING_BEFORE, STATUS_MOUNTING_RUN
$url='/rest/set-status';
$input=[
    'id_request',
    'status_old',
    'status_new'
];


$url='/rest/add-request-new-metering';
$input=[
    'date_metering_plan',
    'address_client_street',
    'address_client_house',
    'address_client_room'
];

$url='http://marketnp.ru/backend/rest/get-user-id';
$input=[
//    'tel',
//    'password'
    'auth_key'
];


/*
 *
 *
 */
/* Сформировать дебит клиенту и провести через оплату монтажника
/*

*/


?>




<form id="form" action="<?= $url ?>" method="post">
    <!--
    <input type="hidden" name="_csrf" value="F65gjloLC_QNMXgKJyDmpKgnaNYxm2LRajX_kO02USxj7SL3DFQ8tWBoDFpxQonzwlcelATMI6IGAbXEgwYdcw==">
    !-->
    </br>
    <?php
    for($i=0;$i<count($input);$i++)
        print (''.$input[$i].'
						<input type="text" name="'.$input[$i].'" value="'.$input2[$i].'" /> </br>');
    ?>
    <button type = "submit"> Отправить </button>
</form>
<!-- /.form -->
