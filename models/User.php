<?php

namespace app\models;
use Yii;


class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $tl_user_status_ref;
    public $tl_password_expire;
    public $tl_account_expire;
    public $tl_retry_count;
    public $result;
    public $roless;
    

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];

    public static function findData($causeStr){
        $result=AuthLogin::find()->where($causeStr)->one();
        if ($result!=null) {
                $user = new User();

                $user->id=$result->user_id;
                $q = "SELECT item_name from auth_assignment where user_id='".$user->id."'";
                $user->username=$result->tl_username;
                $user->password=$result->tl_password;
                $user->authKey=$result->tl_authKey;
                $user->accessToken=$result->tl_accessToken;
                $user->tl_user_status_ref=$result->tl_user_status_ref;
                $user->tl_password_expire=$result->tl_password_expire;
                $user->tl_account_expire=$result->tl_account_expire;
                $user->tl_retry_count=$result->tl_retry_count;
                $user->result=$result;
                $user->roless = Yii::$app->db->createCommand($q)->queryScalar();
                $session = \Yii::$app->session;
                $session['username']=$user->username;
                $session['id'] = $user->id;
                return $user;
            
            
        } else return null;
    }
    
    
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::findData("user_id='".$id."'");
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findData("tl_accessToken='".$token."'");
        /*
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;*/
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        /*
         foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
         */
        return self::findData("tl_username='".$username."'");
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        $comp_password=Yii::$app->id.$this->username.$password;
        /*
        $hash_password = Yii::$app->getSecurity()->generatePasswordHash($comp_password);
        
        echo ('user '.$this->username."<br>");
        
        echo('hash pasword'.$hash_password."<br>");
        $hash_password ='$2y$13$4uqGMGDhr5TiD2SDdqGqEerptCXh0yQQYO3S7UpxtA4qMrdeRoIsC';
        echo('hash pasword save'.$hash_password."<br>");
        echo ('secret '.Yii::$app->id."<br>");
        echo ('secret '.Yii::$app->params['secret_key']."<br>");
        if (Yii::$app->getSecurity()->validatePassword($comp_password, $hash_password)) {
            echo("true"."<br>");
        } else {
            echo("false"."<br>");
            // wrong password
        }
        exit();
         * 
        */
        
        try {
            if(is_null($this->password)) 
                return false;
            if ($this->result->tl_retry_count===null or $this->result->tl_retry_count>0) {
                if (Yii::$app->getSecurity()->validatePassword($comp_password, $this->password)) {
                    if ($this->result->tl_max_retry===null){
                       $tl_max_retry=10;   
                    } else {
                        $tl_max_retry=$this->result->tl_max_retry;
                    }
                    $this->result->tl_retry_count=$tl_max_retry;
                    $this->result->save();
                    return true;
                } else {
                    if ($this->result!=null) {
                        $this->result->tl_retry_count=$this->result->tl_retry_count-1;
                        $this->result->save();
                    }
                    return false;
                    // wrong password
                }
            } else {
                return false;
                
                
                
            }
        } catch(\yii\base\InvalidParamException $e) {
            return false;
        }
        //return $this->password === $hash_password;
        
    }
}
