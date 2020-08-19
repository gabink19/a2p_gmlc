<?php

namespace app\models;

use Yii;


include_once("functions.php");
include("AuthItemChild_Config.php");

/**
* This is the model class for table "auth_item_child".
*
    * @property string $parent
    * @property string $child
    * @property string $first_user
    * @property string $first_ip
    * @property string $first_update
    * @property string $last_user
    * @property string $last_ip
    * @property string $last_update
    *
            * @property AuthItem $parent0
            * @property AuthItem $child0
    */



class AuthItemChild extends \app\models\baseActiveRecord
{

var $AuthItemChild_config;
function __construct() {
parent::__construct();
$this->AuthItemChild_config=AuthItemChild_config();


}

/**
* {@inheritdoc}
*/
public static function tableName()
{
return 'auth_item_child';
}

/**
* {@inheritdoc}
*/
public function rules()
{
return [
            [['parent', 'child'], 'required'],
            [['first_update', 'last_update'], 'safe'],
            [['parent', 'child'], 'string', 'max' => 64],
            [['first_user', 'last_user'], 'string', 'max' => 50],
            [['first_ip', 'last_ip'], 'string', 'max' => 20],
            [['parent', 'child'], 'unique', 'targetAttribute' => ['parent', 'child']],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::className(), 'targetAttribute' => ['parent' => 'name']],
            [['child'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::className(), 'targetAttribute' => ['child' => 'name']],
        ];
}

var $parent0name;
var $child0showname;

public function flexParameter3($className,$name,$xlabel){

$title=$this->AuthItemChild_config['dataLabel'][$name]['name'];
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
'parent0.name' => flexParameter2('AuthItemChild','parent','Parent'),
'parent0name' => flexParameter2('AuthItemChild','parent','Parent'),
'parent' => flexParameter2('AuthItemChild','parent','Parent'),
'child0.showName' => flexParameter2('AuthItemChild','child','Child'),
'child0showname' => flexParameter2('AuthItemChild','child','Child'),
'child' => flexParameter2('AuthItemChild','child','Child'),
'first_user' => $this->flexParameter3('AuthItemChild','first_user','User'),
'first_ip' => $this->flexParameter3('AuthItemChild','first_ip','Ip'),
'first_update' => $this->flexParameter3('AuthItemChild','first_update','Update'),
'last_user' => $this->flexParameter3('AuthItemChild','last_user','User'),
'last_ip' => $this->flexParameter3('AuthItemChild','last_ip','Ip'),
'last_update' => $this->flexParameter3('AuthItemChild','last_update','Update'),
];
}
                                





    /**
    * @return \yii\db\ActiveQuery
    */
    public function getParent0()
    {
    return $this->hasOne(AuthItem::className(), ['name' => 'parent']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getChild0()
    {
    return $this->hasOne(AuthItem::className(), ['name' => 'child']);
    }
}
