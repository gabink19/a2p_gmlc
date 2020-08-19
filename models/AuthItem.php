<?php
//gii_manual_update

namespace app\models;

use Yii;




class AuthItem extends XxAuthItem{

    public function getShowName(){
        if ($this->type==1) {
            if ($this->menu1=="") {
               return $this->menu1."-".$this->menu2." (".$this->name.")";
            } else {
               return $this->menu1."-".$this->menu2;
                
            }
        } else if ($this->type==3){
            if ($this->menu_label=="") {
                return $this->menu_label."-(menu:".$this->menu1."\\".$this->menu2.")"." (".$this->name.")";
            } else {
                return $this->menu_label."-(menu:".$this->menu1."\\".$this->menu2.")";
                
            }
                
        } else {
            return "profile:".$this->name;
        }
    }
    public function getPerentname()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'perent']);
    }

}
