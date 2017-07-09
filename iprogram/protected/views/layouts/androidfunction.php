<?php

function getAndroidTabCss($controller, $action){
	if(strcasecmp($controller, getCurrentController()) === 0 && 
		strcasecmp($action, getCurrentAction()) === 0){
		return "androidpage_toolbaritemsel";
	}else{
		return "";
	}
}

function isAndroidAction($action){
	if(strcasecmp($action, getCurrentAction()) === 0){
		return true;
	}
	return false;
}