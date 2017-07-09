<?php

/**
 * 注意：
 * @var 1.0.1
 * 重启后要挂载disk
 *  mount /dev/xvdb1 /mnt/gdisk
 */

define("BAE_LOCAL_DEBUG", true);
ini_set("display_errors", 1);

require_once(dirname(__FILE__).'/iprogram/protected/utils/globalbase.php');
require_once(dirname(__FILE__).'/iprogram/protected/utils/common.php');	

try {
	if(BAE_LOCAL_DEBUG){
		define('YII_DEBUG',true);
		error_reporting(E_ERROR | E_WARNING | E_PARSE);
	}else{
		define('YII_DEBUG',true);
		error_reporting(E_ERROR);

		//define('YII_DEBUG',true);
		//error_reporting(E_ERROR | E_WARNING | E_PARSE);
	}
}catch (Exception $e){
	
}

error_reporting(E_ALL);

session_start();

$webroot=dirname(__FILE__).'/iprogram/index.php';
require_once($webroot);

?>
