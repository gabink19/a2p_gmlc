<?

    function flexParameter($class,$attr,$data) {
       $plug_in=Yii::$app->params['bootstrap']["app\\models\\".$class]['dataLabel'][$attr]['name'];
       if ($plug_in==null) {
           $plug_in=$data;
       }
       return $plug_in;
    }
    
    function flexParameter2($class,$attr,$data) {
       $obj_name=$class."_config";
       $plug_in=$$obj_name['dataLabel'][$attr]['name'];
       //echo "attr".$$obj_name."\n";
       //exit();
       if ($plug_in==null or $plug_in=="") {
           $plug_in=$data;
       }
       return $plug_in;
    }
    
    function CheckParameter($class,$attr){
       $plug_in=Yii::$app->params['bootstrap'][$class]['dataLabel'][$attr]['index'];
       return $plug_in; 
    }
    
    function get_class_dir($model){
        $model_view=($model[0]);
        $length = strlen($model);
        for ($i=1; $i<$length; $i++) {
            if (ctype_upper ($model[$i])){
                $model_view=$model_view.'-';
            };
            $model_view=$model_view.$model[$i];

        }
        return strtolower($model_view);
            
    }

?>
