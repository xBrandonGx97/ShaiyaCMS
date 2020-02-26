<?php
	use smmoosavi\util\gettext\L10n;
	use Compiler\Compiler;
	class Bootstrap{
		protected static $debug=false;

		public static function run(){
			# Load Vendor autoloader for Vendor resources
			require(dirname(__DIR__) . '/vendor/autoload.php');

			self::init();
			self::autoload();
		}
		private static function init(){
			# Define misc helpers
			define("DS",DIRECTORY_SEPARATOR);
			define('SEPARATOR','\\');
			# Define path constants
			if(defined('AJAX_CALL')){
				define("ROOT_PATH",$_SERVER['DOCUMENT_ROOT']);
			}
			else{
				define("ROOT_PATH",getcwd().DS);
			}
			define("APP_PATH",ROOT_PATH."../app".DS);
			define("CLASSES_PATH",APP_PATH."classes".DS);
			define("FRAMEWORK_PATH",ROOT_PATH."../framework".DS);
			define("PUBLIC_PATH","Public".DS);
			define("CONFIG_PATH",APP_PATH."config".DS);
			define("CONTROLLER_PATH",APP_PATH."controllers".DS);
			define("MODELS_PATH",APP_PATH."models".DS);
			define("VIEWS_PATH",APP_PATH."views".DS);
			define("CORE_PATH",FRAMEWORK_PATH."Core".DS);
			define('DB_PATH',FRAMEWORK_PATH."database".DS);
			define("LIB_PATH",FRAMEWORK_PATH."Libraries".DS);
			define("HELPER_PATH",FRAMEWORK_PATH."Helpers".DS);
			define("UPLOAD_PATH",PUBLIC_PATH."uploads".DS);
			if(!defined('AJAX_CALL')){
				# Load core classes
				require(CORE_PATH."loader.class.php");
				# Load configuration file
				$GLOBALS['config']=include(CONFIG_PATH."config.php");
			}
			# Start session
		#	session_start();
		}
		private static function autoload(){
			spl_autoload_register(array(__CLASS__,'load'));
		}
		private static function load($classname){
			$classFile		=	$classname.'.class.php';
			$classPath		=	'';

			if(self::$debug){echo '===> '.__METHOD__.': classname('.$classname.') (Line: '.__LINE__.')<br>';}
			if(substr($classname,-10)=="Controller"){
				if(is_file(CONTROLLER_PATH.$classFile)){
					if(self::$debug){echo $classFile.' exists.. (Line: '.__LINE__.')<br>';}else{}
					$classPath=CONTROLLER_PATH;
				}
				elseif(is_file(CORE_PATH.$classFile)){
					if(self::$debug){echo $classFile.' exists.. (Line: '.__LINE__.')<br>';}
					$classPath=CORE_PATH;
				}
			}
			elseif(substr($classname,-5)=="Model"){
				if(is_file(MODEL_PATH.$classFile)){
					if(self::$debug){echo $classFile.' exists.. (Line: '.__LINE__.')<br>';}
					$classPath=MODEL_PATH;
				}
			}
			else{
				$classDir=self::getNamespace($classname);
				$classFile=self::getClassname($classname).'.class.php';
				if(self::$debug){
					echo 'classDir: '.$classDir.'<br>';
					echo 'classFile: '.$classFile.'<br>';
					echo 'Class Path: '.APP_PATH.$classDir.DS.$classFile.' (Line: '.__LINE__.')<br>';
				}

				if(is_file(APP_PATH.$classDir.DS.$classFile)){
					if(self::$debug){
						echo $classFile.' exists.. (Line: '.__LINE__.')<br>';
					}
					$classPath=APP_PATH.$classDir.DS;
				}
			}

			if(!$classPath==''){
			#	echo 'ClassPath: '.$classPath.'<br>';
			#	echo 'ClassFile: '.$classFile.'<br>';

				require_once($classPath.$classFile);
				if(self::$debug){echo 'Class '.$classFile.' loaded.. (Line: '.__LINE__.')<br><br>';}
			}
			else{
				echo $classFile.' does not exist.. (Line: '.__LINE__.')<br>';
			}
/*
			if(self::$debug){
				$namespaces=array();

				foreach(get_declared_classes() as $name) {
					if(preg_match_all("@[^\\\]+(?=\\\)@iU", $name, $matches)) {
						$matches = $matches[0];
						$parent =&$namespaces;
						while(count($matches)) {
							$match = array_shift($matches);
							if(!isset($parent[$match]) && count($matches))
								$parent[$match] = array();
							$parent =&$parent[$match];
						}
					}
				}

				print_r($namespaces);
			}
*/
		}
		private static function getNamespace($path){
			$parts=explode(SEPARATOR,$path);
			array_pop($parts);
			return implode(SEPARATOR,$parts);
		}
		private static function getClassname($path){
			$parts=explode(SEPARATOR,$path);
			return array_pop($parts);
		}
		public static function dispatch(){
			# Init Session
			Classes\Utils\Session::init('Default');
			# Load Helpers
			Core\Loader::helper('modal');
			Core\Loader::helper('template');
			Core\Loader::helper('url');
			# Init
			require_once('init.php');
			# Load Langs
			self::load_langs();
			# Load Route
			require_once(CORE_PATH.'route.class.php');
			Core\Route::run();
			# Load Routes
			require_once(LIB_PATH.'routes.class.php');
			Core\Route::checkRoute();
		}
		public static function _is_ajax(){
			if(defined('AJAX_CALL')){
				# Define Security
				define('IN_CMS',true);
				self::run();
				
				// Load Config
				require_once 'config/config.php';

				// Load Helpers
				foreach(scandir(FWROOT.'/Helpers/') as $filename){
					$path=FWROOT.'/Helpers/'.$filename;
					if(is_file($path)){
						require_once $path;
					}
				}
			}
		}
		public static function load_langs(){
			$compiler = new Compiler();
			$compiler->compile(dirname(__DIR__).'/app/locale/'.LANG.'/LC_MESSAGES/messages.po');
			require_once("libraries/translate.php");
		}
	}
?>