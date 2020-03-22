

	<div class="container">
	<div id="content-wrapper">
		<div id="content-title">
			CMS Diagnostics
		</div>
		<div id="content">
			<div id="tabs">
				<ul>
					<li><a href="#tabs-1">Versions</a></li>
					<li><a href="#tabs-2">Directories</a></li>
					<li><a href="#tabs-3">Skin Configuration</a></li>
				</ul>
				<div id="tabs-1">
					CMS Base Version 			= <?php echo $CMS_Version;?><br />
					CMS Configuration Version	= <?php echo $Cfg_Version;?><br />
					CMS Functions Version		= <?php echo $Fn_Version;?><br />
				</div>
				<div id="tabs-2">
					CMS Main Path				= <?php echo $CMS_Root_Path;?><br />
					CMS Init Path				= <?php echo $CMS_Init;?><br />
					CMS Content Path			= <?php echo $CMS_Content;?><br />
					CMS Pages Path				= <?php echo $CMS_Pages;?><br />
					CMS Registration Path		= <?php echo $CMS_Reg;?>
					CMS Live Support Path		= <?php echo $CMS_LiveChat;?>
				</div>
				<div id="tabs-3">
					Site Skin Path				= <?php echo $SkinPath;?><br />
					Skin Name					= <?php echo $StyleName;?><br />
					Skin Style Path				= <?php echo $SkinStyle;?><br />
					Skin Theme Path				= <?php echo $SkinTheme;?><br />
					Skin Menu Path				= <?php echo $SkinMenu;?><br />
					Skin Image Path				= <?php echo $SkinImage;?><br />
					Site FavIcon				= <?php echo $FavIcon;?><br />
				</div>
			</div>
			<?php
			echo '<div class="container">';
				echo 'Am I admin? '.$CheckUser -> ADM1();
				echo '<div>Session Info</div>';
				echo '<pre>';
					var_dump($_SESSION);
				echo '</pre>';
			echo '</div>';
			die();
			?>
		</div>
	</div></div>