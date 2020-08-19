<?php

namespace app\helpers;

/**
 * Inflector pluralizes and singularizes English nouns. It also contains some other useful methods.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @since 2.0
 */
class Strings 
{
    function convertToDir($__camel2id_modelClass){
        $camel2id_modelClass=$__camel2id_modelClass[0];
        $length = strlen($__camel2id_modelClass);
        for ($i=1; $i<$length; $i++) {
            if (ctype_upper ($__camel2id_modelClass[$i])){
                $camel2id_modelClass=$camel2id_modelClass.'-';
            };
            $camel2id_modelClass=$camel2id_modelClass.$__camel2id_modelClass[$i];

        }
        return strtolower($camel2id_modelClass);

    }
    function getclass($field){
        
        $split_array = explode("_", $field);
        $no=0;
        $max_no = count($split_array);
        $ret_field=$split_array[0];                        
        foreach ($split_array as $split_str) {
            if ($no!=0 and $no<($max_no-2)){
                $ret_field=$ret_field."-".$split_str;
            };
            $no = $no + 1;
        }
                                
        return $ret_field;
    }
}
