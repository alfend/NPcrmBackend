<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "balance".
 *
 * @property int $id
 * @property int $balance
 * @property string $date_create
 */
class Balance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'balance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['balance'], 'integer'],
            [['id_user'], 'integer'],
            [['date_create'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'balance' => 'Баланс',
            'date_create' => 'Дата создания',
            'id_user' => 'Пользователя'
        ];
    }

    //создание баланса
    public function createBalance($id_user)
    {
        if(!$this->getBalance($id_user)) {
            $balance = new Balance();
            $balance->id_user = $id_user;
            $balance->balance = 0;
            if ($balance->save()) {
                return true;
            };
        };
        return false;
    }

    //изменение баланса
    public function updateBalance($id_user,$sum)
    {
        $balance = new Balance();
        $balance=$balance->getBalance($id_user);
        $balance->balance = $balance->balance+ $sum;
        if ($balance->save()) {
           return true;
        };
        return false;
    }

    public function getBalance($id_user)
    {
        $cheсk = $this->find()->where(['id_user'=>$id_user])->one(); // ['balance']
        return $cheсk;
    }
}
