<?php

namespace app\models;

use Yii;


include_once("functions.php");
include("ErrCodeSms_Config.php");

/**
* This is the model class for table "tbl_err_code_sms".
*
    * @property int $tecs_id
    * @property string $tecs_err_code 0 : success 			
 -1 : error default selain yg didefinisikan 			1-xxxxxx : error code yg didefinisikan
    * @property string $tecs_sms_template
    * @property string $first_user
    * @property string $first_ip
    * @property string $first_update
    * @property string $last_user
    * @property string $last_ip
    * @property string $last_update
    * @property int $tecs_aph_id
*/



class XxErrCodeSms extends \yii\db\ActiveRecord
{

public $constanta;
/**
* {@inheritdoc}
*/
public static function tableName()
{
return 'tbl_err_code_sms';
}


public function flexParameter3($className,$name,$xlabel){

$title=$this->ErrCodeSms_config['dataLabel'][$name]['name'];
if ($title==null or $title=="") {
return $xlabel;
} else {
return $title;
}

}
var $title_log='ErrCodeSms_config';
/**
* {@inheritdoc}
*/
public function rules()
{
return [
            [['first_update', 'last_update'], 'safe'],
            [['tecs_aph_id'], 'integer'],
            [['tecs_err_code', 'tecs_sms_template'], 'string', 'max' => 255],
            [['first_user', 'last_user'], 'string', 'max' => 50],
            [['first_ip', 'last_ip'], 'string', 'max' => 25],
        [[], 'safe'],
];
}


/**
* {@inheritdoc}
*/
public function attributeLabels()
{
return [
'tecs_err_code' => $this->flexParameter3('ErrCodeSms','tecs_err_code','Error Code'),
'tecs_sms_template' => $this->flexParameter3('ErrCodeSms','tecs_sms_template','SMS Template'),
'first_user' => $this->flexParameter3('ErrCodeSms','first_user','User'),
'first_ip' => $this->flexParameter3('ErrCodeSms','first_ip','Ip'),
'first_update' => $this->flexParameter3('ErrCodeSms','first_update','Update'),
'last_user' => $this->flexParameter3('ErrCodeSms','last_user','User'),
'last_ip' => $this->flexParameter3('ErrCodeSms','last_ip','Ip'),
'last_update' => $this->flexParameter3('ErrCodeSms','last_update','Update'),
];
}
                                        





var $ErrCodeSms_config;
function __construct() {
parent::__construct();
$this->ErrCodeSms_config=ErrCodeSms_config();

}

public function afterFind ( ){
parent::afterFind();
}
public function beforeDelete()
{
if (!parent::beforeDelete()) {
return false;
}
return true;


}


}