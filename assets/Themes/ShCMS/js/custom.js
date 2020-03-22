// Div Auto-update
$(document).ready(function(){
	setInterval(function()
    {
        $("#plContainer").load(location.href + " #plContent");
    }, 60000);
});

// Autoloader

function fadeOut(){
    $(".fadeout").fadeToggle(500, "swing",function(){
        this.remove();
    });

    document.getElementById("myDiv").style.display = "block";
}

var delay = 3000; //3 seconds
setTimeout(fadeOut, delay);

// Popovers
$(function () {
    $('[data-toggle="popover"]').popover()
  })

  $('[data-toggle=popover]').popover({
    html: true,
    content: function () {
        return $('#content').html();
    }
}).click(function (e) {
    $('[data-toggle=popover]').not(this).popover('hide');
});

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    var cookie = document.cookie;
    var prefix = name + "=";
    var begin = cookie.indexOf("; " + prefix);
    if (begin == -1) {
        begin = cookie.indexOf(prefix);
        if (begin != 0) return null;
    } else {
        begin += 2;
        var end = document.cookie.indexOf(";", begin);
        if (end == -1) {
            end = cookie.length;
        }
    }
    return unescape(cookie.substring(begin + prefix.length, end));
}

/*function deleteCookie(cname) {
    var d = new Date(); //Create an date object
    d.setTime(d.getTime() - (1000 * 60 * 60 * 24)); //Set the time to the past. 1000 milliseonds = 1 second
    var expires = "expires=" + d.toGMTString(); //Compose the expirartion date
    window.document.cookie = cname + "=" + "; " + expires;//Set the cookie with name and the expiration date

}*/

function deleteCookie(name) {
    var d = new Date();
    d.setTime(d.getTime() - (24*60*60*1000));
    var expires = "expires="+d.toUTCString();
	document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

/* Color Switcher */

function toggleDarkLight() {
    var body = document.getElementById("page-top");
    var currentClass = body.className;
    body.className = currentClass == "dark-mode" ? "light-mode" : "dark-mode";

    if ($('.toggletheme').hasClass('active')) {
        setCookie("LightMode", "btn btn-sm btn-toggle toggletheme", 365);
        deleteCookie("DarkMode");
    }
    else{
        setCookie("DarkMode", "btn btn-sm btn-toggle active toggletheme", 365);
        deleteCookie("LightMode");
    }
}

/* Avatar Upload */
function getFile() {
    document.getElementById("upfile").click();
}
/* Show File name */
var input = document.getElementById('upfile');
var infoArea = document.getElementById('file-upload-filename');

if (input) {
	input.addEventListener('change', showFileName);
}

function showFileName(event) {

    var input = event.srcElement;

    var fileName = input.files[0].name;

    infoArea.textContent = 'File name: ' + fileName;
}

	$(document).ready(function(){
		$(document).on('click','.open_verify_userid_modal',function(e){
			e.preventDefault();

			$('#verify_userid_modal #dynamic-content').html('');
			$('#verify_userid_modal #modal-loader').show();

			$.ajax({
				url: "../assets/includes/Addons/jQuery/AJAX/Site/Registration/verify_userid.php",
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
				url: "../assets/includes/Addons/jQuery/AJAX/Site/Registration/verify_displayname.php",
				type: 'POST',
				data: $('form').serialize(),
				dataType: 'html'
			})
			.done(function(data){
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