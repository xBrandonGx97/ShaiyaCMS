<div class="nk-sign-form" style="padding-top: 147px; display: none; opacity: 0; transform: translate3d(0px, 0px, 0px);">
    <div class="nk-gap-5"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3">
                <div class="nk-sign-form-container" style="opacity: 1; transform: translate3d(0px, 0px, 0px);">
                    <div class="nk-sign-form-toggle h3">
                        <a href="#" class="nk-sign-form-login-toggle active">Log In</a>
                        <a href="#" class="nk-sign-form-register-toggle">Register</a>
                    </div>
                    <div class="nk-gap-2"></div>
                    <!-- START: Login Form -->
                    <form class="nk-sign-form-login active" novalidate="novalidate">
                        <input class="form-control login-username" type="text" placeholder="Username or Email" name="UserName">
                        <div class="error-login-username nk-error"></div>
                        <div class="nk-gap-2"></div>
                        <div class="input-group">
                            <input class="form-control login-password" type="password" placeholder="Password or Pin" id="password3" name="Password">
                            <span class="input-group-append">
                                <span class="input-group-text bg-transparent border-0">
                                    <a href="#" class="password_visibility_login"><i class="far fa-eye-slash" id="password_icon3"></i></a>
                                </span>
                            </span>
                        </div>
                        <div class="error-login-password nk-error"></div>
                        <div class="success-login nk-success"></div>
                        <div class="nk-gap-2"></div>
                        <div class="form-check pull-left">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input login-remember" checked=""> Stay Logged In
                            </label>
                        </div>
                        <input type="hidden" name="doLogin" value="true"/>
                        <div class="clearfix login-submit-container"><button type="button" class="nk-btn nk-btn-color-white link-effect-4 pull-right login-submit ready" id="login" name="doLogin"><span class="link-effect-inner"><span class="link-effect-l"><span>Log In</span></span><span class="link-effect-r"><span>Log In</span></span><span class="link-effect-shade"><span>Log In</span></span></span></button></div>
                        <div class="error-login-submit-container nk-error error-ignore"></div>
                        <div class="nk-gap-1"></div>
                        <a class="nk-sign-form-lost-toggle pull-right" href="#">Lost Password ?</a>
                    </form>
                    <!-- END: Login Form -->
                    <!-- START: Lost Password Form -->
                    <form class="nk-sign-form-lost" novalidate="novalidate">
                        <input class="form-control password-reset-usernameoremail" type="text" placeholder="Username or Email">
                        <div class="nk-gap-2"></div>
                        <button class="nk-btn nk-btn-color-white link-effect-4 pull-right ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Reset Password</span></span><span class="link-effect-r"><span>Reset Password</span></span><span class="link-effect-shade"><span>Reset Password</span></span></span></button>
                    </form>
                    <!-- END: Lost Password Form -->
                    <!-- START: Register Form -->
                    <form class="nk-sign-form-register" novalidate="novalidate">
                        <input class="form-control register-username" type="text" placeholder="Username" name="Username">
                        <div class="error-register-username nk-error"></div>
                        <div class="nk-gap-2"></div>
                        <input class="form-control register-display-name" type="text" placeholder="Display name" name="DisplayName">
                        <div class="error-register-display-name nk-error"></div>
                        <div class="nk-gap-2"></div>
                        <input class="form-control register-email" type="email" placeholder="Email address" name="email">
                        <div class="error-register-email nk-error"></div>
                        <div class="nk-gap-2"></div>
                        <div class="input-group">
                            <input class="form-control register-password" type="password" placeholder="Password" id="password" name="Pwd">
                            <span class="input-group-append">
                                <span class="input-group-text bg-transparent border-0">
                                    <a href="#" class="password_visibility_reg"><i class="far fa-eye-slash" id="password_icon"></i></a>
                                </span>
                            </span>
                        </div>
                        <div class="error-register-password nk-error"></div>
                        <div class="nk-gap-2"></div>
                        <div class="input-group">
                            <input class="form-control register-repeat-password" type="password" placeholder="Repeat password" id="password2" name="cPassword">
                            <span class="input-group-append">
                                 <span class="input-group-text bg-transparent border-0">
                                     <a href="#" class="password_visibility_reg"><i class="far fa-eye-slash" id="password_icon2"></i></a>
                                 </span>
                            </span>
                        </div>
                        <div class="error-register-repeat-password nk-error"></div>
                        <div class="nk-gap-2"></div>
                        
                        
                        <?php echo $data['select']->secQuestion(); ?>

                        <div class="error-register-sec-question nk-error"></div>
                        <div class="nk-gap-2"></div>
                        <input class="form-control register-security-answer" type="text" placeholder="Security Answer" name="SecAnswer">
                        <div class="error-register-sec-answer nk-error"></div>
                        <div class="nk-gap-2"></div>
                        <input name="Terms" id="Terms" type="radio"/>
                        <label for="Terms">I Agree to the <?php echo $_SESSION['Settings']['SITE_TITLE']; ?>'s <a href="/serverinfo/terms" target="_blank">Terms of Use.</a></label>
                        <div class="error-register-terms nk-error"></div>
                        <div class="nk-gap-2"></div>
                        <div class="success-register nk-success"></div>
                        <input type="hidden" name="doReg" value="true"/>
                        <div class="clearfix register-submit-container"><button type="button" class="nk-btn nk-btn-color-white link-effect-4 pull-right register-submit ready" id="registration" name="doReg"><span class="link-effect-inner"><span class="link-effect-l"><span>Register</span></span><span class="link-effect-r"><span>Register</span></span><span class="link-effect-shade"><span>Register</span></span></span></button></div>
                        <div class="error-register-submit-container nk-error error-ignore"></div>
                    </form>
                    <!-- END: Register Form -->
                </div>
            </div>
        </div>
    </div>
    <div class="nk-gap-5"></div>
