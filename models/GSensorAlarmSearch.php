<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GSensorAlarm;

/**
 * GSensorAlarmSearch represents the model behind the search form of `app\models\GSensorAlarm`.
 */
class GSensorAlarmSearch extends GSensorAlarm
{   

    
    
        /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gsa_id', 'gsa_value', 'gsa_alarm_mode_ref', 'g_sensor_db_gsd_id', 'f_sensor_detail_fsd_id', 'g_customer_gc_id'], 'integer'],
            [['gsa_name', 'first_user', 'first_ip', 'first_update', 'last_user', 'last_ip', 'last_update'], 'safe'],
            [['gsensordbgsdfgk_name' ,'fsensordetailfsdfgk_name' ,'gcustomergcfgk_name' ,], 'safe'],
            
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
    public function search($params,$master_id=null)
    {
        $query = GSensorAlarm::find();

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
        //$query->joinWith('gSensorDbGsd gsensordbgsdfgk_name');
//$query->joinWith('fSensorDetailFsd fsensordetailfsdfgk_name');
//$query->joinWith('gCustomerGc gcustomergcfgk_name');
        
                    
        // grid filtering conditions
        $query->andFilterWhere([
            'gsa_id' => $this->gsa_id,
            'gsa_value' => $this->gsa_value,
            'gsa_alarm_mode_ref' => $this->gsa_alarm_mode_ref,
            'g_sensor_db_gsd_id' => $this->g_sensor_db_gsd_id,
            'f_sensor_detail_fsd_id' => $this->f_sensor_detail_fsd_id,
            'first_update' => $this->first_update,
            'last_update' => $this->last_update,
            'g_customer_gc_id' => $this->g_customer_gc_id,
        ]);

        $query->andFilterWhere(['like', 'gsa_name', $this->gsa_name])
            ->andFilterWhere(['like', 'first_user', $this->first_user])
            ->andFilterWhere(['like', 'first_ip', $this->first_ip])
            ->andFilterWhere(['like', 'last_user', $this->last_user])
            ->andFilterWhere(['like', 'last_ip', $this->last_ip]);
        //$query->andFilterWhere(['like', 'g_sensor_db.gsd_name', $this->gsensordbgsdfgk_name]);
//$query->andFilterWhere(['like', 'f_sensor_detail.fsd_name', $this->fsensordetailfsdfgk_name]);
//$query->andFilterWhere(['like', 'g_customer.gc_name', $this->gcustomergcfgk_name]);
        
        return $dataProvider;
    }
}
