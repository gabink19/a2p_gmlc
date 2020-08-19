<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AphTransactionHistory;

/**
 * AphTransactionHistorySearch represents the model behind the search form of `app\models\AphTransactionHistory`.
 */
class AphTransactionHistorySearch extends AphTransactionHistory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'direction', 'status', 'aph_id'], 'integer'],
            [['event_datetime', 'mdn', 'shortcode', 'content', 'error_code', 'msg_id', 'api_id'], 'safe'],
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
        $query = AphTransactionHistory::find();
        if (isset($params['AphTransactionHistorySearch'])) {
            $query = AphTransactionHistory::find()
                ->select("*")
                ->where(['between','event_datetime',$params['AphTransactionHistorySearch']['startDate'].' 00:00:00',$params['AphTransactionHistorySearch']['endDate'].' 23:59:59']);
        }
        else 
            $query = AphTransactionHistory::find()
                    ->select("*")
                    ->where(['between','event_datetime','1970-01-01 00:00:00','1970-01-01 00:00:00']);

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
            'event_datetime' => $this->event_datetime,
            'direction' => $this->direction,
            'status' => $this->status,
            'aph_id' => $this->aph_id,
        ]);

        $query->andFilterWhere(['like', 'mdn', $this->mdn])
            ->andFilterWhere(['like', 'shortcode', $this->shortcode])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'error_code', $this->error_code])
            ->andFilterWhere(['like', 'msg_id', $this->msg_id])
            ->andFilterWhere(['like', 'api_id', $this->api_id]);

        return $dataProvider;
    }
}
