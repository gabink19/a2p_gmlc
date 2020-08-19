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
if (!function_exists("endsWith")) {

    function endsWith($haystack, $needle)
    {
        return substr_compare($haystack, $needle, -strlen($needle)) === 0;
    }
}




try {
    include(dirname(__FILE__) . "/../../../models/" . $className . "_Config.php");
    $obj_name = $className . "_config";
    if (function_exists($obj_name)) {
        $$obj_name = $obj_name();
    }
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file.\n";
}


$new_label = "";
$construct_var = "";
?>

include_once("functions.php");
include("<?= $className ?>_Config.php");

/**
* This is the model class for table "<?= $generator->generateTableName($tableName) ?>".
*
<?php foreach ($properties as $property => $data) : ?>
    * @property <?= "{$data['type']} \${$property}" . ($data['comment'] ? ' ' . strtr($data['comment'], ["\n" => ' ']) : '') . "\n" ?>
<?php endforeach; ?>
<?php if (!empty($relations)) : ?>
    *
    <?php foreach ($relations as $name => $relation) : ?>
        * @property <?= $relation[1] . ($relation[2] ? '[]' : '') . ' $' . lcfirst($name) . "\n" ?>
    <?php endforeach; ?>
<?php endif; ?>
*/



class <?= $generator->generateInheritance ? "Xx" : "" ?><?= $className ?> extends <?= '\\' . ltrim($generator->baseClass, '\\') . "\n" ?>
{


/**
* {@inheritdoc}
*/
public static function tableName()
{
return '<?= $generator->generateTableName($tableName) ?>';
}
<?php if ($generator->db !== 'db') : ?>

