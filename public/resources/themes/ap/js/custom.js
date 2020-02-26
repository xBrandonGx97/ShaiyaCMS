$(document).ready(function(){
		$(document).on('click','.open_settings_modal',function(e){
			e.preventDefault();
			var uid = $(this).data('id');

			$('#settings_modal #dynamic-content').html('');
			$('#settings_modal #modal-loader').show();

			$.ajax({
				url: "../../../../assets/includes/Addons/jQuery/AJAX/CP/ServerManagement/update_config.php",
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
				$('#settings_modal #dynamic-content').html('');
				$('#settings_modal #dynamic-content').html(data);
				$('#settings_modal #modal-loader').hide();
			})
			.fail(function(){
				$('#settings_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#settings_modal #modal-loader').hide();
			});
		});
	});