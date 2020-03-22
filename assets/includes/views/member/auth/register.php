<?php
		# Start Template
		Template::_start_mainSection();
		Template::Separator(20);
		Template::_do_pageHead("Account Registration","Please sign up");
		$Valid = isset($_GET["Valid"]) ? Data::escData(trim($_GET["Valid"])) : false;
		if(!empty($Valid)){
			if($Valid == true){
				echo '<div class="row tac">';
					echo '<div class="col-md-12">';
						echo '<a class="badge badge-pill badge-info f_16" href="../member/auth">Log In</a>';
					echo '</div>';
				echo '</div>';
				unset($Valid);
			}
		}
		else{
			echo '<script src="https://www.google.com/recaptcha/api.js"></script>';
		echo '<form action="../member/validate" method="post" id="register" enctype="multipart/form-data">';
				echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="input-group col-md-4 col-sm-12">';
									echo '<input autocomplete="off" class="form-control tac" id="Input-UserID" name="UserID" placeholder="Desired UserID" type="text" />';
									echo '<div class="input-group-append">';
										echo '<button type="button" class="btn badge badge-warning open_verify_userid_modal" data-id="" data-target="#verify_userid_modal" data-toggle="modal">Check</button>';
									echo '</div>';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="input-group col-md-4 col-sm-12">';
									echo '<input autocomplete="off" class="form-control tac" id="Input-DisplayName" name="DisplayName" placeholder="Desired Display Name" type="text"/>';
									echo '<div class="input-group-append">';
										echo '<button type="button" class="btn badge badge-warning open_verify_displayname_modal" data-id="" data-target="#verify_displayname_modal" data-toggle="modal">Check</button>';
									echo '</div>';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo '<input autocomplete="off" class="form-control tac" id="Input-Password" name="Password" placeholder="Password" type="password" />';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo '<input autocomplete="off" class="form-control tac" id="Input-Password2" name="c_Password" placeholder="Confirm Password" type="password" />';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo '<input autocomplete="off" class="form-control tac" id="Input-Email" name="Email" placeholder="Email" type="text" />';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo '<input autocomplete="off" class="form-control tac" id="Input-DOB" name="DOB" placeholder="Date of Birth" type="text"/>';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo Select::gender();
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo '<input autocomplete="off" class="form-control tac" id="Input-Referer" name="Referer" placeholder="Referer" type="text"/>';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo Select::sec_question();
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo '<input autocomplete="off" class="form-control tac" id="Input-SecAnswer" name="SecAnswer" placeholder="Security Answer" type="text"/>';
								echo '</div>';
							echo '</div>';

							/*echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo '<div class="btn btn-sm btn-dark" style="margin-left:5px" onclick="getFile()">Browse Avatar</div>';
									echo '<div style="height: 0px;width:0px; overflow:hidden;"><input id="upfile" name="Avatar" type="file" value="upload"/></div>';
									echo '<div id="file-upload-filename"></div>';
								echo '</div>';
							echo '</div>';*/

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
									echo '<center>';
										echo '<input name="Checkbox" type="radio"/> I Agree to the <a href="./community/terms" target="_blank">'.Settings::$SiteTitle.'\'s Terms Of Use</a>';
									echo '</center>';
							echo '</div>';

							echo '<center><div class="g-recaptcha" data-sitekey="'.Settings::$sitekey.'" data-theme="dark"></div></center>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-12 tac">';
									echo '<button class="btn btn-sm btn-primary m_auto" type="submit" name="sub_reg">Create Account</button>';
								echo '</div>';
							echo '</div>';

							echo '<div class="separator_10"></div>';
							echo '</form>';
							echo '</div>';
		Modal::Display('verify_userid_modal','<i class="fa fa-pencil"></i>','0','2','Check UserID Availability');
		Modal::Display('verify_displayname_modal','<i class="fa fa-pencil"></i>','0','2','Check Display Name Availability');
		}
		# End Template
		Template::_do_pageFooter();
		Template::Separator(20);
		Template::_end_mainSection();
		echo '</div>';
?>
<script>
	$(document).ready(function(){
		$(document).on('click','.open_verify_userid_modal',function(e){
			e.preventDefault();

			$('#verify_userid_modal #dynamic-content').html('');
			$('#verify_userid_modal #modal-loader').show();

			$.ajax({
				url: "assets/includes/Addons/jQuery/AJAX/Site/Registration/verify_userid.php",
				type: 'POST',
				data: $('form#register').serialize(),
				dataType: 'html'
			})
			.done(function(data){
				$('#verify_userid_modal #dynamic-content').html('');
				$('#verify_userid_modal #dynamic-content').html(data);
				$('#verify_userid_modal #modal-loader').hide();
			})
			.fail(function(){
				$('#verify_userid_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#verify_userid_modal #modal-loader').hide();
			});
		});
		$(document).on('click','.open_verify_displayname_modal',function(e){
			e.preventDefault();

			$('#verify_displayname_modal #dynamic-content').html('');
			$('#verify_displayname_modal #modal-loader').show();

			$.ajax({
				url: "assets/includes/Addons/jQuery/AJAX//Site/Registration/verify_displayname.php",
				type: 'POST',
				data: $('form').serialize(),
				dataType: 'html'
			})
			.done(function(data){
				<?php if(Setting::$Debug === "1" || Settings::$Debug === "2"){ ?>
					console.log(data);
				<?php } ?>
				$('#verify_displayname_modal #dynamic-content').html('');
				$('#verify_displayname_modal #dynamic-content').html(data);
				$('#verify_displayname_modal #modal-loader').hide();
			})
			.fail(function(){
				$('#verify_displayname_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#verify_displayname_modal #modal-loader').hide();
			});
		});
	});
</script>