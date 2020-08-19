<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\XxAuthLogin2Search;

class AuthLogin2Search extends XxAuthLogin2Search
{   

    public function search($params,$master_id=null)
    {
        return parent::search($params,$master_id);
    }

}
