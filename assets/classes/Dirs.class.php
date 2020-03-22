<?php
	class Dirs{

		public $DIR_ASSETS;
		public $DIR_PAYPAL_IPN;
		public $DIR_PHPMAILER;
		public $DIR_PLUGINS;

		function __construct(){
			$this->DIR_ASSETS();
			$this->DIR_PAYPAL_IPN();
			$this->DIR_PHPMAILER();
			$this->DIR_PLUGINS();
		}
		function DIR_ASSETS(){
			$this->DIR_ASSETS		=	'assets/';
			$this->DIR_PLUGINS();
		}
		function DIR_DOWNLOADS(){
			$this->DIR_DOWNLOADS	=	'downloads/';
		}
		function DIR_UPLOADS(){
			$this->DIR_UPLOADS		=	'uploads/';
		}
		function DIR_AJAX(){
			$this->DIR_AJAX			=	'ajax/';
		}
		function DIR_PAYPAL_IPN(){
			$this->DIR_PAYPAL_IPN	=	$this->DIR_PLUGINS.'PayPal_IPN/';
		}
		function DIR_PLUGINS(){
			$this->DIR_PLUGINS		=	$this->DIR_ASSETS.'plugins/';
		}
		function DIR_PHPMAILER(){
			$this->DIR_PHPMAILER	=	$this->DIR_PLUGINS.'PHPMailer/';
		}
		
	}