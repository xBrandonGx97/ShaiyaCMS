<?php
    class Downloads{
        function __construct($Setting,$Tpl){
			$this->Setting	=	$Setting;
			$this->Tpl	=	$Tpl;
		}
        function _get_Downloads(){
            echo '<p>Thank you for choosing to download Server Name. Please note that by downloading our server you agree to our <a href="?'.$this->Setting->PAGE_PREFIX.'=TERMS" class="terms">Terms of Service</a>.</p>';
			echo '<div class="table-responsive">';
				echo '<table class="table-dark table-striped table-bordered table-sm container">';
					echo '<thead>';
						echo '<tr>';
							echo '<th>MEGA</th>';
							echo '<th>Google Drive</th>';
						echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
						echo '<tr>';
							echo '<th><button onclick="window.open(\'https://mega.nz/#!PvgWkChQ!x0FWYuRsy6okkkcgpoTBSPi67AhPnoA0sRR30YGLgbA\')" class="btn btn-sm btn-dark m_auto"><img src="assets/Themes/Standard/images/icons/mega-logo.png" width="30"> Mega</button></th>';
							echo '<th><button onclick="window.open(\'https://drive.google.com/open?id=1qTFeiJfvhpkuQFqmunXr9MSIHP9ncgDS\')" class="btn btn-sm btn-dark m_auto"><img src="assets/Themes/Standard/images/icons/Google-Drive-Icon.png" width="30">Google Drive</a></button></th>';
						echo '</tr>';
					echo '</tbody>';
					echo '<tfoot>';
						echo '<tr>';
							echo '<th>Last Updated on: </th>';
							echo '<th>Last Updated on: </th>';
						echo '</tr>';
					echo '</tfoot>';
				echo '</table>';
			echo '</div>';
			$this->Tpl->Separator(20);
        }
        function _get_Patch(){
            echo '<div class="table-responsive">';
				echo '<table class="table-dark table-striped table-bordered table-sm container">';
					echo '<thead>';
						echo '<tr>';
							echo '<th>Game.exe Patch</th>';
							echo '<th>Updater.exe Patch</th>';
						echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
						echo '<tr>';
							echo '<th><button onclick="window.open(\'#\')" class="btn btn-small btn-dark m_auto">Game.exe</button></th>';
							echo '<th><button onclick="window.open(\'#\')" class="btn btn-small btn-dark m_auto">Updater.exe</button></th>';
						echo '</tr>';
					echo '</tbody>';
					echo '<tfoot>';
						echo '<tr>';
							echo '<th>Last Updated on: </th>';
							echo '<th>Last Updated on: </th>';
						echo '</tr>';
					echo '</tfoot>';
				echo '</table>';
			echo '</div>';
				echo '<hr>';
        }
        function _get_sysRequirements(){
            echo '<h5 class="display-5">System requirements</h5>';
					echo '<div class="table-responsive">';
        				echo '<table class="table table-striped table-dark">';
            				echo '<thead>';
                				echo '<tr>';
                    				echo '<th>Category</th>';
                    				echo '<th>Minimum</th>';
                    				echo '<th>Recommended</th>';
                				echo '</tr>';
            				echo '</thead>';
            				echo '<tbody>';
               					echo '<tr>';
                    				echo '<th>Processor</th>';
                    				echo '<th>Pentium 4 1.5GHz</th>';
                    				echo '<th>i3 8100 3.6GHZ or higher</th>';
                				echo '</tr>';
                				echo '<tr>';
                    				echo '<th>Memory</th>';
                    				echo '<th>2 GB</th>';
                    				echo '<th>4 GB or higher</th>';
                				echo '</tr>';
                				echo '<tr>';
									echo '<th>Video</th>';
									echo '<th>3D graphics processor of minimum 256 MB</th>';
									echo '<th>3D graphics processor of minimum 1GB</th>';
                				echo '</tr>';
								echo '<tr>';
									echo '<th>DirectX</th>';
									echo '<th>9c</th>';
									echo '<th>9c</th>';
								echo '</tr>';
								echo '<tr>';
									echo '<th>Operating System</th>';
									echo '<th>Windows XP</th>';
									echo '<th>Windows Vista / 7 / 8 / 8.1 / 10</th>';
								echo '</tr>';
								echo '<tr>';
									echo '<th>Hard Drive Space</th>';
									echo '<th>10GB</th>';
									echo '<th>50GB</th>';
								echo '</tr>';
								echo '<tr>';
									echo '<th>Internet connection</th>';
									echo '<th>Yes</th>';
									echo '<th>Yes</th>';
								echo '</tr>';
							echo '</tbody>';
						echo '</table>';
					echo '</div>';
        }
        function _drivers(){
            echo '<h5 class="display-5">Are your drivers up to date?</h5>';
			echo '<h8 class="display-8">We want you to get the most out of your gaming experience. If you haven\'t recently updated your Graphic Card Drivers please download and install the newest versions before you start gaming.</h8>';
			$this->Tpl->Separator(20);
			echo '<a href="https://www.nvidia.com/Download/index.aspx"><img class="img-fluid" src="assets/Themes/Standard/images/drivers/nvidia.png" width="150" height="150"></a>';
			echo '<a href="http://support.amd.com/us/gpudownload/Pages/index.aspx"><img class="img-fluid" src="assets/Themes/Standard/images/drivers/amd-ryzen.png" width="150" height="150"></a>';
        }
    }
?>