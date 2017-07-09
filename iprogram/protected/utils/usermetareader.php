<?php

class UserMetaReader{
	private $_meta = null;
	public function setMeta($meta){
		$this->_meta = $meta;
	}
	
	private function getField($field,$default = ""){
		if($this->_meta == null) return $default;
		
		if(array_key_exists($field, $this->_meta)){
			return $this->_meta[$field];
		}
		return $default;
	}
	
	public function getNickname(){
		$this->getField("nickname");
	}
	
	public function getEmail(){
		$this->getField("email");
	}
	
	public function getMobile(){
		$this->getField("mobile");
	}
	
	public function getQQ(){
		$this->getField("qq");
	}
	
	public function getSkype(){
		$this->getField("skype");
	}
	
	public function getWeibo(){
		$this->getField("weibo");
	}
	
	public function getGTalk(){
		$this->getField("gtalk");
	}
	
	public function getCorp(){
		$this->getField("corp");
	}
	
	public function getWebsite(){
		$this->getField("website");
	}
	
	public function getSign(){
		$this->getField("sign");
	}
}