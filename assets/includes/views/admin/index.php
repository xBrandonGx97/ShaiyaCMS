<?php
	# Check if User Logged In
	if(!User::LoggedIn()){
		Template::doACP_Head("","",false,"12","Welcome!");
			echo '<span>Welcome '.User::$UserLoginStatus.', To Continue Please Log In.</span>';
		Template::doACP_Foot();
	}
	# Checks if Staff
	User::AccessCheck();

	# Checks if Admin
	if(User::isAdmin()){
		# Panels
		echo '<div class="row">';
			Panels::_get_newly_registered();
			Panels::_get_total_accts();
			Panels::_get_online_last_1();
			Panels::_get_online_current();
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
										Panels::ActionLogs();
									echo '</tbody>';
								echo '</table>';
							echo '</div>';
						echo '</div>';
					echo '<div class="tac">';
						echo '<a class="badge badge-pill badge-primary b_i f14" href="/acp-access-logs">View All Activity</a>';
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
								Panels::GMLogs();
							echo '</tbody>';
						echo '</table>';
					echo '</div>';
				echo '</div>';
				echo '<div class="tac">';
					echo '<a class="badge badge-pill badge-primary b_i f14" href="/gm-cmd-logs">View All Activity</a>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		Template::Separator(10);

		# New Users
		echo '<div class="row">';
			echo '<div class="col-md-12 m_t_10">';
				echo '<div id="content_card" class="card custom-card">';
					echo '<div class="card-header cstm-card-head tac">New Users</div>';
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
							Panels::NewUsers();
							echo '</tbody>';
						echo '</table>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}
?>
<script>
	$(document).ready(function(){
		$('#NewPlayers').dataTable( {
			   "searching": false,
			   "info": false,
			   "bLengthChange": false
         } );
	});
</script>