<?php

/*
 * 使用http://androidos.codingsky.com/androidos/buildmeta?os={api}生成配置
 * */

require_once "defaultcontroller.php";
require_once "iprogram/protected/utils/ioutil.php";
require_once "iprogram/protected/config/androidos.config.php";
class AndroidosController extends DefaultController
{
	public function __construct($id, $module = null){
		parent::__construct($id, $module);
		$this->layout = "androidos";
	}
	
	public function actionIndex(){
		$os = -1;

        $q = $this->getQueryStringEx("q","");
        $os = intval($this->getQueryStringEx("os",0));

		if(strlen($q) == 0){
			$this->render("index",array(
				    "android_os_list" => get_android_os_alias(),
			));
			return;
		}
		
		//开始搜索
		$androidOsSearch = new AndroidOsSearch();
		$pageinfo = $androidOsSearch->getSearchPage($q, $os);

		$oslist = null;
		if($os < 0){
			$oslist = $androidOsSearch->getOsList($q);
		}
		
		$result = $androidOsSearch->searchFileName($q, $os, $this->getPageNo());
		
		$androidOs = new AndroidOsFileConfig();
		$totalcount = count($result);
		for($i = 0;$i < $totalcount;$i++){
			$osinfo = $androidOs->getOsInfo($result[$i]["os"]);
			if($osinfo == null){
				$result[$i]["osname"] = "";
				$result[$i]["osroot"] = "";
			}else{
				$result[$i]["osroot"] = $osinfo["dir"];
				$result[$i]["osname"] = $osinfo["name"];
			}
		}
		
		$totalcount = count($oslist);
		for($i = 0;$i < $totalcount;$i++){
			$osinfo = $androidOs->getOsInfo($oslist[$i]["os"]);
			if($osinfo == null){
				$oslist[$i]["osname"] = "";
				$oslist[$i]["osroot"] = "";
			}else{
				$oslist[$i]["osroot"] = $osinfo["dir"];
				$oslist[$i]["osname"] = $osinfo["name"];
			}
		}
		
		$currentsearchos = $androidOs->getOsInfo($os);
		
		$this->render("searchresult",array(
				"list" => $result,
				"oslist" => $oslist,
				"searchtext" => $q,
				"searchos" => $os,
				"searchosname" => $currentsearchos == null ? "" : $currentsearchos["name"],
				"pageinfo" => $pageinfo,
			));
	}
	
	public function actionBrowser(){
	    //get input
        $ossdk = intval($this->getQueryStringEx("os",0));
        $relativepath = $this->getQueryStringEx("path","");

        if($ossdk <= 0){
            throw new CHttpException(404);
        }
		
        //get server env from user input
		$androidOs = new AndroidOsFileConfig();
		$rootpath = $androidOs->getSdkPath($ossdk);
        $allos = $androidOs->getAll();
		$osname = $androidOs->getSdkName($ossdk);

		if(strlen($rootpath) == 0){
            throw new CHttpException(500,"no source code dir at sdk {$ossdk}");
		}

		if(strpos($relativepath, "..") > 0 || strcasecmp($relativepath, "..") == 0){
            throw new CHttpException(404,"the path is illega");
		}

		$folder = $rootpath . "/" . $relativepath;
		$folder = str_replace("\\","/",$folder);
		$folder = str_replace("//","/",$folder);
		
		$relativepath = "/" . $relativepath . "/";
		$relativepath = str_replace("//","/",$relativepath);
		$relativepath = str_replace("//","/",$relativepath);
		
		$childFile = array();
		$childFolder = array();

		if (is_dir($folder)){
			$dh = null;
			if ($dh = opendir($folder)){
				while (($file = readdir($dh)) != false){
					if(strcasecmp($file, ".") == 0 || strcasecmp($file, "..") == 0 || strpos($file,".") === 0){
						continue;
					}
					
					//文件名的全路径 包含文件名
					$curfilePath = $folder . "/" . $file;
					$curfilePath = str_replace("//","/",$curfilePath);
					//echo $curfilePath;
					if(is_dir($curfilePath) > 0){
						array_push($childFolder,
							array(
								"name" => $file,
								"relative" => $relativepath . $file,
							) 
						);
					}else{
						array_push($childFile,
							array(
								"name" => $file,
								"relative" => $relativepath . $file,
							) 
						);
					}
				}
				closedir($dh);
			}
		}
		
		$introduce = "";
		$showloadIntroduce = strlen($this->getQueryStringEx("path","")) > 0;
		if($showloadIntroduce){
			$osinfoQuery = new AndroidOsInfo();
			$introduce = $osinfoQuery->getOsIntroduce($ossdk);
		}
		
		$this->render("folder",array(
				"allos" => $allos,
				"ossdk" => $ossdk,
				"osname" => $osname,
				"rootpath" => $rootpath,
				"introduce" => $introduce,
				"relativepath" => $relativepath,
				"childfile" => $childFile,
				"childfolder" => $childFolder,
			));
	}
	
