<?php

require_once 'iprogram/protected/utils/AliSdk/aliyun.php';

use \Aliyun\OSS\OSSClient;

function get_file_extension_helper_oss($file_name){
	$extend = pathinfo($file_name);
	$extend = strtolower($extend["extension"]);
	return $extend;
}

function move_attachments_oss_fileupload($fileName, $folder, $filePath, $isContent) {
	$client = OSSClient::factory(array(
	    'AccessKeyId' => 'OCxmwmVd7EYAkUYZ',
	    'AccessKeySecret' => 'bNXMZtRFhJK8dXfhG02T5cdbdio5V9',
	));	
	
	try {
		$objectkey = "";
		if(strlen($folder) > 0){
			$objectkey =  $folder . "/" . $fileName;
		}else{
			$objectkey =  $fileName;
		}
		
		if($isContent === false){
			$fp = fopen($filePath, 'r');
			if($client != null && $fp != null){
				$client->putObject(array(
				    'Bucket' => 'codingsky',
				    'Key' => $objectkey,
				    'Content' => $fp,
					'ContentLength' => filesize($filePath),
				));
				fclose($fp);
			}
		} else {
			if($client != null){
				$client->putObject(array(
				    'Bucket' => 'codingsky',
				    'Key' => $objectkey,
				    'Content' => $filePath,
				));
			}	
		}
	}catch (Exception $e){
		//print_r($e);
	}
}

function is_oss_object_exist($object){
	$client = OSSClient::factory(array(
	    'AccessKeyId' => 'OCxmwmVd7EYAkUYZ',
	    'AccessKeySecret' => 'bNXMZtRFhJK8dXfhG02T5cdbdio5V9',
	));	

	try {
		$object = $client->getObject(array(
	    	'Bucket' => 'codingsky',
	    	'Key' => $object,
		));
		return $object != null;	
	}catch (Exception $e){
		//print_r($e);
	}
	
	return false; 
}


function request_oss_object($object){
	$client = OSSClient::factory(array(
	    'AccessKeyId' => 'OCxmwmVd7EYAkUYZ',
	    'AccessKeySecret' => 'bNXMZtRFhJK8dXfhG02T5cdbdio5V9',
	));	

	try {
		$object = $client->getObject(array(
	    	'Bucket' => 'codingsky',
	    	'Key' => $object,
		));
		
		if($object != null){
			return stream_get_contents($object->getObjectContent());		
		}
	}catch (Exception $e){
		//print_r($e);
	}
	
	return "";
}

function delete_bcs_object($object){
	
}


