<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $captcha;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['captcha', 'captcha','on' => ['login']]
            
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
                
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $user=$this->getUser();
            $now = time();
            if ($user->tl_user_status_ref==1){
                Yii::$app->session->setFlash('error', "user panding confirmation!"); 
                
                return 0;
            } else if ($user->tl_user_status_ref==2){
                Yii::$app->session->setFlash('error', "waiting aproval from admin!"); 
                return 0;
            } else if ($user->tl_user_status_ref==3){
                Yii::$app->session->setFlash('error', "account blocked, please contact admin!"); 
                return 0;
            } else if ($user->tl_user_status_ref==4){
                return 2;
            } else if ($user->tl_password_expire!==null and $now > strtotime($user->tl_password_expire)) {
                return 2;
            } else if ($user->tl_account_expire!==null and $now > strtotime($user->tl_account_expire)) {
                Yii::$app->session->setFlash('error', "account expire, please contact admin!"); 
                return 0;
            } else if ($user->tl_retry_count!==null and $user->tl_retry_count<=0) {
                Yii::$app->session->setFlash('error', "wrong password, max retries occurred!"); 
                return 0;
            } else if (Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30 : 0)) {
                return 1;
            }
        }
        return 0;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
