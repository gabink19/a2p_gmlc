<?php
/**
 * This is the template for generating CRUD search class of the specified model.
 */

use yii\helpers\StringHelper;

try {
    
    $className= StringHelper::basename($generator->modelClass);
    include(dirname(__FILE__) .    "/../../../models/".$className."_Config.php");
    $obj_name=$className."_config";
    $$obj_name=$obj_name();   
    $master_id=$$obj_name['master_id'];

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../../models/".$className."_Config.php".".\n";
}



/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $modelAlias = $modelClass . 'Model';
}
$rules = $generator->generateSearchRules();
$labels = $generator->generateSearchLabels();
$searchAttributes = $generator->getSearchAttributes();
$searchConditions = $generator->generateSearchConditions();

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->searchModelClass, '\\')) ?>;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use <?= ltrim($generator->modelClass, '\\') . (isset($modelAlias) ? " as $modelAlias" : "") ?>;

/**
 * <?= $searchModelClass ?> represents the model behind the search form of `<?= $generator->modelClass ?>`.
 */
class <?=$generator->generateInheritance? "Xx":""?><?= $searchModelClass ?> extends <?= isset($modelAlias) ? $modelAlias : $modelClass ?>

{   

<?

if(!function_exists("endsWith")) {
    function endsWith($haystack, $needle) {
        return substr_compare($haystack, $needle, -strlen($needle)) === 0;
    }
}

$new_label="";
$join_str;
?>
    
    
    <?
    if ($$obj_name!=null) {
                
        foreach ($$obj_name['dataLabel'] as $name => $val){ 
            if  ($val['disable']=="1") continue;
        
            //foreach ($labels as $name => $label): 
            $label_value=$val['value'];
        
            $virtual_flag=false;
            if ($label_value != null or $label_value != ""){
                $virtual_flag=true;
            }
        
            $field_type = $val['field_type'];
            $field_type_ext_data = $val['field_type_ext_data'];

            if ($label_value!=null and $label_value!=""){
                $new_label=$new_label."'".$name."',";         
                        
                
            };
            {
                $plug_in=Yii::$app->params['plugin_datatype'][$name];
                if ($plug_in != null) {
                    require(Yii::$app->basePath . '/myTemplates/plugin/'.$plug_in['name'].'_search.php');
                } else if (($field_type == 'date') or ( $field_type == 'datetime') or ( $field_type == 'date') or ( $field_type == 'boolean') or ( $field_type == 'money') ) {
                    $ref_table2="";
                       $ref_table="";
                            $split_array=explode("_",$name);
                            $no=0;
                            $max_no=count($split_array);
                            foreach($split_array as $split_str){
                                if ($no==0) {
                                            $ref_table2=$ref_table2.$split_str;

                                        } else {
                                            $ref_table2=$ref_table2.ucfirst($split_str);


                                        }
                                $ref_table=$ref_table.ucfirst($split_str);
                                $no=$no+1;

                            }

                        $var_name=strtolower($ref_table)."str";
                        $new_label=$new_label."'".$var_name."',";         
                        if (!$virtual_flag) {
                            $andFilterWhere=$andFilterWhere."\$query->andFilterWhere(['like', '".$name."', \$this->".$var_name."]);\n";
                        }






                } else if (($field_type == 'id') ) {
                
                    require(Yii::$app->basePath . '/myTemplates/plugin/id_search.php');


                }
            }
    
    
            
        };
    };?>
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            <?= implode(",\n            ", $rules) ?>,
            <?= "[[".$new_label."], 'safe']" ?>,
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params,$master_id=null)
    {
        $query = <?= isset($modelAlias) ? $modelAlias : $modelClass ?>::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        <?= $join_str ?>
        
            <? if ($master_id!="") {
              echo "\$query->andFilterWhere([ 
               '".$master_id."' => \$master_id]); ";
            
            } 
            ?>
        
        // grid filtering conditions
        <?= implode("\n        ", $searchConditions) ?>
        <?= $andFilterWhere ?>
        
        return $dataProvider;
    }
}
