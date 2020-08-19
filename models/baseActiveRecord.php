<?php

namespace app\models;

use Yii;
use yii\db\Expression;

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

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

class baseActiveRecord extends \yii\db\ActiveRecord
{
    
    public function save($runValidation = true, $attributeNames = null)
    {
        $session = \Yii::$app->session;

        date_default_timezone_set("Asia/Jakarta");
        if ($this->isNewRecord) {
            $this->first_user=$session['username'];
            $this->first_ip=getUserIpAddr();
            $this->first_update=new Expression('NOW()');
        } else {
            $this->last_user=$session['username'];
            $this->last_ip=getUserIpAddr();
            $this->last_update=new Expression('NOW()');
        }
        
        return parent::save($runValidation,$attributeNames);
        
    }

public function afterSave($isNew, $old) {
        $session = \Yii::$app->session;
        date_default_timezone_set("Asia/Jakarta");
       if ($isNew){
            $auth = strrpos($this->tableSchema->fullName, 'auth');
            if ($auth === 0) {
                return true;
            }
            $new = $this->attributes;
            $model = $this->title_log;
            if($this->$model['name']=='') {
                $nama_class = str_replace('_config', '', $model);
            } else {
                $nama_class = $this->$model['name'];
            }
            $nama_param = str_replace('id', 'name', $this->tableSchema->primaryKey);
            $berita .= $nama_class . ' [CREATE] '. $new[$nama_param[0]].' | ';
            foreach ($new as $key => $value) {

                if ($this->$model['dataLabel'][$key]['display'] == '' || $this->$model['dataLabel'][$key]['display'] == '0') {
                    if ($this->$model['dataLabel'][$key]['ActiveForm_display'] == '') {
                        continue;
                    }
                }
                if ($this->$model['dataLabel'][$key]['field_type'] == 'ref') {
                    $str = $key;
                    $str2 = str_replace('_ref', '', $str);
                    $str3 = explode('_', $str2);
                    unset($str3[0]);
                    $flag = null;
                    foreach ($str3 as $str4) {

                        $str5 .= ucfirst($str4);
                    }
                    $str5 = lcfirst($str5);
                    $a = Yii::$app->params[$str5];
                    $value = $a[$value];
                }
                if ($this->$model['dataLabel'][$key]['field_type'] == 'boolean') {
                    if ($value == 1) {
                        $value = 'True';
                    } else $value = 'False';
                }
                if ($this->$model['dataLabel'][$key]['name'] != null) {
                    $key = $this->$model['dataLabel'][$key]['name'];
                }

                $berita .= $key . ': ' . $value . ', ';
            }
            $berita = substr($berita, 0, -2);
            $model2 = new GCustomer;
            if ($this->$model['master_id'] != '') {
                $berita .= ' (at ';
                $name_master = $this->$model['master_id'];
                $table_master = $this->getTableSchema()->foreignKeys;
                $x = 1;
                while ($x <= 1) {
                    foreach ($table_master as $id_master) {
                        if ($id_master[$name_master] != null) {
                            $name_master2 = str_replace($id_master[$name_master], '', $name_master);
                            $name_master2 = str_replace('_', ' ', $name_master2);
                            $name_master2 = ucwords($name_master2);
                            $name_master2 = 'app\models\\' . str_replace(' ', '', $name_master2);
                            $model2 = new $name_master2;
                            $model3 = $model2->find([$id_master[$name_master] => $new->$name_master])->one();
                            $field_name = str_replace('id', 'name', $id_master[$name_master]);
                            $label_master = $model2->title_log;
                            $label_master = $model2[$label_master];
                            if ($label_master['name'] == '') {
                                $label_master['name'] = str_replace('_config', '', $model2->title_log);
                            }
                            $berita .= $label_master['name'] . ': ' . $model3->$field_name . ', ';


                            if ($label_master['master_id'] == '') {
                                $x = 2;
                            } else {
                                $table_master = $model2->getTableSchema()->foreignKeys;
                                $name_master = $label_master['master_id'];
                                break;
                            }
                        }
                    }
                }
                $berita = substr($berita, 0, -2);
                $berita .= ')';
            }
            $model_id = $this->getPrimaryKey();
            // print("<pre>" . print_r($this->getPrimaryKey(), true) . "</pre>");
            // exit;   
       
        if ($berita != null) {
            $sql = "insert into g_history_log (ghl_userid, ghl_username, ghl_log, ghl_date, ghl_ip, ghl_id_model, ghl_model) value ('" . $session['id'] . "','" . $session['username'] . "','" . $berita . "','" . date("Y-m-d H:i:s") . "','" . $_SERVER['REMOTE_ADDR'] . "','" . $model_id . "','" . str_replace('app\models\\', '', $this->className()) . "')";
            Yii::$app->db->createCommand($sql)->execute();
        }
    }
   }
    public function beforeSave($insert)
    {
        $session = \Yii::$app->session;
        date_default_timezone_set("Asia/Jakarta");
        
        // strrpos(
        if (parent::beforeSave($insert)) {
            // Place your custom code here
            if ($this->isNewRecord) {
                return true;
            }
            $auth= strrpos($this->tableSchema->fullName, 'auth');
            if($auth===0){
                return true; 
            }
            $new = $this->attributes;
            $old = $this->oldAttributes;
            $model = $this->title_log;
            // print("<pre>" . print_r($old, true) . "</pre>");
            $nama_param=str_replace('id','name',$this->tableSchema->primaryKey);
            // print("<pre>" . print_r(stripos($this->tableSchema->fullName, 'auth_'), true) . "</pre>");
            // exit;
            if ($this->$model['name'] == '') {
                $nama_class = str_replace('_config', '', $model);
            } else {
                $nama_class = $this->$model['name'];
            }
            $berita .= $nama_class . ' [UPDATE] '.$old[$nama_param[0]].' | ';
            foreach ($new as $key => $value) {
                $name_field = $key;
                if ($this->$model['dataLabel'][$key]['display'] == null || $this->$model['dataLabel'][$key]['display'] == '0') {
                    if ($this->$model['dataLabel'][$key]['ActiveForm_display'] == null) {
                        continue;
                    }
                }

                if ($old[$name_field] != $value) {
                    // print("<pre>" . print_r($old[$name_field], true) . "</pre>");
                    // print("<pre>" . print_r($value, true) . "</pre>");
                    // exit;
                    if ($this->$model['dataLabel'][$key]['field_type'] == 'ref') {
                        $str = $key;
                        $str2 = str_replace('_ref', '', $str);
                        $str3 = explode('_', $str2);
                        unset($str3[0]);
                        foreach ($str3 as $str4) {

                            $str5 .= ucfirst($str4);
                        }
                        $str5 = lcfirst($str5);
                        $a = Yii::$app->params[$str5];
                        $value = $a[$value];
                        $old[$name_field] = $a[$old[$name_field]];
                    }
                    if ($this->$model['dataLabel'][$key]['field_type'] == 'boolean') {
                        if ($value == 1) {
                            $value = 'True';
                        } else $value = 'False';
                        if ($old[$name_field] == 1) {
                            $old[$name_field] = 'True';
                        } else $old[$name_field] = 'False';
                    }
                    if ($this->$model['dataLabel'][$key]['field_type'] == 'id') {
                        $id_model = $this->getTableSchema()->foreignKeys;
                        // print("<pre>" . print_r($id_model, true) . "</pre>");
                        // print("<pre>" . print_r($id_model, true) . "</pre>");
                        // print("<pre>" . print_r($key, true) . "</pre>");
                        // exit;
                        foreach ($id_model as $simpan_model) {
                            if ($simpan_model[$key] != null) {
                                $str = $key;
                                $str = str_replace('_', ' ', $str);
                                $str = ucwords($str);
                                $str = str_replace('Id', '', $str);
                                $str = str_replace(' ', '', $str);
                                $str = lcfirst($str);
                                $str2 = $simpan_model[$key];
                                $str2 = str_replace('id', 'name', $str2);
                                $this->t_sensor_type_tst_id= $old[$name_field];
                                $old[$name_field] = $this->$str->$str2;
                                $this->t_sensor_type_tst_id = $value;
                                $value = $this->$str->$str2;
                                // print("<pre>" . print_r($value, true) . "</pre>");
                                // print("<pre>" . print_r($old[$name_field], true) . "</pre>");
                                // exit;
                            }
                        }
                    }
                    if ($this->$model['dataLabel'][$key]['name'] != null) {
                        $key = $this->$model['dataLabel'][$key]['name'];
                    }
                    $berita .= $key . ': ' . $old[$name_field] . ' -> ' . $value . ', ';
                }
            }
            $berita= substr($berita, 0, -2);
            $model2 = new GCustomer;
            if($this->$model['master_id']!=''){
                $berita .= ' (at ';
            $name_master=$this->$model['master_id'];
            $table_master= $this->getTableSchema()->foreignKeys;
            $x = 1;
            while ($x <= 1) {
            foreach ($table_master as $id_master){
                if($id_master[$name_master]!=null){
                    $name_master2=str_replace($id_master[$name_master],'',$name_master);
                    $name_master2=str_replace('_',' ', $name_master2);
                    $name_master2= ucwords($name_master2);
                    $name_master2 = 'app\models\\'.str_replace(' ', '', $name_master2);
                    $model2= new $name_master2;
                    $model3= $model2->find([$id_master[$name_master]=>$new->$name_master])->one();
                    $field_name= str_replace('id','name',$id_master[$name_master]);
                    $label_master=$model2->title_log;
                    $label_master= $model2[$label_master];
                    if($label_master['name']==''){
                        $label_master['name']=str_replace('_config','', $model2->title_log);
                    }
                    $berita.=$label_master['name'].': '.$model3->$field_name.', ';
                    
                   
                    if($label_master['master_id']==''){
                            $x=2;
                    } else {
                                $table_master = $model2->getTableSchema()->foreignKeys;
                                $name_master = $label_master['master_id'];
                    break;  
                    }
                }
            }
        }
        $berita = substr($berita, 0, -2);
        $berita.=')';
    }
            // print("<pre>" . print_r($x, true) . "</pre>");
            // exit; 
            $model_id = $this->getPrimaryKey();
            if ($berita != null) {
                $sql = "insert into g_history_log (ghl_userid, ghl_username, ghl_log, ghl_date, ghl_ip, ghl_id_model, ghl_model) value ('" . $session['id'] . "','" . $session['username'] . "','" . $berita . "','" . date("Y-m-d H:i:s") . "','" . $_SERVER['REMOTE_ADDR'] . "','" . $model_id . "','" . str_replace('app\models\\', '', $this->className()) . "')";
                Yii::$app->db->createCommand($sql)->execute();
            }
            return true;
        } else {
            return false;
        }
    }

