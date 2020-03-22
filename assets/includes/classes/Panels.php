<?php
	class Panels{

		public static $err_msg='<h4 class="b_i f_22">No data available for display..</h4>';

		# Panels Usage:
		# _get_<panel_name>(_panel_size_){}
		public static function _get_newly_registered(){
			$display = false;

			$sql = ("
											SELECT COUNT(*) AS 'Login'
											FROM ".Database::getTable('SH_USERDATA')."
											WHERE [JoinDate] >= DATEADD(day, -14, GETDATE())
			");
			$stmt = Database::connect()->prepare($sql);
			$stmt->execute();

			try{
				while($data=$stmt->fetch()){
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
								else{echo self::$err_msg;}
								echo '</div>';
              echo '</div>';
			echo '</div>';
			}catch (PDOException $e) {

			}
		}
		public static function _get_total_accts(){
			$display	=	false;

			$sql = ("
											SELECT COUNT(*) AS cnt
											FROM ".Database::getTable("SH_USERDATA")."
			");
			$stmt = Database::connect()->prepare($sql);
			$stmt->execute();

			try{
				while($data=$stmt->fetch()){
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
								else{echo self::$err_msg;}
								echo '</div>';
              echo '</div>';
			echo '</div>';
			}catch (PDOException $e) {

			}
		}
		public static function _get_online_last_1(){
			$display	=	false;

			$sql = ("
											SELECT COUNT(*) AS 'Login'
											FROM ".Database::getTable('SH_USERLOGIN')."
											WHERE LogoutTime >= DATEADD(day, -1, GETDATE())
			");
			$stmt = Database::connect()->prepare($sql);
			$stmt->execute();

			try{
				while($data=$stmt->fetch()){
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
								else{echo self::$err_msg;}
								echo '</div>';
              echo '</div>';
			echo '</div>';
			}catch (PDOException $e) {

			}
		}
		public static function _get_online_last_7(){
			$display	=	false;

			$sql = ("
											SELECT COUNT(*) AS 'Login'
											FROM ".Database::getTable('SH_USERLOGIN')."
											WHERE LogoutTime >= DATEADD(day, -7, GETDATE())
			");
			$stmt = Database::connect()->prepare($sql);
			$stmt->execute();

			try{
				while($data=$stmt->fetch()){
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
								else{echo self::$err_msg;}
								echo '</div>';
              echo '</div>';
			echo '</div>';
			}catch (PDOException $e) {

			}
		}
		public static function _get_online_last_14(){
			$display	=	false;

			$sql = ("
											SELECT COUNT(*) AS 'Login'
											FROM ".Database::getTable('SH_USERLOGIN')."
											WHERE LogoutTime >= DATEADD(day, -1, GETDATE())
			");
			$stmt = Database::connect()->prepare($sql);
			$stmt->execute();

			try{
				while($data=$stmt->fetch()){
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
								else{echo self::$err_msg;}
								echo '</div>';
              echo '</div>';
			echo '</div>';
			}catch (PDOException $e) {

			}
		}
		public static function _get_online_last_30(){
			$display	=	false;

			$sql = ("
											SELECT COUNT(*) AS 'Login'
											FROM ".Database::getTable('SH_USERLOGIN')."
											WHERE LogoutTime>=DATEADD(day,-30,GETDATE())
			");
			$stmt = Database::connect()->prepare($sql);
			$stmt->execute();

			try{
				while($data=$stmt->fetch()){
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
								else{echo self::$err_msg;}
								echo '</div>';
              echo '</div>';
			echo '</div>';
			}catch (PDOException $e) {

			}
		}
		public static function _get_online_current(){
			$display	=	false;

			$sql = ("
											SELECT COUNT(*) AS 'Login'
											FROM ".Database::getTable('SH_CHARDATA')."
											WHERE [LoginStatus]=?
			");
			$stmt = Database::connect()->prepare($sql);
			$params = array(1);
			$stmt->execute($params);

			try{
				while($data=$stmt->fetch()){
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
					else{echo self::$err_msg;}
				echo '</div>';
              echo '</div>';
			echo '</div>';
			}
			catch (PDOException $e) {

			}
		}
		public static function ActionLogs(){
			$display	=	false;

			$sql = ('
							SELECT TOP 8 *
							FROM '.Database::getTable("LOG_ACCESS").'
							ORDER BY ActionTime DESC
			');
			$stmt = Database::connect()->prepare($sql);
			$stmt->execute();

			while($data=$stmt->fetch()){
				$display='<a href="javascript:;"><td>'.$data["UserID"].' '.$data["Action"].'</td><td><span class="badge badge-pill badge-secondary">'.Data::getDateDiff($data['ActionTime']).'</span></td>';
				if($display){
				echo '<tr>';
					echo $display;
				echo '</tr>';
				}
				else{
					echo self::$err_msg;
				}
			}
		}
		public static function GMLogs(){
			$display	=	false;

			$sql = ('
							SELECT TOP 7 *
							FROM '.Database::getTable("LOG_GM_COMMANDS").'
							ORDER BY ActionTime DESC
			');
			$stmt = Database::connect()->prepare($sql);
			$stmt->execute();

			while($data=$stmt->fetch()){
				$display='<a href="javascript:;"><td>'.$data["CharName"].'</td> <td>'.$data["Command"].'</td> <td>'.$data["CommandResult"].'</td> <td>'.$data["PlayerAffected"].'</td><td><span class="badge badge-pill badge-secondary">'.date('F d, Y', strtotime($data['ActionTime'])).'</span></td>';
				if($display){
				echo ' <tr>';
					echo $display;
				echo '</tr>';
				}
				else{
					echo self::$err_msg;
				}
			}
		}
		public static function NewUsers(){
			$display	=	false;

			$sql = ('
							SELECT TOP 200 [UM].[UserUID],[UM].[UserID],[UM].[Email],[C].[CharName],[C].[Faction],[UM].[Point],[UM].[JoinDate],[ULS].[LogOutTime],[UM].[Status],[C].[CharID],[C].[Level],[ULS].[LogoutTime]
							FROM '.Database::getTable("SH_CHARDATA").' AS [C]
							INNER JOIN '.Database::getTable("SH_USERDATA").' AS [UM] ON [C].[UserUID] = [UM].[UserUID]
							INNER JOIN '.Database::getTable("SH_USERLOGIN").' AS [ULS] ON [C].[UserUID] = [ULS].[UserUID]
							ORDER BY [UM].[JoinDate] DESC
			');
			$stmt = Database::connect()->prepare($sql);
			$stmt->execute();

			while($data=$stmt->fetch()){
				$newdate = date('F d, Y', strtotime($data['JoinDate']));
				$newondate = date('F d, Y', strtotime($data['LogOutTime']));
				$display='<td>'.User::get_Faction($data['Faction']).'</td><td>'.$data['UserID'].'</td><td>'.$newdate.'</td><td>'.$newondate.'</td><td>'.User::get_Status($data['Status']).'</td><td>'.$data['Point'].'</td>';

				if($display){
					echo '<tr>';
						echo $display;
					echo '</tr>';
				}
				else{
					echo self::$err_msg;
				}
			}
		}
	}