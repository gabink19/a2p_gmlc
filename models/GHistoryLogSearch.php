<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\XxGHistoryLogSearch;

class GHistoryLogSearch extends XxGHistoryLogSearch
{   

    public function search($params,$master_id=null)
    {
        return parent::search($params,$master_id);
    }

}
