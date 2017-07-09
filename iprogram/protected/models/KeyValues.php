<?php

class KeyValues extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'keyvalues';
	}
	
	public function getKeyValue($key){
		$sql = "select valueitem from keyvalues where keyitem = '" . addslashes($key) . "'";
		$result = $this->querySql($sql);
		if($result != null && count($result) == 1){
			return $result[0]["valueitem"]; 
		}
		return "";
	}
	
	public function saveKeyValue($key,$value){
		if($this->isKeyExist($key)){
			$this->updateKeyValue($key, $value);
		}else{
			$this->addKeyValue($key, $value);
		}
	}
	
	public function isKeyExist($key){
		$sql = "select count(*) as totalcount from keyvalues where keyitem = '" . addslashes($key) . "'";
		$result = $this->querySql($sql);
		if($result != null && count($result) == 1){
			return $result[0]['totalcount'] > 0;
		}
		return false;
	}
	
	public function addKeyValue($key,$value){
		$sql = "insert into keyvalues(keyitem,valueitem) values('" . addslashes($key) . "','" . 
					addslashes($value) . "')";
		$this->runSql($sql);
	}
	
	public function updateKeyValue($key,$value){
		$sql = "update keyvalues set valueitem = '" . addslashes($value) . 
					"' where keyitem = '" . addslashes($key) . "'";
		$this->runSql($sql);
	}
}