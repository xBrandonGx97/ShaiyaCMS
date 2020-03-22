<?php
	Class Controller{
		public function model($model){
			require_once('assets/includes/models/'.$model.'.php');
			return new $model();
		}
		public function view($view,$data=[]){
			require_once('assets/includes/views/'.$view.'.php');
		}
	}
?>