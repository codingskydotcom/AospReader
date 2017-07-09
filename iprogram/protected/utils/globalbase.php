<?php

//判断是否是打印模式，打印模式下，只显示内容，其它(网站LOGO，栏目等)都不显示
function csg_isPrintMode(){
	if(key_exists("print", $_GET)){
		if($_GET['print'] == "1"){
			return true;
		}
	}
	return false;
}

$g_showTopAdv = true;
function csg_GetShowTopAdv(){
	global $g_showTopAdv;
	return $g_showTopAdv;
}

function csg_SetShowTopAdv($showTopAdv){
	global $g_showTopAdv;
	$g_showTopAdv = $showTopAdv;
}


$g_profileFunc = 1;
function csg_GetProfileFunction(){
	global $g_profileFunc;
	return $g_profileFunc;
}

function csg_SetProfileFunction($profileFunction){
	global $g_profileFunc;
	$g_profileFunc = $profileFunction;
}



function global_get_cachedir(){
	return "/caches/1/";
}

function global_get_cachedir_ex(){
	return "caches/1";
}

function converResUrl($url){
	return $url;
	/*if(strpos($url, "http:") === false){
		//相对路径
		return "http://youxires.woyouxi.net" . $url;
	}
	return str_replace("bcs.duapp.com/youxires", "youxires.oss.aliyuncs.com", $url);*/
}

function converBaeResUrl($url){
	return $url;
	/*if(strpos($url, "http:") === false){
		//相对路径
		return "http://bcs.duapp.com/youxires" . $url;
	}
	$url = str_replace("youxires.oss.aliyuncs.com", "bcs.duapp.com/youxires", $url);
	return str_replace("youxires.woyouxi.net", "bcs.duapp.com/youxires", $url);*/
}

function gotoerrorpage(){
	echo "<html><head><META HTTP-EQUIV=\"refresh\" CONTENT=\"0;url=/exception.html\"></head><body></body></html>";
}

$show_center_column = true;
function setShowCenterColumn($showCenterColumn)
{
	global $show_center_column;
	$show_center_column = $showCenterColumn;
}

function getShowCenterColumn()
{
	global $show_center_column;
	return $show_center_column;
}

$global_title = null;
function setGlobalTitle($title)
{
	global $global_title;
	$global_title = $title;
}

$global_meta = null;
function setGlobalMeta($meta)
{
	global $global_meta;
	$global_meta = $meta;	
}

$global_keywords = null;
function setGlobalKeywords($keywords)
{
	global $global_keywords;
	$global_keywords = $keywords;
}

$global_descript = null;
function setGlobalDescript($descrpit)
{
	global $global_descript;
	$global_descript = $descrpit;
}

$global_catalog = null;
function setGlobalCatalog($catalog)
{
	global $global_catalog;
	$global_catalog = $catalog;
}

$global_param1 = null;
function setGlobalParam1($param1)
{
	global $global_param1;
	$global_param1 = $param1;
}
function getGlobalParam1()
{
	global $global_param1;
	return $global_param1;
}

$global_param2 = null;
function setGlobalParam2($param2)
{
	global $global_param2;
	$global_param2 = $param2;
}
function getGlobalParam2()
{
	global $global_param2;
	return $global_param2;
}

$global_current_action = "";
function getCurrentAction()
{
	global $global_current_action;
	return $global_current_action;
}
function setCurrentAction($action){
	global $global_current_action;
	$global_current_action = $action;
}
$global_current_controller = "";
function getCurrentController()
{
	global $global_current_controller;
	return $global_current_controller;
}
function setCurrentController($controller)
{
	global $global_current_controller;
	$global_current_controller = $controller;
}