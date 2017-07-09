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

<div style="border-bottom:1px solid #ccc;height:60px;">
	<div class="page_root_div_noborder" style="padding-top:10px;">
		<a href="/" class="ostitle_link" style="float:left;">Android OS</a>
		<p style="float:left;font-size:20px;height:40px;line-height:40px;">&nbsp;/&nbsp;</p>
		<a href="/api/<?php echo $os; ?>" class="ostitle_link" style="float:left;margin-right:10px;"><?php echo $osname; ?></a>
	</div>
</div>
<div class="page_root_div_noborder">
	<div style="height:40px;line-height:40px;font-size:14pt;padding-left:0px;">
		<?php
		$currentRelative = "/";
		$preurl = "/api/{$os}?path=";

		$matches = explode($src,"/");//split("/", $src);
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
		<a href="/download?os=<?php echo $os; ?>&src=<?php echo $src; ?>" target="_blank" style="font-size:15px;float:right;display:block;"><i class="fa fa-cloud-download"></i>下载</a>
		<span style="float:right;display:block;">&nbsp;&nbsp;&nbsp;</span>
		<a href="/diff?os=<?php echo $os; ?>&src=<?php echo $src; ?>" target="_blank" style="font-size:15px;float:right;display:block;"><i class="fa fa-cloud-download"></i>比较改动历史</a>
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
$fileTypeConfig = new FileTypeConfig();

//计算文件大小
$filesize = filesize($localfile);
$filesizeText = format_bytes($filesize);

function isTextFile($fileTypeConfig,$localfile){
	$highlightType = $fileTypeConfig->getHighlightType($localfile);
	if(strlen($highlightType) > 0){
		return true;
	}
	
	if(filesize($localfile) < 20 * 1024){
		return true;
	}
	
	return false;
}

?>

<div class="page_root_div_noborder"  style="background:#f7f7f7;font-size:14pt;padding-top:10px;border:1px solid #ccc;">
	<div style="border-bottom:0px solid #d8d8d8;padding:0px 10px;padding-bottom:7px;">
		<span style="font-size:14px;"><?php echo $fileTypeConfig->getFileReadableType($localfile); ?></span>
		<span style="font-size:14px;">&nbsp;|&nbsp;</span>
		<span style="font-size:14px;"><?php echo isTextFile($fileTypeConfig,$localfile) ? getFileLine($localfile) : "0"; ?>行</span>
		<span style="font-size:14px;">&nbsp;|&nbsp;</span>
		<span style="font-size:14px;"><?php echo $filesizeText; ?></span>
		<div style="float:right;">
			<ul class="prjstaticsul" style="width:220px;border:1px solid #DDDDDD;border-radius: 3px;">
				<li style="border-right:1px solid #dddddd;padding:5px 0px;"><a href="/code?os=<?php echo $os; ?>&src=<?php echo $src; ?>&show=1" style="font-size:13px">原始内容</a></li>
				<li style="border-right:1px solid #dddddd;padding:5px 0px;"><a href="/code?os=<?php echo $os; ?>&src=<?php echo $src; ?>" style="font-size:13px">高亮显示</a></li>
				<li><a href="#" style="font-size:13px;padding:5px 0px;">复制内容</a></li>
			</ul>
		</div>
	</div>
	<div style="background:#fff;">
	<?php
		$highlightType = $fileTypeConfig->getHighlightType($localfile);
		if(strlen($highlightType) > 0){
			if($rawshow) $highlightType = "nohighlight";
			echo "<pre><code class=\"" . $highlightType . "\">" . safe_get_content($localfile) . "</code></pre>";
		}else{
			if(isImage($localfile)){
				echo "<img src=\"{$url}\" />";
			}else{
				$allfilename = basename($localfile);
				$allfilename = strtolower($allfilename);
				if(strcasecmp($allfilename,"makefile") == 0){
					$highlightType = "makefile";
					if($rawshow) $highlightType = "nohighlight";
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

<?php $hideUrls = true; ?>
<?php require_once 'iprogram/protected/views/layouts/component/foot.php'; ?>

<script type="text/javascript">
$(function(){
    $('pre code').each(function(){
        var lines = $(this).text().split('\n').length - 1;
        var $numbering = $('<ul/>').addClass('pre-numbering');
        $(this)
            .addClass('has-numbering')
            .parent()
            .append($numbering);
        for(i=1;i<=lines;i++){
            $numbering.append($('<li/>').text(i));
        }
    });
});

</script>

