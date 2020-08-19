<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ErrCodeSms;

/**
 * ErrCodeSmsSearch represents the model behind the search form of `app\models\ErrCodeSms`.
 */
class XxErrCodeSmsSearch extends ErrCodeSms
{   

    
    
        /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tecs_id', 'tecs_aph_id'], 'integer'],
            [['tecs_err_code', 'tecs_sms_template', 'first_user', 'first_ip', 'first_update', 'last_user', 'last_ip', 'last_update'], 'safe'],
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
        $query = ErrCodeSms::find();

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
            'tecs_id' => $this->tecs_id,
            'first_update' => $this->first_update,
            'last_update' => $this->last_update,
            'tecs_aph_id' => $this->tecs_aph_id,
        ]);

        $query->andFilterWhere(['like', 'tecs_err_code', $this->tecs_err_code])
            ->andFilterWhere(['like', 'tecs_sms_template', $this->tecs_sms_template])
            ->andFilterWhere(['like', 'first_user', $this->first_user])
            ->andFilterWhere(['like', 'first_ip', $this->first_ip])
            ->andFilterWhere(['like', 'last_user', $this->last_user])
            ->andFilterWhere(['like', 'last_ip', $this->last_ip]);
                
        return $dataProvider;
    }
}
