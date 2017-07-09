<?php

class DiffContainer{
	private $diffs = null;
	
	public function __construct(){
		$this->diffs = array();
	}
	
	public function getData(){
		return $this->diffs;
	}
	
	public function appendDiff($osapi,$osname,$md5,$file){
		$finded = false;
		$totalCount = count($this->diffs);
		for($i = 0;$i < $totalCount;$i++){
			$diffItem = $this->diffs[$i];
			if(strcasecmp($md5, $diffItem["md5"]) == 0){
				$finded = true;
				array_push($this->diffs[$i]["data"], array(
						"osapi" => $osapi,
						"osname" => $osname,
						"file" => $file
					)); 
			}
		}
		
		if(!$finded){
			array_push($this->diffs, array(
					"md5" => $md5,
					"data" => array(
						array(
							"osapi" => $osapi,
							"osname" => $osname,
							"file" => $file
							)
					),
				));
		}
	}
	
}