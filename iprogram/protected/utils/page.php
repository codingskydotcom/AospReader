<?php

class HtmlPage {
	var $name;
	var $argName;
	var $showTimes;
	
	var $page;
	var $pageCount;
	
	var $staticMode;
	
	function HtmlPage(){
		$this->name = "defaultpager";
		$this->argName = "defaultpager";
		$this->showTimes = 1;
		$this->page = 1;
		$this->pageCount = 1;
		$this->staticMode = false;
	}
	
	public function setStaticMode($staticMode)
	{
		$this->staticMode = $staticMode;
	}
	
	public function setPageInfo($totalPage){
		$totalPage = intval($totalPage);
		//$currentPage = intval($currentPage);
		
		//if($currentPage < $totalPage){
			//$this->page = $currentPage;
			$this->pageCount = $totalPage;
		//}
	}
	
	public function createBaseUrl(){ //生成页面跳转url
		$url = $_SERVER['REQUEST_URI'];
		return $url;
	}
	
	public function removeLastDot(){
		$url = $_SERVER['REQUEST_URI'];
		$pos = stripos($url,".html");
		//echo (strlen($url) - 5) . "==" . $pos; 
		if($pos == strlen($url) - 5){
			return substr($url, 0,strlen($url) - 5);
		}
		return $url;	
	}
	
	public function getPage(){
		if(key_exists("pageno", $_GET)){
			return intval($_GET["pageno"]);
		}
		return 1;
	}
	
	function printHtml($baseUrl){
		$this->page = $this->getPage();
		$this->checkPages();
		$this->showTimes += 1;
		
		$result = '<div id="pages_' . $this->name . '_' . $this->showTimes . '" class="pages">' . $this->createHtml($baseUrl) . '</div>';
		echo $result; 
	}
	
	function checkPages(){
		if($this->page <= 0){
			$this->page = 1;
		}
		
		if($this->pageCount < 1){
			$this->page = 1;
		}
		
		if($this->page > $this->pageCount){
			$this->page = 1;
		}
	}
	
	function getPageUrl($baseUrl,$page){
		if($this->staticMode){
			return $baseUrl . $page . ".html";
		}else{
			return $baseUrl . $page;
		}
	}
	
	function createHtml($baseUrl){
		$strHtml = '';
		$prevPage = $this->page - 1;
		$nextPage = $this->page + 1;

		$strHtml = $strHtml . '<span class="number">';
		if ($prevPage < 1) {
			$strHtml = $strHtml . '<span title="第一页">«</span>';
			$strHtml = $strHtml . '&nbsp;&nbsp;';
			$strHtml = $strHtml . '<span title="上一页">‹</span>';
			$strHtml = $strHtml . '&nbsp;&nbsp;';
		} else {
			$strHtml = $strHtml . '<span title="第一页"><a href="' . $this->getPageUrl($baseUrl, 1) . '">«</a></span>';
			$strHtml = $strHtml . '&nbsp;&nbsp;';
			$strHtml = $strHtml . '<span title="上一页"><a href="' . $this->getPageUrl($baseUrl, $prevPage)  . '">‹</a></span>';
			$strHtml = $strHtml . '&nbsp;&nbsp;';
		}
		if ($this->page != 1) {
			$strHtml = $strHtml . '<span title="第1页"><a href="' . $this->getPageUrl($baseUrl, 1) . '" class="pageitem">1</a></span>';
			$strHtml = $strHtml . '&nbsp;&nbsp;';
		}
		
		if ($this->page >= 5) {
			$strHtml = $strHtml . '<span>...</span>';
			$strHtml = $strHtml . '&nbsp;&nbsp;';
		}
		
		if ($this->pageCount > $this->page + 2) {
			$endPage = $this->page + 2;
		} else {
			$endPage = $this->pageCount;
		}
		
		for ($i = $this->page - 2; $i <= $endPage; $i++) {
			if ($i > 0) {
				if ($i == $this->page) {
					$strHtml = $strHtml . '<span  class="pageitem_active" title="第' . $i . '页">' . $i . '</span>';
					$strHtml = $strHtml . '&nbsp;&nbsp;';
				} else {
					if ($i != 1 && $i != $this->pageCount) {
						$strHtml = $strHtml . '<span title="第' . $i . '页"><a class="pageitem" href="' . $this->getPageUrl($baseUrl, $i) . '">' . $i . '</a></span>';
						$strHtml = $strHtml . '&nbsp;&nbsp;';
					}
				}
			}
		}
		//strHtml += '&nbsp;&nbsp;';
		if ($this->page + 3 < $this->pageCount) {
			$strHtml = $strHtml . '<span>...</span>';
			$strHtml  = $strHtml . '&nbsp;&nbsp;';
		}
	
		if ($this->page != $this->pageCount) { 
			$strHtml  = $strHtml . '<span title="第' . $this->pageCount . '页"><a class="pageitem" href="' . $this->getPageUrl($baseUrl, $this->pageCount) . '">' . $this->pageCount . '</a></span>';
			$strHtml  = $strHtml . '&nbsp;&nbsp;';
		}
	
		if ($nextPage > $this->pageCount) {
			$strHtml  = $strHtml . '<span title="下一页">›</span>';
			$strHtml  = $strHtml . '&nbsp;&nbsp;';
			$strHtml  = $strHtml . '<span title="最后一页">»</span>';
		} else {
			$strHtml  = $strHtml . '<span title="下一页"><a href="' . $this->getPageUrl($baseUrl, $nextPage) . '">›</a></span>';
			$strHtml  = $strHtml . '&nbsp;&nbsp;';
			$strHtml  = $strHtml . '<span title="最后一页"><a href="' . $this->getPageUrl($baseUrl, $this->pageCount) . '">»</a></span>';
		}
		$strHtml = $strHtml . '</span><br/>';
		return $strHtml;
	}	
}