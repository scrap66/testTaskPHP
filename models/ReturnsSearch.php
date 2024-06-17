<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Returns;

/**
 * ReturnsSearch represents the model behind the search form of `app\models\Returns`.
 */
class ReturnsSearch extends Returns
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_distribution', 'id_book', 'id_employee'], 'integer'],
            [['condition', 'date_return'], 'safe'],
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
        $query = Returns::find();

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
            'id_distribution' => $this->id_distribution,
            'id_book' => $this->id_book,
            'id_employee' => $this->id_employee,
            'date_return' => $this->date_return,
        ]);

        $query->andFilterWhere(['ilike', 'condition', $this->condition]);

        return $dataProvider;
    }
}
