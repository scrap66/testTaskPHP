<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Distribution;

/**
 * DistributionSearch represents the model behind the search form of `app\models\Distribution`.
 */
class DistributionSearch extends Distribution
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_client', 'id_book', 'id_employee'], 'integer'],
            [['date_issue', 'period'], 'safe'],
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
        $query = Distribution::find();

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
            'date_issue' => $this->date_issue,
            'id_book' => $this->id_book,
            'id_employee' => $this->id_employee,
        ]);

        $query->andFilterWhere(['ilike', 'period', $this->period]);

        return $dataProvider;
    }
}
