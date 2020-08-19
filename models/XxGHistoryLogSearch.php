<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GHistoryLog;

/**
 * GHistoryLogSearch represents the model behind the search form of `app\models\GHistoryLog`.
 */
class XxGHistoryLogSearch extends GHistoryLog
{   

    
    
        /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ghl_id', 'ghl_id_model'], 'integer'],
            [['ghl_userid', 'ghl_username', 'ghl_log', 'ghl_ip', 'ghl_date', 'ghl_model'], 'safe'],
            [[], 'safe'],
            
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
        $query = GHistoryLog::find();

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
            'ghl_id' => $this->ghl_id,
            'ghl_date' => $this->ghl_date,
            'ghl_id_model' => $this->ghl_id_model,
        ]);

        $query->andFilterWhere(['like', 'ghl_userid', $this->ghl_userid])
            ->andFilterWhere(['like', 'ghl_username', $this->ghl_username])
            ->andFilterWhere(['like', 'ghl_log', $this->ghl_log])
            ->andFilterWhere(['like', 'ghl_ip', $this->ghl_ip])
            ->andFilterWhere(['like', 'ghl_model', $this->ghl_model]);
                
        return $dataProvider;
    }
}
