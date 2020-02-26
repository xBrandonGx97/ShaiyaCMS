<?php
    use \Classes\Utils\Data;
    use \Classes\DB\MSSQL;
    \Classes\Utils\Session::init('Default');
    
    $UserUID	=	$_POST['id'] ? Data::_do('escData',trim($_POST["id"]))		:	false;
?>
<form class="send_ticket" method="POST">
	<div class="row m_b_10">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="text-center">
				<h3 class="u">New Ticket</h3>
				<h5>Please provide as much detail as possible so we can best assist you.</h5>
			</div>
			<input type="hidden" name="id" value="{{$UserUID}}"/>
		</div>
	</div>
	<div class="row m_b_10">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="text-center">
				<label for="MessageTest">Category:</label>
			</div>
			<select name="Category" id="Category" class="form-control form-custom tac">
				<option>Choose One</option>
				<option>Billing</option>
				<option>Bug Reports</option>
				<option>Player Reports</option>
				<option>Ban Appeal</option>
				<option>GM Services</option>
				<option>Technical Issues</option>
				<option>Others</option>
			</select>
		</div>
	</div>
	<div class="row m_b_10">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="text-center">
				<label for="MessageTest">Subject:</label>
			</div>
			<input type="text" name="Subject" placeholder="Subject" class="form-control form-custom tac b_i"/>
		</div>
	</div>
	<div class="row m_b_10">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="text-center">
				<label for="MessageTest">Message:</label>
			</div>
			<textarea name="Message" placeholder="Message" class="form-control form-custom tac b_i"></textarea>
		</div>
	</div>
	@php Separator(20); @endphp
	<div class="row m_b_10">
		<div class="col-md-5"></div>
		<div class="col-md-6">
			<button type="button" class="nk-btn nk-btn-color-main-1 text-center" id="send_ticket_submit">Send <i class="fa fa-send"></i></button>
		</div>
	</div>
</form>
<script>
	$(document).ready(function(){
		$("button#send_ticket_submit").click(function(){
			$.ajax({
				type: "POST",
				url:"/resources/jquery/addons/ajax/site/support/send_ticket_submit.php",
				data: $("form.send_ticket").serialize(),
				success: function(message){
					$("#get_ticket_modal #dynamic-content").html(message);
					$("#TableLoader").load(location.href + " #TabularData");
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>