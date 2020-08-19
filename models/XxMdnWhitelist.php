<?php

namespace app\models;

use Yii;


include_once("functions.php");
include("MdnWhitelist_Config.php");

/**
* This is the model class for table "tbl_mdn_whitelist".
*
    * @property int $tmw_id
    * @property int $tmw_aph_id
    * @property string $tmw_name
    * @property string $tmw_mdn
    * @property string $first_user
    * @property string $first_ip
    * @property string $first_update
    * @property string $last_user
    * @property string $last_ip
    * @property string $last_update
    *
            * @property TblAph $tmwAph
    */



class XxMdnWhitelist extends \yii\db\ActiveRecord
{


/**
* {@inheritdoc}
*/
public static function tableName()
{
return 'tbl_mdn_whitelist';
}


var $tmwaphaph_name;
public function flexParameter3($className,$name,$xlabel){

$title=$this->MdnWhitelist_config['dataLabel'][$name]['name'];
if ($title==null or $title=="") {
return $xlabel;
} else {
return $title;
}

}
var $title_log='MdnWhitelist_config';
/**
* {@inheritdoc}
*/
public function rules()
{
return [
            [['tmw_aph_id', 'tmw_name', 'tmw_mdn'], 'required'],
            [['file','remove_file'], 'file'],
            [['tmw_aph_id'], 'integer'],
            [['first_update', 'last_update'], 'safe'],
            [['tmw_name', 'first_user', 'last_user'], 'string', 'max' => 50],
            [['tmw_mdn'], 'string', 'max' => 20],
            [['first_ip', 'last_ip'], 'string', 'max' => 25],
            [['tmw_aph_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aph::className(), 'targetAttribute' => ['tmw_aph_id' => 'ta_id']],
        [[], 'safe'],
];
}


/**
* {@inheritdoc}
*/
public function attributeLabels()
{
return [
'tmwAph.aph_name' => $this->flexParameter3('MdnWhitelist','tmw_aph_id','APH'),
'tmwaphaph_name' => $this->flexParameter3('MdnWhitelist','tmw_aph_id','APH'),
'tmw_aph_id' => $this->flexParameter3('MdnWhitelist','tmw_aph_id','APH'),
'tmw_name' => $this->flexParameter3('MdnWhitelist','tmw_name','Name'),
'tmw_mdn' => $this->flexParameter3('MdnWhitelist','tmw_mdn','MDN'),
'first_user' => $this->flexParameter3('MdnWhitelist','first_user','User'),
'first_ip' => $this->flexParameter3('MdnWhitelist','first_ip','Ip'),
'first_update' => $this->flexParameter3('MdnWhitelist','first_update','Update'),
'last_user' => $this->flexParameter3('MdnWhitelist','last_user','User'),
'last_ip' => $this->flexParameter3('MdnWhitelist','last_ip','Ip'),
'last_update' => $this->flexParameter3('MdnWhitelist','last_update','Update'),
];
}
                                        





    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTmwAph()
    {
    return $this->hasOne(Aph::className(), ['ta_id' => 'tmw_aph_id']);
    }

var $MdnWhitelist_config;
function __construct() {
parent::__construct();
$this->MdnWhitelist_config=MdnWhitelist_config();

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