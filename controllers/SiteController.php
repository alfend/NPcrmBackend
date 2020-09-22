<?php

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\SignupFormCompany;
use app\models\User;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    //регистрация клиента
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup(User::TYPE_CLIENT)) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['/client']);
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /*
     *     const TYPE_METERING = 2; //metering - замерщик
    const TYPE_DELEVERY = 3; //delivery - доставщик
    const TYPE_MOUNTING = 4; //mounting - монтажник
    const TYPE_COMPANY = 5; //company - изготовитель
     */

    //регистрация замерщика
    public function actionSignupMetering()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup(User::TYPE_METERING)) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['/metering/default/new-request']);
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    //регистрация Курьера
    public function actionSignupDelivery()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup(User::TYPE_DELIVERY)) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['/delivery/default/new-request']);
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    //регистрация Монтажника
    public function actionSignupMounting()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup(User::TYPE_MOUNTING)) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['/mounting/default/new-request']);
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    //регистрация Компании
    public function actionSignupCompany()
    {
        $model = new SignupFormCompany();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signupCompany(User::TYPE_COMPANY)) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['/company/default/new-request']);
                }
            }
        }

        return $this->render('signupCompany', [
            'model' => $model,
        ]);
    }



    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionIndex()
    {
      //  if(\Yii::$app->mobileDetect->isMobile()){print(1);};
      //  if(\Yii::$app->mobileDetect->isDesktop()){return $this->render('index');};
      //  if(\Yii::$app->mobileDetect->isTablet()){print(3);};

       return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //print_r(Yii::$app->user); die;
            //Yii::$app->user->id=Yii::$app->user->at
           // return $this->goBack();

            if (Yii::$app->user->identity->type == User::TYPE_CLIENT) {
                return $this->redirect(['/client']);
            }

            if (Yii::$app->user->identity->type == User::TYPE_METERING) {
                //если с мобильного
                if(\Yii::$app->mobileDetect->isMobile() or \Yii::$app->mobileDetect->isTablet()) {
                    return $this->redirect(['/metering/default/index']);
                } else {
                    return $this->redirect(['/metering/default/new-request']);
                }

            }
            if (Yii::$app->user->identity->type == User::TYPE_DELIVERY) {
                return $this->redirect(['/delivery/default/new-request']);
            }

            if (Yii::$app->user->identity->type == User::TYPE_MOUNTING) {
                return $this->redirect(['/mounting/default/new-request']);
            }

            if (Yii::$app->user->identity->type == User::TYPE_COMPANY) {
                return $this->redirect(['/company/default/new-request']);
            }


            return $this->redirect(['/client/request']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
