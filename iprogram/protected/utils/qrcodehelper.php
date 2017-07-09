<?php

require_once(dirname(__FILE__) . "/phpqrcode/qrlib.php"); 

function buildQRCode($url){
	return QRcode::png($url);
}

