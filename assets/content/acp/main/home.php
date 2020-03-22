<?php
	if(!$this->User->LoggedIn()){
		$this->Tpl->_do_ACP_pageHeader("","",false,"12","Welcome!");
			echo '<span>Welcome '.$this->User->UserLoginStatus.', To Continue Please Log In.</span>';
		$this->Tpl->_do_ACP_pageFooter();
	}
	
	# Checks if Staff
	$this->User->AccessCheck();
	
	# Checks if Admin
	if($this->User->isAdmin()){
		# Panels
		echo '<div class="row">';
			$this->Panels->_get_newly_registered();
			$this->Panels->_get_total_accts();
			$this->Panels->_get_online_last_1();
			$this->Panels->_get_online_current();
		echo '</div>';

		# Update Checker
		echo '<div class="row">';
			echo '<div class="col-lg-12">';
				echo '<div class="table-responsive">';
					echo '<table class="table table-sm table-dark">';
						echo '<thead>';
							echo '<tr>';
								echo '<th class="col-md-4">Version Type</th>';
								echo '<th class="col-md-4">Current Version</th>';
#								echo '<th class="col-md-4">Update Status</th>';
								echo '<th></th>';
							echo '</tr>';
						echo '</thead>';
						echo '<tbody>';
							echo '<tr>';
								echo '<td>ACP Version</td>';
								echo '<td><div class="badge-info">'.$this->Setting->VERSION.'</div></td>';
#								echo '<td>'.$this->Version->ValidateVersion().'</td>';
#								echo '<td><button class="badge badge-info align-middle open_updater_modal" data-target="#updater_modal" data-toggle="modal"><i class="fa fa-gear"></i> Update Info</button></td>';
							echo '</tr>';
						echo '</tbody>';
					echo '</table>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		# Admin Panel Action Logs
		echo '<div class="row">';
			echo '<div class="col-md-6 m_t_10">';
				echo '<div id="content_card" class="card custom-card">';
					echo '<div class="card-header cstm-card-head tac">';
					echo '<i class="fas fa-clock"></i>';
						echo 'Admin Panel Action Log</div>';
							echo '<div class="card-block content_bg content pContent">';
								echo '<div class="card-text">';
								echo '<div class="table-responsive">';
									echo '<table class="table table-sm table-dark">';
										echo '<thead>';
											echo '<tr>';
												echo '<th>Action</th>';
												echo '<th>Time</th>';
											echo '</tr>';
										echo '</thead>';
									echo '<tbody>';
										$this->SQL->ActionLogs();
									echo '</tbody>';
								echo '</table>';
							echo '</div>';
						echo '</div>';
					echo '<div class="tac">';
						echo '<a class="badge badge-pill badge-primary b_i f14" href="?'.$this->Setting->PAGE_PREFIX.'=ADM_ACCSS_LOG">View All Activity</a>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
		
		# GM Command Logs
		echo '<div class="col-md-6 m_t_10">';
			echo '<div id="content_card" class="card custom-card">';
				echo '<div class="card-header cstm-card-head tac"><i class="fas fa-clock"></i>GM Command Logs</div>';
					echo '<div class="table-responsive">';
						echo '<table class="table table-sm table-dark">';
							echo '<thead>';
								echo '<tr>';
									echo '<th>CharName</th>';
									echo '<th>Command</th>';
									echo '<th>Command Result</th>';
									echo '<th>Player Affected</th>';
									echo '<th>Time</th>';
								echo '</tr>';
							echo '</thead>';
							echo '<tbody>';
								$this->SQL->GMLogs();
							echo '</tbody>';
						echo '</table>';
					echo '</div>';
				echo '</div>';
				echo '<div class="tac">';
					echo '<a class="badge badge-pill badge-primary b_i f14" href="?'.$this->Setting->PAGE_PREFIX.'=ADM_CMD_LOG">View All Activity</a>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		# New Users
		echo '<div class="row">';
			echo '<div class="col-md-12 m_t_10">';
				echo '<div id="content_card" class="card custom-card">';
					echo '<div class="card-header cstm-card-head tac">New Users</div>';
						echo '<div class="table-responsive">';
							echo '<table class="table table-sm table-dark" id="NewPlayers">';
								echo '<thead>';
									echo '<tr>';
										echo '<th>User Faction</th>';
										echo '<th>User Name</th>';
										echo '<th>Joined Date</th>';
										echo '<th>Last Online Date</th>';
										echo '<th>Account Status</th>';
										echo '<th>Donation Points</th>';
									echo '</tr>';
								echo '</thead>';
								echo '<tbody>';
								$this->SQL->NewUsers();
								echo '</tbody>';
							echo '</table>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}
	$this->Modal->Display('updater_modal','<i class="fa fa-pencil"></i>','0','2','Update Information');
?>
<script>
	$(document).ready(function(){
		$(document).on('click','.open_updater_modal',function(e){
			e.preventDefault();

			var uid = $(this).data('id');

			$('#updater_modal #dynamic-content').html('');
			$('#updater_modal #modal-loader tac').show();

			$.ajax({
				url:"AJAX/AP/Updater/updater.php",
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
				<?php if($this->Setting->DEBUG === "1"){ ?>
					console.log(data);
				<?php } ?>
				$('#updater_modal #dynamic-content').html('');
				$('#updater_modal #dynamic-content').html(data);
				$('#updater_modal #modal-loader').hide();
			})
			.fail(function(){
				$('#updater_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#updater_modal #modal-loader').hide();
			});
		});
		$('#NewPlayers').dataTable( {
			   "searching": false,
			   "info": false,
			   "bLengthChange": false	
         } );
	});
</script>