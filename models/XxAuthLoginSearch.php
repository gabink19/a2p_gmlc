<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AuthLogin;

/**
 * AuthLoginSearch represents the model behind the search form of `app\models\AuthLogin`.
 */
class XxAuthLoginSearch extends AuthLogin
{   

    
    
        /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'tl_username', 'tl_password', 'tl_authKey', 'tl_accessToken', 'first_user', 'first_ip', 'first_update', 'last_user', 'last_ip', 'last_update', 'tl_password_expire', 'tl_account_expire', 'tl_email', 'tl_phone_number', 'tl_address', 'tl_city', 'tl_country'], 'safe'],
            [[ 'tl_change_password_duration', 'tl_user_status_ref', 'tl_retry_count', 'tl_max_retry'], 'integer'],
            [['tl_password_old','tl_password_new','tl_password_new2','capcha','gcustomergcgc_name' ,'tlaccountexpirestr','tlpasswordexpirestr',], 'safe'],
            
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
        $query = AuthLogin::find();

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
        //$query->joinWith('gCustomerGc gcustomergcgc_name');
        
                    
        // grid filtering conditions
        $query->andFilterWhere([
            'first_update' => $this->first_update,
            'last_update' => $this->last_update,
            // 'g_customer_gc_id' => $this->g_customer_gc_id,
            'tl_password_expire' => $this->tl_password_expire,
            'tl_account_expire' => $this->tl_account_expire,
            'tl_change_password_duration' => $this->tl_change_password_duration,
            'tl_user_status_ref' => $this->tl_user_status_ref,
            'tl_retry_count' => $this->tl_retry_count,
            'tl_max_retry' => $this->tl_max_retry,
        ]);

        $query->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'tl_username', $this->tl_username])
            ->andFilterWhere(['like', 'tl_password', $this->tl_password])
            ->andFilterWhere(['like', 'tl_authKey', $this->tl_authKey])
            ->andFilterWhere(['like', 'tl_accessToken', $this->tl_accessToken])
            ->andFilterWhere(['like', 'first_user', $this->first_user])
            ->andFilterWhere(['like', 'first_ip', $this->first_ip])
            ->andFilterWhere(['like', 'last_user', $this->last_user])
            ->andFilterWhere(['like', 'last_ip', $this->last_ip])
            ->andFilterWhere(['like', 'tl_email', $this->tl_email])
            ->andFilterWhere(['like', 'tl_phone_number', $this->tl_phone_number])
            ->andFilterWhere(['like', 'tl_address', $this->tl_address])
            // ->andFilterWhere(['like', 'tl_address2', $this->tl_address2])
            ->andFilterWhere(['like', 'tl_city', $this->tl_city])
            ->andFilterWhere(['like', 'tl_country', $this->tl_country]);
        //$query->andFilterWhere(['like', 'g_customer.gc_name', $this->gcustomergcgc_name]);
$query->andFilterWhere(['like', 'tl_account_expire', $this->tlaccountexpirestr]);
$query->andFilterWhere(['like', 'tl_password_expire', $this->tlpasswordexpirestr]);
        
        return $dataProvider;
    }
}
