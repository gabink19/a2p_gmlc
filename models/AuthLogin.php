<?php

namespace app\models;

use Yii;


include_once("functions.php");
include("AuthLogin_Config.php");

/**
* This is the model class for table "auth_login".
*
    * @property string $user_id
    * @property string $tl_username
    * @property string $tl_password
    * @property string $tl_authKey
    * @property string $tl_accessToken
    * @property string $first_user
    * @property string $first_ip
    * @property string $first_update
    * @property string $last_user
    * @property string $last_ip
    * @property string $last_update
    * @property string $tl_password_expire
    * @property string $tl_account_expire
    * @property int $tl_change_password_duration
    * @property int $tl_user_status_ref
    * @property string $tl_email
    * @property string $tl_phone_number
    * @property string $tl_address
    * @property string $tl_city
    * @property string $tl_country
    * @property int $tl_retry_count
    * @property int $tl_max_retry
    *
            * @property AuthAssignment[] $authAssignments
            * @property AuthItem[] $itemNames
            * @property GCustomer $gCustomerGc
    */



class AuthLogin extends \app\models\baseActiveRecord
{


public $role;
/**
* {@inheritdoc}
*/
public static function tableName()
{
return 'auth_login';
}


public function getTlUserStatusRefStr() {
return Yii::$app->params['userStatus'][$this->tl_user_status_ref];
}
var $tl_password_old;
var $tl_password_new;
var $tl_password_new2;
var $capcha;
var $gcustomergcgc_name;
public function getTlAccountExpireStr() {
    return date('Y-m-d', strtotime($this->tl_account_expire));  }
var $tlaccountexpirestr;
public function getTlPasswordExpireStr() {
    return date('Y-m-d', strtotime($this->tl_password_expire)); }
var $tlpasswordexpirestr;

public function flexParameter3($className,$name,$xlabel){

    $title=$this->AuthLogin_config['dataLabel'][$name]['name'];
    if ($title==null or $title=="") {
        return $xlabel;
    } else {
        return $title;
    }

}

/**
* {@inheritdoc}
*/
public function rules()
{
return [
            [['user_id', 'tl_username'], 'required'],
            [['first_update', 'last_update', 'tl_password_expire', 'tl_account_expire'], 'safe'],
            [['tl_change_password_duration', 'tl_user_status_ref', 'tl_retry_count', 'tl_max_retry'], 'integer'],
            [['user_id', 'tl_username', 'tl_password', 'tl_authKey', 'tl_accessToken'], 'string', 'max' => 64],
            [['first_user', 'last_user'], 'string', 'max' => 50],
            [['first_ip', 'last_ip'], 'string', 'max' => 20],
            [['tl_email', 'tl_phone_number', 'tl_address', 'tl_city', 'tl_country'], 'string', 'max' => 45],
            [['tl_username'], 'unique'],
            [['user_id'], 'unique'],
            [[], 'safe'],
            ['tl_password_old',  'required','on' => ['change_password']],
            ['tl_password_new',  'required','on' => ['change_password','signup']],
            ['tl_password_new',\kartik\password\StrengthValidator::className(), 'preset'=>'normal','userAttribute'=>'tl_username'],['tl_password_new2',  'compare', 'compareAttribute' => 'tl_password_new'],
            ['tl_password_new2',  'required','on' => ['change_password','signup']],
            ['capcha',  'captcha','on' => ['change_password','signup']],
        ];
}

var $title_log='AuthLogin_config';
/**
* {@inheritdoc}
*/
public function attributeLabels()
{
return [
'tlUserStatusRefStr' => $this->flexParameter3('AuthLogin','tl_user_status_ref','status'),
'tl_user_status_ref' => $this->flexParameter3('AuthLogin','tl_user_status_ref','status'),
'tl_username' => $this->flexParameter3('AuthLogin','tl_username','Username'),
'tl_password_old' => $this->flexParameter3('AuthLogin','tl_password_old','Password(old)'),
'tl_password_new' => $this->flexParameter3('AuthLogin','tl_password_new','Password(new)'),
'tl_password_new2' => $this->flexParameter3('AuthLogin','tl_password_new2','password(retype)'),
'tl_password' => $this->flexParameter3('AuthLogin','tl_password','Password'),
'capcha' => $this->flexParameter3('AuthLogin','capcha','capcha'),
'tl_authKey' => $this->flexParameter3('AuthLogin','tl_authKey','Auth Key'),
'tl_accessToken' => $this->flexParameter3('AuthLogin','tl_accessToken','Access Token'),
'first_user' => $this->flexParameter3('AuthLogin','first_user','User'),
'first_ip' => $this->flexParameter3('AuthLogin','first_ip','Ip'),
'first_update' => $this->flexParameter3('AuthLogin','first_update','Update'),
'last_user' => $this->flexParameter3('AuthLogin','last_user','User'),
'last_ip' => $this->flexParameter3('AuthLogin','last_ip','Ip'),
'last_update' => $this->flexParameter3('AuthLogin','last_update','Update'),

'tl_phone_number' => $this->flexParameter3('AuthLogin','tl_phone_number','Phone '),
'tl_email' => $this->flexParameter3('AuthLogin','tl_email','Email'),
'tl_address' => $this->flexParameter3('AuthLogin','tl_address','Address'),
'tl_city' => $this->flexParameter3('AuthLogin','tl_city','City'),
'tl_country' => $this->flexParameter3('AuthLogin','tl_country','Country'),
'tlAccountExpireStr' => $this->flexParameter3('AuthLogin','tl_account_expire','Account Expire'),
'tlaccountexpirestr' => $this->flexParameter3('AuthLogin','tl_account_expire','Account Expire'),
'tl_account_expire' => $this->flexParameter3('AuthLogin','tl_account_expire','Account Expire'),
'tlPasswordExpireStr' => $this->flexParameter3('AuthLogin','tl_password_expire','Password Expire'),
'tlpasswordexpirestr' => $this->flexParameter3('AuthLogin','tl_password_expire','Password Expire'),
'tl_password_expire' => $this->flexParameter3('AuthLogin','tl_password_expire','Password Expire'),
'tl_change_password_duration' => $this->flexParameter3('AuthLogin','tl_change_password_duration','duration'),
'tl_retry_count' => $this->flexParameter3('AuthLogin','tl_retry_count','Retry Count'),
'tl_max_retry' => $this->flexParameter3('AuthLogin','tl_max_retry','Max Retry'),
];
}
                                                                                                





    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAuthAssignments()
    {
    return $this->hasMany(AuthAssignment::className(), ['user_id' => 'user_id']);
    }

    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['tg_id' => 'tg_id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getItemNames()
    {
    return $this->hasMany(AuthItem::className(), ['name' => 'item_name'])->viaTable('auth_assignment', ['user_id' => 'user_id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
   

var $AuthLogin_config;
function __construct() {
    parent::__construct();
    $this->AuthLogin_config=AuthLogin_config();
    
}

public function afterFind ( ){
    parent::afterFind();
    }
    
}
