<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Aph;

/**
 * AphSearch represents the model behind the search form of `app\models\Aph`.
 */
class XxAphSearch extends Aph
{   

    
    
        /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ta_id'], 'integer'],
            [['ta_name', 'ta_desc', 'ta_api_username', 'ta_api_password', 'first_user', 'first_ip', 'first_update', 'last_user', 'last_ip', 'last_update'], 'safe'],
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
        $query = Aph::find();

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
            'ta_id' => $this->ta_id,
            'first_update' => $this->first_update,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'ta_name', $this->ta_name])
            ->andFilterWhere(['like', 'ta_desc', $this->ta_desc])
            ->andFilterWhere(['like', 'ta_api_username', $this->ta_api_username])
            ->andFilterWhere(['like', 'ta_api_password', $this->ta_api_password])
            ->andFilterWhere(['like', 'first_user', $this->first_user])
            ->andFilterWhere(['like', 'first_ip', $this->first_ip])
            ->andFilterWhere(['like', 'last_user', $this->last_user])
            ->andFilterWhere(['like', 'last_ip', $this->last_ip]);
                
        return $dataProvider;
    }
}
