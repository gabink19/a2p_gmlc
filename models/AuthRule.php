<?php

namespace app\models;

use Yii;


include_once("functions.php");
include("AuthRule_Config.php");

/**
 * This is the model class for table "auth_rule".
 *
 * @property string $name
 * @property resource $data
 * @property string $first_user
 * @property string $first_ip
 * @property string $first_update
 * @property string $last_user
 * @property string $last_ip
 * @property string $last_update
 *
 * @property AuthItem[] $authItems
 */
 
 
            
class AuthRule extends \app\models\baseActiveRecord
{

    var $AuthRule_config;
    function __construct() {
        parent::__construct();
        $this->AuthRule_config=AuthRule_config();
        
    
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_rule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['data'], 'string'],
            [['first_update', 'last_update'], 'safe'],
            [['name'], 'string', 'max' => 64],
            [['first_user', 'last_user'], 'string', 'max' => 50],
            [['first_ip', 'last_ip'], 'string', 'max' => 20],
            [['name'], 'unique'],
        ];
    }
            
        
    public function flexParameter3($className,$name,$xlabel){
       
        $title=$this->AuthRule_config['dataLabel'][$name]['name'];
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
            'name' => $this->flexParameter3('AuthRule','name','Name'),
'data' => $this->flexParameter3('AuthRule','data','Data'),
'first_user' => $this->flexParameter3('AuthRule','first_user','User'),
'first_ip' => $this->flexParameter3('AuthRule','first_ip','Ip'),
'first_update' => $this->flexParameter3('AuthRule','first_update','Update'),
'last_user' => $this->flexParameter3('AuthRule','last_user','User'),
'last_ip' => $this->flexParameter3('AuthRule','last_ip','Ip'),
'last_update' => $this->flexParameter3('AuthRule','last_update','Update'),
        ];
    }
                                                                                                                                    

    
    
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItems()
    {
        return $this->hasMany(AuthItem::className(), ['rule_name' => 'name']);
    }
}
