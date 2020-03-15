<?php
    define('AJAX_CALL',true);
    // Start our session
    session_name("Default");
    session_start();
	ob_start();
	setcookie("Default",session_id(),0,"/",null,null,true);

    # Autoloader
	require_once($_SERVER['DOCUMENT_ROOT']."/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	
	use \Classes\Utils\Select;
?>
<script src="https://www.google.com/recaptcha/api.js"></script>
<form class="registration">
	<div class="form-group row">
		<label for="Input-Value" class="col-sm-4 col-form-label tar">Display Name</label>
		<div class="col-sm-8">
			<div class="input-group">
				<input class="form-control" name="DisplayName" placeholder="Display Name" type="text"/>
                <span class="input-group-append">
                    <button type="button" class="nk-btn nk-btn-xs nk-btn-rounded nk-btn-outline nk-btn-color-main-1 open_verify_displayname_modal" data-target="#verify_displayname_modal" data-toggle="modal">Check Display Name</button>
                </span>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label for="Input-Value" class="col-sm-4 col-form-label tar">User Name</label>
		<div class="col-sm-8">
			<div class="input-group">
				<input class="form-control" name="UserName" placeholder="User Name" type="text"/>
                <span class="input-group-append">
                    <button class="nk-btn nk-btn-xs nk-btn-rounded nk-btn-outline nk-btn-color-main-1" type="button">Check User Name</button>
                </span>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label for="Input-Value" class="col-sm-4 col-form-label tar">Password</label>
		<div class="col-sm-8">
			<div class="input-group">
				<input class="form-control" id="password" name="Password" placeholder="Password" type="password"/>
                <span class="input-group-append">
                    <span class="input-group-text bg-transparent border-0">
                        <a href="#" class="password_visibility"><i class="far fa-eye-slash" id="password_icon"></i></a>
                    </span>
                </span>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label for="Input-Value" class="col-sm-4 col-form-label tar">Confirm Password</label>
		<div class="col-sm-8">
			<div class="input-group">
				<input class="form-control" id="password2" name="cPassword" placeholder="Confirm Password" type="password"/>
                <span class="input-group-append">
                     <span class="input-group-text bg-transparent border-0">
                         <a href="#" class="password_visibility"><i class="far fa-eye-slash" id="password_icon2"></i></a>
                     </span>
                </span>
			</div>
		</div>
	</div>
    <div class="form-group row">
		<label for="Input-Value" class="col-sm-4 col-form-label tar">Pin</label>
		<div class="col-sm-8">
			<div class="input-group">
				<input class="form-control" name="Pin" placeholder="Pin" type="password" minlength="4" maxlength="6"/>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label for="Input-Value" class="col-sm-4 col-form-label tar">Email</label>
		<div class="col-sm-8">
			<div class="input-group">
				<input class="form-control" name="email" placeholder="Email" type="email"/>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label for="Input-Value" class="col-sm-4 col-form-label tar">Security Question</label>
		<div class="col-sm-8">
			<div class="input-group">
			    <?php echo Select::sec_question(); ?>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label for="Input-Value" class="col-sm-4 col-form-label tar">Security Answer</label>
		<div class="col-sm-8">
			<div class="input-group">
				<input class="form-control" name="SecAnswer" placeholder="Security Answer" type="text"/>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-8">
			<div class="input-group">
				<p class="text-center"><input name="Terms" type="radio"/>
					<a href="./terms" target="_blank"> I Agree to the <?php echo $_SESSION['Settings']['SITE_TITLE']; ?>'s Terms of Use.</a>
				</p>
			</div>
		</div>
	</div>
	<center><div class="g-recaptcha" data-sitekey="<?php echo $_SESSION['Settings']['RECAPTCHA_SITE_KEY']; ?>" data-theme="dark"></div></center>
	<input type="hidden" name="doReg" value="true"/>
	<p class="text-center"><button type="button" class="nk-btn nk-btn-xs nk-btn-rounded nk-btn-outline nk-btn-color-main-1" id="registration" name="doReg">Create Account</button></p>
</form>
<?php
    Display('verify_displayname_modal','<i class="fa fa-pencil"></i>','0','2','Check Display Name Availability');
?>
<script>
	$(document).ready(function(){
		$("button#registration").click(function(){
			$.ajax({
				type: "POST",
				url: "/resources/jquery/addons/ajax/site/auth/register.submit.php",
				data: $('form.registration').serialize(),
				success: function(message){
					$('#register_form_modal #dynamic-content').html(message);
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>