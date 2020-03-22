<?php
	Class Community Extends Controller{
		public function index(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'Community';
			Settings::$PageIndex	=	'community';
			Display::launchDisplay();
			Content::initContent();
			$this->view('community/index');
			echo '</div>';
			Content::initFooter();
		}
		public function discord(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'Discord';
			Settings::$PageIndex	=	'discord';
			Settings::$PageCat		=	'Community';
			Display::launchDisplay();
			Content::initContent();
			$this->view('community/discord');
			echo '</div>';
			Content::initFooter();
		}
		public function downloads(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'Downloads';
			Settings::$PageIndex	=	'downloads';
			Settings::$PageCat		=	'Community';
			Display::launchDisplay();
			Content::initContent();
			$this->view('community/downloads');
			echo '</div>';
			Content::initFooter();
		}
		public function news(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'News';
			Settings::$PageIndex	=	'news';
			Settings::$PageCat		=	'Community';
			Display::launchDisplay();
			Content::initContent();
			$this->view('community/news');
			echo '</div>';
			Content::initFooter();
		}
		public function patchnotes(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'Patch Notes';
			Settings::$PageIndex	=	'patchnotes';
			Settings::$PageCat		=	'Community';
			Display::launchDisplay();
			Content::initContent();
			$this->view('community/patchnotes');
			echo '</div>';
			Content::initFooter();
		}
		public function pvprankings(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'PvP Rankings';
			Settings::$PageIndex	=	'pvprankings';
			Settings::$PageCat		=	'Community';
			Display::launchDisplay();
			Content::initContent();
			$this->view('community/pvprankings');
			echo '</div>';
			Content::initFooter();
		}
		public function media($subpage=false){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'Media';
			Settings::$PageIndex	=	'media';
			Settings::$PageCat		=	'Community';
			Display::launchDisplay();
			Content::initContent();
			$media	=	$this->model('Media');
			$media	->subpage	=	$subpage;
			$this->view('community/media/media',['subpage'=>$media->subpage]);
			echo '</div>';
			Content::initFooter();
		}
	}
?>