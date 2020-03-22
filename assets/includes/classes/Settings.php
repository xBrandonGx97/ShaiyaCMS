<?php
    Class Settings{
		/* Meta Data */
		public static $Author      		=   '[Dev]Velocity';
		public static $WebMaster   		=   '[Dev]Velocity';
		public static $Description		=	'Description Here';
		public static $Keywords			=	'Keyword,Keywords,More,Here';
		/* Site Settings */
        public static $SiteTitle   		=   'Shaiya CMS';
        public static $SiteFooter  		=   '&copy; 2019 Shaiya CMS. All rights reserved. <br>Developed By [Dev]Velocity.';
        public static $SiteDomain  		=   'http://shaiyacms.com';
        public static $Debug       		=   0;
		public static $Version     		=   '2.0';
		/* Themes - shCMS,OS */
		public static $SiteTheme		=	'shCMS';
		public static $Ajax				=	'false';
		# Paging
		public static $PageTitle		=	NULL;
		public static $PageZone			=	'Default';
		public static $PageIndex		=	NULL;
		public static $PageCat			=	NULL;
		public static $PageSub			=	NULL;
		# Content
		public static $Preloader		=	0;
		public static $Jumbotron		=	1;
		public static $Carousel			=	0;
		public static $LogoEnabled		=	0;
		public static $FooterEnabled	=	1;
		public static $GRBEnabled		=	1;
		# Registration
		public static $secretkey 		= "SecretKey";
		public static $sitekey			=	"SiteKey";
		public static $LimitAccs		=	3;
		# Purifier
		public static $config;
		public static $purifier;
		# Server Ports
		public static $ServerIP			=	'127.0.0.1';
		public static $LoginPort		=	'30800';
		public static $GamePort			=	'30810';
		public static $ServStatusNav	=	1;
		# Login > Game
		public static $ServerPorts	=	 array(80, 80);
		public static function _load_purifier(){
			require_once 'assets/includes/library/HTMLPurifier.auto.php';
			self::$config = HTMLPurifier_Config::createDefault();
			self::$purifier = new HTMLPurifier(self::$config);
		}
    }
?>