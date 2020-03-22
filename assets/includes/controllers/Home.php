<?php
	Class Home Extends Controller{
		public function index($name	=	''){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'Home';
			Settings::$PageIndex	=	'home';
			Display::launchDisplay();
			Content::initContent();
			$this->view('home/index');
			echo '</div>';
			Content::initFooter();
		}
	}
?>