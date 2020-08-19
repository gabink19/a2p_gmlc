<?php

namespace app\models;

use Yii;

class ReportGeneratorX extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_json';
    }
	
	public function rules()
    {
        return [
            [['tj_id'], 'integer'],
            [['tj_name'], 'string', 'max' => 100],
            [['tj_desc','tj_file'], 'string', 'max' => 255],
            [['tj_name'], 'cek_unique', 'skipOnEmpty'=>false],

        ];
    }

    function cek_unique($attribute, $params){
        $unique =  ReportGeneratorX::find()->where("tj_name='{$this->tj_name}' AND tj_id<>'{$this->tj_id}'")->count();
        
        if($unique)
            $this->addError("tj_name","Name has already been taken.");
    }

	public function attributeLabels()
    {
        return [
            'tj_id'		=> 'ID',
			'tj_name'	=> 'Name',
			'tj_desc' 	=> 'Description',
			'tj_file' 	=> 'Filename',
        ];
    }
}
