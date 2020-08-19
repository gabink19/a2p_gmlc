<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AuthItemChild;

/**
 * AuthItemChildSearch represents the model behind the search form of `app\models\AuthItemChild`.
 */
class AuthItemChildSearch extends AuthItemChild
{   

    
    
        /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent', 'child', 'first_user', 'first_ip', 'first_update', 'last_user', 'last_ip', 'last_update'], 'safe'],
            [['parent0name' ,'child0showName' ,], 'safe'],
            
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
        $query = AuthItemChild::find();

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
        //$query->joinWith('parent0 parent0name');
//$query->joinWith('child0 child0showName');
        
            $query->andFilterWhere([ 
               'parent' => $master_id]);         
        // grid filtering conditions
        $query->andFilterWhere([
            'first_update' => $this->first_update,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'parent', $this->parent])
            ->andFilterWhere(['like', 'child', $this->child])
            ->andFilterWhere(['like', 'first_user', $this->first_user])
            ->andFilterWhere(['like', 'first_ip', $this->first_ip])
            ->andFilterWhere(['like', 'last_user', $this->last_user])
            ->andFilterWhere(['like', 'last_ip', $this->last_ip]);
        //$query->andFilterWhere(['like', 'auth_item.name', $this->parent0name]);
//$query->andFilterWhere(['like', 'auth_item.showName', $this->child0showName]);
        
        return $dataProvider;
    }
}
