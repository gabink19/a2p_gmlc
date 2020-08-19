<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_summary_hourly_mo".
 *
 * @property int $id
 * @property string|null $date
 * @property string|null $shortcode
 * @property int|null $aph_id
 * @property int|null $status 0 failed, 1 success
 * @property string|null $error_code
 * @property int|null $total
 */
class SummaryMtHourly extends \yii\db\ActiveRecord
{
    public $startDate;
    public $endDate;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_summary_hourly_mt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['aph_id', 'status', 'total'], 'integer'],
            [['shortcode', 'error_code'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'shortcode' => 'Shortcode',
            'aph_id' => 'Aph ID',
            'status' => 'Status',
            'error_code' => 'Error Code',
            'total' => 'Total',
        ];
    }
}
