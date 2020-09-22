<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Request;

/**
 * RequestSearch represents the model behind the search form of `app\models\Request`.
 */
class RequestSearch extends Request
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_client', 'id_metering', 'id_delivery', 'price_delivery', 'id_mounting', 'price_mounting', 'type_price', 'id_company', 'type_deposit', 'status_price', 'status_request'], 'integer'],
            [['date_create', 'address', 'address_client_street', 'address_client_house', 'address_client_room', 'comment_request', 'date_metering_plan', 'date_metering'], 'safe'],
            [['price_company', 'price_request', 'deposit_transfer', 'deposit_cash'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchRequest($params)
    {
        $query = Request::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_client' => $this->id_client,
            'date_create' => $this->date_create,
            'id_metering' => $this->id_metering,
            'date_metering_plan' => $this->date_metering_plan,
            'date_metering' => $this->date_metering,
            'id_delivery' => $this->id_delivery,
            'price_delivery' => $this->price_delivery,
            'id_mounting' => $this->id_mounting,
            'price_mounting' => $this->price_mounting,
            'type_price' => $this->type_price,
            'id_company' => $this->id_company,
            'price_company' => $this->price_company,
            'price_request' => $this->price_request,
            'deposit_transfer' => $this->deposit_transfer,
            'deposit_cash' => $this->deposit_cash,
            'type_deposit' => $this->type_deposit,
            'status_price' => $this->status_price,
            'status_request' => $this->status_request,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address])
//            ->andFilterWhere(['like', 'address_client_street', $this->address_client_street])
//            ->andFilterWhere(['like', 'address_client_house', $this->address_client_house])
//            ->andFilterWhere(['like', 'address_client_room', $this->address_client_room])
            ->andFilterWhere(['like', 'comment_request', $this->comment_request]);

        return $dataProvider;
    }

    public function search($params)
    {
        $query = Request::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_client' => $this->id_client,
            'date_create' => $this->date_create,
            'id_metering' => $this->id_metering,
            'date_metering_plan' => $this->date_metering_plan,
            'date_metering' => $this->date_metering,
            'id_delivery' => $this->id_delivery,
            'price_delivery' => $this->price_delivery,
            'id_mounting' => $this->id_mounting,
            'price_mounting' => $this->price_mounting,
            'type_price' => $this->type_price,
            'id_company' => $this->id_company,
            'price_company' => $this->price_company,
            'price_request' => $this->price_request,
            'deposit_transfer' => $this->deposit_transfer,
            'deposit_cash' => $this->deposit_cash,
            'type_deposit' => $this->type_deposit,
            'status_price' => $this->status_price,
            'status_request' => $this->status_request,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'address_client_street', $this->address_client_street])
            ->andFilterWhere(['like', 'address_client_house', $this->address_client_house])
            ->andFilterWhere(['like', 'address_client_room', $this->address_client_room])
            ->andFilterWhere(['like', 'comment_request', $this->comment_request]);

        return $dataProvider;
    }

}
