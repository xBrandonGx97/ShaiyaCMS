<?php
	namespace Classes\Utils;
	if(!defined('IN_CMS')){die('<b>'.__NAMESPACE__.'\DTime</b>: unauthorized access detected, exiting...');}

	class DTime{

		private $ctime;
		private $input;
		public $output;

		public function __construct(){
			$this->_curr_time();
		}
		public function _class_info($level=false){
			switch($level){
				case 1	:	return $this->_Props($level);	break;
				case 2	:	return $this->_Mthds($level);	break;
			}
		}
		private function _curr_time(){
			$this->ctime=time();
		}
		public function _time($time=false,$limiter=false){
			if(empty($time)){
				$this->input=$this->ctime;
				$limiter='0';
			}
			else{
				$this->input=$time;
			}

			switch($limiter){
				case '0' : return $this->_time_to_datetime();break;
				case '1' : return $this->_time_to_seconds();break;
			}

			return $this->output;
		}
		public function _time_to_datetime(){
			$this->_time_to_seconds();
			$this->output=date('Y-m-d H:i:s',$this->output);
		}
		public function _time_to_seconds(){
			$this->output=$this->input/1000;
		}
		# Debugging
		public function _Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit();
		}
		public function _Mthds(){
			$class_methods	=	get_class_methods($this);
			echo '<div class="col-md-12">';
				echo '<b>Class ('.get_class($this).') Methods:</b> <br>';
				echo '<pre>';
				foreach($class_methods as $method_name){
					echo $method_name.'<br>';
				}
				echo '</pre>';
			echo '</div>';
			exit();
		}
	}