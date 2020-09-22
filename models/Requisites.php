<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "requisites".
 *
 * @property int $id
 * @property int $id_user
 * @property string $company
 * @property string $inn
 * @property string $kpp
 * @property string $bank_name
 * @property string $bank_bik
 * @property string $account_calc
 * @property string $account_cor
 * @property string $address_company
 * @property string $director
 */
class Requisites extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requisites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user'], 'required'],
            [['id_user'], 'integer'],
            [['inn', 'kpp', 'bank_bik', 'account_calc', 'account_cor'], 'number'],
            [['company', 'bank_name', 'address_company', 'director'], 'string', 'max' => 255],
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
            'company' => 'Company',
            'inn' => 'Inn',
            'kpp' => 'Kpp',
            'bank_name' => 'Bank Name',
            'bank_bik' => 'Bank Bik',
            'account_calc' => 'Account Calc',
            'account_cor' => 'Account Cor',
            'address_company' => 'Address Company',
            'director' => 'Director',
        ];
    }

    //все реквезиты по ид пользователя
    public function getRequisitesByUserId($id_user)
    {
        return static::find()->where(['id_user' => $id_user])->asArray()->one(); //, 'status' => self::STATUS_ACTIVE]
    }

    public function setRequisites($id_user,$company,$inn,$kpp,$bank_name,$bank_bik,$account_calc,$account_cor,$address_company,$director)
    {
        $requisites = Requisites::find()->where(['id_user' => $id_user])->one();

        if (empty($requisites) ) {
            $requisites = new Requisites();
            $requisites->id_user = $id_user;
        }

        $requisites->company = $company;
        $requisites->inn = $inn;
        $requisites->kpp = $kpp;
        $requisites->bank_name = $bank_name;
        $requisites->bank_bik = $bank_bik;
        $requisites->account_calc = $account_calc;
        $requisites->account_cor = $account_cor;
        $requisites->address_company = $address_company;
        $requisites->director = $director;

        if ($requisites->save()) {
            return true;
        } else {
            return false;
        }
    }


}
