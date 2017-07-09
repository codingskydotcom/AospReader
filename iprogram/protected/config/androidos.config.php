<?php

$android_os_list = array(
			array(
				"ids" => "cupcake",
				"shorttitle" => "Cupcake",
				"dir" => "android2.3.7",
				"title" => "Cupcake - Android 1.5",
			),
			array(
				"ids" => "donut",
				"shorttitle" => "Donut",
				"dir" => "",
				"title" => "Donut - Android 1.6",
			),
			array(
				"ids" => "froyo",
				"shorttitle" => "Froyo",
				"dir" => "",
				"title" => "Froyo - Android 2.2",
			),
			array(
				"ids" => "gingerbread",
				"shorttitle" => "Gingerbread",
				"dir" => "",
				"title" => "Gingerbread - Android 2.3",
			),
			array(
				"ids" => "honeycomb-1",
				"shorttitle" => "Honeycomb(3.0)",
				"dir" => "",
				"title" => "Honeycomb - Android 3.0",
			),
			array(
				"ids" => "honeycomb-2",
				"shorttitle" => "Honeycomb(3.1)",
				"dir" => "",
				"title" => "Honeycomb - Android 3.1",
			),
			array(
				"ids" => "honeycomb-3",
				"shorttitle" => "Honeycomb(3.2)",
				"dir" => "",
				"title" => "Honeycomb - Android 3.2",
			),
			array(
				"ids" => "icecreamsandwich",
				"shorttitle" => "Ice Cream Sandwich",
				"dir" => "",
				"title" => "Ice Cream Sandwich - Android 4.0",
			),
			array(
				"ids" => "jellybean-1",
				"shorttitle" => "Jelly Bean(4.1)",
				"dir" => "",
				"title" => "Jelly Bean - Android 4.1",
			),
			array(
				"ids" => "jellybean-2",
				"shorttitle" => "Jelly Bean(4.2)",
				"dir" => "",
				"title" => "Jelly Bean - Android 4.2",
			),
			array(
				"ids" => "jellybean-3",
				"shorttitle" => "Jelly Bean(4.3)",
				"dir" => "",
				"title" => "Jelly Bean - Android 4.3",
			),
			array(
				"ids" => "kitkat",
				"shorttitle" => "KitKat",
				"dir" => "",
				"title" => "KitKat - Android 4.4",
			),

		);

