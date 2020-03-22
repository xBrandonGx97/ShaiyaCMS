<?php
	Class ServerInfo Extends Controller{
		public function index($name	=	''){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'ServerInfo';
			Settings::$PageIndex	=	'serverinfo';
			Display::launchDisplay();
			Content::initContent();
			$this->view('serverinfo/index');
			echo '</div>';
			Content::initFooter();
		}
		public function about(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'About';
			Settings::$PageIndex	=	'serverinfo';
			Settings::$PageCat		=	'ServerInfo';
			Display::launchDisplay();
			Content::initContent();
			$this->view('serverinfo/about');
			echo '</div>';
			Content::initFooter();
		}
		public function bossrecords(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'Boss Records';
			Settings::$PageIndex	=	'bossrecords';
			Settings::$PageCat		=	'ServerInfo';
			Display::launchDisplay();
			Content::initContent();
			$this->view('serverinfo/bossrecords');
			echo '</div>';
			Content::initFooter();
		}
		public function dropfinder(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'Drop Finder';
			Settings::$PageIndex	=	'dropfinder';
			Settings::$PageCat		=	'ServerInfo';
			Display::launchDisplay();
			Content::initContent();
			$this->view('serverinfo/dropfinder');
			echo '</div>';
			Content::initFooter();
		}
		public function guildrankings(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'Guild Rankings';
			Settings::$PageIndex	=	'guildrankings';
			Settings::$PageCat		=	'ServerInfo';
			Display::launchDisplay();
			Content::initContent();
			$this->view('serverinfo/guildrankings');
			echo '</div>';
			Content::initFooter();
		}
		public function terms(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'Terms of Service';
			Settings::$PageIndex	=	'terms';
			Settings::$PageCat		=	'ServerInfo';
			Display::launchDisplay();
			Content::initContent();
			$this->view('serverinfo/terms');
			echo '</div>';
			Content::initFooter();
		}
	}
?>