</div>
<script>
    document.body.addEventListener("click", e => {
        if(e.target.closest("#login")) {
            e.preventDefault();

            const user =  document.querySelector('input[name="UserName"]').value;
            const pw =  document.querySelector('input[name="Password"]').value;
            const login =  document.querySelector('input[name="doLogin"]').value;

            const userError =  document.querySelector('input[name="UserName"]');
            const passError =  document.querySelector('input[name="Password"]');

            const errorDivUser = document.querySelector(".error-login-username");
            const errorDivPass = document.querySelector(".error-login-password");
            const successLogin = document.querySelector(".success-login");

            fetch('/auth/login', {
                method: 'post',
                mode: "same-origin",
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    user,
                    pw,
                    login
                })
            })
            .then(r => r.json())
            .then(data => {
                console.log(data);
                if(data.finished==='true') {
                    userError.classList.add("nk-success");
                    errorDivUser.innerHTML = "";
                    passError.classList.add("nk-success");
                    errorDivPass.innerHTML = "";
                    successLogin.innerHTML = "Login successful.<br>Redirecting now...";
                    const referrer = document.location.href;
                    window.setTimeout(function(){
						window.location.href = referrer
					}, 2000);
                } else {
                    data.errors.forEach((error) => {
                        console.log(error);
                        if (error === '1') {
                            userError.classList.remove("nk-success");
                            userError.classList.add("nk-error");
                            successLogin.innerHTML = "";
                            errorDivUser.innerHTML = "A Username or Email is required. How else would you be able to log in?";
                        } else if (error === '2') {
                            passError.classList.remove("nk-success");
                            passError.classList.add("nk-error");
                            successLogin.innerHTML = "";
                            errorDivPass.innerHTML = "A password is required for all accounts.<br>Please provide a password.";
                        } else if (error === '3') {
                            passError.classList.remove("nk-success");
                            passError.classList.add("nk-error");
                            successLogin.innerHTML = "";
                            errorDivPass.innerHTML = "Your password must be between 3 and 16 characters in length.";
                        } else if (error === '4') {
                            passError.classList.remove("nk-success");
                            passError.classList.add("nk-error");
                            successLogin.innerHTML = "";
                            errorDivPass.innerHTML = "Unable to locate an account with the information that you provided.<br>If you believe this to be in error, please notify an Admin so that this issue can be resolved.";
                        } else if (error === '5') {
                            userError.classList.remove("nk-success");
                            userError.classList.add("nk-error");
                            successLogin.innerHTML = "";
                            errorDivUser.innerHTML = "Unable to locate an account with the information that you provided.<br>If you believe this to be in error, please notify an Admin so that this issue can be resolved.";
                        } else if (error === '6') {
                            userError.classList.remove("nk-success");
                            userError.classList.add("nk-error");
                            successLogin.innerHTML = "";
                            errorDivUser.innerHTML = "Your account has been banned due to rules infractions.<br>To find out what infraction you were banned for, as well as ban period,<br>please ask a GM or GS.";
                        }
                    })
                }
            })
            .catch(err => {

            })
        }
        if(e.target.closest("#registration")) {
            e.preventDefault();

            const user =  document.querySelector('input[name="Username"]');
            const display =  document.querySelector('input[name="DisplayName"]');
            const email =  document.querySelector('input[name="email"]');
            const pw =  document.querySelector('input[name="Pwd"]');
            const repeat_pw =  document.querySelector('input[name="cPassword"]');
            const sq =  document.querySelector('select[name="SecQuestion"]');
            const security_question =  sq.options[sq.selectedIndex].value;
            const security_answer =  document.querySelector('input[name="SecAnswer"]');
            const terms =  document.querySelector('input[name="Terms"]');
            const register =  document.querySelector('input[name="doReg"]').value;

            const errorDivUser = document.querySelector(".error-register-username");
            const errorDivDisplay = document.querySelector(".error-register-display-name");
            const errorDivEmail = document.querySelector(".error-register-email");
            const errorDivPass = document.querySelector(".error-register-password");
            const errorDivRepeatPass = document.querySelector(".error-register-repeat-password");
            const errorDivSecQuestion = document.querySelector(".error-register-sec-question");
            const errorDivSecAnswer = document.querySelector(".error-register-sec-answer");
            const errorDivTerms = document.querySelector(".error-register-terms");
            const successLogin = document.querySelector(".success-register");

            const ERRORS = {
                '1': { err: "Please provide a Username.", type: "user", selector: user, class: errorDivUser },
                '2': { err: "Username must be between 3 and 16 characters in length.", type: "user", selector: user, class: errorDivUser },
                '3': { err: "Username must consist of numbers and letters only.", type: "user", selector: user, class: errorDivUser },
                '4': { err: "Username already exists, please choose a different Username.", type: "user", selector: user, class: errorDivUser },
                '5': { err: "Please provide a Display name.", type: "display", selector: display, class: errorDivDisplay },
                '6': { err: "Display name must consist of numbers and letters only.", type: "display", selector: display, class: errorDivDisplay },
                '7': { err: "Display name already exists. please choose a different display name.", type: "display", selector: display, class: errorDivDisplay },
                '8': { err: "Please provide your e-mail.", type: "email", selector: email, class: errorDivEmail },
                '9': { err: "Invalid e-mail format", type: "email", selector: email, class: errorDivEmail },
                '10': { err: "The e-mail address provided has already been used. Please choose a different e-mail address.", type: "email", selector: email, class: errorDivEmail },
                '11': { err: "Please provide a password.", type: "pass", selector: pw, class: errorDivPass },
                '12': { err: "Password must be between 8 and 16 characters in length", type: "pass", selector: pw, class: errorDivPass },
                '13': { err: "Password must include at least one uppercase letter.", type: "pass", selector: pw, class: errorDivPass },
                '14': { err: "Password must include at least one number.", type: "pass", selector: pw, class: errorDivPass },
                '15': { err: "Password must include at least one special character.", type: "pass", selector: pw, class: errorDivPass },
                '16': { err: "Passwords do not match.", type: "pass2", selector: repeat_pw, class: errorDivRepeatPass },
                '17': { err: "Please provide a Security Question.", type: "sq", selector: sq, class: errorDivSecQuestion },
                '18': { err: "Please provide a Security Answer.", type: "sa", selector: security_answer, class: errorDivSecAnswer },
                '19': { err: "You must agree to our Terms Of Use to register", type: "terms", selector: terms, class: errorDivTerms },
            };

            fetch('/resources/jquery/addons/ajax/site/auth/register.submit.php', {
                method: 'post',
                mode: "same-origin",
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    user: user.value,
                    display: display.value,
                    email: email.value,
                    pw: pw.value,
                    repeat_pw: repeat_pw.value,
                    security_question,
                    security_answer: security_answer.value,
                    terms: terms.value,
                    register
                })
            })
            .then(r => r.json())
            .then(data => {
                console.log(data);
                if(data.finished==='true') {
                    const def = {
                        'user': { selector: user, class: errorDivUser },
                        'display': { selector: display, class: errorDivDisplay },
                        'email': { selector: email, class: errorDivEmail },
                        'pass': { selector: pw, class: errorDivPass },
                        'pass2': { selector: repeat_pw, class: errorDivRepeatPass },
                        'sq': { selector: sq, class: errorDivSecQuestion },
                        'sa': { selector: security_answer, class: errorDivSecAnswer },
                        'terms': { selector: terms, class: errorDivTerms },
                    };
                    for (const key in def) {
                        if (!def.hasOwnProperty(key)) continue;
                        const obj = def[key];
                        obj.selector.classList.add("nk-success");
                        obj.class.innerHTML = "";
                    }
                    successLogin.innerHTML = "Register successful.<br>Redirecting now...";
                    const referrer = document.location.href;
                    window.setTimeout(function(){
						window.location.href = referrer
					}, 2000);
                } else {
                    data.errors.forEach((error) => {
                        if (ERRORS[error] !== undefined) {
                            const full_error = ERRORS[error];
                            let element = null;
                            let element2 = null;
                            switch (full_error.type) {
                                case "user":
                                    element = user;
                                    element2 = errorDivUser;
                                    break;
                                case "display":
                                    element = display;
                                    element2 = errorDivDisplay;
                                    break;
                                case "email":
                                    element = email;
                                    element2 = errorDivEmail;
                                    break;
                                case "pass":
                                    element = pw;
                                    element2 = errorDivPass;
                                    break;
                                case "pass2":
                                    element = repeat_pw;
                                    element2 = errorDivRepeatPass;
                                    break;
                                case "sq":
                                    element = sq;
                                    element2 = errorDivSecQuestion;
                                    break;
                                case "sa":
                                    element = security_answer;
                                    element2 = errorDivSecAnswer;
                                    break;
                                case "terms":
                                    element = terms;
                                    element2 = errorDivTerms;
                                    break;
                            }
                            displayError(element);
                            successLogin.innerHTML = "";
                            element2.innerHTML = full_error.err;
                        }
                        /*if(!data.errors.includes('1')) {
                            console.log('e: ' + error);
                            errorDivUser.innerHTML = "";
                            // need to remove nk-error too
                            user.classList.add("nk-success");
                        }*/
                    });
                    Object.keys(ERRORS).forEach(function (item) {
                        if(!data.errors.includes(item)) {
                            //console.log('error clear');
                            //ERRORS[item].selector.classList.add("nk-success");
                            //ERRORS[item].class.innerHTML = "";
                        }
                        console.log(data.errors);
                        const userErrors = (data.errors.indexOf("1") > -1 || data.errors.indexOf("2") > -1 || data.errors.indexOf("3") > -1 || data.errors.indexOf("4") > -1);
                        if (!userErrors) {
                            user.classList.add("nk-success");
                            errorDivUser.innerHTML = "";
                        }
                        const displayErrors = (data.errors.indexOf("5") > -1 || data.errors.indexOf("6") > -1 || data.errors.indexOf("7") > -1);
                        if (!displayErrors) {
                            display.classList.add("nk-success");
                            errorDivDisplay.innerHTML = "";
                        }
                    });
                }
            })
            .catch(err => {

            })
        }
    });
    function displayError(element) {
        element.classList.remove("nk-success");
        element.classList.add("nk-error");
    }
    /*$(document).ready(function(){
		$("button#login").click(function(){
			$.ajax({
				type: "POST",
				url: "/resources/jquery/addons/ajax/site/auth/login.submit.php",
				data: $('form.nk-sign-form-login').serialize(),
				success: function(message){
					$('#login_form_modal #dynamic-content').html(message);
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});*/
</script>
<?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/partials/cms/signForms.blade.php ENDPATH**/ ?>