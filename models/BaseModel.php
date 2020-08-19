<?php

namespace app\models;

use Yii;
use yii\db\Expression;

class BaseModel extends \yii\db\ActiveRecord
{
    
    public function beforeSave($insert) {
            $expression = new Expression('NOW()');
            $user_name=Yii::$app->session['username'];
            $location=Yii::$app->session['location'];
            if ($user_name==null) return false;
            if ($this->isNewRecord) {
                    $this->create_time = $expression;
                    $this->create_by=$user_name;
                    $this->create_on=$location;
                    

            } else {

                $this->update_time = $expression;
                $this->update_by=$user_name;
                $this->update_on=$location;
                   
            }

            return parent::beforeSave($insert);
    }    
}
?>