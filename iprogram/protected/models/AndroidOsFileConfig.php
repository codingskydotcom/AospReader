<?php

class AndroidOsFileConfig {
	private $androidOsConfig = null;
	
	public function __construct(){
		$this->init();
	}
	
	public function init(){
		$this->androidOsConfig = array(
            array("sdk" => 4, "name" => "Donut", "dir" => "/mnt/gdisk/androidos/android-1.6_r1"),
            array("sdk" => 5, "name" => "Eclair", "dir" => "/mnt/gdisk/androidos/android-2.0_r1"),
            array("sdk" => 6, "name" => "Eclair MR1", "dir" => "/mnt/gdisk/androidos/android-2.0.1_r1"),
            array("sdk" => 7, "name" => "Eclair MR2", "dir" => "/mnt/gdisk/androidos/android-2.1_r2.1p2"),
            array("sdk" => 8, "name" => "Froyo", "dir" => "/mnt/gdisk/androidos/android-2.2_r1"),
            array("sdk" => 9, "name" => "Gingerbread", "dir" => "/mnt/gdisk/androidos/android-2.3.2_r1"),
            array("sdk" => 10, "name" => "Gingerbread MR1", "dir" => "/mnt/gdisk/androidos/android-2.3.7_r1"),
            array("sdk" => 14, "name" => "Ice Cream Sandwich", "dir" => "/mnt/gdisk/androidos/android-4.0.2_r1"),
            array("sdk" => 15, "name" => "Ice Cream Sandwich MR1", "dir" => "/mnt/gdisk/androidos/android-4.0.4_r2.1"),
            array("sdk" => 16, "name" => "Jelly Bean", "dir" => "/mnt/gdisk/androidos/android-4.1.1_r1"),
            array("sdk" => 17, "name" => "Jelly Bean MR1", "dir" => "/mnt/gdisk/androidos/android-4.2.2_r1"),
            array("sdk" => 18, "name" => "Jelly Bean MR2", "dir" => "/mnt/gdisk/androidos/android-4.3_r1"),
            array("sdk" => 19, "name" => "Kitkat", "dir" => "/mnt/gdisk/androidos/android-4.4.4_r1"),
            array("sdk" => 20, "name" => "Kitkat Watch", "dir" => "/mnt/gdisk/androidos/android-4.4w_r1"),
            array("sdk" => 21, "name" => "Lollipop", "dir" => "/mnt/gdisk/androidos/android-5.0.1_r1"),
            array("sdk" => 22, "name" => "Lollipop MR1", "dir" => "/mnt/gdisk/androidos/android-5.1.0_r3"),
            array("sdk" => 23, "name" => "Marshmallow", "dir" => "/mnt/gdisk/androidos/android-6.0.1_r16"),
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
        //return "/Users/shishengyi/Projects/adb/";
		foreach($this->androidOsConfig as $configItem){
			if($configItem["sdk"] == $sdk){
				return $configItem["dir"];
			}
		}
		return "";
	}
	
	
	
	
}