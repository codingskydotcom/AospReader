<?php require_once 'iprogram/protected/utils/FileTypeConfig.php'; ?>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.5/styles/github.min.css">
<script src="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.5/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>

<style>
pre {
    position: relative;
    margin-bottom: 24px;
    border-radius: 3px;
    border: 1px solid #C3CCD0;
    background: #FFF;
    overflow: hidden;
}

code {
  display: block;
  padding: 12px 24px;
  overflow-y: auto;
  font-weight: 300;
  font-family: consolas,Courier,Andale Mono,Monaco,Profont,Monofur,monospace,Tahoma,Droid Sans Mono;
  font-size: 0.8em;
}

code.has-numbering {
    margin-left: 31px;
}

.pre-numbering {
    position: absolute;
    top: 0;
    left: 0;
    width: 30px;
    padding: 12px 2px 12px 0;
    border-right: 1px solid #C3CCD0;
    border-radius: 3px 0 0 3px;
    background-color: #EEE;
    text-align: right;
    font-family: Menlo, monospace;
    font-size: 0.8em;
    color: #AAA;
}
</style>

<!-- 显示header -->
<div class="header" style="border-bottom:1px solid #ccc;">
	<div class="page_root_div_noborder">
		<a href="http://www.codingsky.com" target="_blank" class="logo_link" style="float:left;margin-right:10px;">扣丁书屋</a>
		<div class="searchbox" style="margin:10px 0px 10px 0px;text-align:left;float:left;">
			<form method="GET" action="/">
				<input align="middle" name="q" class="q" id="kw" value="" maxlength="100" size="50" autocomplete="off" baiduSug="1" x-webkit-speech style="color:#000;" placeholder="请输入文件名以在<?php echo $osname ?>中搜索代码"/>
				<input id="btn" class="btn" align="middle" value="搜索源代码" type="submit" />
				<input type="hidden" name="os" value="<?php echo $os; ?>"></input>
			</form>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>

<?php
 function safe_get_content($filepath){
	if(!is_file($filepath)){
		return "file not exist!";
	}
	if(filesize($filepath) > 1024 * 1024 * 5 ){
		return "";
	}else{
		$text = file_get_contents($filepath);
		$text = str_replace("<", "&lt;", $text);
		$text = str_replace(">", "&gt;", $text);
		return $text;
	}
} 
?>

<div style="border-bottom:1px solid #ccc;height:60px;">
	<div class="page_root_div_noborder" style="padding-top:10px;">
		<a href="/" class="ostitle_link" style="float:left;">Android OS</a>
		<p style="float:left;font-size:20px;height:40px;line-height:40px;">&nbsp;/&nbsp;</p>
		<a href="/api/<?php echo $os; ?>" class="ostitle_link" style="float:left;margin-right:10px;"><?php echo $osname; ?></a>
	</div>
</div>
<?php $fileTypeConfig = new FileTypeConfig(); ?>
<!-- 显示文件的路径信息 -->
<div class="page_root_div_noborder" style="border-bottom:0px solid #ccc">
	<div style="height:40px;line-height:40px;font-size:14pt;padding-left:0px;">
		<?php
		$currentRelative = "/";
		$preurl = "/api/{$os}?path=";
		$matches = explode("/", $src);
		$matches = array_filter($matches);
		$matches = array_values($matches);
		if(count($matches) > 0){
			//echo "<span>/&nbsp;</span>";
			echo "<a href=\"/api/{$os}\">根目录</a>";
			echo "<span>&nbsp;|&nbsp;</span>";
			
			$itemCount = count($matches); 
			for($i = 0;$i < $itemCount;$i++){
				$matcheitem = $matches[$i];
				if(strlen($matcheitem) > 0 && $i < $itemCount - 1){
					if($i > 0){
						echo "<span>/&nbsp;</span>";
					}
					echo "<a href=\"{$preurl}{$currentRelative}{$matcheitem}\">{$matcheitem}&nbsp;</a>";
					$currentRelative = $currentRelative . $matcheitem . "/";
				}else if($i == $itemCount - 1){
					if($i > 0){
						echo "<span>/&nbsp;</span>";
					}
					echo "<span>{$matcheitem}</span>";
				}
			}
		}else{
			//echo "<span>&nbsp;</span>";
			echo "<span>根目录&nbsp;|&nbsp;+</span>";
		}
		?>
	</div>
</div>

<div class="page_root_div_noborder" style="border:1px solid #829aa8;">
	<p style="color:#fff;background-color:#829aa8;font-size:16px;padding-left:10px;padding-top:5px;padding-bottom:5px;">改动信息：</p>
	<p style="font-size:16px;padding-left:10px;padding-top:10px;padding-bottom:10px;">文件"<strong><?php echo getFileName($rawsrc); ?></strong>"在所有的Android OS中，共检测到<span style="color:#f00"><strong><?php echo count($diffdata); ?></strong></span>次改动</p>
</div>
<?php //print_r($diffdata); ?>
<?php $index = 0; ?>
<?php foreach($diffdata as $diffDataItem){ ?>
	<div class="page_root_div_noborder">
		<?php
			$text = "";
			$localfile = "";
			foreach($diffDataItem["data"] as $diffOsItem){
				if(strlen($text) > 0){
					$text = $text . "," ; 
				}
				$localfile = $diffOsItem["file"];
				$text = $text . $diffOsItem["osapi"] . ":" . $diffOsItem["osname"];
			}
		 ?>
		<p style="font-size:16px;padding-left:10px;padding-top:10px;padding-bottom:10px;">第<strong><?php echo $index + 1 ?></strong>次改动(<?php echo $text; ?>)</p>
		
		<div style="background:#fff;">
		<?php
			$highlightType = $fileTypeConfig->getHighlightType($localfile);
			if(strlen($highlightType) > 0){
				echo "<pre><code class=\"" . $highlightType . "\">" . safe_get_content($localfile) . "</code></pre>";
			}else{
				if(isImage($localfile)){
					//echo "<img src=\"{$url}\" />";
				}else{
					$allfilename = basename($localfile);
					$allfilename = strtolower($allfilename);
					if(strcasecmp($allfilename,"makefile") == 0){
						$highlightType = "makefile";
						echo "<pre><code class=\"" . $highlightType . "\">" . safe_get_content($localfile) . "</code></pre>";
					}else if(filesize($localfile) < 20 * 1024){
						$highlightType = "nohighlight";
						echo "<pre><code class=\"" . $highlightType . "\">" . safe_get_content($localfile) . "</code></pre>";
					}else{
						echo "<div style=\"padding:10px;\">此文件无法预览，请<a href=\"{$url}\">下载</a>后再进行查看!</div>";
					}
				}
			}
		?>
		</div>
	</div>
<?php  $index++;} ?>
