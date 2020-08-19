<?php

namespace app\models;

use Yii;


include_once("functions.php");
include("AuthItem3_Config.php");

/**
* This is the model class for table "auth_item".
*
    * @property string $name
    * @property int $type
    * @property string $description
    * @property string $rule_name
    * @property resource $data
    * @property string $menu1
    * @property string $menu2
    * @property string $menu3
    * @property string $menu_label
    * @property string $menu_url
    * @property string $first_user
    * @property string $first_ip
    * @property string $first_update
    * @property string $last_user
    * @property string $last_ip
    * @property string $last_update
    *
            * @property AuthAssignment[] $authAssignments
            * @property AuthLogin[] $users
            * @property AuthRule $ruleName
            * @property AuthItemChild[] $authItemChildren
            * @property AuthItemChild[] $authItemChildren0
            * @property AuthItem3[] $children
            * @property AuthItem3[] $parents
    */



class AuthItem3 extends \app\models\baseActiveRecord
{

var $AuthItem3_config;
function __construct() {
parent::__construct();
$this->AuthItem3_config=AuthItem3_config();


}

/**
* {@inheritdoc}
*/
public static function tableName()
{
return 'auth_item';
}

/**
* {@inheritdoc}
*/
public function rules()
{
return [
            [['name', 'type'], 'required'],
            [['type'], 'integer'],
            [['data'], 'string'],
            [['first_update', 'last_update'], 'safe'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 1000],
            [['menu1', 'menu2', 'menu3', 'menu_label', 'menu_url'], 'string', 'max' => 450],
            [['first_user', 'last_user'], 'string', 'max' => 50],
            [['first_ip', 'last_ip'], 'string', 'max' => 20],
            [['name'], 'unique'],
            [['rule_name'], 'exist', 'skipOnError' => true, 'targetClass' => AuthRule::className(), 'targetAttribute' => ['rule_name' => 'name']],
        ];
}


public function flexParameter3($className,$name,$xlabel){

$title=$this->AuthItem3_config['dataLabel'][$name]['name'];
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
'name' => $this->flexParameter3('AuthItem3','name','Name'),
'type' => $this->flexParameter3('AuthItem3','type','Type'),
'description' => $this->flexParameter3('AuthItem3','description','Description'),
'rule_name' => $this->flexParameter3('AuthItem3','rule_name','Name'),
'data' => $this->flexParameter3('AuthItem3','data','Data'),
'menu1' => $this->flexParameter3('AuthItem3','menu1','Menu1'),
'menu2' => $this->flexParameter3('AuthItem3','menu2','Menu2'),
'menu3' => $this->flexParameter3('AuthItem3','menu3','Menu3'),
'menu_label' => $this->flexParameter3('AuthItem3','menu_label','Label'),
'menu_url' => $this->flexParameter3('AuthItem3','menu_url','Url'),
'first_user' => $this->flexParameter3('AuthItem3','first_user','User'),
'first_ip' => $this->flexParameter3('AuthItem3','first_ip','Ip'),
'first_update' => $this->flexParameter3('AuthItem3','first_update','Update'),
'last_user' => $this->flexParameter3('AuthItem3','last_user','User'),
'last_ip' => $this->flexParameter3('AuthItem3','last_ip','Ip'),
'last_update' => $this->flexParameter3('AuthItem3','last_update','Update'),
];
}
                                                                





    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAuthAssignments()
    {
    return $this->hasMany(AuthAssignment::className(), ['item_name' => 'name']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUsers()
    {
    return $this->hasMany(AuthLogin::className(), ['user_id' => 'user_id'])->viaTable('auth_assignment', ['item_name' => 'name']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getRuleName()
    {
    return $this->hasOne(AuthRule::className(), ['name' => 'rule_name']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAuthItemChildren()
    {
    return $this->hasMany(AuthItemChild::className(), ['parent' => 'name']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAuthItemChildren0()
    {
    return $this->hasMany(AuthItemChild::className(), ['child' => 'name']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getChildren()
    {
    return $this->hasMany(AuthItem3::className(), ['name' => 'child'])->viaTable('auth_item_child', ['parent' => 'name']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getParents()
    {
    return $this->hasMany(AuthItem3::className(), ['name' => 'parent'])->viaTable('auth_item_child', ['child' => 'name']);
    }
}
