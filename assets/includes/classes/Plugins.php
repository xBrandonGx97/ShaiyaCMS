<?php
	Class Plugins{
		Public static $PluginName;
		Public static $PluginMasterFile;
		Public static $PluginEnabled;
		Public static $Mode;
		public static function plugin_search(){
			self::plugin_display();
		}
		public static function plugin_display(){
			if(self::$Mode=='left'){
				self::ServerTime();
				self::BossRecords();
			}elseif(self::$Mode=='right'){
				self::ServerInformation();
				#self::Test1();
			}
		}
		public static function ServerTime(){
			self::$PluginName		=	'ServerTime';
			self::$PluginMasterFile	=	'plugin.ServerTime.php';
			self::$PluginEnabled	=	true;
			if(self::$PluginName=='ServerTime' && self::$PluginEnabled==true){
				require_once('assets/includes/plugins/'.self::$PluginMasterFile);
			}
		}
		public static function BossRecords(){
			self::$PluginName		=	'BossRecords';
			self::$PluginMasterFile	=	'plugin.BossRecords.php';
			self::$PluginEnabled	=	true;
			if(self::$PluginName=='BossRecords' && self::$PluginEnabled==true){
				require_once('assets/includes/plugins/'.self::$PluginMasterFile);
			}
		}
		public static function ServerInformation(){
			self::$PluginName		=	'ServerInformation';
			self::$PluginMasterFile	=	'plugin.ServerInfo.php';
			self::$PluginEnabled	=	true;
			if(self::$PluginName=='ServerInformation' && self::$PluginEnabled==true){
				require_once('assets/includes/plugins/'.self::$PluginMasterFile);
			}
		}
	}
?>