<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "data_metering".
 *
 * @property int $id
 * @property int $id_request
 * @property int $id_workers
 * @property int $count_ceiling
 * @property double $area
 * @property int $perimeter
 * @property int $spot
 * @property int $luster
 * @property int $curtain
 * @property int $cut_pipe
 * @property string $file
 */
class DataMetering extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $images;

    public static function tableName()
    {
        return 'data_metering';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_request','count_ceiling', 'perimeter','area','spot', 'luster', 'curtain', 'cut_pipe'], 'required','message'=>'Обязательно'],
            [['id_request', 'id_workers','area', 'count_ceiling', 'perimeter', 'spot', 'luster', 'curtain', 'cut_pipe'], 'integer'],
           // [['file'], 'string', 'max' => 255],
            [['images'], 'file','maxFiles' => 0,'extensions' => 'png, jpg'],
            //'skipOnEmpty' => false, , 'extensions' => 'png, jpg','maxFiles' => 0
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_request' => 'Заказ',
            'id_workers' => 'Работник',
            'count_ceiling' => 'Кол-во потолков',
            'area' => 'Общая площадь(м2)',
            'perimeter' => 'Периметр(м)',
            'spot' => 'Светильников',
            'luster' => 'Люстр',
            'curtain' => 'Гардин',
            'cut_pipe' => 'Обвод труб',
            'files' => 'Файлы',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $dir='web/uploads/images/metering/'.$this->id_request;
            //папка для размещения образов потолковпо номеру заказа
            if(!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }


            foreach ($this->images as $file) {
                $file->saveAs($dir.'/'.$file->baseName.'.'.$file->extension);
            };
            return true;
        } else {
            return false;
        }
    }


    //создание замера
    public function createDataMetering($id_request, $id_workers,$count_ceiling,$area,$perimeter,$spot,$luster,$curtain,$cut_pipe)
    {
        if(!$this->cheсkDataMetering($id_request, $id_workers)) {
            $data_metering = new DataMetering();
            $data_metering->id_request = $id_request;
            $data_metering->id_workers = $id_workers;
            $data_metering->count_ceiling = $count_ceiling;
            $data_metering->area = $area;
            $data_metering->perimeter = $perimeter;
            $data_metering->spot = $spot;
            $data_metering->luster = $luster;
            $data_metering->curtain = $curtain;
            $data_metering->cut_pipe = $cut_pipe;
            if ($data_metering->save()) {
                return true;
            };
        };
        return false;

    }

    //изменение замера
    public function updateDataMetering($id_request, $id_workers,$count_ceiling,$area,$perimeter,$spot,$luster,$curtain,$cut_pipe)
    {
        if($data_metering=$this->cheсkDataMetering($id_request, $id_workers)) {
            $data_metering->count_ceiling = $count_ceiling;
            $data_metering->area = $area;
            $data_metering->perimeter = $perimeter;
            $data_metering->spot = $spot;
            $data_metering->luster = $luster;
            $data_metering->curtain = $curtain;
            $data_metering->cut_pipe = $cut_pipe;
            if ($data_metering->save()) {
                return true;
            };
        };
        return false;

    }

    public function cheсkDataMetering($id_request, $id_workers)
    {
        $cheсk = $this->find()->where(['id_request'=>$id_request,'id_workers'=>$id_workers])->one(); //
        return $cheсk;
    }




}
