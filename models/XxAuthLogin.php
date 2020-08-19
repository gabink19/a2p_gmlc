<?php

namespace app\models;

use Yii;


include_once("functions.php");
include("AuthLogin_Config.php");

/**
 * This is the model class for table "auth_login".
 *
 * @property int $user_id
 * @property string $tl_name
 * @property string $tl_password
 * @property string $tl_authKey
 * @property string $tl_accessToken
 * @property string $first_user
 * @property string $first_ip
 * @property string $first_update
 * @property string $last_user
 * @property string $last_ip
 * @property string $last_update
 */
 
 
            
class XxAuthLogin extends \app\models\baseActiveRecord
{

    var $AuthLogin_config;
    function __construct() {
        parent::__construct();
        $this->AuthLogin_config=AuthLogin_config();
        
    
    }

    public $role;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_login';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tl_name', 'tl_password'], 'required'],
            [['first_update', 'last_update'], 'safe'],
            [['tl_name', 'tl_password', 'tl_authKey', 'tl_accessToken'], 'string', 'max' => 45],
            [['first_user', 'last_user'], 'string', 'max' => 50],
            [['first_ip', 'last_ip'], 'string', 'max' => 20],
        ];
    }
            
        
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
    public function attributeLabels()
    {
        return [
            'tl_name' => $this->flexParameter3('AuthLogin','tl_name','Name'),
'tl_password' => $this->flexParameter3('AuthLogin','tl_password','Password'),
'tl_authKey' => $this->flexParameter3('AuthLogin','tl_authKey','Auth Key'),
'tl_accessToken' => $this->flexParameter3('AuthLogin','tl_accessToken','Access Token'),
'first_user' => $this->flexParameter3('AuthLogin','first_user','User'),
'first_ip' => $this->flexParameter3('AuthLogin','first_ip','Ip'),
'first_update' => $this->flexParameter3('AuthLogin','first_update','Update'),
'last_user' => $this->flexParameter3('AuthLogin','last_user','User'),
'last_ip' => $this->flexParameter3('AuthLogin','last_ip','Ip'),
'last_update' => $this->flexParameter3('AuthLogin','last_update','Update'),
        ];
    }
                                                                                                                                                                                    

    
    
    
}
