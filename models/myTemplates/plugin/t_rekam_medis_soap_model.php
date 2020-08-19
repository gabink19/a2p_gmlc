    public static function findOne($condition)
    {
        //echo $condition;
        
        $tempS="select * from t_rekam_medis  WHERE trm_id = ".$condition.";";
        $resultdb=Yii::$app->db->createCommand($tempS)->queryOne();
        $result=new TRekamMedisSoap();
        if ($resultdb!=null){
            $result->trms_id=$condition;
            $result->trms_name=$resultdb['trm_name'];
            $result->trms_notes=$resultdb['trm_notes'];
            $tempS="select * from t_rekam_medis_detail  WHERE t_rekam_medis_trm_id = ".$condition.";";
            $resultdb=Yii::$app->db->createCommand($tempS)->queryAll();
            foreach ($resultdb as $rows) {
                switch ($rows['trmd_parameter']) {
                    case "trms_subject_notes":
                        $result->trms_subject_notes=$rows['trmd_notes'];
                        
                        break;
                    case "trms_object_notes":
                        $result->trms_object_notes=$rows['trmd_notes'];
                        break;
                    case "trms_assessment_notes":
                        $result->trms_assessment_notes=$rows['trmd_notes'];
                        break;
                    case "trms_planning_notes":
                        $result->trms_planning_notes=$rows['trmd_notes'];
                        break;
                    case "g_tenaga_medis_gtm_id":
                        $result->g_tenaga_medis_gtm_id=$rows['trmd_notes'];
                        break;
                    case "trms_trans_date":
                        $result->trms_trans_date=$rows['trmd_notes'];
                        break;
                    
                }
                
            }
            
        }
        return $result;
        
    }
    
    public function save2($t_transaksi_tt_id, $f_rekam_medis_type_frmt_id){
        //echo $t_transaksi_tt_id.'\n';
        //echo $f_rekam_medis_type_frmt_id.'\n';
        //exit();
        $tempS="INSERT INTO t_rekam_medis  (trm_notes,trm_name,t_transaksi_tt_id,f_rekam_medis_type_frmt_id) values ('".$this->trms_notes."','".$this->trms_name."',".$t_transaksi_tt_id.",".$f_rekam_medis_type_frmt_id.");";
        Yii::$app->db->createCommand($tempS)->execute();
        $id = Yii::$app->db->getLastInsertID();
        
        $tempS="delete from t_rekam_medis_detail where t_rekam_medis_trm_id=".$id.";";
        Yii::$app->db->createCommand($tempS)->execute();
            
        $tempS="INSERT INTO t_rekam_medis_detail (trmd_parameter,trmd_name,trmd_notes,t_rekam_medis_trm_id) "
                    . "VALUES ('trms_subject_notes','','".$this->trms_subject_notes."',".$id.");";
        Yii::$app->db->createCommand($tempS)->execute();
        $tempS="INSERT INTO t_rekam_medis_detail (trmd_parameter,trmd_name,trmd_notes,t_rekam_medis_trm_id) "
                . "VALUES ('trms_object_notes','','".$this->trms_object_notes."',".$id.");";
        Yii::$app->db->createCommand($tempS)->execute();
        $tempS="INSERT INTO t_rekam_medis_detail (trmd_parameter,trmd_name,trmd_notes,t_rekam_medis_trm_id) "
                . "VALUES ('trms_assessment_notes','','".$this->trms_assessment_notes."',".$id.");";
        Yii::$app->db->createCommand($tempS)->execute();
        $tempS="INSERT INTO t_rekam_medis_detail (trmd_parameter,trmd_name,trmd_notes,t_rekam_medis_trm_id) "
                . "VALUES ('trms_planning_notes','','".$this->trms_planning_notes."',".$id.");";
        Yii::$app->db->createCommand($tempS)->execute();
        $tempS="INSERT INTO t_rekam_medis_detail (trmd_parameter,trmd_name,trmd_notes,t_rekam_medis_trm_id) "
                . "VALUES ('g_tenaga_medis_gtm_id','','".$this->g_tenaga_medis_gtm_id."',".$id.");";
        Yii::$app->db->createCommand($tempS)->execute();

        $tempS="INSERT INTO t_rekam_medis_detail (trmd_parameter,trmd_name,trmd_notes,t_rekam_medis_trm_id) "
                . "VALUES ('trms_trans_date','','".$this->trms_trans_date."',".$id.");";
        Yii::$app->db->createCommand($tempS)->execute();
        return true;
        
    }
            
    
            
    public function save($runValidation = true, $attributeNames = null)
    {
        
        $tempS="UPDATE t_rekam_medis SET trm_notes = '".$this->trms_notes."',trm_name = '".$this->trms_name."' WHERE trm_id = ".$this->trms_id.";";
        Yii::$app->db->createCommand($tempS)->execute();
        
        
        $tempS="delete from t_rekam_medis_detail where t_rekam_medis_trm_id=".$this->trms_id.";";
        Yii::$app->db->createCommand($tempS)->execute();
            
        $tempS="INSERT INTO t_rekam_medis_detail (trmd_parameter,trmd_name,trmd_notes,t_rekam_medis_trm_id) "
                    . "VALUES ('trms_subject_notes','','".$this->trms_subject_notes."',".$this->trms_id.");";
        Yii::$app->db->createCommand($tempS)->execute();
        $tempS="INSERT INTO t_rekam_medis_detail (trmd_parameter,trmd_name,trmd_notes,t_rekam_medis_trm_id) "
                . "VALUES ('trms_object_notes','','".$this->trms_object_notes."',".$this->trms_id.");";
        Yii::$app->db->createCommand($tempS)->execute();
        $tempS="INSERT INTO t_rekam_medis_detail (trmd_parameter,trmd_name,trmd_notes,t_rekam_medis_trm_id) "
                . "VALUES ('trms_assessment_notes','','".$this->trms_assessment_notes."',".$this->trms_id.");";
        Yii::$app->db->createCommand($tempS)->execute();
        $tempS="INSERT INTO t_rekam_medis_detail (trmd_parameter,trmd_name,trmd_notes,t_rekam_medis_trm_id) "
                . "VALUES ('trms_planning_notes','','".$this->trms_planning_notes."',".$this->trms_id.");";
        Yii::$app->db->createCommand($tempS)->execute();
        $tempS="INSERT INTO t_rekam_medis_detail (trmd_parameter,trmd_name,trmd_notes,t_rekam_medis_trm_id) "
                . "VALUES ('g_tenaga_medis_gtm_id','','".$this->g_tenaga_medis_gtm_id."',".$this->trms_id.");";
        Yii::$app->db->createCommand($tempS)->execute();

        $tempS="INSERT INTO t_rekam_medis_detail (trmd_parameter,trmd_name,trmd_notes,t_rekam_medis_trm_id) "
                . "VALUES ('trms_trans_date','','".$this->trms_trans_date."',".$this->trms_id.");";
        Yii::$app->db->createCommand($tempS)->execute();
        return true;
        
    }
    
    
    
    public function delete(){
        
        $tempS="delete from t_rekam_medis_detail where t_rekam_medis_trm_id=".$this->trms_id.";";
        Yii::$app->db->createCommand($tempS)->execute();
        
        $tempS="delete from t_rekam_medis where trm_id=".$this->trms_id.";";
        Yii::$app->db->createCommand($tempS)->execute();
        
        return true;
    }    