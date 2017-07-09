<?php

/*
 * 开源时简代处理,原本此类关联的表为:android_os_info,其表结构如下所示。
 * 此表原意是用来存储某一个版本的Android代码的描述。
 *
 *
 * 表结构:
CREATE TABLE `android_os_info`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `introduce` text,
  `api` int DEFAULT 0,
  `status` int(11) DEFAULT '1',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '加入时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * */

class AndroidOsInfo /*extends CActiveRecord*/
{
	private $recordPerPage = 50;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'android_os_info';
	}
	
	/*public function getOsIntroduce($api){
		$sql = "select introduce from android_os_info where api = '" . intval($api) . "'";		
		$result = $this->querySql($sql);
		if($result != null && count($result) == 1){
			return $result[0]["introduce"];
		}
		return "";
	}*/

	/*
	 * 如果需要此功能,请使用上面的方法,并创建数据库表
	 * */
    public function getOsIntroduce($api){
        return "";
    }
}