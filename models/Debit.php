<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "debit".
 *
 * @property int $id
 * @property int $id_request
 * @property int $id_user
 * @property int $type_user
 * @property string $data_create
 * @property int $sum
 * @property int $sum_dolg
 */
class Debit extends \yii\db\ActiveRecord
{

    const STATUS_DELETED = -1; //удален или отменен
    const STATUS_CREATE = 0; //только создан
    const STATUS_PAY = 1; //оплачен


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'debit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_request', 'id_user', 'type_user', 'sum', 'sum_dolg'], 'integer'],
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
            'id_request' => 'Id Request',
            'id_user' => 'Id User',
            'type_user' => 'Type User',
            'data_create' => 'Data Create',
            'sum' => 'Sum',
            'sum_dolg' => 'Sum Dolg',
        ];
    }

    //создание дебит то что платит клиент
    public function createDebit($id_request,$id_user,$type_user,$sum)
    {
        {
            $debit = new Debit();
            $debit->id_request = $id_request;
            $debit->id_user = $id_user;
            $debit->type_user = $type_user;
            $debit->sum = $sum;
            $debit->status = 0;
            if ($debit ->save()) {
                return true;
            };
        };
        return false;
    }

    //оплата (списание с баланса на дебит) //переодически запускаямая функция
    public function payDebit($id_request,$id_user)
    {
        {
            $debit = new Debit();
            $debit = $debit->find()->where(['id_user'=>$id_user,'status'=>STATUS_CREATE,'id_request'=>$id_request])->one(); //
            $balance = new Balance();
            $balance = $balance->getBalance($id_user);
            if($balance['balance']>0) {
                if($balance['balance']>=$debit['sum_dolg']){
                    $balance->updateBalance($id_user, $debit['sum_dolg']);
                    $debit['sum_dolg']=0;
                    $debit['status']=STATUS_PAY;
                    $debit->save();
                } else {
                    $balance->updateBalance($id_user, -1 * $balance['balance']);
                    $debit['sum_dolg']=$debit['sum_dolg']-$balance['balance'];
                    $debit->save();
                }
            }
            if ($debit ->save()) {
                return true;
            };
        };
        return false;
    }

    //получить все для пользователя
    public function getDebitAllByUser($id_user)
    {
        $cheсk = $this->find()->where(['id_user'=>$id_user])->all(); //
        return $cheсk;
    }

}
