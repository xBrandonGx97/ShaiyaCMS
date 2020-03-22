<?php
	# Content
	Template::_start_mainSection();
		Template::Separator(20);
		Template::_do_pageHead("User Settings");
			if(Settings::$SiteTheme=='shCMS'){
				if(isset($_COOKIE['LightMode'])) {
				echo '<div class="form-group row">';
				echo '<label for="name" class="col-4 col-form-label">Dark/Light Mode Switcher</label>';
				echo '<div class="col-8">';
					echo '<button type="button" class="btn btn-sm btn-toggle toggletheme" id="toggletheme" data-toggle="button" aria-pressed="false" autocomplete="on" name="dark_light"  onclick="toggleDarkLight()">';
						echo '<div class="handle"></div>';
							echo '<script>var body = document.getElementById("page-top");';
								echo 'var currentClass = body.className;';
								echo 'body.className = currentClass == "dark-mode" ? "light-mode" : "dark-mode";';
							echo '</script>';
					echo '</button>';
				echo '</div>';
				}else{
					echo '<div class="form-group row">';
					echo '<label for="name" class="col-4 col-form-label">Dark/Light Mode Switcher</label>';
					echo '<div class="col-6">';
						echo '<button type="button" class="btn btn-sm btn-toggle active toggletheme" id="toggletheme" data-toggle="button" aria-pressed="true" autocomplete="on" name="dark_light"  onclick="toggleDarkLight()">';
							echo '<div class="handle"></div>';
						echo '</button>';
						echo '</div>';
					echo '</div>';
				}
			}
			/*echo '<div class="form-group row">';
				echo '<label for="name" class="col-4 col-form-label">Display Name</label>';
				echo '<div class="col-6">';
					echo '<input autocomplete="off" class="form-control tac" id="Input-DisplayName" name="DisplayName" placeholder="Desired Display Name" type="text"/>';
				echo '</div>';
			echo '</div>';*/
		Template::_do_pageFooter();
		Template::Separator(20);
	Template::_end_mainSection();
?>