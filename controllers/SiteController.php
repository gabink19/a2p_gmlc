<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public $successUrl = '';
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
                'successUrl' => $this->successUrl
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'momt' => $this->actionMoMt(1),
            'tps' => $this->actionTps(1),
        ]);
    }
    public function actionMoMt($type=0)
    {
        $dateto = date('Y-m-d H:00:00');
        $datefrom = date('Y-m-d H:00:00', strtotime( '-1 day', strtotime($dateto)));
        $timelist = $this->getListTanggal($datefrom,$dateto);
        $timelist_mo = [];
        $timelist_mt = [];
        $result = [];
        foreach ($timelist as $key => $value) {
            $timelist_mo[$value] = 0;
        }
        foreach ($timelist as $key => $value) {
            $timelist_mt[$value] = 0;
        }
        // echo "<pre>"; print_r($timelist_mo);echo "</pre>";die();

        $query = "SELECT DATE_FORMAT(`date`, '%Y-%m-%d %H:00:00')AS `date`,sum(total) as `total` FROM tbl_summary_hourly_mo WHERE `date` between '".$datefrom."' and '".$dateto."' group by DATE_FORMAT(`date`, '%Y-%m-%d %H:00:00')";
        $hasil = Yii::$app->db->createCommand($query)->queryAll();
        foreach ($hasil as $key => $value) {
           $timelist_mo[$value['date']] = (int)$value['total'];        
        }

        $query = "SELECT DATE_FORMAT(`date`, '%Y-%m-%d %H:00:00')AS `date`,sum(total) as `total` FROM tbl_summary_hourly_mt WHERE `date` between '".$datefrom."' and '".$dateto."' group by DATE_FORMAT(`date`, '%Y-%m-%d %H:00:00')";
        $hasil = Yii::$app->db->createCommand($query)->queryAll();
        foreach ($hasil as $key => $value) {
           $timelist_mt[$value['date']] = (int)$value['total'];        
        }

        foreach ($timelist_mt as $key => $value) {
            $timelist_mt_last[] = $value;
        }
        foreach ($timelist_mo as $key => $value) {
            $timelist_mo_last[] = $value;
        }


        $result['tanggal']=$timelist;
        $result['MO']=$timelist_mt_last;
        $result['MT']=$timelist_mo_last;
        if ($type==1) {
            return json_encode($result);
        }
        echo json_encode($result);
        die();
    }

    public function actionTps($type=0)
    {
        $dateto = date('Y-m-d H:00:00');
        $datefrom = date('Y-m-d H:00:00', strtotime( '-1 day', strtotime($dateto)));
        $timelist = $this->getListTanggal($datefrom,$dateto);
        $timelist_mo = [];
        $timelist_mt = [];
        $timelist_api = [];
        $timelist_dr = [];
        $result = [];
        foreach ($timelist as $key => $value) {
            $timelist_mo[$value] = 0;
        }
        foreach ($timelist as $key => $value) {
            $timelist_mt[$value] = 0;
        }
        foreach ($timelist as $key => $value) {
            $timelist_api[$value] = 0;
        }
        foreach ($timelist as $key => $value) {
            $timelist_dr[$value] = 0;
        }
        // echo "<pre>"; print_r($timelist_mo);echo "</pre>";die();

        $query = "SELECT DATE_FORMAT(`time`, '%Y-%m-%d %H:00:00')AS `date`, max(mo_tps_max) AS `sms_mo`, max(mt_tps_max) AS `sms_mt`, max(api_tps_max) AS `api`, max(dr_tps_max) AS `dr` FROM tbl_summary_tps WHERE `time` between '".$datefrom."' and '".$dateto."' group by DATE_FORMAT(`time`, '%Y-%m-%d %H:00:00')";
        $hasil = Yii::$app->db->createCommand($query)->queryAll();
        foreach ($hasil as $key => $value) {
            $timelist_mo[$value['date']] = (int)$value['sms_mo'];  
            $timelist_mt[$value['date']] = (int)$value['sms_mt'];  
            $timelist_api[$value['date']] = (int)$value['api'];  
            $timelist_dr[$value['date']] = (int)$value['dr'];  
        }

        foreach ($timelist_mt as $key => $value) {
            $timelist_mt_last[] = $value;
        }
        foreach ($timelist_mo as $key => $value) {
            $timelist_mo_last[] = $value;
        }

        foreach ($timelist_api as $key => $value) {
            $timelist_api_last[] = $value;
        }
        foreach ($timelist_dr as $key => $value) {
            $timelist_dr_last[] = $value;
        }


        $result['tanggal']=$timelist;
        $result['MO']=$timelist_mt_last;
        $result['MT']=$timelist_mo_last;
        $result['API']=$timelist_api_last;
        $result['DR']=$timelist_dr_last;

        if ($type==1) {
            return json_encode($result);
        }
        echo json_encode($result);
        die();
    }


    function getListTanggal($dateFrom,$dateTo,$type = 1)
    {
      $dateList = array();
      $datefrom2 = $dateFrom;
      $dateto2 = $dateTo;
      while($datefrom2 <= $dateto2){
        $dateList[] = $datefrom2;
        if($type == 1){
          $dodo = explode (" ",$datefrom2);
          $date1 = explode("-",$dodo[0]);
          $date2 = explode(":",$dodo[1]);
        }
        else
          $date1 = explode("-",$datefrom2);

        $datefrom2 = date("Y-m-d H:00:00", mktime(intval($date2[0])+1, intval($date2[1]), intval($date2[2]), $date1[1], $date1[2], $date1[0]));

      }
      return $dateList;
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin($username=null,$password=null)
    {
        //var_dump($_POST);
        // exit();
        $session = \Yii::$app->session;
        date_default_timezone_set("Asia/Jakarta");
        // \var_dump($session['attributes']);
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
       
        $model = new LoginForm();
        $model->scenario="login";
        if ($model->load(Yii::$app->request->post())) {

            $res=$model->login();
            if ($res===1) {
                $berita='User '. $session['username'].' has [LOGIN]';
                $sql = "insert into g_history_log (ghl_userid, ghl_username, ghl_log, ghl_date, ghl_ip) value ('" . $session['id'] . "','" . $session['username'] . "','" . $berita . "','" . date("Y-m-d H:i:s") . "','" . $_SERVER['REMOTE_ADDR'] . "')";
                Yii::$app->db->createCommand($sql)->execute();
                return $this->redirect(['site/index']);
            } if ($res===2) {
                Yii::$app->session->setFlash('error', "please change password!"); 
                return $this->redirect(['//auth-login/change-password',
                        'app_mode'=>$app_mode,
                    ]);
            }
        } else if ($session['username_google']!=null && $session['password_google']!=null){
            // var_dump($session['username_google']);
            // exit;
            $model = new LoginForm();
            $model->username= $session['username_google'];
            $model->password= $session['password_google'];
            $res = $model->login();
            if ($res === 1) {
                $berita = 'User ' . $session['username'] . ' has [LOGIN]';
                $sql = "insert into g_history_log (ghl_userid, ghl_username, ghl_log, ghl_date, ghl_ip) value ('" . $session['id'] . "','" . $session['username'] . "','" . $berita . "','" . date("Y-m-d H:i:s") . "','" . $_SERVER['REMOTE_ADDR'] . "')";
                Yii::$app->db->createCommand($sql)->execute();
                return $this->redirect(['site/index']);
            }
            if ($res === 2) {
                Yii::$app->session->setFlash('error', "please change password!");
                return $this->redirect([
                    '//auth-login/change-password',
                    'app_mode' => $app_mode,
                ]);
            }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
        die();
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        $session = \Yii::$app->session;
        date_default_timezone_set("Asia/Jakarta");
        $berita = 'User ' . $session['username'] . ' has [LOGOUT]';
        $sql = "insert into g_history_log (ghl_userid, ghl_username, ghl_log, ghl_date, ghl_ip) value ('" . $session['id'] . "','" . $session['username'] . "','" . $berita . "','" . date("Y-m-d H:i:s") . "','" . $_SERVER['REMOTE_ADDR'] . "')";
        Yii::$app->db->createCommand($sql)->execute();
        unset($session['id']);
        unset($session['timestamp']);
        $session->destroy();
        
        Yii::$app->user->logout();
        
        $this->redirect(['site/login']);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
     public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();
        
        // print("<pre>" . print_r($client, true) . "</pre>");

        // exit;
        // user login or signup comes here
        /*
    Kalo di die(print_r($attributes));
    maka akan keluar
    Array ( [id] => https://www.google.com/accounts/o8/id?id=AItOawkSN3ecyrQAUOVyy9kuX-2oq-hahagake [namePerson/first] => Hafid [namePerson/last] => Mukhlasin [pref/language] => en [contact/email] => milisstudio@gmail.com [first_name] => Hafid [last_name] => Mukhlasin [email] => milisstudio@gmail.com [language] => en ) 
 
    Nah data ini bisa kita gunakan untuk check apakah si user udah terdaftar ato belum..
    */

        $user = \app\models\AuthLogin::find()
            ->where([
                'tl_email' => $attributes['email'],
            ])
            ->one();
        if (!empty($user)) {
            
            // Yii::$app->user->login($user);
            $username = explode('@', $attributes['email']);
            // $tl_username = $username[0];
            // $tl_password = $username[0];
            $session = Yii::$app->session;
            $session['picture']= $attributes['picture'];
            $session['password_google'] = $username[0];
            $session['username_google'] = $attributes['email'];
            return $this->redirect([
                'login',
                // 'app_mode' => $app_mode,
                // 'password' => $tl_password,
                // 'username' => $tl_username 
                // 'attr_google'=> $attributes
            ]);
        } else {
            //Simpen disession attribute user dari Google
            $session = Yii::$app->session;
            $session['attributes'] = $attributes;
            // print("<pre>" . print_r($attributes, true) . "</pre>");
            // exit;
            // redirect ke form signup, dengan mengset nilai variabell global successUrl
            return $this->redirect([
                '//auth-login/signup-google',
                'app_mode' => $app_mode,
                // 'attr_google'=> $attributes
            ]);
        }  
    }
    

}
