<?php

function htmltoraw($htmls){
	$htmltoraw_search = array ("'<script[^>]*?>.*?</script>'si", 
// 去掉 javascript 
"'<[\/\!]*?[^<>]*?>'si", // 去掉 HTML 标记 
"'([\r\n])[\s]+'", // 去掉空白字符 
"'&(quot|#34);'i", // 替换 HTML 实体 
"'&(amp|#38);'i", 
"'&(lt|#60);'i", 
"'&(gt|#62);'i", 
"'&(nbsp|#160);'i", 
"'&(iexcl|#161);'i", 
"'&(cent|#162);'i", 
"'&(pound|#163);'i", 
"'&(copy|#169);'i", 
"'&#(\d+);'e"); // 作为 PHP 代码运行 

$replace = array ("", 
"", 
"\\1", 
"\"", 
"&", 
"<", 
">", 
" ", 
chr(161), 
chr(162), 
chr(163), 
chr(169), 
"chr(\\1)"); 

$text = preg_replace ($htmltoraw_search, $replace, $htmls);
return  $text;
}
