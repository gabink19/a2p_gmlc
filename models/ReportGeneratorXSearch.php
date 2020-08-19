<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ReportGeneratorX;

/**
 * ReportGeneratorXSearch represents the model behind the search form about `backend\models\ReportGeneratorX`.
 */
class ReportGeneratorXSearch extends ReportGeneratorX
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tj_id'], 'integer'],
            [['tj_name', 'tj_desc', 'tj_file'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = ReportGeneratorX::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'tj_id' => $this->tj_id,
        ]);

        $query->andFilterWhere(['like', 'tj_name', $this->tj_name])
            ->andFilterWhere(['like', 'tj_desc', $this->tj_desc])
            ->andFilterWhere(['like', 'tj_file', $this->tj_file]);

        $query->orderBy([
            'tj_id' => SORT_ASC,
        ]);

        return $dataProvider;
    }
}
