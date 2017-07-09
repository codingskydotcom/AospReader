<div class="header" style="border-bottom:1px solid #ccc;">
	<div class="page_root_div_noborder">
		<a href="http://www.codingsky.com" target="_blank" class="logo_link" style="float:left;margin-right:10px;">扣丁书屋</a>
		<div class="searchbox" style="margin:10px 0px 10px 0px;text-align:left;float:left;">
			<form method="GET" action="/">
				<input align="middle" name="q" class="q" id="kw" value="" maxlength="100" size="50" autocomplete="off" baiduSug="1" x-webkit-speech style="color:#000;" placeholder="请输入文件名以在<?php echo $osname ?>中搜索代码"/>
				<input id="btn" class="btn" align="middle" value="搜索源代码" type="submit" />
				<input type="hidden" name="os" value="<?php echo $ossdk; ?>"></input>
			</form>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>

<div style="border-bottom:1px solid #ccc;height:70px;">
	<div class="page_root_div_noborder" style="padding-top:10px;">
		<a href="/" class="ostitle_link" style="float:left;">Android OS</a>
		<p style="float:left;font-size:20px;height:40px;line-height:40px;">&nbsp;/&nbsp;</p>
		<a href="/api/<?php echo $ossdk; ?>" class="ostitle_link" style="float:left;margin-right:10px;"><?php echo $osname; ?></a>
	</div>
</div>

