<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AuthItem;

/**
 * AuthItemSearch represents the model behind the search form of `app\models\AuthItem`.
 */
class AuthItemSearch extends AuthItem
{   

    
    
        /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'rule_name', 'data', 'menu1', 'menu2', 'perent', 'menu_label', 'menu_url', 'first_user', 'first_ip', 'first_update', 'last_user', 'last_ip', 'last_update'], 'safe'],
            [['type'], 'integer'],
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
        $query = AuthItem::find();

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
            'type' => $this->type,
            'first_update' => $this->first_update,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'rule_name', $this->rule_name])
            ->andFilterWhere(['like', 'data', $this->data])
            ->andFilterWhere(['like', 'menu1', $this->menu1])
            ->andFilterWhere(['like', 'menu2', $this->menu2])
            ->andFilterWhere(['like', 'perent', $this->perent])
            ->andFilterWhere(['like', 'menu_label', $this->menu_label])
            ->andFilterWhere(['like', 'menu_url', $this->menu_url])
            ->andFilterWhere(['like', 'first_user', $this->first_user])
            ->andFilterWhere(['like', 'first_ip', $this->first_ip])
            ->andFilterWhere(['like', 'last_user', $this->last_user])
            ->andFilterWhere(['like', 'last_ip', $this->last_ip]);
                
        return $dataProvider;
    }
}
