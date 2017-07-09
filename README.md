## 背景

如我们都知道的那样，Google的很多网站无法在国内访问。其中包括Android相关的网站，这增加了我们获取，阅读Android源代码的难度。扣丁书院([https://www.codingsky.com](https://www.codingsky.com))在前年（2015年）开发了在线阅读Android源代码的网站。本着开源精神，现将这个网站开源。

## 示例

示例网站如下图所示
![网站截图](https://codingsky.oss-cn-hangzhou.aliyuncs.com/cdn/codingsky/blog/aosp_website_screenshot.png)

当然，你也可以从我们的官方保留站点访问，其地址为[http://aosp.codingsky.com](http://aosp.codingsky.com)

## 如何部署这一网站

本网站使用Yii框架进行开发，按照Yii框架的部署方式进行部署即可：

 - 将代码clone到本地
 - 配置nginx或apache

如果一切正常，那么网站应该是可以访问了，此时访问一下站点，如果成功，则可进行后续路径的配置。网站为了提供在线阅读的功能，需要事先将源代码下载到本地。比如下载到本地的**/mnt/androidos**目录下，则打开之前网站的php文件：`{website}/iprogram/protected/models/AndroidOsFileConfig.php`，修改类成员变量androidOsConfig的值即可，此值在类的init方法中被初始化。以源代码下载到/mnt/androidos为例，此文件配置完成后如下所示：

```php
class AndroidOsFileConfig {
	private $androidOsConfig = null;

	public function __construct(){
		$this->init();
	}

	public function init(){
		$this->androidOsConfig = array(
			array("sdk" => 9, "name" => "Gingerbread", "dir" => "/mnt/androidos/android-2.3.2_r1"),
			array("sdk" => 10, "name" => "Gingerbread MR1", "dir" => "/mnt/androidos/android-2.3.7_r1"),
			array("sdk" => 14, "name" => "Ice Cream Sandwich", "dir" => "/mnt/androidos/android-4.0.2_r1"),
			array("sdk" => 15, "name" => "Ice Cream Sandwich MR1", "dir" => "/mnt/androidos/android-4.0.4_r2.1"),
			array("sdk" => 16, "name" => "Jelly Bean", "dir" => "/mnt/androidos/android-4.1.1_r1"),
			array("sdk" => 17, "name" => "Jelly Bean MR1", "dir" => "/mnt/androidos/android-4.2.2_r1"),
			array("sdk" => 18, "name" => "Jelly Bean MR2", "dir" => "/mnt/androidos/android-4.3_r1"),
			array("sdk" => 19, "name" => "Kitkat", "dir" => "/mnt/androidos/android-4.4.4_r1"),
			array("sdk" => 20, "name" => "Kitkat Watch", "dir" => "/mnt/androidos/android-4.4w_r1"),
			array("sdk" => 21, "name" => "Lollipop", "dir" => "/mnt/androidos/android-5.0.1_r1"),
			array("sdk" => 22, "name" => "Lollipop MR1", "dir" => "/mnt/androidos/android-5.1.0_r3"),
			array("sdk" => 23, "name" => "Marshmallow", "dir" => "/mnt/androidos/android-6.0.1_r16"),
		);
	}

	public function getAll(){
		return $this->androidOsConfig;
	}

	public function getOsInfo($sdk){
		foreach($this->androidOsConfig as $configItem){
			if($configItem["sdk"] == $sdk){
				return $configItem;
			}
		}
		return null;
	}

	public function getSdkName($sdk){
		foreach($this->androidOsConfig as $configItem){
			if($configItem["sdk"] == $sdk){
				return $configItem["name"];
			}
		}
		return "";
	}

	public function getSdkPath($sdk){
		foreach($this->androidOsConfig as $configItem){
			if($configItem["sdk"] == $sdk){
				return $configItem["dir"];
			}
		}
		return "";
	}
}
```

## 数据库支持

为了支持简单的按文件名搜索代码的功能，需要数据库支持。实现方式为事先将所有文件，文件所在目录（相对目录）及OS版本添加到数据库中，当用户输入文件名时，直接通过sql语句的like功能搜索文件名字段。当然，like本身效率低下，需要给文件名字段（filename）建立索引。

如果不需要搜索功能，则可以不用数据库支持。

表android_os_search表结构如下所示：

```
DROP TABLE IF EXISTS  `android_os_search`;
CREATE TABLE `android_os_search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(512) DEFAULT '',
  `filepath` text,
  `os` int(11) DEFAULT '0' COMMENT 'Android的OS版本号，如8=Froto',
  `status` int(11) DEFAULT '1',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '加入时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `filename_index` (`filename`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

```