    public function beforeDelete()
    {
        
        if ($berita != null) {
            $sql = "insert into g_history_log (ghl_userid, ghl_username, ghl_log, ghl_date, ghl_ip, ghl_id_model, ghl_model) value ('" . $session['id'] . "','" . $session['username'] . "','" . $berita . "','" . date("Y-m-d H:i:s") . "','" . $_SERVER['REMOTE_ADDR'] . "','" . $model_id . "','" . str_replace('app\models\\', '', $this->className()) . "')";
            Yii::$app->db->createCommand($sql)->execute();
        }
       return parent::beforeDelete() ;
       
    
    }
    public function afterDelete()
    {
        $session = \Yii::$app->session;
        date_default_timezone_set("Asia/Jakarta");
        $new = $this->attributes;
        $model = $this->title_log;
        if ($this->$model['name'] == '') {
            $nama_class = str_replace('_config', '', $model);
        } else {
            $nama_class = $this->$model['name'];
        }
        $nama_param = str_replace('id', 'name', $this->tableSchema->primaryKey);
        $berita .= $nama_class . ' [DELETE] ' . $new[$nama_param[0]] . ' | ';
        // print("<pre>" . print_r($this->$model, true) . "</pre>");
        // exit;
        foreach ($new as $key => $value) {

            if ($this->$model['dataLabel'][$key]['display'] == '' || $this->$model['dataLabel'][$key]['display'] == '0') {
                if ($this->$model['dataLabel'][$key]['ActiveForm_display'] == '') {
                    continue;
                }
            }
            if ($this->$model['dataLabel'][$key]['field_type'] == 'ref') {
                $str = $key;
                $str2 = str_replace('_ref', '', $str);
                $str3 = explode('_', $str2);
                unset($str3[0]);
                $flag = null;
                foreach ($str3 as $str4) {

                    $str5 .= ucfirst($str4);
                }
                $str5 = lcfirst($str5);
                $a = Yii::$app->params[$str5];
                $value = $a[$value];
            }
            if ($this->$model['dataLabel'][$key]['field_type'] == 'boolean') {
                if ($value == 1) {
                    $value = 'True';
                } else $value = 'False';
            }
            if ($this->$model['dataLabel'][$key]['name'] != null) {
                $key = $this->$model['dataLabel'][$key]['name'];
            }

            $berita .= $key . ': ' . $value . ', ';
        }
        $berita = substr($berita, 0, -2);
        $model2 = new GCustomer;
        if ($this->$model['master_id'] != '') {
            $berita .= ' (at ';
            $name_master = $this->$model['master_id'];
            $table_master = $this->getTableSchema()->foreignKeys;
            $x = 1;
            while ($x <= 1) {
                foreach ($table_master as $id_master) {
                    if ($id_master[$name_master] != null) {
                        $name_master2 = str_replace($id_master[$name_master], '', $name_master);
                        $name_master2 = str_replace('_', ' ', $name_master2);
                        $name_master2 = ucwords($name_master2);
                        $name_master2 = 'app\models\\' . str_replace(' ', '', $name_master2);
                        $model2 = new $name_master2;
                        $model3 = $model2->find([$id_master[$name_master] => $new->$name_master])->one();
                        $field_name = str_replace('id', 'name', $id_master[$name_master]);
                        $label_master = $model2->title_log;
                        $label_master = $model2[$label_master];
                        if ($label_master['name'] == '') {
                            $label_master['name'] = str_replace('_config', '', $model2->title_log);
                        }
                        $berita .= $label_master['name'] . ': ' . $model3->$field_name . ', ';


                        if ($label_master['master_id'] == '') {
                            $x = 2;
                        } else {
                            $table_master = $model2->getTableSchema()->foreignKeys;
                            $name_master = $label_master['master_id'];
                            break;
                        }
                    }
                }
            }
            $berita = substr($berita, 0, -2);
            $berita .= ')';
        }
        $model_id = $this->getPrimaryKey();
        if ($berita != null) {
            $sql = "insert into g_history_log (ghl_userid, ghl_username, ghl_log, ghl_date, ghl_ip, ghl_id_model, ghl_model) value ('" . $session['id'] . "','" . $session['username'] . "','" . $berita . "','" . date("Y-m-d H:i:s") . "','" . $_SERVER['REMOTE_ADDR'] . "','" . $model_id . "','" . str_replace('app\models\\', '', $this->className()) . "')";
            Yii::$app->db->createCommand($sql)->execute();
        }
         return parent::afterDelete();
    }

}
