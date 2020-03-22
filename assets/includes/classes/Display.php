<?php
	Class Display{
		/*function __construct(){
			#$this->launchDisplay();
		}*/
		public static function launchDisplay(){
			echo '<!DOCTYPE html>';
			echo '<html lang="en">';
			echo '<head>';
			# Load Meta Info
			self::loadMeta();
			# Load Caching
			self::loadCaching();
			# Fetch Title
			self::loadTitle();
			# Load Our SS/JS
			//Style::run();
			self::loadStylesheets();
			self::loadJavascript();
			echo '</head>';
			if(Settings::$PageZone=='Site'){
				echo '<body id="page-top" class="dark-mode">';
			}elseif(Settings::$PageZone=='ACP'){
				echo '<body id="page-top" class="acp-body">';
			}
		}
		public static function loadMeta(){
			echo '<meta charset="utf-8">';
			echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
			echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
			echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>';
			echo '<meta name="Author" content="'.Settings::$Author.'"/>';
			echo '<meta name="Copyrights" content="'.Settings::$SiteTitle.'"/>';
			echo '<meta name="Designer" content="'.Settings::$SiteTitle.'"/>';
			echo '<meta name="Description" content="'.Settings::$Description.'"/>';
			echo '<meta name="keywords" content="'.Settings::$Keywords.'">';
			echo '<meta name="Robots" content="all"/>';
			echo '<meta name="Version" content="'.Settings::$Version.'"/>';
			echo '<meta name="Webmaster" content="'.Settings::$WebMaster.'"/>';
			echo '<link rel="icon" type="image/png" href="assets/Themes/shCMS/images/icons/favicon.png">';
		}
		public static function loadCaching(){
			# Headers | Caching
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Cache-Control: no-store, no-cache, must-revalidate');
			header('Cache-Control: post-check=0, pre-check=0', FALSE);
			header('Pragma: no-cache');
		}
		public static function loadTitle(){
			echo '<title>';
				echo Settings::$SiteTitle.' | '.Settings::$PageTitle;
			echo '</title>';
		}
		public static function loadStylesheets(){
			# Bootstrap v4.2.1
			echo '<link href="'.DOC_ROOT.'/assets/includes/Addons/Bootstrap/v4.2.1/bootstrap.min.css" rel="stylesheet" type="text/css">';
			# Font Awesome
			echo '<link href="'.DOC_ROOT.'/assets/Themes/shCMS/fonts/font-awesome/v5.6.1/css/all.css" rel="stylesheet" type="text/css">';
			if(Settings::$PageZone=='Site'){
				if(Settings::$PageIndex=='pvprankings'){
					echo '<link href="'.DOC_ROOT.'/assets/Themes/shCMS/css/pvp.css" rel="stylesheet" type="text/css">';
				}
				if(Settings::$SiteTheme == 'shCMS'){
					# Google Fonts
					echo '<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300i,400,700%7cMarcellus+SC" rel="stylesheet">';
					# shCMS Theme
					echo '<link href="'.DOC_ROOT.'/assets/Themes/shCMS/css/theme.css" rel="stylesheet" type="text/css">';
					/* Theme Switcher */
					echo '<link href="'.DOC_ROOT.'/assets/Themes/shCMS/css/toggleTheme.css" rel="stylesheet" type="text/css">';
					/* Light Theme */
					echo '<link href="'.DOC_ROOT.'/assets/Themes/Light/css/style.css" rel="stylesheet" type="text/css">';
					/* Dark Theme */
					echo '<link href="'.DOC_ROOT.'/assets/Themes/Dark/css/style.css" rel="stylesheet" type="text/css">';
				}
			}elseif(Settings::$PageZone=='ACP'){
				echo '<link rel="stylesheet" href="'.DOC_ROOT.'/assets/Themes/ACP/css/sb-admin.css" type="text/css" media="all"/>';
				echo '<link rel="stylesheet" href="'.DOC_ROOT.'/assets/Themes/ACP/css/custom.css" type="text/css" media="all"/>';
				#jQuery UI
				echo '<link rel="stylesheet" href="'.DOC_ROOT.'/assets/includes/Addons/jQuery/UI/v1.12.1/themes/Dot Luv/jquery-ui-style.css" type="text/css" media="all"/>';
				# Ajax Loader
				echo '<link rel="stylesheet" href="'.DOC_ROOT.'/assets/includes/Addons/LoadLab/bt-spinner.css" type="text/css" media="all"/>';
			}
		}
		public static function loadJavascript(){
			# jQuery
			echo '<script src="'.DOC_ROOT.'/assets/includes/Addons/jQuery/v1.12.4/jquery-v1.12.4.js"></script>';
			# Popper
			echo '<script src="'.DOC_ROOT.'/assets/includes/Addons/Popper/popper.min.js"></script>';
			# Bootstrap JS
			echo '<script src="'.DOC_ROOT.'/assets/includes/Addons/Bootstrap/v4.2.1/bootstrap.min.js"></script>';
			if(Settings::$PageZone=='Site'){
				if(Settings::$SiteTheme == 'shCMS'){
					echo '<script src="'.DOC_ROOT.'/assets/Themes/shCMS/js/custom.js"></script>';
				}
			}elseif(Settings::$PageZone=='ACP'){
				echo '<script src="'.DOC_ROOT.'/assets/Themes/ACP/js/sb-admin.js"></script>';
			}
		}
		public static function load_Javascript_Addons(){
			# jQueryUI
			echo '<script src="'.DOC_ROOT.'/assets/includes/Addons/jQuery/UI/v1.12.1/js/jquery-v1.12.1.ui.js"></script>';
			# Data Tables
			echo '<script src="'.DOC_ROOT.'/assets/includes/Addons/jQuery/DataTables/datatables.js"></script>';
			# Tiny MCE
			echo '<script src="'.DOC_ROOT.'/assets/includes/Addons/jQuery/TinyMCE/v4.9.0/js/tinymce.min.js"></script>';
			echo '<script src="'.DOC_ROOT.'/assets/includes/Addons/jQuery/TinyMCE/v4.9.0/js/init.tinymce.js"></script>';
			# Tabs
			echo '<script src="'.DOC_ROOT.'/assets/includes/Addons/jQuery/Tabs/tabs.js"></script>';
			if(Settings::$PageZone=='Site'){
				if(Settings::$SiteTheme == 'shCMS'){

				}
			}
		}
	}
?>