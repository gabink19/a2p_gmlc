<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_summary_tps".
 *
 * @property string|null $time
 * @property string|null $aph_id
 * @property int|null $mo_tps_min
 * @property int|null $mo_tps_max
 * @property int|null $mo_tps_count
 * @property int|null $mt_tps_min
 * @property int|null $mt_tps_max
 * @property int|null $mt_tps_count
 * @property int|null $api_tps_min
 * @property int|null $api_tps_max
 * @property int|null $api_tps_count
 * @property int|null $dr_tps_min
 * @property int|null $dr_tps_max
 * @property int|null $dr_tps_count
 * @property int $id
 */
class SuccessDrHourly extends \yii\db\ActiveRecord
{
    public $startDate;
    public $endDate;

    public $date;
    public $sms_mo;
    public $api;
    public $sms_mt;
    public $dr;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_summary_tps';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time'], 'safe'],
            [['mo_tps_min', 'mo_tps_max', 'mo_tps_count', 'mt_tps_min', 'mt_tps_max', 'mt_tps_count', 'api_tps_min', 'api_tps_max', 'api_tps_count', 'dr_tps_min', 'dr_tps_max', 'dr_tps_count'], 'integer'],
            [['aph_id'], 'string', 'max' => 11],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'time' => 'Time',
            'aph_id' => 'Aph ID',
            'mo_tps_min' => 'Mo Tps Min',
            'mo_tps_max' => 'Mo Tps Max',
            'mo_tps_count' => 'Mo Tps Count',
            'mt_tps_min' => 'Mt Tps Min',
            'mt_tps_max' => 'Mt Tps Max',
            'mt_tps_count' => 'Mt Tps Count',
            'api_tps_min' => 'Api Tps Min',
            'api_tps_max' => 'Api Tps Max',
            'api_tps_count' => 'Api Tps Count',
            'dr_tps_min' => 'Dr Tps Min',
            'dr_tps_max' => 'Dr Tps Max',
            'dr_tps_count' => 'Dr Tps Count',


            'sms_mt' => 'SMS MT',
            'sms_mo' => 'SMS MO',
            'api' => 'API',
            'dr' => 'Delivery Report',
        ];
    }
}
