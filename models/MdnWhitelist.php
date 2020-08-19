<?php

namespace app\models;

use Yii;




class MdnWhitelist extends XxMdnWhitelist{

static $parameter=['tmw_aph_id','tmw_name','tmw_mdn','first_user','first_ip','first_update','last_user','last_ip','last_update',]; 

    public $file;
    public $remove_file;

    public static function findOne($condition)
    {
        return parent::findOne($condition);
    }  
    
    public function save($runValidation = true, $attributeNames = null)
    {
        return parent::save($runValidation,$attributeNames);
    
    }
    
    public function delete(){
        return parent::delete();
    
    }

}
