<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property int $id
 * @property int $id_user
 * @property string $data_create
 * @property int $type
 * @property int $number
 * @property int $sum
 * @property int $status
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'type', 'sum', 'status'], 'required'],
            [['id', 'id_user', 'type', 'number', 'sum', 'status'], 'integer'],
            [['data_create'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'data_create' => 'Data Create',
            'type' => 'Type',
            'number' => 'Number',
            'sum' => 'Sum',
            'status' => 'Status',
        ];
    }
}
