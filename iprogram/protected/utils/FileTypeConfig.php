<?php

class FileTypeConfig{
	private $fileTypeConfig = null;
	
	public function __construct(){
		$this->init();
	}
	
	private function init(){
		$this->fileTypeConfig = array(
			array("ext" => "java", "highlighttype" => "java", "readable" => "Java程序"),
			array("ext" => "h", "highlighttype" => "cpp", "readable" => "C++程序"),
			array("ext" => "c", "highlighttype" => "cpp", "readable" => "C++程序"),
			array("ext" => "cpp", "highlighttype" => "cpp", "readable" => "C++程序"),
			array("ext" => "sh", "highlighttype" => "bash", "readable" => "Bash程序"),
			array("ext" => "css", "highlighttype" => "css", "readable" => "CSS样式"),
			array("ext" => "js", "highlighttype" => "javascript", "readable" => "Javascript"),
			array("ext" => "xml", "highlighttype" => "xml", "readable" => "Xml文件"),
			array("ext" => "html", "highlighttype" => "xml", "readable" => "Html程序"),
			array("ext" => "mk", "highlighttype" => "makefile", "readable" => "Makefile文件"),
			array("ext" => "txt", "highlighttype" => "nohighlight", "readable" => "文本文件"),
			array("ext" => "aidl", "highlighttype" => "nohighlight", "readable" => "接口文件"),
			array("ext" => "conf_EU", "highlighttype" => "nohighlight", "readable" => "配置文件"),
			array("ext" => "conf_EU_SUPL", "highlighttype" => "nohighlight", "readable" => "配置文件"),
			array("ext" => "conf_US", "highlighttype" => "nohighlight", "readable" => "配置文件"),
			array("ext" => "conf_US_SUPL", "highlighttype" => "nohighlight", "readable" => "配置文件"),
			array("ext" => "conf_AS", "highlighttype" => "nohighlight", "readable" => "配置文件"),
			array("ext" => "conf_AS_SUPL", "highlighttype" => "nohighlight", "readable" => "配置文件"),
			
			);
	}
	
	private function getFileItem($ext){
		$count = count($this->fileTypeConfig);
		for($i = 0;$i < $count;$i++){
			$fileItem = $this->fileTypeConfig[$i];
			if(strcasecmp($fileItem["ext"], $ext) == 0){
				return $fileItem;
			}
		}
		return null;
	}
	
	public function getFileReadableType($fileName){
		$fileextension = get_file_extension($fileName);
		$fileextension = strtolower($fileextension);
		$fileItem = $this->getFileItem($fileextension);
		if($fileItem != null){
			return $fileItem["readable"];
		}
		return "普通文本";
	}
	
	function getHighlightType($fileName){
		$fileextension = get_file_extension($fileName);
		$fileextension = strtolower($fileextension);
		$fileItem = $this->getFileItem($fileextension);
		if($fileItem != null){
			return $fileItem["highlighttype"];
		}else{
			$allfilename = basename($fileName);
			$allfilename = strtolower($allfilename);
			if(strcasecmp($allfilename,"makefile") == 0){
				return "makefile";
			}
		}
		return "";
	}
}

function getFileReadableType($fileName){
	$fileextension = get_file_extension($localfile);
	$fileextension = strtolower($fileextension);
	if(strlen($fileextension) == 0){
		return "可执行文件";
	}else if(strcasecmp($fileextension, "java") == 0){
		return "Java文件";
	}
}

function getHighlightType($fileName){
$fileextension = get_file_extension($localfile);
		$fileextension = strtolower($fileextension);
		$allfilename = basename($localfile);
		$allfilename = strtolower($allfilename); 
		if(strcasecmp($fileextension, "java") == 0){
			echo "<pre><code class=\"java\">" . safe_get_content($localfile) . "</code></pre>";
		}else if(strcasecmp($fileextension, "h") == 0 || strcasecmp($fileextension, "cpp") == 0 || 
				strcasecmp($fileextension, "c") == 0 ){
			echo "<pre><code class=\"cpp\">" . safe_get_content($localfile) . "</code></pre>";
		}else if(strcasecmp($fileextension, "sh") == 0){
			echo "<pre><code class=\"bash\">" . safe_get_content($localfile) . "</code></pre>";
		}else if(strcasecmp($fileextension, "css") == 0){
			echo "<pre><code class=\"css\">" . safe_get_content($localfile) . "</code></pre>";
		}else if(strcasecmp($fileextension, "js") == 0){
			echo "<pre><code class=\"javascript\">" . safe_get_content($localfile) . "</code></pre>";
		}else if(strcasecmp($fileextension, "xml") == 0){
			echo "<pre><code class=\"xml\">" . htmlspecialchars(safe_get_content($localfile)) . "</code></pre>";
		}else if(strcasecmp($fileextension, "html") == 0){
			echo "<pre><code class=\"xml\">" . htmlspecialchars(safe_get_content($localfile)) . "</code></pre>";
		}else if(strcasecmp($fileextension, "mk") == 0){
			echo "<pre><code class=\"makefile\">" . safe_get_content($localfile) . "</code></pre>";
		}else if(strcasecmp($fileextension, "txt") == 0){
			echo "<pre style=\"padding:10px;background:#fff;color:#fff;\">" . safe_get_content($localfile) . "</pre>";
		}else if(strlen($fileextension) == 0){
			if(strcasecmp($allfilename,"makefile") == 0){
				echo "<pre><code class=\"makefile\">" . safe_get_content($localfile) . "</code></pre>";
			}else{
				echo "<pre style=\"padding:10px;background:#000;color:#fff;\">" . safe_get_content($localfile) . "</pre>";
			}
		}else{
			$url = $_SERVER["REQUEST_URI"];
			$url = str_replace("/code?", "/download?", $url);
			if(isImage($localfile)){
				echo "<img src=\"{$url}\" />";
			}else{
				echo "<div style=\"padding:10px;\">此文件无法预览，请<a href=\"{$url}\">下载</a>后再进行查看!</div>";
			}
		}
}