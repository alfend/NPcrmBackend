<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "verify".
 *
 * @property int $id
 * @property int $id_request
 * @property int $id_from_user
 * @property int $id_to_user
 * @property int $verify_to_user
 * @property int $status
 */
class Verify extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'verify';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_request'], 'required'],
            [['id_request', 'id_from_user', 'id_to_user', 'verify_to_user', 'status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_request' => '№ Заказа',
            //тип добавить
            'text' => 'Текст',
            'id_from_user' => 'От кого',
            'id_to_user' => 'Кому',
            'verify_to_user' => 'Подтверждено кому',
            'status' => 'Статус',
        ];
    }

    //подтвержение по ид
    public function getVerifyById($id)
    {
        return static::find()->where(['id' => $id])->one();
    }

    //подтвержение по ид заказа
    public function getVerifyByIdRequest($id_request)
    {
        return static::find()->where(['id_request' => $id_request])->all();
    }

    //все подтвержение назначенные пользователю
    public function getVerifyByIdTo($id_user)
    {
        return static::find()->where(['id_to_user' => $id_user])->all();
    }

    //создать подтверждение
    public function createVerify($id_request,$id_to_user, $id_from_user,$text=null)
    {
        $verify = new Verify();
        $verify->id_request = $id_request;
        $verify->id_to_user = $id_to_user;
        $verify->id_from_user= $id_from_user;
        $verify->text = $text;
        if($verify->save()) {
            return true;
        } else {
            return false;
        }
    }
    //подтвердить
    public function setVerifyYes($id_request,$id_to_user, $id_from_user)
    {
        $verify =  Verify::find()->where(['id_to_user' => $id_to_user])->andWhere(['id_from_user'=>$id_from_user])->andWhere(['id_request'=>$id_request])->one();
        $verify->verify_to_user = 1;
        if($verify->save()) {
            return true;
        } else {
            return false;
        }
    }

    //не подтвердить
    public function setVerifyNo($id_request,$id_to_user, $id_from_user)
    {
        $verify =  Verify::find()->where(['id_to_user' => $id_to_user])->andWhere(['id_from_user'=>$id_from_user])->andWhere(['id_request'=>$id_request])->one();
        $verify->verify_to_user = 0;
        if($verify->save()) {
            return true;
        } else {
            return false;
        }
    }


}
