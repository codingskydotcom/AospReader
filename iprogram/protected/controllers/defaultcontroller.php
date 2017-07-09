<?php

class CrumbItem
{
	public $name = "";
	public $url  = "";
}

class DefaultController extends CController
{
	public $module = null;
	public $crumbs = null;
	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
		$this->layout = "default";
		
		$crumbItem = new CrumbItem();
		$crumbItem->url = "/site";
		$crumbItem->name = "首页";
		$this->crumbs = array($crumbItem);
		
		setCurrentController($this->getId());
	}
	
	public function addCrumbItem($name,$url = "")
	{
		$crumbItem = new CrumbItem();
		$crumbItem->url = $url;
		$crumbItem->name = $name;
		array_push($this->crumbs, $crumbItem);
	}
	
	public function getCrumb()
	{
		return 	$this->crumbs;
	}
	
	public function actionIndex(){
		$this->render("index",null);
	}
	
	//读取URL中的页码，为了和显示一致，PAGENO从1开始，即1表示第0页
	public function getPageNo(){
		if(key_exists("pageno", $_GET)){
			$pageno = $_GET["pageno"];
			if($pageno > 0){
				return $pageno - 1;
			}
		}
		return 0;
	}
	
	public function getQueryString($key){
		if(array_key_exists($key, $_GET)){
			return $_GET["{$key}"];
		}
		if(array_key_exists($key, $_POST)){
			return $_POST["{$key}"];
		}
		return "";
	}

    public function getQueryStringEx($key,$def){
        if(array_key_exists($key, $_GET)){
            return $_GET["{$key}"];
        }
        if(array_key_exists($key, $_POST)){
            return $_POST["{$key}"];
        }
        return $def;
    }
	
	public function getConditionArray($condition){
		$result = explode(",",$condition);

		$realResult = array();
		foreach($result as $resultItem){
			if(strlen($resultItem) > 0){
				array_push($realResult, $resultItem);
			}
		}

		return $realResult;
	}
	
	/*public function loadModel()
	{
		if($this->_model === null)
		{
			if(isset($_GET['id']))
				$this->_model=Comment::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}*/
}