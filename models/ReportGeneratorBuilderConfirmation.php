<?php

namespace app\models;

use Yii;
use yii\base\Model;



// class XxGDepartment extends \yii\db\ActiveRecord
class ReportGeneratorBuilderConfirmation extends Model
{
    
    var $param1;
    
    public function rules()
{
return [
            [['$param1'], 'safe'],
        [[], 'safe'],
];
}
        


}
