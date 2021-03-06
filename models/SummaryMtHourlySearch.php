<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SummaryMtHourly;

/**
 * SummaryMtHourlySearch represents the model behind the search form of `app\models\SummaryMtHourly`.
 */
class SummaryMtHourlySearch extends SummaryMtHourly
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'aph_id', 'status', 'total'], 'integer'],
            [['date', 'shortcode', 'error_code'], 'safe'],
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
        $query = SummaryMtHourly::find();
        if (isset($params['SummaryMtHourlySearch'])) {
            $query = SummaryMtHourly::find()
                ->select("*")
                ->where(['between','date',$params['SummaryMtHourlySearch']['startDate'].' 00:00:00',$params['SummaryMtHourlySearch']['endDate'].' 23:59:59']);
        }
        else 
            $query = SummaryMtHourly::find()
                    ->select("*")
                    ->where(['between','date','1970-01-01 00:00:00','1970-01-01 00:00:00']);

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
            'date' => $this->date,
            'aph_id' => $this->aph_id,
            'status' => $this->status,
            'total' => $this->total,
        ]);

        $query->andFilterWhere(['like', 'shortcode', $this->shortcode])
            ->andFilterWhere(['like', 'error_code', $this->error_code]);

        return $dataProvider;
    }
}
