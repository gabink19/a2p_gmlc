<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_aph_transaction_history".
 *
 * @property int $id
 * @property string $event_datetime
 * @property string $mdn
 * @property string $shortcode
 * @property resource $content
 * @property int $direction 0 mo, 1 mt
 * @property int $status 0 failed, 1 success
 * @property string|null $error_code
 * @property string $msg_id
 * @property string|null $api_id
 * @property int|null $aph_id
 *
 * @property TblAph $aph
 */
class AphTransactionHistoryDaily extends \yii\db\ActiveRecord
{
    public $startDate;
    public $endDate;
    public $total;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_aph_transaction_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_datetime', 'mdn', 'shortcode', 'content', 'direction', 'status', 'msg_id'], 'required'],
            [['event_datetime'], 'safe'],
            [['content'], 'string'],
            [['direction', 'status', 'aph_id'], 'integer'],
            [['mdn', 'shortcode', 'error_code'], 'string', 'max' => 20],
            [['msg_id', 'api_id'], 'string', 'max' => 50],
            [['msg_id', 'direction'], 'unique', 'targetAttribute' => ['msg_id', 'direction']],
            [['aph_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aph::className(), 'targetAttribute' => ['aph_id' => 'ta_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_datetime' => 'Event Datetime',
            'mdn' => 'Mdn',
            'shortcode' => 'Shortcode',
            'content' => 'Content',
            'direction' => 'Direction',
            'status' => 'Status',
            'error_code' => 'Error Code',
            'msg_id' => 'Msg ID',
            'api_id' => 'Api ID',
            'aph_id' => 'Aph ID',
        ];
    }

    /**
     * Gets query for [[Aph]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAph()
    {
        return $this->hasOne(TblAph::className(), ['ta_id' => 'aph_id']);
    }
}
