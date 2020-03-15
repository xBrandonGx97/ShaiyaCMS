<?php
	use Jenssegers\Blade\Blade;

	class CoreController{

		// Load model
		public static function model($model){
			// Require model file
			require_once(APPROOT.'/models/'.$model.'.php');

			// Instantiate model
			return new $model();
		}
		// Load view
		public static function view($view,$data=[]){
			// Create Blade Instance
			$blade = new Blade('../app/views','cache');
			// Check for view file
			if(file_exists('../app/views/'.$view.'.blade.php')){
				echo $blade->make($view,['data'=>$data])->render();
				#require_once '../app/views/' . $view . '.php';
			}
			else{
				// View does not exist
				die('View doesn\'t exist');
			}
		}
	}
?>