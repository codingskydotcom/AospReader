<?php $isAndroidSite = true; ?>
<?php require_once 'component/default_head.php'; ?>
	<div style="position:absolute;top:0px;bottom:0px;left:0px;right:0px;width:100%;height:100%;background:#fff;">
		<div style="position:relative;height:100%;padding:0px;margin:0px;">
			<?php require_once 'androidfunction.php'; ?>
			<!-- 左边栏 -->
			<div style="float:left;background:#2B3E4E;width:60px;padding:0px;margin:0px;top:0px;bottom:0px;height:100%;">
				<a href="http://android.codingsky.com" class="androidpage_toolbaritem <?php echo getAndroidTabCss("android","index"); ?>">
					<img src="/iprogram/assets/img/android3.png" alt="android频道" style="width:32px;height:32px;padding:0px;margin:0px;" />
				</a>
				<a href="http://android.codingsky.com/os" class="androidpage_toolbaritem <?php echo getAndroidTabCss("android","os"); ?>">
					<img src="/iprogram/assets/img/oscode.png" alt="android操作系统源代码" style="width:32px;height:32px;padding:0px;margin:0px;" />
				</a>
				<a href="http://android.codingsky.com/archive" class="androidpage_toolbaritem <?php echo getAndroidTabCss("android","archive"); ?>">
					<img src="/iprogram/assets/img/androidarchive.png" alt="android技术文档" style="width:32px;height:32px;padding:0px;margin:0px;" />
				</a>
				<a href="http://android.codingsky.com/devtools" class="androidpage_toolbaritem <?php echo getAndroidTabCss("android","devtools"); ?>">
					<img src="/iprogram/assets/img/devtools.png" alt="android开发工具" style="width:32px;height:32px;padding:0px;margin:0px;" />
				</a>
			</div>
			
			<!-- 中间 -->
			<?php if(getShowCenterColumn() == false){ ?>
			<div style="margin-left:60px;">			
				<?php echo $content; ?>
			</div>
			<?php }else{ ?>
			<div style="float:left;margin-left:0px;padding-left:0px;height:100%;width:300px;">
				<?php if(isAndroidAction("index") || isAndroidAction("wiki")){ ?>
				<?php require_once dirname(dirname(__FILE__)) . "/android/index_center.php"; ?>
				<?php }else if(isAndroidAction("devtools")){ ?>
				<?php require_once dirname(dirname(__FILE__)) . "/android/devtools_center.php"; ?>
				<?php }else if(isAndroidAction("archive")){ ?>
				<?php require_once dirname(dirname(__FILE__)) . "/android/archive_center.php"; ?>
				<?php } ?>
			</div>
			<!-- 右侧内容区 -->
			<div style="margin-left:360px;">
				<?php echo $content; ?>
			</div>
			<?php } ?>
			<div style="clear:both;"></div>
		</div>
		
	</div>
  </body>
</html>