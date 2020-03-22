<?php
	class Setting{

		public $PAGE_PREFIX='pageid';
		public $SETUP=0;
		public $ADDRESS_1='123 Find Me Lane';
		public $ADDRESS_2='Apt. 1';
		public $ADDRESS_3='Somewhere, USA 01234';
		public $EMAIL_SALES='mail@mail.com';
		public $EMAIL_SUPPORT='mail@mail.com';
		public $PHONE_PRIMARY='(012)-345-6789';
		public $PHONE_SECONDARY='(012)-345-6789';
		public $AUTHOR='[Dev]Velocity';
		public $WEBMASTER='[Dev]Velocity';
		public $SITE_TITLE='Server Name';
		public $SITE_FOOTER='&copy; 2018 ServerName. All rights reserved. Developed By [Dev]Velocity.';
		public $ACP_SITE_TITLE='Admin Panel';
		public $SITE_DOMAIN='ServerName.com';
		public $DEBUG=0;
		public $LOGGING=1;
		public $HTTPS_SSL=0;
		public $SITE_TYPE='Shaiya';
		public $RECAPTCHA_SITE_KEY='6LdQ8RETAAAAAD2qZC4Q1dXSTfuGAqw2Kai77dHa';
		public $RECAPTCHA_SEC_KEY='6LdQ8RETAAAAAPl-2DzW8Ewt25oFYgPY2nFJFatc';
		public $VERSION='1.3';
		public $UPDATER_KEY='NXZavEdcYFjGzQNR4MOP9ElV';
		public $MAINTENANCE=0;
		public $Preloader=1;
		public $LOGO_ENABLED=0;
		public $Jumbotron=0;
		public $Carousel=1;
		public $FOOTER_ENABLED=1;
		public $SERVERSTAT_NAV=1;
		public $Bless=1;

		function __construct($Data,$db,$Tpl){
			$this->Data	=	$Data;
			$this->db	=	$db;
			$this->Tpl	=	$Tpl;
		}

		function MAINTENANCE_CHECK(){
			if($this->MAINTENANCE){
				header("location: ?".$this->PAGE_PREFIX."=MAINTENANCE");
			}
		}
		# OTHER
		function Props(){
			echo "<b>Class > Settings Properties:</b> "; 
			echo "<pre>";
				print_r(get_object_vars($this));
			echo "</pre>";
		}
	}
?>