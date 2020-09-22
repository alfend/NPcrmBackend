<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Requisites;

/**
 * RequisitesSearch represents the model behind the search form of `app\models\Requisites`.
 */
class RequisitesSearch extends Requisites
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_user'], 'integer'],
            [['company', 'bank_name', 'address_company', 'director'], 'safe'],
            [['inn', 'kpp', 'bank_bik', 'account_calc', 'account_cor'], 'number'],
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
    public function search($params)
    {
        $query = Requisites::find();

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
            'id_user' => $this->id_user,
            'inn' => $this->inn,
            'kpp' => $this->kpp,
            'bank_bik' => $this->bank_bik,
            'account_calc' => $this->account_calc,
            'account_cor' => $this->account_cor,
        ]);

        $query->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'address_company', $this->address_company])
            ->andFilterWhere(['like', 'director', $this->director]);

        return $dataProvider;
    }
}
