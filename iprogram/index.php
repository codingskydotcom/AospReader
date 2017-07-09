<?php

// include Yii bootstrap file
require_once(dirname(__FILE__) . '/../framework/yii.php');
$config = dirname(__FILE__) . '/protected/config/main.php';

Yii::createWebApplication($config)->run();
try {

}
catch (Exception $e){
	//echo "error!!!";
}

?>
