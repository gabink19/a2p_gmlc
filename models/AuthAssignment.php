<?php

namespace app\models;

use Yii;


include_once("functions.php");
include("AuthAssignment_Config.php");

/**
* This is the model class for table "auth_assignment".
*
    * @property string $item_name
    * @property string $user_id
    * @property string $first_user
    * @property string $first_ip
    * @property string $first_update
    * @property string $last_user
    * @property string $last_ip
    * @property string $last_update
    *
            * @property AuthItem $itemName
            * @property AuthLogin $user
    */



class AuthAssignment extends \app\models\baseActiveRecord
{

var $AuthAssignment_config;
function __construct() {
parent::__construct();
$this->AuthAssignment_config=AuthAssignment_config();


}

/**
* {@inheritdoc}
*/
public static function tableName()
{
return 'auth_assignment';
}

/**
* {@inheritdoc}
*/
public function rules()
{
return [
            [['item_name', 'user_id'], 'required'],
            [['first_update', 'last_update'], 'safe'],
            [['item_name', 'user_id'], 'string', 'max' => 64],
            [['first_user', 'last_user'], 'string', 'max' => 50],
            [['first_ip', 'last_ip'], 'string', 'max' => 20],
            [['item_name', 'user_id'], 'unique', 'targetAttribute' => ['item_name', 'user_id']],
            [['item_name'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::className(), 'targetAttribute' => ['item_name' => 'name']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => AuthLogin::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
}

var $usertl_name;
var $itemnamename;

public function flexParameter3($className,$name,$xlabel){

$title=$this->AuthAssignment_config['dataLabel'][$name]['name'];
if ($title==null or $title=="") {
return $xlabel;
} else {
return $title;
}

}

/**
* {@inheritdoc}
*/
public function attributeLabels()
{
return [
'user.tl_name' => flexParameter2('AuthAssignment','user_id','ID'),
'usertl_name' => flexParameter2('AuthAssignment','user_id','ID'),
'user_id' => flexParameter2('AuthAssignment','user_id','ID'),
'itemName.name' => flexParameter2('AuthAssignment','item_name','item name'),
'itemnamename' => flexParameter2('AuthAssignment','item_name','item name'),
'item_name' => flexParameter2('AuthAssignment','item_name','item name'),
'first_user' => $this->flexParameter3('AuthAssignment','first_user','User'),
'first_ip' => $this->flexParameter3('AuthAssignment','first_ip','Ip'),
'first_update' => $this->flexParameter3('AuthAssignment','first_update','Update'),
'last_user' => $this->flexParameter3('AuthAssignment','last_user','User'),
'last_ip' => $this->flexParameter3('AuthAssignment','last_ip','Ip'),
'last_update' => $this->flexParameter3('AuthAssignment','last_update','Update'),
];
}
                                





    /**
    * @return \yii\db\ActiveQuery
    */
    public function getItemName()
    {
    return $this->hasOne(AuthItem::className(), ['name' => 'item_name']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUser()
    {
    return $this->hasOne(AuthLogin::className(), ['user_id' => 'user_id']);
    }
}
