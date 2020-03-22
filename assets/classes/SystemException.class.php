<?php
	set_error_handler('exception_error_handler');

	Class SystemException extends ErrorException{

		private $trace;

		public function __construct($message='',$code=0,$severity=100,$filename='',$lineno=0){
			parent::__construct($message,$code,$severity,$filename,$lineno);
		}
		public function getStacktrace(){
			$this->trace = $this->getTraceAsString();

			return preg_replace('/\n/','<br>',$this->trace);
		}
		public function __toString(){
			echo '<html>';
			echo '<head>';
			echo '<title>ERROR!</title>';
			echo '<link rel="stylesheet" type="text/css" href="assets/jquery/addons/bootstrap/v4.0.0/js/bootstrap.css" media="all">';
			echo '<link rel="stylesheet" type="text/css" href="assets/styles/Standard/css/master.css" media="all">';
			echo '</head>';
			echo '<body style="background-color:#000;">';
				echo '<div class="container text-white">';
					echo '<div class="row" style="background-color:#ff0000;">';
						echo '<div class="col-md-12 tac f_26 b_i">Fatal Error!</div>';
					echo '</div>';

					echo '<div class="row">';
						echo '<div class="col-md-12" style="background-color:#797676;">';
							echo '<div class="separator_5"></div>';
							echo '<div class="badge bg-dark w_100_p b_i f_20 tac b_i">CMS Info</div>';
							echo '<div class="table-responsive bg-black">';
								echo '<table class="table table-sm text-white">';
									echo '<tr>';
										echo '<td class="col-sm-2">PHP Version: </td>';
										echo '<td>'.PHP_VERSION.'</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td class="col-sm-2">CMS CodeName: </td>';
										echo '<td>ShaiyaCMS</td>';
									echo '<tr>';
										echo '<td class="col-sm-2">CMS Version: </td>';
										echo '<td>1.2</td>';
									echo '</tr>';
									
								echo '</table>';
							echo '</div>';
							echo '<div class="separator_10"></div>';

							echo '<div class="badge bg-dark w_100_p b_i f_20 tac b_i">Error Info</div>';
							echo '<div class="table-responsive bg-black">';
								echo '<table class="table table-sm text-white">';
									echo '<tr>';
										echo '<td class="col-sm-2">Error Date: </td>';
										echo '<td>'.Parser::do_date(time()).'</td>';
									echo '</tr>';
								if(!$this->getMessage()){}
								else{
									echo '<tr>';
										echo '<td class="col-sm-2">Error message: </td>';
										echo '<td>'.$this->getMessage().'</td>';
									echo '</tr>';
								}
								if(!$this->getFile()){}
								else{
									echo '<tr>';
										echo '<td class="col-sm-2">File: </td>';
										echo '<td>'.$this->getFile().'</td>';
									echo '</tr>';
								}
								if(!$this->getLine()){}
								else{
									echo '<tr>';
										echo '<td class="col-sm-2">Line: </td>';
										echo '<td>'.$this->getLine().'</td>';
									echo '</tr>';
								}
								if(!$this->getSeverity()){}
								else{
									echo '<tr>';
										echo '<td class="col-sm-2">Severity ID: </td>';
										echo '<td>'.$this->getSeverity().'</td>';
									echo '</tr>';
								}
								if(!isset($_SERVER['REQUEST_URI'])){}
								else{
									echo '<tr>';
										echo '<td class="col-sm-2">Request: </td>';
										echo '<td>'.($_SERVER['REQUEST_URI']).'</td>';
									echo '</tr>';
								}
								if(!isset($_SERVER['HTTP_REFERER'])){}
								else{
									echo '<tr>';
										echo '<td class="col-sm-2">Referer: </td>';
										echo '<td>'.$_SERVER['HTTP_REFERER'].'</td>';
									echo '</tr>';
								}
								echo '</table>';
							echo '</div>';
							echo '<div class="separator_5"></div>';

							echo '<div class="badge bg-dark w_100_p b_i f_20 tac b_i">Stack Trace</div>';
							echo '<div class="bg-black">';
								echo $this->getStacktrace();
							echo '</div>';
							echo '<div class="separator_5"></div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</body>';
			echo '</html>';

#			error_log("Error: [$errno] $errstr",1,"admin@ndf-innovations.net","From: support@ndf-innovations.net");
			die();
		}
		function do_SendMail($errno,$errstr){
			error_log("Error: [$errno] $errstr",1,"admin@ndf-innovations.net","From: support@ndf-innovations.net");
		}
		function Props(){
			echo "<b>Class=>Display Properties:</b> ";
			echo "<pre>";
				print_r(object_vars($this));
			echo "</pre>";
		}
	}

	function exception_error_handler($errno,$errstr,$errfile,$errline){
		throw new SystemException($errstr,0,$errno,$errfile,$errline);
	}
?>