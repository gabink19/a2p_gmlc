<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_transaksi".
 *
 * @property int $tt_id
 * @property int $g_pasien_gp_id
 * @property int $g_poliklinik_gp_id
 * @property int $g_tenaga_medis_gtm_id
 *
 * @property TRekamMedis[] $tRekamMedis
 * @property TTenagaMedisAllowed[] $tTenagaMedisAlloweds
 * @property GPasien $gPasienGp
 * @property GPoliklinik $gPoliklinikGp
 * @property GTenagaMedis $gTenagaMedisGtm
 * @property TTransksiDetail[] $tTransksiDetails
 */
class xActiveRecord extends \yii\db\ActiveRecord
{
    
    public static function getDb() {
        return Yii::$app->db2;
    }
    

}
