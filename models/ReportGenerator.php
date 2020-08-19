<?php

namespace app\models;

use Yii;
use yii\base\Model;



// class XxGDepartment extends \yii\db\ActiveRecord
class ReportGenerator extends Model
{
    
    var $param0;
    var $param1;
    var $param2;
    var $param3;
    var $param4;
    var $param5;
    var $param6;
    var $param7;
    var $param8;
    var $param9;
    var $param10;
    var $param11;
    var $param12;
    var $param13;
    var $param14;
    var $param15;
    var $param16;
    var $param17;
    var $param18;
    var $param19;
    var $param0_2;
    var $param1_2;
    var $param2_2;
    var $param3_2;
    var $param4_2;
    var $param5_2;
    var $param6_2;
    var $param7_2;
    var $param8_2;
    var $param9_2;
    var $param10_2;
    var $param11_2;
    var $param12_2;
    var $param13_2;
    var $param14_2;
    var $param15_2;
    var $param16_2;
    var $param17_2;
    var $param18_2;
    var $param19_2;
    var $param0_3=0;
    var $param1_3=0;
    var $param2_3=0;
    var $param3_3=0;
    var $param4_3=0;
    var $param5_3=0;
    var $param6_3=0;
    var $param7_3=0;
    var $param8_3=0;
    var $param9_3=0;
    var $param10_3=0;
    var $param11_3=0;
    var $param12_3=0;
    var $param13_3=0;
    var $param14_3=0;
    var $param15_3=0;
    var $param16_3=0;
    var $param17_3=0;
    var $param18_3=0;
    var $param19_3=0;
    var $limit="";
    var $param_adv_filter;
    //var $image;
    
    
    public function load_session($data){
        if ($data!=null){
            for ($i=0;$i<20;$i++){
                $param="param".$i;
                $param2="param".$i."_2";
                $param3="param".$i."_3";
                $this->$param=$data['param'][$i];
                $this->$param2=$data['param2'][$i];
                $this->$param3=$data['operation'][$i];
            }
        };
    }
    public function get_session(){
        $data=[];
        for ($i=0;$i<20;$i++){
                $param="param".$i;
                $param2="param".$i."_2";
                $param3="param".$i."_3";
                $data['param'][$i]=$this->$param;
                $data['param2'][$i]=$this->$param2;
                $data['operation'][$i]=$this->$param3;
            }
            return $data;
        
    }   

    public function rules()
{
return [
            [[  'param0', 'param1', 'param2', 'param3', 'param4', 'param5', 'param6', 'param7', 'param8', 'param9',
                'param10', 'param11', 'param12', 'param13', 'param14', 'param15', 'param16', 'param17', 'param18', 'param19',
                'param0_2', 'param1_2', 'param2_2', 'param3_2', 'param4_2', 'param5_2', 'param6_2', 'param7_2', 'param8_2', 'param9_2',
                'param10_2', 'param11_2', 'param12_2', 'param13_2', 'param14_2', 'param15_2', 'param16_2', 'param17_2', 'param18_2', 'param19_2',
                'param0_3', 'param1_3', 'param2_3', 'param3_3', 'param4_3', 'param5_3', 'param6_3', 'param7_3', 'param8_3', 'param9_3',
                'param10_3', 'param11_3', 'param12_3', 'param13_3', 'param14_3', 'param15_3', 'param16_3', 'param17_3', 'param18_3', 'param19_3','limit','param_adv_filter'], 'safe'],
            //[['image'], 'safe'],
            //[['image'], 'file', 'extensions'=>'jpg, gif, png'],
            [[], 'safe'],
];
}
        


}
