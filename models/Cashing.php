<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cashing".
 *
 * @property int $id
 * @property int $id_request
 * @property int $id_client
 * @property string $data_create
 * @property int $type
 * @property int $id_worker
 * @property int $verify
 * @property int $sum
 * @property int $status
 * @property string $cheque
 */
class Cashing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cashing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_request', 'id_client', 'type', 'id_worker', 'verify', 'sum', 'status'], 'integer'],
            [['id_client', 'sum'], 'required'],
            [['data_create'], 'safe'],
            [['cheque'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_request' => 'Id Request',
            'id_client' => 'Id Client',
            'data_create' => 'Data Create',
            'type' => 'Type',
            'id_worker' => 'Id Worker',
            'verify' => 'Verify',
            'sum' => 'Sum',
            'status' => 'Status',
            'cheque' => 'Cheque',
        ];
    }
}
