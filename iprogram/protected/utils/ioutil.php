<?php

function get_sub_file_dir($dir){
	$result = array();
	if(is_dir($dir) && $handle = opendir($dir)){
        while(false !== ($file = readdir($handle))){
            if($file=="." || $file=="..") continue;
            if(strcasecmp(".meta", $file) == 0) continue;
            if(is_dir($dir. $file)){
            	array_push($result, array(
            			"file" => $file,
            			"isfile" => 0,
            		) );
            }else{
            	array_push($result, array(
            			"file" => $file,
            			"isfile" => 1,
            		) );
            }
        }
        closedir($handle);
    }
}

function get_file_content($file){
	
}

function getallfolder($dir,&$result){
	//echo $dir;
    if(is_dir($dir) && $handle = opendir($dir)){
        while(false !== ($file = readdir($handle))){
            if($file=="." || $file=="..") continue;
            if(strcasecmp(".meta", $file) == 0) continue;
            
            $path = "{$dir}/{$file}";
            if(is_dir($path)){
            	array_push($result, "{$path}");
            }else{
            	echo $file . "<br/>";
            }
        }
        closedir($handle);
    }else{
    	echo "read err!";
    }
}

function build_io_meta($file){
	//echo $file . "<br/>";
	$metaDir = $file . "/" . ".meta/";
	if(!is_dir($metaDir)){
		if(!file_exists($metaDir)){
			//echo $metaDir;
			mkdir($metaDir);
		}else{
			return;
		}
		//return;
	}
	
	$allfolders = array();
	getallfolder($file, $allfolders);
	
	$baselen = strlen($file);
	if(count($allfolders) > 0){
		foreach($allfolders as $allfolder){
			$relativename = substr($allfolder, $baselen, -1);
			
			$relativename = str_replace("/","#",$relativename);
			$relativename = str_replace("\\","#",$relativename);
			
			$folder = get_sub_file_dir($allfolder);
			
			$jsonarr = array(
					"subfolder" => $folder,
					"fullpath" => $allfolder,
				);
			$savepath = $metaDir . $relativename;
			file_put_contents($savepath, json_encode($jsonarr));
			
				
			echo "get the folder info : " . $allfolder;
			echo "<br/>";
			if(count($folder) > 0){
				foreach($folder as $folderitem){
					echo "&nbsp;&nbsp;&nbsp;&nbsp;" . $folderitem["file"];
				}
			}else{
				echo "empty!!";
			}
			
		}
	}
	
	
}



