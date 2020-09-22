<?php

namespace app\modules\metering\controllers;

use app\models\Request;
use Yii;
use app\models\DataMetering;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * DataMeteringController implements the CRUD actions for DataMetering model.
 */
class DataMeteringController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DataMetering models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => DataMetering::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DataMetering model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DataMetering model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DataMetering();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->images = UploadedFile::getInstances($model, 'images');
            if ($model->upload()) {;}
            $request = new Request();
            //$model->file='web/uploads/images/metering/'.$model->file->baseName . '.' . $model->file->extension;
            $prov = $request->setStatus($model->id_request,Request::STATUS_METERING_RUN,Request::STATUS_COMPANY_BEFORE);
            return $this->redirect(['/metering/default/my-request']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DataMetering model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {


        $model = new DataMetering();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->images = UploadedFile::getInstances($model, 'images');
            if ($model->upload()) {;}
            return $this->redirect(['/metering/default/my-request']);
        };
        return $this->render('update', [
            'model' => $model,
        ]);

    }

    /**
     * Deletes an existing DataMetering model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /**
     * Finds the DataMetering model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataMetering the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataMetering::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
