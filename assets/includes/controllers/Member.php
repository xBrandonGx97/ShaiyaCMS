<?php
	Class Member Extends Controller{
		public function index(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'Member';
			Settings::$PageIndex	=	'member';
			Display::launchDisplay();
			Content::initContent();
			$this->view('member/index');
			echo '</div>';
			Content::initFooter();
		}
		public function register(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'Register';
			Settings::$PageIndex	=	'register';
			Settings::$PageCat		=	'Member';
			Display::launchDisplay();
			Content::initContent();
			$this->view('member/auth/register');
			echo '</div>';
			Content::initFooter();
		}
		public function auth(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'Auth';
			Settings::$PageIndex	=	'auth';
			Settings::$PageCat		=	'Member';
			Display::launchDisplay();
			Content::initContent();
			$this->view('member/auth/login');
			echo '</div>';
			Content::initFooter();
		}
		public function login(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'Login';
			Settings::$PageIndex	=	'login';
			Settings::$PageCat		=	'Member';
			Display::launchDisplay();
			Content::initContent();
			$this->view('member/auth/login');
			echo '</div>';
			Content::initFooter();
		}
		public function logout(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'Logout';
			Settings::$PageIndex	=	'logout';
			Settings::$PageCat		=	'Member';
			Display::launchDisplay();
			Content::initContent();
			$this->view('member/auth/logout');
			echo '</div>';
			Content::initFooter();
		}
		public function validate(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'Validate';
			Settings::$PageIndex	=	'validate';
			Settings::$PageCat		=	'Member';
			Display::launchDisplay();
			Content::initContent();
			$this->view('member/auth/validate');
			echo '</div>';
			Content::initFooter();
		}
		public function profile(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'Profile';
			Settings::$PageIndex	=	'profile';
			Settings::$PageCat		=	'Member';
			Display::launchDisplay();
			Content::initContent();
			$this->view('member/profile');
			echo '</div>';
			Content::initFooter();
		}
		public function settings(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'Settings';
			Settings::$PageIndex	=	'settings';
			Settings::$PageCat		=	'Member';
			Display::launchDisplay();
			Content::initContent();
			$this->view('member/settings');
			echo '</div>';
			Content::initFooter();
		}
		public function recoverpwd(){
			Settings::$PageZone 	= 	'Site';
			Settings::$PageTitle 	= 	'Recover Password';
			Settings::$PageIndex	=	'recoverpwd';
			Settings::$PageCat		=	'Member';
			Display::launchDisplay();
			Content::initContent();
			$this->view('member/recoverpwd');
			echo '</div>';
			Content::initFooter();
		}
	}
?>