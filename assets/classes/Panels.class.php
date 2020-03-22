<?php
	class Panels{
		
		protected $err_msg='<h4 class="b_i f_22">No data available for display..</h4>';

		# Panels Usage:
		# _get_<panel_name>(_panel_size_){}

		function __construct($db){
			$this->db		=	$db;
		}
		function _get_newly_registered(){
			$display = false;

			$this->sql = ("
											SELECT COUNT(*) AS 'Login'
											FROM ".$this->db->get_TABLE('SH_USERDATA')."
											WHERE [JoinDate] >= DATEADD(day, -14, GETDATE())
			");
			$this->stmt = $this->db->conn->prepare($this->sql);
			$this->stmt->execute();

			try{
				while($data=$this->stmt->fetch()){
					$display='<h4 class="b_i f_22">'.$data["Login"].'</h4>';
				}
				echo '<div class="col-xl-3 col-sm-6 mb-3">';
              echo '<div class="card text-white bg-primary o-hidden h-100">';
                echo '<div class="card-body">';
                  echo '<div class="card-body-icon">';
                    echo '<i class="fas fa-fw fa-user-plus"></i>';
                  echo '</div>';
									echo '<div class="mr-5">Newly Registered (Last 14D)</div>';
								if($display){echo $display;}
								else{echo $this->err_msg;}
								echo '</div>';
              echo '</div>';
			echo '</div>';
			}catch (PDOException $e) {
				
			}
		}
		function _get_total_accts(){
			$display	=	false;

			$this->sql = ("
											SELECT COUNT(*) AS cnt
											FROM ".$this->db->get_TABLE("SH_USERDATA")."
			");
			$this->stmt = $this->db->conn->prepare($this->sql);
			$this->stmt->execute();

			try{
				while($data=$this->stmt->fetch()){
					$display='<h4 class="b_i f_22">'.$data['cnt'].'</h4>';
				}
				echo '<div class="col-xl-3 col-sm-6 mb-3">';
              echo '<div class="card text-white bg-primary o-hidden h-100">';
                echo '<div class="card-body">';
                  echo '<div class="card-body-icon">';
                    echo '<i class="fas fa-fw fa-search-plus"></i>';
                  echo '</div>';
									echo '<div class="mr-5">Total Accounts</div>';
								if($display){echo $display;}
								else{echo $this->err_msg;}
								echo '</div>';
              echo '</div>';
			echo '</div>';
			}catch (PDOException $e) {
				
			}
		}
		function _get_online_last_1(){
			$display	=	false;

			$this->sql = ("
											SELECT COUNT(*) AS 'Login'
											FROM ".$this->db->get_TABLE('SH_USERLOGIN')."
											WHERE LogoutTime >= DATEADD(day, -1, GETDATE())
			");
			$this->stmt = $this->db->conn->prepare($this->sql);
			$this->stmt->execute();

			try{
				while($data=$this->stmt->fetch()){
					$display='<h4 class="b_i f_22">'.$data["Login"].'</h4>';
				}
				echo '<div class="col-xl-3 col-sm-6 mb-3">';
              echo '<div class="card text-white bg-primary o-hidden h-100">';
                echo '<div class="card-body">';
                  echo '<div class="card-body-icon">';
                    echo '<i class="fas fa-fw fa-globe-americas"></i>';
                  echo '</div>';
									echo '<div class="mr-5">Online (Last 24 Hours)</div>';
								if($display){echo $display;}
								else{echo $this->err_msg;}
								echo '</div>';
              echo '</div>';
			echo '</div>';
			}catch (PDOException $e) {
				
			}
		}
		function _get_online_last_7(){
			$display	=	false;

			$this->sql = ("
											SELECT COUNT(*) AS 'Login'
											FROM ".$this->db->get_TABLE('SH_USERLOGIN')."
											WHERE LogoutTime >= DATEADD(day, -7, GETDATE())
			");
			$this->stmt = $this->db->conn->prepare($this->sql);
			$this->stmt->execute();

			try{
				while($data=$this->stmt->fetch()){
					$display='<h4 class="b_i f_22">'.$data["Login"].'</h4>';
				}
				echo '<div class="col-xl-3 col-sm-6 mb-3">';
              echo '<div class="card text-white bg-primary o-hidden h-100">';
                echo '<div class="card-body">';
                  echo '<div class="card-body-icon">';
                    echo '<i class="fas fa-fw globe-americas"></i>';
                  echo '</div>';
									echo '<div class="mr-5">Online (Last 7 Days)</div>';
								if($display){echo $display;}
								else{echo $this->err_msg;}
								echo '</div>';
              echo '</div>';
			echo '</div>';
			}catch (PDOException $e) {
				
			}
		}
		function _get_online_last_14(){
			$display	=	false;

			$this->sql = ("
											SELECT COUNT(*) AS 'Login'
											FROM ".$this->db->get_TABLE('SH_USERLOGIN')."
											WHERE LogoutTime >= DATEADD(day, -1, GETDATE())
			");
			$this->stmt = $this->db->conn->prepare($this->sql);
			$this->stmt->execute();

			try{
				while($data=$this->stmt->fetch()){
					$display='<h4 class="b_i f_22">'.$data["Login"].'</h4>';
				}
				echo '<div class="col-xl-3 col-sm-6 mb-3">';
              echo '<div class="card text-white bg-primary o-hidden h-100">';
                echo '<div class="card-body">';
                  echo '<div class="card-body-icon">';
                    echo '<i class="fas fa-fw fa-globe-americas"></i>';
                  echo '</div>';
									echo '<div class="mr-5">Online (Last 14 Days)</div>';
								if($display){echo $display;}
								else{echo $this->err_msg;}
								echo '</div>';
              echo '</div>';
			echo '</div>';
			}catch (PDOException $e) {
				
			}
		}
		function _get_online_last_30(){
			$display	=	false;

			$this->sql = ("
											SELECT COUNT(*) AS 'Login'
											FROM ".$this->db->get_TABLE('SH_USERLOGIN')."
											WHERE LogoutTime>=DATEADD(day,-30,GETDATE())
			");
			$this->stmt = $this->db->conn->prepare($this->sql);
			$this->stmt->execute();

			try{
				while($data=$this->stmt->fetch()){
					$display='<h4 class="b_i f_22">'.$data["Login"].'</h4>';
				}
				echo '<div class="col-xl-3 col-sm-6 mb-3">';
              echo '<div class="card text-white bg-primary o-hidden h-100">';
                echo '<div class="card-body">';
                  echo '<div class="card-body-icon">';
                    echo '<i class="fas fa-fw globe-americas"></i>';
                  echo '</div>';
									echo '<div class="mr-5">Online (Last 30 Days)</div>';
								if($display){echo $display;}
								else{echo $this->err_msg;}
								echo '</div>';
              echo '</div>';
			echo '</div>';
			}catch (PDOException $e) {
				
			}
		}
		function _get_online_current(){
			$display	=	false;

			$this->sql = ("
											SELECT COUNT(*) AS 'Login'
											FROM ".$this->db->get_TABLE('SH_CHARDATA')."
											WHERE [LoginStatus]=?
			");
			$this->stmt = $this->db->conn->prepare($this->sql);
			$this->params = array(1);
			$this->stmt->execute($this->params);

			try{
				while($data=$this->stmt->fetch()){
					$display='<h4 class="b_i f_22">'.$data["Login"].'</h4>';
				}
				echo '<div class="col-xl-3 col-sm-6 mb-3">';
              echo '<div class="card text-white bg-primary o-hidden h-100">';
                echo '<div class="card-body">';
                  echo '<div class="card-body-icon">';
                    echo '<i class="fas fa-fw fa-globe"></i>';
                  echo '</div>';
									echo '<div class="mr-5">Online (Live)</div>';
								if($display){echo $display;}
								else{echo $this->err_msg;}
								echo '</div>';
              echo '</div>';
			echo '</div>';
			}catch (PDOException $e) {

			}
	}
}