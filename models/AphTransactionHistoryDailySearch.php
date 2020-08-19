<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AphTransactionHistoryDaily;

/**
 * AphTransactionHistoryDailySearch represents the model behind the search form of `app\models\AphTransactionHistoryDaily`.
 */
class AphTransactionHistoryDailySearch extends AphTransactionHistoryDaily
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
        $query = AphTransactionHistoryDaily::find();
        if (isset($params['AphTransactionHistoryDailySearch'])) {
            $query = AphTransactionHistoryDaily::find()
                ->select("DATE_FORMAT(event_datetime, '%Y-%m-%d')AS `event_datetime`, `direction`, `status`, `aph_id`,  `shortcode`,  `error_code`, `api_id`, count(*) AS `total`")
                ->where(['between','event_datetime',$params['AphTransactionHistoryDailySearch']['startDate'].' 00:00:00',$params['AphTransactionHistoryDailySearch']['endDate'].' 23:59:59'])

                ->groupBy(["DATE_FORMAT(event_datetime,'%Y-%m-%d'), `aph_id`, `direction`,  `error_code`, `status`,  `shortcode`, `api_id`"]);
        }
        else 
            $query = AphTransactionHistoryDaily::find()
                    ->select("DATE_FORMAT(event_datetime, '%Y-%m-%d')AS `event_datetime`, `direction`, `status`, `aph_id`,  `shortcode`,  `error_code`, `api_id`, count(*) AS `total`")
                    ->where(['between','event_datetime','1970-01-01 00:00:00','1970-01-01 00:00:00'])
                    ->groupBy(["DATE_FORMAT(event_datetime,'%Y-%m-%d'), `aph_id`, `direction`,  `error_code`, `status`,  `shortcode`, `api_id`"]);

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
