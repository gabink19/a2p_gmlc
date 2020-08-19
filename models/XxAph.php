<?php

namespace app\models;

use Yii;


include_once("functions.php");
include("Aph_Config.php");

/**
* This is the model class for table "tbl_aph".
*
    * @property int $ta_id
    * @property string $ta_name
    * @property string $ta_desc
    * @property string $ta_api_username
    * @property string $ta_api_password
    * @property string $first_user
    * @property string $first_ip
    * @property string $first_update
    * @property string $last_user
    * @property string $last_ip
    * @property string $last_update
    *
            * @property TblAphTransactionHistory[] $tblAphTransactionHistories
            * @property TblMdnWhitelist[] $tblMdnWhitelists
    */



class XxAph extends \yii\db\ActiveRecord
{


/**
* {@inheritdoc}
*/
public static function tableName()
{
return 'tbl_aph';
}


public function flexParameter3($className,$name,$xlabel){

$title=$this->Aph_config['dataLabel'][$name]['name'];
if ($title==null or $title=="") {
return $xlabel;
} else {
return $title;
}

}
var $title_log='Aph_config';
/**
* {@inheritdoc}
*/
public function rules()
{
return [
            [['ta_name', 'ta_desc', 'ta_api_username', 'ta_api_password'], 'required'],
            [['first_update', 'last_update'], 'safe'],
            [['ta_name', 'ta_desc', 'ta_api_username', 'first_user', 'last_user'], 'string', 'max' => 50],
            [['ta_api_password'], 'string', 'max' => 100],
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
'ta_name' => $this->flexParameter3('Aph','ta_name','Name'),
'ta_desc' => $this->flexParameter3('Aph','ta_desc','Desc'),
'ta_api_username' => $this->flexParameter3('Aph','ta_api_username','API Username'),
'ta_api_password' => $this->flexParameter3('Aph','ta_api_password','API Password'),
'first_user' => $this->flexParameter3('Aph','first_user','User'),
'first_ip' => $this->flexParameter3('Aph','first_ip','Ip'),
'first_update' => $this->flexParameter3('Aph','first_update','Update'),
'last_user' => $this->flexParameter3('Aph','last_user','User'),
'last_ip' => $this->flexParameter3('Aph','last_ip','Ip'),
'last_update' => $this->flexParameter3('Aph','last_update','Update'),
];
}
                                            





    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTblAphTransactionHistories()
    {
    // return $this->hasMany(AphTransactionHistory::className(), ['aph_id' => 'ta_id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTblMdnWhitelists()
    {
    return $this->hasMany(MdnWhitelist::className(), ['tmw_aph_id' => 'ta_id']);
    }

var $Aph_config;
function __construct() {
parent::__construct();
$this->Aph_config=Aph_config();

}

public function afterFind ( ){
parent::afterFind();
}
public function beforeDelete()
{
if (!parent::beforeDelete()) {
return false;
}
            if($this->tblAphTransactionHistories!=null) {
        return false;
        }
                if($this->tblMdnWhitelists!=null) {
        return false;
        }
    return true;


}


}