<?php

class AndroidOsSearch extends CActiveRecord
{
	private $recordPerPage = 50;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'android_os_search';
	}
	
	public function getSearchPage($text,$os){
		$sql = "select count(*) as totalcount from android_os_search where filename like '" . addslashes($text) . "%'";
		
		if($os > 0){
			$sql = $sql . " and os = " . intval($os);
		}
		
		$result = $this->querySql($sql);
		$totalCount = $result[0]['totalcount'];
	
		return array(
				'totalcount' => (int)$totalCount,
				'pagecount' => (int)($totalCount / $this->recordPerPage) + 1,
				'countperpage' => $this->recordPerPage
		);
	}
	
	public function searchFileName($text, $os, $startPage){
		$startOffset = $startPage * $this->recordPerPage;
		$sql = "select * from android_os_search where filename like '" . addslashes($text) . "%' ";
		if($os > 0){
			$sql = $sql . " and os = " . intval($os);  
		}
		$sql .= " order by filename asc ";
		$sql .= " limit {$startOffset},{$this->recordPerPage}";
		
		return $this->querySql($sql);
	}
	
	public function getOsList($text){
		$sql = "select distinct os from android_os_search where filename like '" . addslashes($text) . "%' order by os asc";		
		return $this->querySql($sql);
	}
}