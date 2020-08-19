<?php

namespace app\models;

use Yii;


include_once("functions.php");
include("GSensorAlarm_Config.php");

/**
* This is the model class for table "g_sensor_alarm".
*
    * @property int $gsa_id
    * @property string $gsa_name
    * @property int $gsa_value
    * @property int $gsa_alarm_mode_ref
    * @property int $g_sensor_db_gsd_id
    * @property int $f_sensor_detail_fsd_id
    * @property string $first_user
    * @property string $first_ip
    * @property string $first_update
    * @property string $last_user
    * @property string $last_ip
    * @property string $last_update
    * @property int $g_customer_gc_id
    *
            * @property FSensorDetail $fSensorDetailFsd
            * @property GCustomer $gCustomerGc
            * @property GSensorDb $gSensorDbGsd
    */



class GSensorAlarm extends \app\models\baseActiveRecord
{

var $GSensorAlarm_config;
function __construct() {
parent::__construct();
$this->GSensorAlarm_config=GSensorAlarm_config();


}

/**
* {@inheritdoc}
*/
public static function tableName()
{
return 'g_sensor_alarm';
}

/**
* {@inheritdoc}
*/
public function rules()
{
return [
            [['gsa_value', 'gsa_alarm_mode_ref', 'g_sensor_db_gsd_id', 'f_sensor_detail_fsd_id', 'g_customer_gc_id'], 'integer'],
            [['g_sensor_db_gsd_id', 'f_sensor_detail_fsd_id', 'g_customer_gc_id'], 'required'],
            [['first_update', 'last_update'], 'safe'],
            [['gsa_name'], 'string', 'max' => 45],
            [['first_user', 'last_user'], 'string', 'max' => 50],
            [['first_ip', 'last_ip'], 'string', 'max' => 20],
            [['f_sensor_detail_fsd_id'], 'exist', 'skipOnError' => true, 'targetClass' => FSensorDetail::className(), 'targetAttribute' => ['f_sensor_detail_fsd_id' => 'fsd_id']],
            [['g_customer_gc_id'], 'exist', 'skipOnError' => true, 'targetClass' => GCustomer::className(), 'targetAttribute' => ['g_customer_gc_id' => 'gc_id']],
            [['g_sensor_db_gsd_id'], 'exist', 'skipOnError' => true, 'targetClass' => GSensorDb::className(), 'targetAttribute' => ['g_sensor_db_gsd_id' => 'gsd_id']],
        ];
}

var $gsensordbgsdgsd_name;
var $fsensordetailfsdfsd_name;
public function getGsaAlarmModeRefStr() {
return Yii::$app->params['alarmMode'][$this->gsa_alarm_mode_ref];
}
var $gcustomergcgc_name;

public function flexParameter3($className,$name,$xlabel){

$title=$this->GSensorAlarm_config['dataLabel'][$name]['name'];
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
'gsa_name' => $this->flexParameter3('GSensorAlarm','gsa_name','Name'),
'gsa_value' => $this->flexParameter3('GSensorAlarm','gsa_value','Value'),
'gSensorDbGsd.gsd_name' => flexParameter2('GSensorAlarm','g_sensor_db_gsd_id','Sensor Db Gsd ID'),
'gsensordbgsdgsd_name' => flexParameter2('GSensorAlarm','g_sensor_db_gsd_id','Sensor Db Gsd ID'),
'g_sensor_db_gsd_id' => flexParameter2('GSensorAlarm','g_sensor_db_gsd_id','Sensor Db Gsd ID'),
'fSensorDetailFsd.fsd_name' => flexParameter2('GSensorAlarm','f_sensor_detail_fsd_id','Sensor Detail Fsd ID'),
'fsensordetailfsdfsd_name' => flexParameter2('GSensorAlarm','f_sensor_detail_fsd_id','Sensor Detail Fsd ID'),
'f_sensor_detail_fsd_id' => flexParameter2('GSensorAlarm','f_sensor_detail_fsd_id','Sensor Detail Fsd ID'),
'gsaAlarmModeRefStr' => $this->flexParameter3('GSensorAlarm','gsa_alarm_mode_ref','Alarm Mode '),
'gsa_alarm_mode_ref' => $this->flexParameter3('GSensorAlarm','gsa_alarm_mode_ref','Alarm Mode '),
'first_user' => $this->flexParameter3('GSensorAlarm','first_user','User'),
'first_ip' => $this->flexParameter3('GSensorAlarm','first_ip','Ip'),
'first_update' => $this->flexParameter3('GSensorAlarm','first_update','Update'),
'last_user' => $this->flexParameter3('GSensorAlarm','last_user','User'),
'last_ip' => $this->flexParameter3('GSensorAlarm','last_ip','Ip'),
'last_update' => $this->flexParameter3('GSensorAlarm','last_update','Update'),
'gCustomerGc.gc_name' => flexParameter2('GSensorAlarm','g_customer_gc_id','Customer Gc ID'),
'gcustomergcgc_name' => flexParameter2('GSensorAlarm','g_customer_gc_id','Customer Gc ID'),
'g_customer_gc_id' => flexParameter2('GSensorAlarm','g_customer_gc_id','Customer Gc ID'),
];
}
                                                    





    /**
    * @return \yii\db\ActiveQuery
    */
    public function getFSensorDetailFsd()
    {
    return $this->hasOne(FSensorDetail::className(), ['fsd_id' => 'f_sensor_detail_fsd_id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getGCustomerGc()
    {
    return $this->hasOne(GCustomer::className(), ['gc_id' => 'g_customer_gc_id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getGSensorDbGsd()
    {
    return $this->hasOne(GSensorDb::className(), ['gsd_id' => 'g_sensor_db_gsd_id']);
    }
}