<div class="page_root_div_noborder">
	<div style="float:left;width:790px;background:#fff;">
		<p style="color:#666;font-size:16px;padding-top:10px;padding-bottom:10px;">&nbsp;&nbsp;&nbsp;<?php echo strlen($introduce) == 0 ? "暂无介绍" : $introduce; ?></p>
		<div style="height:40px;line-height:40px;border:1px solid #DDDDDD;border-radius:3px;font-size:14pt;padding-left:20px;">
			<ul class="prjstaticsul">
				<li><a href="#">0&nbsp;漏洞</a></li>
				<li><a href="#">0&nbsp;分析文章</a></li>
				<li><a href="#">0&nbsp;Bug</a></li>
			</ul>
			<div style="clear:both;"></div>
		</div>
		<div style="height:5px;"></div>
		<div style="height:40px;line-height:40px;font-size:14pt;padding-left:0px;">
			<section class="main">
				<div class="wrapper-demo" style="float:left;height:20px;line-height:20px;font-size:15px;background-color:#ccc;">
					<div id="dd" class="wrapper-dropdown-2" tabindex="1"><?php echo $osname; ?>
						<ul class="dropdown">
							<?php foreach ($allos as $ositem){ ?>
							<li><a href="/api/<?php echo $ositem["sdk"] ?>"><?php echo $ositem["name"] ?></a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</section>
			<?php 
			if(strlen($relativepath) == 0){
				echo "根目录"; 
			 }else{
			 	$currentRelative = "/";
			 	$preurl = "/api/{$ossdk}?path=";
				$matches = explode($relativepath,"/");
				$matches = array_filter($matches);
				$matches = array_values($matches);
				if(count($matches) > 0){
					echo "<span>&nbsp;</span>";
					echo "<a href=\"/browser?os={$ossdk}\">根目录</a>";
					echo "<span>&nbsp;|&nbsp;</span>";
				
					$itemCount = count($matches); 
					//print_r($matches);
					//foreach($matches as $matcheitem){
					for($i = 0;$i < $itemCount;$i++){
						$matcheitem = $matches[$i];
						if(strlen($matcheitem) > 0 && $i < $itemCount - 1){
							if($i > 0){
								echo "<span>&nbsp;/&nbsp;</span>";
							}
							echo "<a href=\"{$preurl}{$currentRelative}{$matcheitem}\">{$matcheitem}</a>";
							$currentRelative = $currentRelative . $matcheitem . "/";
						}else if($i == $itemCount - 1){
							//the last one, show as normal text
							if($i > 0){
								echo "<span>&nbsp;/&nbsp;</span>";
							}
							echo "<span>{$matcheitem}</span>";
						}
					}
				}else{
					echo "<span>&nbsp;</span>";
					echo "<span>根目录</span>";
					echo "<span>&nbsp;|&nbsp;+</span>";
				}
			} ?>
		</div>
		<div>
			<div style="height:10px;"></div>
			<table style="font-size:14pt;width:100%;">
				<thead>
					<tr style="height:35px;border:1px solid #ccc;background:#e6f1f6;">
						<td style="padding-left:10px;color:#000;">文件(夹)名</td>
						<td style="width:10%;text-align:center;color:#000;">文件大小</td>
						<td style="width:20%;text-align:center;color:#000;">操作</td>
					</tr>
				</thead>
				<!-- 先显示文件夹 -->
				<?php foreach($childfolder as $folderItem){ ?>
				<tr style="height:35px;border:1px solid #ccc;background:#f8f8f8;">
					<td style="padding-left:10px;"><img src="/iprogram/assets/img/androidfolder.png" width="15px"></img>&nbsp;<a href="/browser?os=<?php echo $ossdk; ?>&path=<?php echo $folderItem["relative"] ?>"><?php echo $folderItem["name"]; ?></a></td>
					<td style="text-align:center;">-</td>
					<td style="text-align:center;">
						<a href="/api/<?php echo $ossdk; ?>?path=<?php echo $folderItem["relative"] ?>" style="font-size:11pt;">打开文件夹</a>
					</td>
				</tr>
				<?php } ?>
				
				<!-- 再显示文件 -->
				<?php foreach($childfile as $fileItem){ ?>
				<tr style="height:35px;border:1px solid #ccc;background:#f8f8f8;">
					<td style="padding-left:10px;"><img src="/iprogram/assets/img/androidfile.png" width="15px"></img>&nbsp;<a href="/code?os=<?php echo $ossdk; ?>&src=<?php echo $fileItem["relative"] ?>" target="_blank"><?php echo $fileItem["name"]; ?></a></td>
					<td style="text-align:center;">-</td>
					<td style="text-align:center;">
						<a href="/code?os=<?php echo $ossdk; ?>&src=<?php echo $fileItem["relative"] ?>" style="font-size:11pt;">在线阅读</a>
						<a href="/download?os=<?php echo $ossdk; ?>&src=<?php echo $fileItem["relative"] ?>" style="font-size:11pt;">下载</a>
					</td>
				</tr>
				<?php } ?>
			
			</table>
		</div>
	</div>
	<div style="float:right;width:340px;background:#fff;height:550px;overflow:hidden;border-left:1px solid #ccc">
		<div style="height:20px;"></div>
		<div style="text-align:left;margin-left:10px;">
			<div style="margin:0px;padding:0px;height:30px;width:364px;background:#ccc;">
				<span style="color:#000;height:30px;line-height:30px;font-size:15px;padding-left:5px;">已知漏洞</span>
			</div>
			<div style="margin:0px;">
				<p style="font-size:14px;">暂未收录</p>
			</div>
		</div>
		
		<div style="height:20px;"></div>
		<div style="text-align:left;margin-left:10px;">
			<div style="margin:0px;padding:0px;height:30px;width:364px;background:#ccc;">
				<span style="color:#000;height:30px;line-height:30px;font-size:15px;padding-left:5px;">技术分析</span>
			</div>
			<div style="margin:0px;">
				<p style="font-size:14px;">无相关文章</p>
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>
</div>



<script type="text/javascript">

function DropDown(el) {
	this.dd = el;
	this.initEvents();
}
DropDown.prototype = {
	initEvents : function() {
		var obj = this;

		obj.dd.on('click', function(event){
			$(this).toggleClass('active');
			event.stopPropagation();
		});	
	}
}

$(function() {
	var dd = new DropDown( $('#dd') );
	$(document).click(function() {
		// all dropdowns
		$('.wrapper-dropdown-2').removeClass('active');
	});

});

</script>
			

<?php $hideUrls = true; ?>
<?php require_once 'iprogram/protected/views/layouts/component/foot.php'; ?>


