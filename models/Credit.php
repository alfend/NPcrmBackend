<?php

namespace app\models;

use Yii;
use app\models\Balance;
/**
 * This is the model class for table "credit".
 *
 * @property int $id
 * @property int $id_request
 * @property int $id_user
 * @property int $type_user
 * @property string $data_create
 * @property int $sum
 * @property int $sum_dolg
 */
class Credit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'credit';
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
    public function createCredit($id_request, $id_user, $type_user, $sum)
    {
        {
            $credit = new Credit();
            $credit->id_request = $id_request;
            $credit->id_user = $id_user;
            $credit->type_user = $type_user;
            $credit->sum = $sum;
            $credit->sum_dolg = $sum;
            $credit->status = 0;
            if ($credit->save()) {
                return true;
            };
        };
        return false;
    }

    //оплата (зачисление на баланс)
    public function payCredit($id_request, $id_user)
    {
        {
            $credit = new Credit();
            $credit = $credit->find()->where([
                'id_user' => $id_user,
                'status' => 0,
                'id_request' => $id_request
            ])->one(); //
            $balance = new Balance();
            $balance = $balance->getBalance($id_user);
            $balance->updateBalance($id_user, $credit['sum_dolg']);
            $credit->sum_dolg=0;
            $credit->status=1;



            if ($credit->save()) {
                return true;
            };
        };
        return false;
    }

    //получить все для пользователя
    public function getCreditAllByUser($id_user)
    {
        $cheсk = $this->find()->where(['id_user' => $id_user])->all(); //
        return $cheсk;
    }
}