	public function actionCode(){
		$file = $this->getQueryString("src");
		if(strlen($file) == 0 || strpos($file, "..") > 0){
			$this->redirect("/");
			return;
		}
		
		$rawshow = false;
		if(array_key_exists("show", $_GET)){
			$rawshow = intval($_GET["show"]) == 1;
		}
		
		$os = intval($this->getQueryString("os"));
		
		$androidOs = new AndroidOsFileConfig();
		$path = $androidOs->getSdkPath($os);
		
		$file = $path . "/" . $file;
		$file = str_replace("\\","/",$file);
		$file = str_replace("//","/",$file);
		
		//echo $file;
		$realsrc = $this->getQueryString("src");
		$realsrc = str_replace("\\","/",$realsrc);
		$realsrc = str_replace("//","/",$realsrc);
		
		$osinfo = $androidOs->getOsInfo($os);
		
		//echo "the file path is : " . $file;
		
		//显示代码
		$this->render("codefile",array(
				"localfile" => $file,
				"os" => $os,
				"rawshow" => $rawshow,
				"src" => $realsrc,
				"allos" => $androidOs->getAll(),
				"osname" => $osinfo["name"],
			));
	}
	
	public function actionDownload(){
		$srcfile = "";
		$file = $this->getQueryString("src");
		if(strlen($file) == 0 || strpos($file, "..") > 0){
			$this->redirect("/");
			return;
		}
		
		
		$srcfile = $file;
		
		$os = intval($this->getQueryString("os"));
		$androidOs = new AndroidOsFileConfig();
		$path = $androidOs->getSdkPath($os);
		
		$file = $path . "/" . $file;
		$file = str_replace("\\","/",$file);
		$file = str_replace("//","/",$file);
		$file = str_replace("//","/",$file);
		
		if(!file_exists($file)){
            throw new CHttpException(404);
		}

        $filehandle = fopen($file,"r");
        header("Content-type: application/octet-stream");
        header("Accept-Ranges: bytes");
        header("Accept-Length: ".filesize($file));
        header("Content-Disposition: attachment; filename=" . basename($srcfile));
        $content = fread($filehandle, filesize($file));
        fclose($filehandle);

        echo $content;
	}
	
	public function actionDiff(){
		$src = $this->getQueryString("src");
		$src = str_replace("\\","/",$src);
		$src = str_replace("//","/",$src);
		if(strpos($src, "..") != false){
			$this->redirect("/");
			return;
		}
		
		//以/为根目录
		if(strlen($src) == 0 || $src[0] != '/'){
			$this->redirect("/");
			return;
		}
		
		$os = intval($_GET["os"]);
		$androidOsConfig = new AndroidOsFileConfig();
		$osinfo = $androidOsConfig->getOsInfo($os);
		
		$diffContainer = new DiffContainer();

		$allAndroidOs = $androidOsConfig->getAll();
		foreach($allAndroidOs as $androidOsItem){
			$osApi = $androidOsItem["sdk"];
			$file = $androidOsItem["dir"] . $src;

			if(file_exists($file)){
				$md5 = md5_file($file);
				$diffContainer->appendDiff($osApi, $androidOsItem["name"], $md5,$file);
			}
		}
		
		$realsrc = $this->getQueryString("src");
		$realsrc = str_replace("\\","/",$realsrc);
		$realsrc = str_replace("//","/",$realsrc);

		$this->render("diff",array(
				"os" => $os,
				"src" => $realsrc,
				"rawsrc" => $this->getQueryString("src"),
				"osname" => $osinfo["name"],
				"diffdata" => $diffContainer->getData(),
			));
	}

	/*
	public function actionbuildmeta(){
		$osver = $this->getQueryString("os");
		
		$androidOsConfig = new AndroidOsFileConfig();
		
		$dir = get_android_dir($osver);
		build_io_meta($dir);
	}*/
	
	
}
