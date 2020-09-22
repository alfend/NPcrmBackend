<?php
/**
 * Created by PhpStorm.
 * User: alfend
 * Date: 11.10.2019
 * Time: 21:18
 */

namespace app\models;

use Yii;
use yii\base\Model;

class SignupFormCompany extends Model
{

    public $email;
    public $password;
    public $tel;
    public $lastname;
    public $firstname;
    public $secondname;
    public $company;
    public $date_create;
    public $birthday;
    public $address;
    public $address_delivery;
    public $id_city;
    public $status;


    public function rules()
    {
        return [
            [['date_create','address_delivery', 'company','id_city',  'email', 'tel', 'password'], 'required', 'message' => 'Обязательное поле.'],
            [['date_create', 'birthday'], 'safe'],
            [['id_city', 'status'], 'integer'],
            [['company', 'tel'], 'string', 'max' => 255], //'lastname', 'firstname', 'secondname'
            [['address','address_delivery', 'email', 'password'], 'string', 'max' => 255],
            ['email', 'email', 'message' => 'Нужно ввести email.'],
            ['email', 'trim'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Этот email уже занят.'],
            ['password', 'string', 'min' => 6, 'message' => 'Не менее 6 символов.'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signupCompany($type)
    {

        if (!$this->validate()) {return null;};
        $user = new User();
        $user->email = $this->email;
        //$user->password = $this->password;
        $user->setPassword($this->password);
         $user->generateAuthKey();
        $user->tel = $this->tel;
        $user->company = $this->company;
        $user->date_create = $this->date_create;
        $user->birthday = $this->birthday;
        $user->address = $this->address;
        $user->address_delivery = $this->address_delivery;
        $user->id_city = $this->id_city;
        $user->status = $this->status;
        $user->type = $type;
        $user->address_delivery = $this->address_delivery;
       //echo '<pre>'; print_r($user); die;
        return $user->save() ? $user : null;

        /*if($user->save()){
            return $this->goHome();
        }*/
    }

}