<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SmsByDr;

/**
 * SmsByDrSearch represents the model behind the search form of `app\models\SmsByDr`.
 */
class SmsByDrSearch extends SmsByDr
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'direction', 'status', 'aph_id'], 'integer'],
            [['event_datetime', 'mdn', 'shortcode', 'content', 'error_code', 'msg_id', 'api_id','total','date'], 'safe'],
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
        $query = SmsByDr::find();
        if (isset($params['SmsByDrSearch'])) {
            $query = SmsByDr::find()
                ->select("DATE_FORMAT(event_datetime, '%Y-%m-%d')AS `date`, `status`, `aph_id`,  `shortcode`,  `error_code`, count(*) AS `total`, `msg_id`")
                ->where(['between','event_datetime',$params['SmsByDrSearch']['startDate'].' 00:00:00',$params['SmsByDrSearch']['endDate'].' 23:59:59'])
                ->andWhere(['=','direction',1])
                // ->andWhere(['=','status',1])

                ->groupBy(["DATE_FORMAT(event_datetime,'%Y-%m-%d'), `aph_id`,  `error_code`, `status`,  `shortcode`, `msg_id`"]);
        }
        else 
            $query = SmsByDr::find()
                    ->select("DATE_FORMAT(event_datetime, '%Y-%m-%d')AS `date`, `status`, `aph_id`,  `shortcode`,  `error_code`, count(*) AS `total`, `msg_id`")
                    ->where(['between','event_datetime','1970-01-01 00:00:00','1970-01-01 00:00:00'])
                    ->groupBy(["DATE_FORMAT(event_datetime,'%Y-%m-%d'), `aph_id`,  `error_code`, `status`,  `shortcode`, `msg_id`"]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => ['date','shortcode','direction','status','error_code','aph_id','total'],
            ],
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
