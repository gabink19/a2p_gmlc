<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AuthAssignment;

/**
 * AuthAssignmentSearch represents the model behind the search form of `app\models\AuthAssignment`.
 */
class AuthAssignmentSearch extends AuthAssignment
{   

    
    
        /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id', 'first_user', 'first_ip', 'first_update', 'last_user', 'last_ip', 'last_update'], 'safe'],
            [['usertl_name' ,'itemnamename' ,], 'safe'],
            
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
        $query = AuthAssignment::find();

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
        //$query->joinWith('user usertl_name');
//$query->joinWith('itemName itemnamename');
        
            $query->andFilterWhere([ 
               'user_id' => $master_id]);         
        // grid filtering conditions
        $query->andFilterWhere([
            'first_update' => $this->first_update,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'first_user', $this->first_user])
            ->andFilterWhere(['like', 'first_ip', $this->first_ip])
            ->andFilterWhere(['like', 'last_user', $this->last_user])
            ->andFilterWhere(['like', 'last_ip', $this->last_ip]);
        //$query->andFilterWhere(['like', 'auth_login.tl_name', $this->usertl_name]);
//$query->andFilterWhere(['like', 'auth_item.name', $this->itemnamename]);
        
        return $dataProvider;
    }
}
