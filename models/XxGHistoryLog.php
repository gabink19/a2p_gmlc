<?php

namespace app\models;

use Yii;


include_once("functions.php");
include("GHistoryLog_Config.php");

/**
* This is the model class for table "g_history_log".
*
    * @property int $ghl_id
    * @property string $ghl_userid
    * @property string $ghl_username
    * @property resource $ghl_log
    * @property string $ghl_ip
    * @property string $ghl_date
    * @property int $ghl_id_model
    * @property string $ghl_model
*/



class XxGHistoryLog extends \app\models\baseActiveRecord
{


/**
* {@inheritdoc}
*/
public static function tableName()
{
return 'g_history_log';
}


public function getGhlDateStr() {
	return date('Y-m-d', strtotime($this->ghl_date));	}
var $ghldatestr;
public function flexParameter3($className,$name,$xlabel){

$title=$this->GHistoryLog_config['dataLabel'][$name]['name'];
if ($title==null or $title=="") {
return $xlabel;
} else {
return $title;
}

}
var $title_log='GHistoryLog_config';
/**
* {@inheritdoc}
*/
public function rules()
{
return [
            [['ghl_log'], 'string'],
            [['ghl_date'], 'safe'],
            [['ghl_id_model'], 'integer'],
            [['ghl_userid'], 'string', 'max' => 64],
            [['ghl_username', 'ghl_ip'], 'string', 'max' => 45],
            [['ghl_model'], 'string', 'max' => 50],
        [[], 'safe'],
];
}


/**
* {@inheritdoc}
*/
public function attributeLabels()
{
return [
'ghl_userid' => $this->flexParameter3('GHistoryLog','ghl_userid','Userid'),
'ghl_username' => $this->flexParameter3('GHistoryLog','ghl_username','Username'),
'ghl_log' => $this->flexParameter3('GHistoryLog','ghl_log','Log'),
'ghl_ip' => $this->flexParameter3('GHistoryLog','ghl_ip','Ip'),
'ghlDateStr' => $this->flexParameter3('GHistoryLog','ghl_date','date'),
'ghldatestr' => $this->flexParameter3('GHistoryLog','ghl_date','date'),
'ghl_date' => $this->flexParameter3('GHistoryLog','ghl_date','date'),
'ghl_id_model' => $this->flexParameter3('GHistoryLog','ghl_id_model','Id Model'),
'ghl_model' => $this->flexParameter3('GHistoryLog','ghl_model','Model'),
];
}
                                





var $GHistoryLog_config;
function __construct() {
parent::__construct();
$this->GHistoryLog_config=GHistoryLog_config();

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