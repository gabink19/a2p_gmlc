<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ReportGeneratorXSearch;

class RGXSearch extends ReportGeneratorXSearch
{   

    public function search($params,$master_id=null)
    {
        return parent::search($params,$master_id);
    }

}
