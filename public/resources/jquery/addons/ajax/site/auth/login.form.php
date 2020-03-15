<form class="login">
    <div class="form-group row">
        <label for="Input-Value" class="col-sm-4 col-form-label tar">LoginID</label>
        <div class="col-sm-8">
            <div class="input-group">
                <input class="form-control" name="UserName" placeholder="Username or Email" type="text"/>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="Input-Value" class="col-sm-4 col-form-label tar">Password</label>
        <div class="col-sm-8">
            <div class="input-group">
                <input class="form-control" id="password3" name="Password" placeholder="Password" type="password"/>
                <span class="input-group-append">
                    <span class="input-group-text bg-transparent border-0">
                        <a href="#" class="password_visibility"><i class="far fa-eye-slash" id="password_icon3"></i></a>
                    </span>
                </span>
            </div>
        </div>
    </div>
    <input type="hidden" name="doLogin" value="true"/>
    <p class="text-center"><button type="button" class="nk-btn nk-btn-xs nk-btn-rounded nk-btn-outline nk-btn-color-main-1" id="login" name="doLogin">Authenticate</button></p>
</form>
<script>
	$(document).ready(function(){
		$("button#login").click(function(){
			$.ajax({
				type: "POST",
				url: "/resources/jquery/addons/ajax/site/auth/login.submit.php",
				data: $('form.login').serialize(),
				success: function(message){
					$('#login_form_modal #dynamic-content').html(message);
				},
				error: function(){
					alert("Error");
				}
			});
		});
		$("form.login").keypress(function(e) {
            if (e.which == 13) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "/resources/jquery/addons/ajax/site/auth/login.submit.php",
                    data: $('form.login').serialize(),
                    success: function(message){
                        $('#login_form_modal #dynamic-content').html(message);
                    },
                    error: function(){
                        alert("Error");
                    }
                });
            }
        });
	});
</script>