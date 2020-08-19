<?php
/**
 * This is the template for generating the model class of a specified table.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\model\Generator */
/* @var $tableName string full table name */
/* @var $className string class name */
/* @var $queryClassName string query class name */
/* @var $tableSchema yii\db\TableSchema */
/* @var $properties array list of properties (property => [type, name. comment]) */
/* @var $labels string[] list of attribute labels (name => label) */
/* @var $rules string[] list of validation rules */
/* @var $relations array list of relations (name => relation declaration) */

echo "<?php\n";
?>

namespace <?= $generator->ns ?>;

use Yii;

<?

if(!function_exists("endsWith")) {
    function endsWith($haystack, $needle) {
        return substr_compare($haystack, $needle, -strlen($needle)) === 0;
    }
}

$new_label="";
?>



class <?= $className ?> extends <?=$generator->generateInheritance? "Xx":""?><?= $className ?>
{

<?php 
    echo "static \$parameter=[";
    $prefix="";
    foreach ($properties as $property => $data) {
        if ($prefix=="") {
            $prefix=strtok($property, "_");
        } else {
            echo "'".$property."',";
        }
    
    };
    echo "];";
?> 

    public static function findOne($condition)
    {
        //echo $condition;
        
        $tempS="select * from t_rekam_medis  WHERE trm_id = ".$condition.";";
        $resultdb=Yii::$app->db->createCommand($tempS)->queryOne();
        $result=new <?= $className ?>();
        if ($resultdb!=null){
            $result-><?=$prefix?>_name=$resultdb['trm_name'];
            $result-><?=$prefix?>_notes=$resultdb['trm_notes'];
            $tempS="select * from t_rekam_medis_detail  WHERE t_rekam_medis_trm_id = ".$condition.";";
            $resultdb=Yii::$app->db->createCommand($tempS)->queryAll();
            foreach ($resultdb as $rows) {
                $variable=$rows['trmd_parameter'];
                if (array_search($variable,self::$parameter)!=null) {
                    //echo $variable.":".array_search($variable,self::$parameter)."<br>";
                    $result->$variable=$rows['trmd_notes'];
                    }
                
                
                
            }
            $result-><?=$prefix?>_id=$condition;
            
            
        }
        //exit();
        return $result;
        
    }
    
    public function _save($id){
        $tempS="delete from t_rekam_medis_detail where t_rekam_medis_trm_id=".$id.";";
        Yii::$app->db->createCommand($tempS)->execute();
        
        foreach (self::$parameter as $value) {
            
            $tempS="INSERT INTO t_rekam_medis_detail (trmd_parameter,trmd_name,trmd_notes,t_rekam_medis_trm_id) "
                    . "VALUES ('".$value."','','".$this->$value."',".$id.");";
            Yii::$app->db->createCommand($tempS)->execute();
        
        }
         
       
        return true;
        
    }
    
    public function save2($t_transaksi_tt_id, $f_rekam_medis_type_frmt_id){
        $tempS="INSERT INTO t_rekam_medis  (trm_notes,trm_name,t_transaksi_tt_id,f_rekam_medis_type_frmt_id) values ('".$this-><?=$prefix?>_notes."','".$this-><?=$prefix?>_name."',".$t_transaksi_tt_id.",".$f_rekam_medis_type_frmt_id.");";
        Yii::$app->db->createCommand($tempS)->execute();
        $id = Yii::$app->db->getLastInsertID();
        return $this->_save($id);
        
        
    }
            
    
            
    public function save($runValidation = true, $attributeNames = null)
    {
        
        $tempS="UPDATE t_rekam_medis SET trm_notes = '".$this-><?=$prefix?>_notes."',trm_name = '".$this-><?=$prefix?>_name."' WHERE trm_id = ".$this-><?=$prefix?>_id.";";
        Yii::$app->db->createCommand($tempS)->execute();
        return $this->_save($this-><?=$prefix?>_id);
        
        
    }
    
    
    
    public function delete(){
        
        $tempS="delete from t_rekam_medis_detail where t_rekam_medis_trm_id=".$this-><?=$prefix?>_id.";";
        Yii::$app->db->createCommand($tempS)->execute();
        
        $tempS="delete from t_rekam_medis where trm_id=".$this-><?=$prefix?>_id.";";
        Yii::$app->db->createCommand($tempS)->execute();
        
        return true;
    } 

}
