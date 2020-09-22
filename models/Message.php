<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property string $date_create
 * @property string $text
 * @property int $id_from_user
 * @property int $id_to_user
 * @property int $status
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_create'], 'safe'],
            [['id_from_user', 'id_to_user', 'status'], 'integer'],
            [['status'], 'required'],
            [['text'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_create' => 'Date Create',
            'text' => 'Text',
            'id_from_user' => 'Id From User',
            'id_to_user' => 'Id To User',
            'status' => 'Status',
        ];
    }


    //создание сообщения
    public function createMessage($text,$id_from_user,$id_to_user)
    {

        $message = new Message();
        $message->text = $text;
        $message->id_from_user = $id_from_user;
        $message->id_to_user = $id_to_user;
        $message->status = 0;

        if ($message->save())
        {
                return true;
        };
        return false;

    }

    //получить все письма для пользоватея
    public function getMessageForUser($id_to_user)
    {
        return $this->find()->where(['id_to_user'=>$id_to_user])->all();;

    }

    //поставить что сообщение проитано
    public function setMessageRead($id_message)
    {
        $message = $this->find()->where(['id'=>$id_message])->one();
        $message -> status = 1;
        if ($message->save())
        {
            return true;
        };
        return false;

    }
}
