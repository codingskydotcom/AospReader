SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE=InnoDB AUTO_INCREMENT=3039909 DEFAULT CHARSET=utf8;

CREATE TABLE `android_os_info`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `introduce` text,
  `api` int DEFAULT 0,
  `status` int(11) DEFAULT '1',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '加入时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3039909 DEFAULT CHARSET=utf8;

insert into android_os_info(introduce,api,update_time) values("New Home screen tips widget, and Gallery allows you to peek into picture stacks using a zoom gesture.", 8,now());