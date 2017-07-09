<?php


/**
 * @package     BugFree
 * @version     $Id: FunctionsMain.inc.php,v 1.32 2005/09/24 11:38:37 wwccss Exp $
 *
 *
 * Return part of a string(Enhance the function substr())
 *
 * @author                  Chunsheng Wang <wwccss@263.net>
 * @param string  $String  the string to cut.
 * @param int     $Length  the length of returned string.
 * @param booble  $Append  whether append "...": false|true
 * @return string           the cutted string.
 */
function sysSubStr($String,$Length,$Append = false)
{
	if (strlen($String) <= $Length )
	{
		return $String;
	}
	else
	{
		$I = 0;
		while ($I < $Length)
		{
			$StringTMP = substr($String,$I,1);
			if ( ord($StringTMP) >=224 )
			{
				$StringTMP = substr($String,$I,3);
				$I = $I + 3;
			}
			elseif( ord($StringTMP) >=192 )
			{
				$StringTMP = substr($String,$I,2);
				$I = $I + 2;
			}
			else
			{
				$I = $I + 1;
			}
			$StringLast[] = $StringTMP;
		}
		$StringLast = implode("",$StringLast);
		if($Append)
		{
			$StringLast .= "...";
		}
		return $StringLast;
	}
}

function ellipseSummar($text,$len,$moreurl){
	if(strlen($text) > $len * 3){
		return sysSubStr($text,($len - 5) * 3,false) . "...&nbsp;&nbsp;<a href='" . $moreurl . "'>更多</a>";
	}
	return $text;
}

function get_file_extension($file_name){
	$extend = pathinfo($file_name);
	$extend = strtolower($extend["extension"]);
	return $extend;
}

function get_folder_path($filepath){
	$pos = strripos($filepath,"/");
	if($pos > 0){
		return substr($filepath,0,$pos);
	}
	return $filepath;
}

function utf8_strlen($string = null) {  
 	preg_match_all ( "/./us", $string, $match );  
    return count ( $match [0] );  
}

function csubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true) {  
        if (function_exists ( "mb_substr" )) {  
            if (mb_strlen ( $str, $charset ) <= $length)  
                return $str;  
            $slice = mb_substr ( $str, $start, $length, $charset );  
        } else {  
            $re ['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";  
            $re ['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";  
            $re ['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";  
            $re ['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";  
            preg_match_all ( $re [$charset], $str, $match );  
            if (count ( $match [0] ) <= $length)  
                return $str;  
            $slice = join ( "", array_slice ( $match [0], $start, $length ) );  
        }  
        if ($suffix)  
            return $slice . "…";  
        return $slice;  
    }
    
function getIsChinese($wd){
	$ln = utf8_strlen( $wd );  
    $result = false;  
    for($a = 0; $a <= $ln; $a ++) {  
    	$hanzi = csubstr($wd, $a, 1, "utf-8", false );  
        $asc = ord (substr( $hanzi, 0, 1 ) );  
        if ($asc > 160) {  
        	$result = true; //中文  
		}  
	}  
	return $result;  
} 

function getSource($url)
{
	if(strlen($url) == 0){
		return "扣丁书屋";
	}else if(strpos($url,"cnblogs.com") > 0){
		return "博客园";
	}else if(strpos($url,"cppblog.com") > 0){
		return "C++博客";
	}else if(strpos($url,"blog.csdn.net") > 0){
		return "CSDN";
	}else if(strpos($url,"blog.51cto.com") > 0){
		return "51CTO.COM";
	}else if(strpos($url,"lanrentuku.com") > 0){
		return "懒人图库";
	}else if(strpos($url,"cnbeta.com") > 0){
		return "cnBeta";
	}else if(strpos($url,"tech.163.com") > 0){
		return "网易科技";
	}else if(strpos($url,"songshuhui.net") > 0){
		return "松鼠会";
	}else if(strpos($url,"tech.qq.com") > 0){
		return "腾讯科技";
	}else if(strpos($url,"liuyanbaike.com") > 0){
		return "流言百科";
	}else if(strpos($url,"www.nowamagic.net") > 0){
		return "简明现代魔法";
	}
	else if(strpos($url,"http") < 0){
		if (getIsChinese($url)) {
			//有中文
			if(strlen($url) < 10){
				return $url;
			}
		}
		return "网络";
	}
	else{
		return "网络";
	}
}

function getCodeType($programlang){
	if($programlang == 1){
		return "csharp";
	}else if ($programlang == 2){
		return "cpp";
	}else if ($programlang == 3){
		return "java";
	}else if ($programlang == 4){
		return "php";
	}else if ($programlang == 5){
		return "pl";
	}else if ($programlang == 6){
		return "js";
	}else if ($programlang == 7){
		return "css";
	}else if ($programlang == 8){
		return "vb";
	}else if ($programlang == 11){
		return "html";
	}else if ($programlang == 13){
		return "xml";
	}else{
		return "other";
	}
}

$extCodeTypes = array(
	array("ext" => "cs","codetype" => "csharp"),
	array("ext" => "cpp","codetype" => "cpp"),
	array("ext" => "c","codetype" => "cpp"),
	array("ext" => "h","codetype" => "cpp"),
	array("ext" => "hpp","codetype" => "cpp"),
	array("ext" => "java","codetype" => "java"),
	array("ext" => "php","codetype" => "php"),
	array("ext" => "pl","codetype" => "pl"),
	array("ext" => "js","codetype" => "js"),
	array("ext" => "css","codetype" => "css"),
	array("ext" => "vb","codetype" => "vb"),
	array("ext" => "html","codetype" => "html"),
	array("ext" => "htm","codetype" => "html"),
	array("ext" => "xhtml","codetype" => "html"),
	array("ext" => "xml","codetype" => "xml"),
	array("ext" => "vcproj","codetype" => "xml"),
	array("ext" => "csproj","codetype" => "xml"),
	);
function getCodeTypeByExt($filename){
	global $extCodeTypes;
	$ext = get_file_extension($filename);
	foreach($extCodeTypes as $extCodeType){
		if($extCodeType["ext"] == $ext){
			return $extCodeType["codetype"];
		}
	}
	return "";
}

function isFlash($filename){
	$ext = get_file_extension($filename);
	if($ext == "swf" || $ext == "flv" || $ext == "mp4"){
		return true;
	}
	return false;
}

function isImage($filename){
	$ext = get_file_extension($filename);
	if($ext == "jpg" || $ext == "bmp" || $ext == "png" || $ext == "jpeg" || $ext == "gif"){
		return true;
	}
	return false;
}

function isPreviewable($filename){
	$ext = get_file_extension($filename);
	$ext = strtolower($ext);
	if($ext == "sql" || $ext == "txt" || $ext == "log" || $ext == "sln" || $ext == "vcproj" || $ext == "csproj" || strlen($ext) == 0 || 
		$ext == "rc" || $ext == "dsp" || $ext == "reg" || $ext == "dsw" ){
		return true;
	}
	
	$codeType = getCodeTypeByExt($filename);
	if(strlen($codeType) > 0){
		return true;
	}
	
	return false;
}


function getFileIcon($fileName)
{
	$ext = get_file_extension($fileName);
	//echo $ext;
	if(strcasecmp($ext, "rar") == 0 || 
	   strcasecmp($ext, "zip") == 0 || 
	   strcasecmp($ext, "7z") == 0){
		return "/iprogram/assets/img/fileicon/zip.png";
	}
	return "/iprogram/assets/img/fileicon/file.png";
}

$langIdPreviewImgs = array(
	array("id" => 1, "previewimg" => "http://www.codingsky.com/iprogram/assets/img/preview/csharp.png","width"=>120,"height"=>120),
	array("id" => 2, "previewimg" => "http://www.codingsky.com/iprogram/assets/img/preview/cpp.png","width"=>120,"height"=>120),
	array("id" => 3,"previewimg" => "http://www.codingsky.com/iprogram/assets/img/preview/java.png","width"=>120,"height"=>120),
	array("id" => 4, "previewimg" => "http://www.codingsky.com/iprogram/assets/img/preview/php.png","width"=>120,"height"=>120),
	array("id" => 6, "previewimg" => "http://www.codingsky.com/iprogram/assets/img/preview/js.png","width"=>120,"height"=>120),
	array("id" => 7, "previewimg" => "http://www.codingsky.com/iprogram/assets/img/preview/css.png","width"=>120,"height"=>120),
	array("id" => 10, "previewimg" => "http://www.codingsky.com/iprogram/assets/img/preview/bat.png","width"=>120,"height"=>120),
	);
	
$classifyIdPreviewImgs = array(
	array("id" => 1, "previewimg" => "http://www.codingsky.com/iprogram/assets/img/preview/window.png","width"=>120,"height"=>120),
	array("id" => 12, "previewimg" => "http://www.codingsky.com/iprogram/assets/img/preview/window.png","width"=>120,"height"=>120),
	array("id" => 19, "previewimg" => "http://www.codingsky.com/iprogram/assets/img/preview/funny.png","width"=>120,"height"=>120),
	);
function getPreviewImage($previewImageUrl,$classify, $langId){
	global $langIdPreviewImgs;
	global $classifyIdPreviewImgs;
	
	$result = array(
		"url" => "http://www.codingsky.com/iprogram/assets/img/blog/default_preivew.jpg",
		"width" => "180",
		"height" => "120",
	);
	
	if(strlen($previewImageUrl) > 0){
		$result['url'] = $previewImageUrl;
		return $result;
	}
	
	$langId = intval($langId);
	foreach($langIdPreviewImgs as $langIdPreviewImg){
		if($langIdPreviewImg['id'] == $langId){
			$result['url'] = $langIdPreviewImg["previewimg"];
			$result['width'] = $langIdPreviewImg["width"];
			$result['height'] = $langIdPreviewImg["height"];
			return $result;
		}
	}
	
	$classify = intval($classify);
	foreach($classifyIdPreviewImgs as $classifyIdPreviewImg){
		if($classifyIdPreviewImg['id'] == $classify){
			$result['url'] = $classifyIdPreviewImg["previewimg"];
			$result['width'] = $classifyIdPreviewImg["width"];
			$result['height'] = $classifyIdPreviewImg["height"];
			return $result;
		}
	}
	
	return $result;
}

function getOpensourceIcon($previewIconUrl){
	if(strlen($previewIconUrl) > 0){
		return $previewIconUrl;
	}
	return "http://www.codingsky.com/iprogram/assets/img/opensource.png";
}

/**
 * 计算URL的缓存路径
 * @param string $url,相对网站根目录的路径
 */
function getCachePath($url){
	$requestURI = $url;
	
	$requestURI = str_replace("/","__",$requestURI);
	$requestURI = str_replace("?","##",$requestURI);
	
	$needAppendDot = true;
	$extend = pathinfo($requestURI);
	$extend = strtolower($extend["extension"]);
	if(strcmp($extend, "html") == 0){
		$needAppendDot = false;
	}
	
	if($needAppendDot){
		$requestURI = $requestURI . ".html";
	}
	
	$cacheFile = dirname(dirname(dirname(dirname(__FILE__)))) . "/cache/htmls/" . $requestURI;
	return $cacheFile;
}

function getCacheFileName($url){
	$requestURI = $url;
	
	$requestURI = str_replace("/","__",$requestURI);
	$requestURI = str_replace("?","##",$requestURI);
	
	$needAppendDot = true;
	$extend = pathinfo($requestURI);
	$extend = strtolower($extend["extension"]);
	if(strcmp($extend, "html") == 0){
		$needAppendDot = false;
	}
	
	if($needAppendDot){
		$requestURI = $requestURI . ".html";
	}
	
	
	//$cacheFile = dirname(dirname(dirname(dirname(__FILE__)))) . "/cache/htmls/" . $requestURI;
	return $requestURI;
}

function saveToFile($localFile,$contents){
	$fp = fopen($localFile, "w+");
	if($fp != null){
		if ( is_writable($localFile) ){
			file_put_contents($localFile , $contents);
		}
		fclose($fp);
	}
}

$classifyText = array(
array("id" => 1,"text" => "界面技术"),
array("id" => 2,"text" => "网络技术"),
array("id" => 3,"text" => "多媒体技术"),
array("id" => 4,"text" => "数据库技术"),
array("id" => 5,"text" => "CSS"),
array("id" => 6,"text" => "Javascript"),
array("id" => 7,"text" => "PHP"),
array("id" => 8,"text" => "Asp.net"),
array("id" => 9,"text" => "Android"),
array("id" => 10,"text" => "iPhone"),
array("id" => 11,"text" => "手机编程"),
array("id" => 12,"text" => "Windows编程"),
array("id" => 13,"text" => "程序与算法"),
array("id" => 14,"text" => "基础技术"),
array("id" => 15,"text" => "WP技术"),
array("id" => 16,"text" => "IT百科"),
array("id" => 17,"text" => "软件工具")
);
function getBlogTypeText($blogClassify){
	global $classifyText;
	$totalcount = count($classifyText);
	for($index = 0;$index < $totalcount;$index++){
		if($classifyText[$index]["id"] == $blogClassify){
			return  $classifyText[$index]["text"];
		}
	}
	return "技术分析";
}

function getRandText(){
	return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
}

$global_controller = "";
$global_action = "";
function getController(){
	global $global_controller;
	if(strlen($global_controller) == 0){
		$requestUrl = $_SERVER["REQUEST_URI"];
		$requestSegments = explode("/", $requestUrl);
		if(count($requestSegments) >= 2 ){
			$global_controller = $requestSegments[1];
			if(strpos($global_controller, "?") > 0){
				$questSegments = explode("?", $global_controller);
				$global_controller = $questSegments[0];
			}
		}
	}
	return $global_controller;
}

function getAction(){
	global $global_action;
	if(strlen($global_action) == 0){
		
		$requestUrl = $_SERVER["REQUEST_URI"];
		$requestSegments = explode("/", $requestUrl);
		if(count($requestSegments) >= 3 ){
			$global_action = $requestSegments[2];
			if(strpos($global_action, "?") > 0){
				$questSegments = explode("?", $global_action);
				$global_action = $questSegments[0];
			}
		}else{
			$global_action = "index";
		}
	}
	return $global_action;
}

function isMobile()
{ 
	//return true;
	
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    } 
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
    { 
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    } 
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
            ); 
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        } 
    } 
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT']))
    { 
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        } 
    } 
    return false;
}

function formatSubDir($dir){
	$allsegs = explode("/",$dir);
	if($allsegs != null && count($allsegs) > 0){
		for($index = count($allsegs)-1;$index >= 0; $index--){
			if(strlen($allsegs[$index]) > 0){
				return $allsegs[$index];
			}	
		}
	}
	
	return "";
}

function format_bytes($size) { 
	$units = array(' B', ' KB', ' MB', ' GB', ' TB'); 
	for ($i = 0; $size >= 1024 && $i < 4; $i++) {
		$size /= 1024;
	} 
	return round($size, 2).$units[$i]; 
}

function getFileLine($filePath){
	$line = 0;
	$fp = fopen($filePath, 'r');
	if($fp){
		//获取文件的一行内容，注意：需要php5才支持该函数；
		while(!feof($fp) ){
			stream_get_line($fp, 10240, "\n");
   			$line++;
		}
		fclose($fp);//关闭文件
	}else{
		//echo "fp is null";
	}
	return $line;
}

function getFileName($file_name){
	$extend = pathinfo($file_name);
	return $extend["basename"];
}