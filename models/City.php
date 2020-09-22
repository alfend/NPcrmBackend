<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string $name
 * @property int $gmt
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'gmt'], 'required'],
            [['gmt'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'gmt' => 'Стоимость',
            'commission' => 'Комиссия',
            'coefficient' => 'Коэф',
            'price_metering' => 'Стоимость замера',
            'prepayment' => 'Аванс',


        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCityByName($name)
    {
        return static::findOne(['name' => $name]); //, 'status' => self::STATUS_ACTIVE]
    }

    public function getCityById($id)
    {
        return static::findOne(['id' => $id]); //, 'status' => self::STATUS_ACTIVE]
    }

    public static function getCityNameById($id)
    {
        return static::findOne(['id' => $id])->name; //, 'status' => self::STATUS_ACTIVE]
    }

    public function getAllCity()
    {
        return static::find('id','name')->all(); //, 'status' => self::STATUS_ACTIVE]
    }

    public function getCityByIp($ip)
    {
        $postData = "
            <ipquery>
                <fields>
                    <all/>
                </fields>
                <ip-list>
                    <ip>$ip</ip>
                </ip-list>
            </ipquery>
        ";

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, 'http://194.85.91.253:8090/geo/geo.html');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $responseXml = curl_exec($curl);
        curl_close($curl);

        if (substr($responseXml, 0, 5) == '<?xml') {
            $ipinfo = new \SimpleXMLElement($responseXml);
            //echo $ipinfo->ip->city; // город
            //echo $ipinfo->ip->region; // регион
            //echo $ipinfo->ip->district; // федеральный округ РФ
            return $ipinfo->ip->city;
        }
        return false;
    }
}
