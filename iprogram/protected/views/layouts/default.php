<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<?php require_once 'component/default_head.php'; ?>
	<?php 
		$menuHeight = 40;
		if( strcasecmp(getController(),"softwaredev") == 0 || strcasecmp(getController(),"web") == 0 )
		{
			$menuHeight = 73;
		}
		
		function getSecLinkColor($secondSegment,$currentSecItem){
			if(strcasecmp($secondSegment, $currentSecItem) == 0){
				return "color:#B11118;";
			}
			return "";
		}
		
		function getSecLinkColorForBook($classifId){
			if(key_exists("classify", $_GET) == false){
				if(strlen($classifId) == 0){
					return "color:#B11118;";
				}else{
					return "";
				}
			}
			
			$urlClassifyId  = $_GET['classify'];
			
			if(strcasecmp($urlClassifyId, $classifId) == 0){
				return "color:#B11118;";
			}
			return "";
		}
		
		function getNavBarClassName($firstSegment,$navBarItem){
			if(strcasecmp("site", $navBarItem) == 0){
				if(strlen($firstSegment) == 0){
					return "navbar_item_selected";
				}
			}
			
			if(strcasecmp($navBarItem, $firstSegment) == 0 ){
				return "navbar_item_selected";
			}
			return "navbar_item";
		}
	 ?>
	
	<body style="margin:0px;padding:0px;background:#efefef;color:#666;">
		<!-- 第一个top bannel -->
		<div style="background:#f8f8f8;height:32px;border-width:0px 0px 1px 0px;border-style:solid;border-color:#d6d6d6;">
			<div class="top_first_banner" style="height:30px">
				<div style="float:left;width:300px;height:30px">
					<div style="float:left;margin-top:4px;margin-left:0px;">
						<span id="loginedusername">扣丁书屋 , 只有精品，拒绝平庸!</span>
					</div>
					<div style="clear:both;"></div>
				</div>
				<div style="float:right;height:30px;line-height:30px;">
					<a class="crumb_link" href="/site">返回首页</a>
					<span>&nbsp;&nbsp;</span>
					<a class="crumb_link" style="color:#B5141A;" href="/site/new">最新文章</a>
					<span>&nbsp;&nbsp;</span>
					<a class="crumb_link" href="javascript:AddFavorite('http://www.codingsky.com','扣丁书屋网');">加入收藏</a>
					<span>&nbsp;&nbsp;</span>
					<a class="crumb_link" target="_blank" rel="nofollow" href="/about/post">投稿</a>
					<span>&nbsp;&nbsp;</span>
					<?php 
 						//<a class="crumb_link" href="/rss">订阅资讯</a>
						//<a target="_blank" href="http://xianguo.com/service/submitdigg/?link= echo urlencode("http://www.codingsky.com/rss"); ">订阅到鲜果</a>
					?>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div class="top_second_banner" style="background:#fff;">
			<div class="top_first_banner">
				<div style="float:left;width:400px;">
					<img style="margin-top:8px;" src="http://codingsky.oss-cn-hangzhou.aliyuncs.com/website/brand_logo.png" alt="扣丁书屋网" />
				</div>
				<div style="float:right;height:35px;margin-top:22px;">
					<script type="text/javascript">
					(function(){document.write(unescape('%3Cdiv id="bdcs"%3E%3C/div%3E'));var bdcs = document.createElement('script');bdcs.type = 'text/javascript';bdcs.async = true;bdcs.src = 'http://znsv.baidu.com/customer_search/api/js?sid=887976850541914529' + '&plate_url=' + encodeURIComponent(window.location.href) + '&t=' + Math.ceil(new Date()/3600000);var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(bdcs, s);})();
					</script>
				</div>
			</div>
		</div>
		<!-- 菜单 -->
		<div class="navbar_div" style="height:<?php echo $menuHeight; ?>px;margin-top:0px;padding:0px;">
			<div class="top_first_banner" style="height:40px;margin-top:0px;margin-bottom:0px;padding:0px;">
				<ul class="navbar_ul">
					<li class="<?php echo getNavBarClassName(getController(),"site"); ?>"><a href="/">首页</a></li>
					<li class="split"></li>
					<li class="<?php echo getNavBarClassName(getController(),"code"); ?>"><a href="/code">代码</a></li>
					<li class="split"></li>
					<li class="<?php echo getNavBarClassName(getController(),"softwaredev"); ?>"><a href="/softwaredev">软件开发</a></li>
					<li class="<?php echo getNavBarClassName(getController(),"mobiledev"); ?>"><a href="http://android.codingsky.com">安卓小站</a></li>
					<li class="<?php echo getNavBarClassName(getController(),"mobiledev"); ?>"><a href="http://androidos.codingsky.com">Android系统源代码</a></li>
					<li class="<?php echo getNavBarClassName(getController(),"webdev"); ?>"><a href="/webdev">Web前端</a></li>
					<li class="<?php echo getNavBarClassName(getController(),"subject"); ?>"><a href="/subject">专题</a></li>
					<li class="split"></li>
					<li class="<?php echo getNavBarClassName(getController(),"it"); ?>"><a href="/it" style="font-size:18px;color:#FDF411">IT世界</a></li>
					<?php if(BAE_LOCAL_DEBUG){ ?>
					<li class="<?php echo getNavBarClassName(getController(),"software"); ?>"><a href="/software">工具箱</a></li>
					<li class="<?php echo getNavBarClassName(getController(),"book"); ?>"><a href="/book">精品读书</a></li>
					<?php } ?>
					<li class="<?php echo getNavBarClassName(getController(),"opensource"); ?>"><a href="/opensource">开源项目</a></li>
					<li class="<?php echo getNavBarClassName(getController(),"csksoft"); ?>"><a href="/csksoft">扣丁书屋软件</a></li>
					<li class="<?php echo getNavBarClassName(getController(),"editor"); ?>"><a target="_blank" href="/editor">代码编辑器</a></li>
					<li class="<?php echo getNavBarClassName(getController(),"postoffice"); ?>"><a target="_blank" href="/postoffice">传送门</a></li>
					<li class="split"></li>
					
					<div style="clear:both"></div>
				</ul>
			</div>
			
			<div class="top_first_banner">
				<?php if(strcasecmp(getController(),"softwaredev") == 0){ ?>
				<ul class="sec_nav_content" style="margin-left:42px;">
					<li><a class="sec_nav_item" style="height:33px;line-height:33px;<?php echo getSecLinkColor(getAction(),""); ?>" href="/softwaredev">全部</a></li>
					<li><a class="sec_nav_item" style="height:33px;line-height:33px;<?php echo getSecLinkColor(getAction(),"base"); ?>" href="/softwaredev/base">基础技术</a></li>
					<li><a class="sec_nav_item" style="height:33px;line-height:33px;<?php echo getSecLinkColor(getAction(),"ui"); ?>" href="/softwaredev/ui">界面技术</a></li>
					<li><a class="sec_nav_item" style="height:33px;line-height:33px;<?php echo getSecLinkColor(getAction(),"network"); ?>" href="/softwaredev/network">网络技术</a></li>
					<li><a class="sec_nav_item" style="height:33px;line-height:33px;<?php echo getSecLinkColor(getAction(),"multimedia"); ?>" href="/softwaredev/multimedia">图形图像及多媒体技术</a></li>
				</ul>
				<?php } ?>
				<?php if(strcasecmp(getController(),"mobiledev") == 0){ ?>
				<!-- ul class="sec_nav_content" style="margin-left:112px;">
					<li><a class="sec_nav_item" style="height:33px;line-height:33px;<?php echo getSecLinkColor(getAction(),""); ?>" href="/mobiledev">全部</a></li>
					<li><a class="sec_nav_item" style="height:33px;line-height:33px;<?php echo getSecLinkColor(getAction(),"android"); ?>" href="/mobiledev/android">Android</a></li>
					<li><a class="sec_nav_item" style="height:33px;line-height:33px;<?php echo getSecLinkColor(getAction(),"iphone"); ?>" href="/mobiledev/iphone">iPhone</a></li>
					<li><a class="sec_nav_item" style="height:33px;line-height:33px;<?php echo getSecLinkColor(getAction(),"wp"); ?>" href="/mobiledev/wp">WP</a></li>
				</ul -->
				<?php } ?>
				<?php if(strcasecmp(getController(),"web") == 0){ ?>
				<ul class="sec_nav_content" style="margin-left:181px;">
					<li><a class="sec_nav_item" style="height:33px;line-height:33px;<?php echo getSecLinkColor(getAction(),""); ?>" href="/webdev">全部</a></li>
					<li><a class="sec_nav_item" style="height:33px;line-height:33px;<?php echo getSecLinkColor(getAction(),"js"); ?>" href="/webdev/js">Javascript</a></li>
					<li><a class="sec_nav_item" style="height:33px;line-height:33px;<?php echo getSecLinkColor(getAction(),"css"); ?>" href="/webdev/css">CSS</a></li>
					<li><a class="sec_nav_item" style="height:33px;line-height:33px;<?php echo getSecLinkColor(getAction(),"html5"); ?>" href="/webdev/html5">HTML5</a></li>
				</ul>
				<?php } ?>
				<?php if(strcasecmp(getController(),"book") == 0){ ?>
				<ul class="sec_nav_content" style="margin-left:181px;">
					<li><a class="sec_nav_item" style="height:33px;line-height:33px;<?php echo getSecLinkColorForBook(""); ?>" href="">全部</a></li>
					<li><a class="sec_nav_item" style="height:33px;line-height:33px;<?php echo getSecLinkColorForBook("13"); ?>" href="/book/list?classify=13">程序与算法</a></li>
					<li><a class="sec_nav_item" style="height:33px;line-height:33px;<?php echo getSecLinkColorForBook("12"); ?>" href="/book/list?classify=12">Windows开发</a></li>
					<li><a class="sec_nav_item" style="height:33px;line-height:33px;<?php echo getSecLinkColorForBook("11"); ?>" href="/book/list?classify=11">手机开发</a></li>
				</ul>
				<?php } ?>
			</div>
		</div>
		
		<?php //require_once 'component/crumbs.php'; ?>
		
		<?php if(csg_isPrintMode() == false && csg_GetShowTopAdv()){ ?>
		<?php require_once ("iprogram/protected/views/layouts/adv/index_top.php"); ?>
		<?php } ?>
		
		<?php echo $content; ?>
		
		<?php require_once 'component/foot.php'; ?>
	</body>
</html>