function get_android_os_alias(){
	global $android_os_list;
	//return $android_os_list;
	return array(
			array(
				"sdk" => 4,
				"ids" => "Donut",
				"shorttitle" => "Donut",
				"dir" => "",
				"title" => "Eclair - Android 1.6",
				"publishtime" => "2011-12-12",
				"newfunction" => array(
							array("descript" => "灰色的界面变成了黑色，增加电源Widget"),
							array("descript" => "可以同时绑定多个Google账号"),
							array("descript" => "设置里增加Personalize功能"),
							array("descript" => "无线控件里有了VPN设置"),
							array("descript" => "增加了新的分类选项Location和Privacy"),
						),
			),
			array(
				"sdk" => 5,
				"ids" => "Eclair",
				"shorttitle" => "Eclair",
				"dir" => "",
				"title" => "Eclair - Android 2.0",
				"publishtime" => "2011-12-12",
				"newfunction" => array(
							array("descript" => "灰色的界面变成了黑色，增加电源Widget"),
							array("descript" => "可以同时绑定多个Google账号"),
							array("descript" => "设置里增加Personalize功能"),
							array("descript" => "无线控件里有了VPN设置"),
							array("descript" => "增加了新的分类选项Location和Privacy"),
						),
			),
			array(
				"sdk" => 8,
				"ids" => "froyo",
				"shorttitle" => "Froyo",
				"dir" => "",
				"title" => "Froyo - Android 2.2",
				"publishtime" => "2011-12-12",
				"newfunction" => array(
							array("descript" => "新增应用程序“全部升级”或“自动升级”选项"),
							array("descript" => "3G网络共享功能"),
							array("descript" => "Flash的支持"),
							array("descript" => "全新的软件商店,与PC端保持同步"),
							array("descript" => "支持APP2SD，就是把程序安装到SD卡上"),
						),
				"descript" => ""
			),
			array(
				"sdk" => 10,
				"ids" => "cupcake",
				"shorttitle" => "Cupcake",
				"dir" => "android2.3.7",
				"title" => "Cupcake - Android 2.3.7",
				"publishtime" => "2011-12-12",
				"newfunction" => array(
							array("descript" => "老版本仅支持拍照，新版的增加了对视频录制功能，同时也将拍照时的启动速度做了优化。"),
							array("descript" => "支持了Widget，用户可以自行加入音乐播放器和文件夹快捷方式等。"),
							array("descript" => "改进了GPS功能，定位库使用了A-GPS技术，搜星速度大幅提高。"),
							array("descript" => "增加了Voice Search的语音识别功能，但是仅限于英文。"),
							array("descript" => "蓝牙耳机支持A2DP蓝牙立体声，但仍然不能传输文件。"),
							array("descript" => "内置的重力加速感应器增加了自动探测方向的支持。"),
							array("descript" => "内置的Google Chrome Lite浏览器更新了Webkit内核，升级了包含了Squirellfish更快的JavaScript处理。"),
							array("descript" => "用户界面细节改善，在Gmail、Calenda、Messaging等组件的外观都有较小改进。另外在程序菜单的背景出现花纹。"),
							array("descript" => "中文显示和中文输入的支持，国际化有了更进一步的发展，支持包括中文在内的十几种语言。")
						),
			),
			array(
				"sdk" => 15,
				"ids" => "icecreamsandwich",
				"shorttitle" => "Ice Cream Sandwich",
				"dir" => "",
				"title" => "Ice Cream Sandwich - Android 4.0",
				"descript" => "",
				"publishtime" => "2011-12-12",
				"newfunction" => array(
							array("descript" => "虚拟按键，增大屏幕面积同时控制手机整体大小"),
							array("descript" => "桌面插件Widgets列表呈现在标签页中，与程序列表类似并且共存"),
							array("descript" => "文件夹更容易创建和管理，与iOS类似"),
							array("descript" => "可定制的桌面系统"),
							array("descript" => "可视语音邮件"),
							array("descript" => "日历支持缩放操作"),
							array("descript" => "Gmail离线搜索，两行预览，以及底部新快捷栏"),
							array("descript" => "音量下键+电源键组合截图"),
							array("descript" => "改进虚拟键盘纠错"),
							array("descript" => "从锁屏界面直接访问应用程序"),
						),
			),
			array(
				"sdk" => 16,
				"ids" => "jellybean-1",
				"shorttitle" => "Jelly Bean(4.1)",
				"dir" => "",
				"title" => "Jelly Bean - Android 4.1",
				"descript" => "",
				"publishtime" => "2011-12-12",
				"newfunction" => array(
							array("descript" => "更快、更流畅、更灵敏"),
							array("descript" => "增强通知栏"),
							array("descript" => "全新搜索"),
							array("descript" => "桌面插件自动调整大小"),
							array("descript" => "加强无障碍操作"),
							array("descript" => "语言和输入法扩展"),
							array("descript" => "新的输入类型和功能"),
							array("descript" => "新的连接类型(Android Beam)"),
							array("descript" => "新的媒体功能(支持USB音频输出,多声道音视频输出（HDMI端口)等"),
						),
			),
			array(
				"sdk" => 17,
				"ids" => "jellybean-2",
				"shorttitle" => "Jelly Bean(4.2)",
				"dir" => "",
				"title" => "Jelly Bean - Android 4.2",
				"descript" => "",
				"publishtime" => "2011-12-12",
				"newfunction" => array(
							array("descript" => "无线视频(支持 Miracast 影像传输协议)"),
							array("descript" => "Android 平板的多账户支持"),
							array("descript" => "Gesture Typing，滑动输入"),
							array("descript" => "Photo Sphere 全景相片"),
							array("descript" => "锁屏界面现在也支持放置 Widgets"),
							array("descript" => "通知抽屉（notification drawer）加入了更多的操作"),
							array("descript" => "辅助功能方面的改进：三击放大屏幕，可以用两指来平移和缩放"),
							array("descript" => "Gmail 支持缩放。"),
							array("descript" => "Gmail 现在也是 Google Now 的信息来源。"),
						),
			),
			array(
				"sdk" => 18,
				"ids" => "jellybean-3",
				"shorttitle" => "Jelly Bean(4.3)",
				"dir" => "",
				"title" => "Jelly Bean - Android 4.3",
				"descript" => "",
				"publishtime" => "2011-12-12",
				"newfunction" => array(
							array("descript" => "更快，更流畅，更灵敏"),
							array("descript" => "OpenGL ES 3.0高性能图形"),
							array("descript" => "增强的蓝牙连接"),
							array("descript" => "优化的位置和传感器功能"),
							array("descript" => "新媒体功能"),
							array("descript" => "辅助功能和UI自动化"),
							array("descript" => "企业和安全"),
							array("descript" => "分析性能的新方法"),
						),
			),
			array(
				"sdk" => 19,
				"ids" => "kitkat",
				"shorttitle" => "KitKat",
				"dir" => "",
				"title" => "KitKat - Android 4.4",
				"descript" => "",
				"publishtime" => "2011-12-12",
				"newfunction" => array(
							array("descript" => "新的拨号和智能来电显示"),
							array("descript" => "针对RAM的优化"),
							array("descript" => "新图标、锁屏、启动动画和配色方案"),
							array("descript" => "加强主动式语音功能"),
							array("descript" => "集成Hangouts IM软件"),
							array("descript" => "全屏模式"),
							array("descript" => "支持Emoji键盘"),
							array("descript" => "轻松访问在线存储"),
							array("descript" => "无线打印"),
							array("descript" => "屏幕录像功能"),
							array("descript" => "内置字幕管理功能"),
							array("descript" => "计步器应用"),
							array("descript" => "低功耗音频和定位模式"),
							array("descript" => "新的接触式支付系统"),
							array("descript" => "新的蓝牙配置文件和红外兼容性"),
						),
			),
			array(
				"sdk" => 20,
				"ids" => "kitkat",
				"shorttitle" => "KitKat MR1",
				"dir" => "",
				"title" => "KitKat - Android 4.4",
				"descript" => "",
				"publishtime" => "2011-12-12",
				"newfunction" => array(
							array("descript" => "新的拨号和智能来电显示"),
							array("descript" => "针对RAM的优化"),
							array("descript" => "新图标、锁屏、启动动画和配色方案"),
							array("descript" => "加强主动式语音功能"),
							array("descript" => "集成Hangouts IM软件"),
							array("descript" => "全屏模式"),
							array("descript" => "支持Emoji键盘"),
							array("descript" => "轻松访问在线存储"),
							array("descript" => "无线打印"),
							array("descript" => "屏幕录像功能"),
							array("descript" => "内置字幕管理功能"),
							array("descript" => "计步器应用"),
							array("descript" => "低功耗音频和定位模式"),
							array("descript" => "新的接触式支付系统"),
							array("descript" => "新的蓝牙配置文件和红外兼容性"),
						),
			),
			array(
				"sdk" => 21,
				"ids" => "Lollipop",
				"shorttitle" => "Lollipop",
				"dir" => "",
				"title" => "Lollipop - Android 5.0",
				"descript" => "",
				"publishtime" => "2011-12-12",
				"newfunction" => array(
						),
			),
			array(
				"sdk" => 22,
				"ids" => "Lollipop MR1",
				"shorttitle" => "Lollipop MR1",
				"dir" => "",
				"title" => "Lollipop - Android 5.1",
				"descript" => "",
				"publishtime" => "2011-12-12",
				"newfunction" => array(
						),
			),
			array(
				"sdk" => 23,
				"ids" => "Marshmallow",
				"shorttitle" => "Marshmallow",
				"dir" => "",
				"title" => "Lollipop - Android 6.0",
				"descript" => "",
				"publishtime" => "2015-08-18",
				"newfunction" => array(
							array("descript" => "动态权限"),
							array("descript" => "新的墓碑机制"),
						),
			),
		);
}

function get_android_os(){
	global $android_os_list;
	return $android_os_list;
}

function get_android_root(){
	return "E:\\AndroidSourceCode";
}

function get_android_dir($verids){
	$android_os_list = get_android_os_alias();
	$count = count($android_os_list);
	for($i = 0;$i < $count;$i++){
		if(strcasecmp($android_os_list[$i]["ids"], $verids) == 0){
			//return $android_os_list[$i]["dir"];
			//echo "got it";
			return get_android_root() . "/{$android_os_list[$i]["dir"]}";
		}
	}
	return "";
}
