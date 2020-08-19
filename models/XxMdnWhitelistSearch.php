<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MdnWhitelist;

/**
 * MdnWhitelistSearch represents the model behind the search form of `app\models\MdnWhitelist`.
 */
class XxMdnWhitelistSearch extends MdnWhitelist
{   

    
    
        /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tmw_id', 'tmw_aph_id'], 'integer'],
            [['tmw_name', 'tmw_mdn', 'first_user', 'first_ip', 'first_update', 'last_user', 'last_ip', 'last_update'], 'safe'],
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
        $query = MdnWhitelist::find();

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
            'tmw_id' => $this->tmw_id,
            'tmw_aph_id' => $this->tmw_aph_id,
            'first_update' => $this->first_update,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'tmw_name', $this->tmw_name])
            ->andFilterWhere(['like', 'tmw_mdn', $this->tmw_mdn])
            ->andFilterWhere(['like', 'first_user', $this->first_user])
            ->andFilterWhere(['like', 'first_ip', $this->first_ip])
            ->andFilterWhere(['like', 'last_user', $this->last_user])
            ->andFilterWhere(['like', 'last_ip', $this->last_ip]);
                
        return $dataProvider;
    }
}
