<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SummaryTpsHourly;

/**
 * SummaryTpsHourlySearch represents the model behind the search form of `app\models\SummaryTpsHourly`.
 */
class SummaryTpsHourlySearch extends SummaryTpsHourly
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time', 'aph_id'], 'safe'],
            [['mo_tps_min', 'mo_tps_max', 'mo_tps_count', 'mt_tps_min', 'mt_tps_max', 'mt_tps_count', 'api_tps_min', 'api_tps_max', 'api_tps_count', 'dr_tps_min', 'dr_tps_max', 'dr_tps_count'], 'integer'],
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
        $query = SummaryTpsHourly::find();
        if (isset($params['SummaryTpsHourlySearch'])) {
            $query = SummaryTpsHourly::find()
                ->select("DATE_FORMAT(time, '%Y-%m-%d %H:00:00')AS `date`, max(mo_tps_max) AS `sms_mo`, max(mt_tps_max) AS `sms_mt`, max(api_tps_max) AS `api`, max(dr_tps_max) AS `dr`")
                ->where(['between','time',$params['SummaryTpsHourlySearch']['startDate'].' 00:00:00',$params['SummaryTpsHourlySearch']['endDate'].' 23:59:59'])
                // ->andFilterWhere(['site'=>$params['SummaryTpsHourly']['site']])
                ->groupBy(["DATE_FORMAT(time,'%Y-%m-%d %H')"]);
        }
        else 
            $query = SummaryTpsHourly::find()
                    ->select("DATE_FORMAT(time, '%Y-%m-%d %H:00:00')AS `date`, max(mo_tps_max) AS `sms_mo`, max(mt_tps_max) AS `sms_mt`, max(api_tps_max) AS `api`, max(dr_tps_max) AS `dr`")
                    ->where(['between','time','1970-01-01 00:00:00','1970-01-01 00:00:00'])
                    ->groupBy(["DATE_FORMAT(time,'%Y-%m-%d %H')"]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => ['date','sms_mo','sms_mt','api','dr'],
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
            'time' => $this->time,
            'mo_tps_min' => $this->mo_tps_min,
            'mo_tps_max' => $this->mo_tps_max,
            'mo_tps_count' => $this->mo_tps_count,
            'mt_tps_min' => $this->mt_tps_min,
            'mt_tps_max' => $this->mt_tps_max,
            'mt_tps_count' => $this->mt_tps_count,
            'api_tps_min' => $this->api_tps_min,
            'api_tps_max' => $this->api_tps_max,
            'api_tps_count' => $this->api_tps_count,
            'dr_tps_min' => $this->dr_tps_min,
            'dr_tps_max' => $this->dr_tps_max,
            'dr_tps_count' => $this->dr_tps_count,
        ]);

        $query->andFilterWhere(['like', 'aph_id', $this->aph_id]);

        return $dataProvider;
    }
}
