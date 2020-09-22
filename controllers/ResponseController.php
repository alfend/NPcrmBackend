<?php

namespace app\controllers;

class ResponseController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