    /**
    * @return \yii\db\Connection the database connection used by this AR class.
    */
    public static function getDb()
    {
    return Yii::$app->get('<?= $generator->db ?>');
    }
<?php endif; ?>

<?
$plug_in = Yii::$app->params['bootstrap']["app\\models\\" . $className]['model'];
if ($plug_in != null) {
    require(Yii::$app->basePath . '/myTemplates/plugin/' . $plug_in . '_model.php');
}
?>

<?php
if ($$obj_name != null) {
    $new_label2 = "";
    //foreach ($labels as $name => $label): 
    foreach ($$obj_name['dataLabel'] as $name => $val) :
        if ($val['disable'] == "1") continue;
        $label_value = $val['value'];
        $field_type = $val['field_type'];
        $field_type_ext_data = $val['field_type_ext_data'];
        $field_type_ext_array = explode("[seperator]", $field_type_ext_data);
        $virtual_parameter = 0;
        if ($label_value != null) {
            $virtual_parameter = 1;
            if ($label_value == "virtual") {
                echo "var $" . $name . ";\n";
                $field_type_ext_array2 = explode(";", $field_type_ext_array[1]);
                if ($field_type_ext_array2[0] === "1") {
                    //$new_label3=$new_label3."'".$name."',";
                    $count = count($field_type_ext_array2);
                    for ($ke = 1; $ke < $count; $ke++) {
                        $new_label3 = $new_label3 . "['" . $name . "',  " . $field_type_ext_array2[$ke] . "],";
                    }
                } else {
                    $new_label2 = $new_label2 . "'" . $name . "',";
                }
            } else if ($label_value != "") {
                echo "var $" . $name . "_var;\n";
                $ref_table2 = "";
                $ref_table = "";
                $split_array = explode("_", $name);
                $no = 0;
                $max_no = count($split_array);
                $field_type_ext_data = $val['field_type_ext_data'];
                $field_type_ext_array = explode("[seperator]", $field_type_ext_data);
                if (count($field_type_ext_array) > 1) {
                    $field_type_ext_array2 = explode(";", $field_type_ext_array[1]);
                    if ($field_type_ext_array2[0] === "1") {
                        //$new_label3=$new_label3."'".$name."',";
                        $count = count($field_type_ext_array2);
                        for ($ke = 1; $ke < $count; $ke++) {
                            $new_label3 = $new_label3 . "['" . $name . "',  " . $field_type_ext_array2[$ke] . "],";
                        }
                    }
                }
                foreach ($split_array as $split_str) {
                    if ($no == 0) {
                        $ref_table2 = $ref_table2 . $split_str;
                    } else {
                        $ref_table2 = $ref_table2 . ucfirst($split_str);
                    }
                    $ref_table = $ref_table . ucfirst($split_str);
                    $no = $no + 1;
                }
                echo "public function get" . $ref_table . "() {\n"
                    . "\treturn " . $label_value . ";"
                    . "\t}\n";
                echo "public function set" . $ref_table . "(\$param) {\n"
                    . "\$this->" . $name . "_var=\$param;"
                    . "\t}\n";
            };
        } else {
            //parameter 
            // di load . .$field_type_ext_array2
            //$field_type_ext_array2=explode(";",$field_type_ext_array[1]);


        }
        //echo '$name:'.$name."\n";

        //echo "name:".$name."\n";
        $label = $val['name'];
        //if (($label=="") or ($label == null)) {
        //    continue;
        //};
        $update_label = false;
        if ($label == "" or $label == null) {
            $label = $labels[$name];
            if ($label == "" or $label == null) {
                //continue;
                $label = $name;
            }
            $xlabel = $generator->generateString($label);
            $xlabel = str_replace("'", "", $xlabel);
            $xlabel2 = strstr($xlabel, " ");
            if ($xlabel2 != "") {
                $xlabel = substr($xlabel2, 1);
            }
            $update_label = true;
        } else {
            $xlabel = $label;
        }

        //echo 'field_type:'.$field_type."\n";
        //if ($label_value!=null and $label_value!=""){
        //} else 
        {

            if (($field_type == 'password')) {
                $user_attr = $field_type_ext_array[3];
                $new_label3 = $new_label3 . "['" . $name . "',\kartik\password\StrengthValidator::className(), 'preset'=>'normal','userAttribute'=>'" . $user_attr . "'],";
            }
            $plug_in = Yii::$app->params['plugin_datatype'][$name];
            if ($plug_in != null) {
                require(Yii::$app->basePath . '/myTemplates/plugin/' . $plug_in['name'] . '_model.php');
            } else if (($field_type == 'extend') or endsWith($name, "_extend") or ($field_type == 'f-extend') or ($field_type == 'af-extend')) {
                $ref_table2 = "";
                $ref_table = "";
                $split_array = explode("_", $name);
                $no = 0;
                $max_no = count($split_array);
                foreach ($split_array as $split_str) {
                    if ($no == 0) {
                        $ref_table2 = $ref_table2 . $split_str;
                    } else {
                        $ref_table2 = $ref_table2 . ucfirst($split_str);
                    }
                    $ref_table = $ref_table . ucfirst($split_str);
                    $no = $no + 1;
                }
                $xlabel2 = $xlabel;

                $xlabel = "\$this->get" . $ref_table . "Title()";
                $xlabel3 = "\$this->get" . $ref_table . "TitleFixed()";
                $new_label = $new_label . "'" . $ref_table2 . "Str' => " . $xlabel . ",\n";
                $new_label = $new_label . "'" . strtolower($ref_table) . "str' => " . $xlabel . ",\n";
                $new_label = $new_label . "'" . $name . "' => " . $xlabel . ",\n";
                $new_label = $new_label . "'" . $name . "_fixed' => " . $xlabel3 . ",\n";
                echo "public function get" . $ref_table . "Str() {\n"
                    . "\treturn \$this->" . $name . ";"
                    . "\t}\n";
                echo "public function get" . $ref_table . "Title() {\n"
                    . "\treturn \$this->flexParameter3('" . $className . "','" . $name . "','" . $xlabel2 . "');"
                    . "\t}\n";
                echo "public function get" . $ref_table . "TitleFixed() {\n"
                    . "\treturn '';"
                    . "\t}\n";
            } else if (($field_type == 'date') or ($field_type == 'datetime') or ($field_type == 'date') or  ($field_type == 'time') or ($field_type == 'boolean') or ($field_type == 'money') or endsWith($name, "_boolean") or endsWith($name, "_money") or endsWith($name, "_date") or endsWith($name, "_datetime") or endsWith($name, "_time")) {
                $ref_table2 = "";
                $ref_table = "";
                $split_array = explode("_", $name);
                $no = 0;
                $max_no = count($split_array);
                foreach ($split_array as $split_str) {
                    if ($no == 0) {
                        $ref_table2 = $ref_table2 . $split_str;
                    } else {
                        $ref_table2 = $ref_table2 . ucfirst($split_str);
                    }
                    $ref_table = $ref_table . ucfirst($split_str);
                    $no = $no + 1;
                }


                if (($field_type == 'date') or endsWith($name, "_date")) {
                    if ($update_label) {
                        $xlabel = str_replace("Date", "", $xlabel);
                    }
                    $xlabel = "\$this->flexParameter3('" . $className . "','" . $name . "','" . $xlabel . "')";
                    $new_label = $new_label . "'" . $ref_table2 . "Str' => " . $xlabel . ",\n";
                    $new_label = $new_label . "'" . strtolower($ref_table) . "str' => " . $xlabel . ",\n";
                    $new_label = $new_label . "'" . $name . "' => " . $xlabel . ",\n";
                    echo "public function get" . $ref_table . "Str() {\n"
                        . "\treturn date('Y-m-d', strtotime(\$this->" . $name . "));"
                        . "\t}\n";
                } else if (($field_type == 'datetime') or endsWith($name, "_datetime")) {
                    if ($update_label) {
                        $xlabel = str_replace("Datetime", "", $xlabel);
                    }
                    $xlabel = "\$this->flexParameter3('" . $className . "','" . $name . "','" . $xlabel . "')";
                    $new_label = $new_label . "'" . $ref_table2 . "Str' => " . $xlabel . ",\n";
                    $new_label = $new_label . "'" . strtolower($ref_table) . "str' => " . $xlabel . ",\n";
                    $new_label = $new_label . "'" . $name . "' => " . $xlabel . ",\n";
                    echo "public function get" . $ref_table . "Str() {\n"
                        . "\treturn date('Y-m-d H:i:s', strtotime(\$this->" . $name . "));"
                        . "\t}\n";
                } else if (($field_type == 'time') or endsWith($name, "_time")) {
                    if ($update_label) {
                        $xlabel = str_replace("Time", "", $xlabel);
                    }
                    $xlabel = "\$this->flexParameter3('" . $className . "','" . $name . "','" . $xlabel . "')";
                    $new_label = $new_label . "'" . $ref_table2 . "Str' => " . $xlabel . ",\n";
                    $new_label = $new_label . "'" . strtolower($ref_table) . "str' => " . $xlabel . ",\n";
                    $new_label = $new_label . "'" . $name . "' => " . $xlabel . ",\n";
                    echo "public function get" . $ref_table . "Str() {\n"
                        . "\treturn date('H:i:s', strtotime(\$this->" . $name . "));"
                        . "\t}\n";
                } else if (($field_type == 'money') or endsWith($name, "_money")) {
                    if ($update_label) {
                        $xlabel = str_replace("Money", "", $xlabel);
                    }
                    $xlabel = "\$this->flexParameter3('" . $className . "','" . $name . "','" . $xlabel . "')";
                    $new_label = $new_label . "'" . $ref_table2 . "Str' => " . $xlabel . ",\n";
                    $new_label = $new_label . "'" . strtolower($ref_table) . "str' => " . $xlabel . ",\n";
                    $new_label = $new_label . "'" . $name . "' => " . $xlabel . ",\n";
                    echo "public function get" . $ref_table . "Str() {\n"
                        . "\treturn number_format(\$this->" . $name . ");"
                        . "\t}\n";
                } else if (($field_type == 'boolean') or endsWith($name, "_boolean")) {
                    if ($update_label) {
                        $xlabel = str_replace("Boolean", "", $xlabel);
                    }
                    $xlabel = "\$this->flexParameter3('" . $className . "','" . $name . "','" . $xlabel . "')";
                    $new_label = $new_label . "'" . $ref_table2 . "Str' => " . $xlabel . ",\n";
                    $new_label = $new_label . "'" . strtolower($ref_table) . "str' => " . $xlabel . ",\n";
                    $new_label = $new_label . "'" . $ref_table2 . "Str2' => " . $xlabel . ",\n";
                    $new_label = $new_label . "'" . strtolower($ref_table) . "str2' => " . $xlabel . ",\n";
                    $new_label = $new_label . "'" . $name . "' => " . $xlabel . ",\n";
                    echo "public function get" . $ref_table . "Str() {\n"
                        . "\tif (\$this->" . $name . "==1) { return true;} else {return false;};"
                        . "\t}\n";
                    echo "public function get" . $ref_table . "Str2() {\n"
                        . "\tif (\$this->" . $name . "==1) { return 'true';} else {return 'false';};"
                        . "\t}\n";
                    echo "var $" . strtolower($ref_table) . "str2;\n";
                }


                echo "var $" . strtolower($ref_table) . "str;\n";
                //} else if (($field_type == 'capcha')) {
                //    $new_label3=$new_label3."['".$name."','captcha'],";

            } else if (($field_type == 'location')) {
                $field_type_ext_data_array = explode(",", $field_type_ext_data);
                $construct_var = $construct_var . "\$this->" . $name . "=\$this->" . $field_type_ext_data_array[1] . ".':'.\$this->" . $field_type_ext_data_array[0] . ";\n";
            } else if (($field_type == 'id') or (endsWith($name, "_id") or endsWith($name, "_id1") or endsWith($name, "_id2") or endsWith($name, "_id3"))) {
                require(Yii::$app->basePath . '/myTemplates/plugin/id_model.php');
            } else if (($field_type == 'ref') or endsWith($name, "_ref")) {

                $ref_table = "";
                $ref_table2 = "";
                $ref_param = "";

                if ($field_type_ext_data === "") {
                    $split_array = explode("_", $name);
                } else {
                    $split_array = explode("_", $field_type_ext_data);
                }
                $no = 0;
                $max_no = count($split_array);
                if ($max_no > 2) {

                    foreach ($split_array as $split_str) {
                        $ref_table = $ref_table . ucfirst($split_str);

                        if ($no == 0) {
                            $ref_table2 = $ref_table2 . $split_str;
                        } else {
                            $ref_table2 = $ref_table2 . ucfirst($split_str);
                        }
                        if ($no != 0 and $no != ($max_no - 1)) {
                            if ($no == 1) {
                                $ref_param = $ref_param . $split_str;
                            } else {
                                $ref_param = $ref_param . ucfirst($split_str);
                            }
                        }
                        $no = $no + 1;
                    }
                }


                if ($update_label) {
                    $xlabel = str_replace("Ref", "", $xlabel);
                }
                $xlabel = "\$this->flexParameter3('" . $className . "','" . $name . "','" . $xlabel . "')";
                $new_label = $new_label . "'" . $ref_table2 . "Str' => " . $xlabel . ",\n";
                $new_label = $new_label . "'" . $name . "' => " . $xlabel . ",\n";

                echo "public function get" . $ref_table . "Str() {\n"
                    . "return Yii::\$app->params['" . $ref_param . "'][\$this->" . $name . "];\n"
                    . "}\n";
            } else if (($field_type == 'Number') or endsWith($label, "Number")) {
                if ($update_label) {
                    $xlabel = str_replace("Number", "", $xlabel);
                }
                $xlabel = "\$this->flexParameter3('" . $className . "','" . $name . "','" . $xlabel . "')";
                $new_label = $new_label . "'" . $name . "' => " . $xlabel . ",\n";
            } else if (($field_type == 'Notes') or endsWith($label, "Notes")) {
                if ($update_label) {

                    if ($xlabel != "Notes") {
                        $xlabel = str_replace("Notes", "", $xlabel);
                    }
                }
                $xlabel = "\$this->flexParameter3('" . $className . "','" . $name . "','" . $xlabel . "')";
                $new_label = $new_label . "'" . $name . "' => " . $xlabel . ",\n";
            } else if (($field_type == 'Time') or endsWith($label, "Time")) {
                if ($update_label) {
                    $xlabel = str_replace("Time", "", $xlabel);
                }
                $xlabel = "\$this->flexParameter3('" . $className . "','" . $name . "','" . $xlabel . "')";
                $new_label = $new_label . "'" . $name . "' => " . $xlabel . ",\n";
            } else if (($field_type == 'Datetime') or endsWith($label, "Datetime")) {
                if ($update_label) {
                    $xlabel = str_replace("Datetime", "", $xlabel);
                }
                $xlabel = "\$this->flexParameter3('" . $className . "','" . $name . "','" . $xlabel . "')";
                $new_label = $new_label . "'" . $name . "' => " . $xlabel . ",\n";
            } else {
                $xlabel = "\$this->flexParameter3('" . $className . "','" . $name . "','" . $xlabel . "')";
                //$xlabel=$$obj_name['dataLabel'][$name]['name'];
                //$xlabel="$".$className."_config['name']";
                $new_label = $new_label . "'" . $name . "' => " . $xlabel . ",\n";
                //$user_attr=$field_type_ext_array[3];
                //if !=null kosong.. 
                //$new_label3=$new_label3."['".$name."',\kartik\password\StrengthValidator::className(), 'preset'=>'normal','userAttribute'=>'".$user_attr."'],";
            }
        }




    endforeach;
};
?>
<?

?>
public function flexParameter3($className,$name,$xlabel){

$title=$this-><?= $className . "_config" ?>['dataLabel'][$name]['name'];
if ($title==null or $title=="") {
return $xlabel;
} else {
return $title;
}

}
<? if ($$obj_name['API_flag'] == 1) : ?>
    <? for ($i = 0; $i < 3; $i++) {
        if ($i == 0) {
            $file_no = "";
            $file_no_import = null;
        } else {
            $file_no = "_" . ($i + 1);
            $file_no_import = $i + 1;
        }
        $import_file = $$obj_name['index' . $file_no];
        if ($import_file['import']['field_import'] != '') {
            $new_label2 .= "'import_file" . $file_no_import . "',";
            $var_import .= "\$var import_file" . $file_no_import . ";\n";
        }
    } ?>
    <?= $var_import ?>

<? endif; ?>
var $title_log='<?=$className?>_config';
/**
* {@inheritdoc}
*/
public function rules()
{
return [<?= empty($rules) ? '' : ("\n            " . implode(",\n            ", $rules) . ",\n        ") ?>
<?= "[[" . $new_label2 . "], 'safe']" ?>,
<?= $new_label3 ?>
];
}


/**
* {@inheritdoc}
*/
public function attributeLabels()
{
return [
<?= $new_label ?>
];
}
<?php foreach ($labels as $name => $label) : ?>
    <? // "'$name' => '".reArrangeLabel($generator->generateString($label)). "',\n" 
    ?>
<?php endforeach; ?>





<?php foreach ($relations as $name => $relation) : ?>

    /**
    * @return \yii\db\ActiveQuery
    */
    public function get<?= $name ?>()
    {
    <?= $relation[0] . "\n" ?>
    }
<?php endforeach; ?>
<?php if ($queryClassName) : ?>
    <?php
    $queryClassFullName = ($generator->ns === $generator->queryNs) ? $queryClassName : '\\' . $generator->queryNs . '\\' . $queryClassName;
    echo "\n";
    ?>
    /**
    * {@inheritdoc}
    * @return <?= $queryClassFullName ?> the active query used by this AR class.
    */
    public static function find()
    {
    return new <?= $queryClassFullName ?>(get_called_class());
    }
<?php endif; ?>

var $<?= $className . "_config" ?>;
function __construct() {
parent::__construct();
$this-><?= $className . "_config" ?>=<?= $className . "_config" ?>();

}

public function afterFind ( ){
parent::afterFind();
<?= $construct_var ?>
}
public function beforeDelete()
{
if (!parent::beforeDelete()) {
return false;
}
<?php foreach ($relations as $name => $relation) : ?>
    <? if ($relation[2]) : ?>
        if($this-><?= lcfirst($name) ?>!=null) {
        return false;
        }
    <? endif; ?>
<?php endforeach; ?>
return true;


}


}