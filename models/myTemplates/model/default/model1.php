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
        return parent::findOne($condition);
    }  
    
    public function save($runValidation = true, $attributeNames = null)
    {
        return parent::save($runValidation,$attributeNames);
    
    }
    
    public function delete(){
        return parent::delete();
    
    }

}
