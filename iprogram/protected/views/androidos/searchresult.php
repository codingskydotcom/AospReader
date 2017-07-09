<?php require_once 'iprogram/protected/utils/page.php'; ?>

<div style="padding:1px;margin:0px;border-bottom:1px solid #ccc;overflow:hidden;height:60px;position:fixed;z-index:301;min-width:1000px;width:100%;background:#fff;">
	<span style="display: inline-block;float:left;height: 60px;line-height: 60px;font-size:25px;">&nbsp;&nbsp;扣丁书屋&nbsp;&nbsp;</span>
	<div class="searchbox" style="margin:10px 0px 10px 0px;text-align:left;float:left;">
		<form method="GET"><input align="middle" name="q" class="q" id="kw" value="<?php echo $searchtext ?>" maxlength="100" size="50" autocomplete="off" baiduSug="1" x-webkit-speech style="color:#000;"/><input id="btn" class="btn" align="middle" value="搜索源代码" type="submit" /></form>
	</div>
	<div style="clear:both;"></div>
</div>
<div style="height:60px;"></div>
<div class="page_root_div_noborder">
	<div style="float:left;width:790px;background:#fff;">
		<div style="margin-left:20px;margin-right:20px;">
			<?php if($searchos > 0){ ?>
			<p style="font-size:12pt;height:40px;line-height:40px;margin-bottom:10px;color:#ccc;">扣丁书屋为您在<span style="color:#000;font-weight:bold;"><?php echo $searchosname . "(" . $searchos . ")"; ?></span>中找到&nbsp;<span style="color:#f00;font-weight:bold;"><?php echo $pageinfo["totalcount"]; ?></span>&nbsp;个源文件</p>
			<?php }else{ ?>
			<p style="font-size:12pt;height:40px;line-height:40px;margin-bottom:10px;color:#ccc;">扣丁书屋为您找到&nbsp;<span style="color:#f00;font-weight:bold;"><?php echo $pageinfo["totalcount"]; ?></span>&nbsp;个源文件</p>
			<?php } ?>
		
			<?php foreach($list as $searchitem){ ?>
			<div style="text-align:left;border-bottom:1px dashed #ccc;margin-bottom:15px;">
				<div style="text-align:left;">
					<p style="overflow:hidden;height:24px;">
						<a class="android_blog_title" target="_blank" href="/code?os=<?php echo $searchitem['os']; ?>&src=<?php echo $searchitem['filepath']; ?>" style="font-size:20px;height:24px;line-height:24px;margin:0px;padding:0px;overflow:hidden;"><?php echo htmlspecialchars($searchitem['filename']); ?></a>
					</p>
					<div style="margin-top:10px;padding-bottom:5px;">
						<div>
							<span style="font-size:11pt">文件所在目录:&nbsp;:&nbsp;<?php echo get_folder_path($searchitem['filepath']); ?>&nbsp;&nbsp;</span>
						</div>
						<div style="margin-top:10px;">
							<div style="float:left;font-size:11pt">
								<span>系统版本号&nbsp;:&nbsp;<?php echo $searchitem['os']; ?>&nbsp;&nbsp;</span>
								<span>系统名称&nbsp;:&nbsp;<?php echo $searchitem['osname']; ?></span>
							</div>
							<div style="float:right;font-size:11pt">
								<a target="_blank" style="" href="/download?os=<?php echo $searchitem['os']; ?>&src=<?php echo $searchitem['filepath']; ?>">
									下载
								</a>
								&nbsp;&nbsp;&nbsp;
								<a target="_blank" style="" href="/code?os=<?php echo $searchitem['os']; ?>&src=<?php echo $searchitem['filepath']; ?>">
									在线查看
								</a>
							</div>
							<div style="clear:both;"></div>
						</div>
						<div style="clear:both;"></div>
					</div>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
	<div style="float:right;width:340px;background:#fff;height:550px;overflow:hidden;border-left:1px solid #ccc">
		<?php if($oslist != null && count($oslist) > 0){ ?>
		<div style="margin-left:0px;margin-top:0px;padding:10px;height:50px;">
			<?php $topOffset = 160; ?>
			<p style="color:#000;font-size:12pt;">本次查询结果出现在以下OS版本中：</p>
			<ul style="padding:1px;margin:0px;width:350px;">
				<?php foreach ($oslist as $os){ ?>
				<li class="link_li">
					<a style="font-size:16px;height:30px;line-height:30px;" href="?q=<?php echo $searchtext ?>&os=<?php echo $os["os"]; ?>"><?php echo $os["osname"] . "(" . $os["os"] . ")"; ?></a>
				</li>
				<?php } ?>
			</ul>
		</div>
		<?php } ?>
	</div>
	<div style="clear:both;"></div>
</div>


<div style="margin-top:0px;margin-bottom:20px;text-align:center;font-size:18px;">
<?php
	$htmlPage = new HtmlPage();
	$htmlPage->setPageInfo($pageinfo['pagecount']);
	$pageBaseUrl = "/?q=" . $_GET["q"] . "&pageno=";
	//$pageBaseUrl = "";
	$htmlPage->setStaticMode(false);
	$htmlPage->printHtml($pageBaseUrl); 
?>
</div>

<?php $hideUrls = true; ?>
<?php require_once 'iprogram/protected/views/layouts/component/foot.php'; ?>

