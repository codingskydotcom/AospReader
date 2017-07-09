<?php
//include('inc/home.php');
require_once "iprogram/protected/config/androidos.config.php"
?>
<div style="background:#1abc9c;height:370px;position:relative;">
	<div style="height:50px;"></div>
	<div style="width:60%;margin:0 auto;">
		<p style="text-align:center;font-size:25pt;color:#fff;">Android源代码搜索</p>
		<p style="text-align:center;font-size:13pt;color:#fff;">我们为您收集了所有Android操作系统的源代码，并提供在线阅读功能</p>
		<div style="height:20px;"></div>
		<div style="background:rgba(0,0,0,0.6);width:260px;padding:2px 0px;margin:0 auto;text-align:center;"><span style="color:#5fbc0e;font-size:11pt;">输入文字并猛击回车键以开始搜索<span></div>
		<div style="height:10px;"></div>
		<form method="GET">
			<div>
				<input id="q" name="q" class="searchinput" type="text" placeholder="请输入文件名以进行搜索(如View.java)" autofocus="" autocomplete="off" />
			</div>
		</form>
	</div>
	<div style="background:rgba(0,0,0,0.4);position:absolute;left:0px;right:0px;bottom:0px;height:35px;line-height:35px;text-align:center;"><span style="color:#fff;font-size:11pt;">源代码是最好的老师，请不要错过他！<span></div>
</div>

<?php $index = 0; ?>
<?php $androidos = get_android_os_alias(); ?>
<?php foreach($androidos as $androidositem){ ?>
<div style="padding:30px 70px 30px 70px;background:<?php echo $index % 2 == 1 ? "#fff" : "#ecf0f1" ?>">
	<?php $index++; ?>
	<a style="font-size:15pt;display:block;color:#333;font-weight:bold;" href="/api/<?php echo $androidositem["sdk"]; ?>"><?php echo $androidositem["title"]; ?></a>
	<p style="color:#333;font-size:12pt;margin-top:10px;margin-bottom:5px;">发布时间：<?php echo $androidositem["publishtime"]; ?></p>
	<table style="background:#fff;width:100%">
		<tr>
			<td style="vertical-align:text-top;width:20%;border:1px solid #ddd;padding:0.5em 1em;background: #fbfbfb;">
				<p style="color:#333;font-size:12pt;">版本新特性：</p>
			</td>
			<td style="vertical-align:text-top;border: 1px solid #ddd;padding:0.5em 1em;">
				<ul style="color:#333;font-size:12pt;">
					<?php foreach($androidositem["newfunction"] as $newfunctionitem){ ?>
					<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $newfunctionitem["descript"]; ?></li>
					<?php } ?>
				</ul>
			</td>
		</tr>
	</table>
	<p style="font-size:12pt;margin-top:10px;">在线阅读：
		<a href="/api/<?php echo $androidositem["sdk"]; ?>?path=/frameworks">框架源码(frameworks)</a>&nbsp;&nbsp;
		<a href="/api/<?php echo $androidositem["sdk"]; ?>?path=/bionic">bionic</a>&nbsp;&nbsp;
		<a href="/api/<?php echo $androidositem["sdk"]; ?>?path=/dalvik">Java虚拟机(dalvik)</a>&nbsp;&nbsp;
		<a href="/api/<?php echo $androidositem["sdk"]; ?>?path=/packages">系统APP(packages)</a>&nbsp;&nbsp;
		<a href="/api/<?php echo $androidositem["sdk"]; ?>?path=/ndk">本地支持(ndk)</a>&nbsp;&nbsp;
		<a href="/api/<?php echo $androidositem["sdk"]; ?>?path=/system">系统(system)</a>&nbsp;&nbsp;
		<a href="/api/<?php echo $androidositem["sdk"]; ?>?path=/development">开发者(development)</a>
	</p>
</div>
<?php } ?>
<?php $hideUrls = true; ?>
<?php require_once 'iprogram/protected/views/layouts/component/foot.php'; ?>

