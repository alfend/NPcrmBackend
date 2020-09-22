<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{

    const STATUS_DELETED = -1;
    const STATUS_REGISTERED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_ALLOWED = 2;

    const TYPE_CLIENT = 1; // client - клиент
    const TYPE_METERING = 2; //metering - замерщик
    const TYPE_DELIVERY = 3; //delivery - доставщик
    const TYPE_MOUNTING = 4; //mounting - монтажник
    const TYPE_COMPANY = 5; //company - изготовитель


    public static function tableName()
    {
        return '{{%user}}';
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_DELETED,self::STATUS_REGISTERED,self::STATUS_ACTIVE, self::STATUS_ALLOWED]],

        ]
        ;
    }


    /**
     * @inheritdoc
     */
/*    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }
*/



    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    /**
     * @inheritdoc
     */

    //получить пользователя по токену
    public static function findUserByToken($token)
    {
        if(isset($token)) {
            $user=static::findOne(['auth_key' => $token]);
            if(!empty($user)) {
                return $user->id;
            } else {
                return null;
            }

        } else {
            return Yii::$app->user->getId();
        }


    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /*

     */


    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    //поиск по email
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]); //, 'status' => self::STATUS_ACTIVE]
    }

    //поиск по tel
    public static function findByTel($tel)
    {
        return static::findOne(['tel' => $tel]); //, 'status' => self::STATUS_ACTIVE]
    }

    //получение роли
    public static function getRole($id)
    {
        return static::findOne(['id' => $id])->type;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }



    //вывод id города в пользователе
    public function getCity($id)
    {
        return static::findOne(['id' => $id]); //, 'status' => self::STATUS_ACTIVE]
    }


    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function setUser($id,$email,$lastname,$firstname,$birthday,$tel,$password,$sys_notice, $news_notice)
    {

        //$user = new User();
        $user = $this->find()->where(['id' => $id])->one();
        $user->email = $email;
        $user->lastname = $lastname;
        $user->firstname = $firstname;
        $user->birthday = $birthday;
        $user->tel = $tel;
        $user->sys_notice = $sys_notice;
        $user->news_notice = $news_notice;
        $user->setPassword($password);
        if ($user->save()) {
            return true;
        } else {
            return false;
        }
    }


    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password); // $password;
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
/*    public function validatePassword($password)
    {
        return $this->password === $password;
    }
*/

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

}
