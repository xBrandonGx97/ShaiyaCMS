$(document).ready(function(){
	$(document).on('click', '.open_register_form_modal', function (e) {
        e.preventDefault();
        $('#register_form_modal #dynamic-content').html('');
        $('#register_form_modal #modal-loader').show();
        $.ajax({
            url: "assets/includes/Addons/jQuery/AJAX/Site/Authentication/Register/Register.form.php",
            type: 'POST',
            data: $('form#register').serialize(),
            dataType: 'html'
        })
        .done(function (data) {
            $('#register_form_modal #dynamic-content').html('');
            $('#register_form_modal #dynamic-content').html(data);
            $('#register_form_modal #modal-loader').hide();
        })
        .fail(function () {
            $('#register_form_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
            $('#register_form_modal #modal-loader').hide();
        });
	});
	$(document).on('click', '.open_login_form_modal', function (e) {
		e.preventDefault();
		$('#login_form_modal #dynamic-content').html('');
		$('#login_form_modal #modal-loader').show();
		$.ajax({
			url: "assets/includes/Addons/jQuery/AJAX/Site/Authentication/Login/Login.form.php",
			type: 'POST',
			data: $('form#login').serialize(),
			dataType: 'html',
		})
		.done(function (data) {
			$('#login_form_modal #dynamic-content').html('');
			$('#login_form_modal #dynamic-content').html(data);
			$('#login_form_modal #modal-loader').hide();
		})
		.fail(function () {
			$('#login_form_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
			$('#login_form_modal #modal-loader').hide();
		});
	});
	$(document).on('click', '.logout_form', function (e) {
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			type: "POST",
			url: "assets/includes/Addons/jQuery/AJAX/Site/Authentication/Logout/Logout.php",
			data: "id=" + id,
			dataType: "html",
			success: function () {
				location.reload();
			}
		})
	});
	// Search by Pressing enter
	$("#search").keyup(function (e){
   		if (e.keyCode == 13) {
    		$(this).closest('form').submit();
   		}
  	});
});
// Popovers
$(function () {
    $('[data-toggle=popover]').popover({
    html: true,
    content: function () {
        return $('#content').html();
    }
	}).click(function (e) {
    	$('[data-toggle=popover]').not(this).popover('hide');
	});
})