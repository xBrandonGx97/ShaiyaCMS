<?php
	use \Classes\Utils\Data;
    use \Classes\DB\MSSQL;
    use \Classes\Utils\User;
    \Classes\Utils\Session::init('Default');
    require_once($_SERVER['DOCUMENT_ROOT'].'/../app/models/Support.php');
    $Support	=	new Support();
    list($UserUID,$TicketID,$Category,$Subject,$Message,$Status,$Date) = explode("~",$_POST["id"]);
?>
<div class="row m_b_10">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="text-center">
			<h3 class="u">Category: {{$Category}}</h3>
		</div>
	</div>
</div>

<form class="form-inline">
	<div class="row pl_10_p">
		<div class="form-group mx-sm-3 mb-2">
			<label class="pr_5" for="TcktTest">Ticket ID:</label>
			<input type="text" name="ticketID" value="{{$TicketID}}" class="form-control form-custom input-sm tac b_i" readonly/>
		</div>
		<div class="form-group mx-sm-3 mb-2">
			<label class="pr_5" for="SubTest">Subject:</label>
			<input type="text" name="Subject" value="{{$Subject}}" class="form-control form-custom input-sm tac b_i" readonly/>
		</div>
	</div>
</form>
<div class="container">
	@php
		$Support->editTicket($UserUID,$TicketID);
	@endphp
	@foreach($Support->row as $tickets)
		@if($tickets["Type"] == '0')
			<div class="row">
				<div class="col-md-9 badge-pill badge-primary">
					<div class="row plr_15">
						<div class="col-md-12">
							<font class="b_i"> {{User::_fetch_UserGameInfo($tickets['UserUID'],'UserID')}} said:</font>
						</div>
					</div>
					<div class="row plr_15">
						<div class="col-md-12">
							<div class="float-left">
								{{$tickets['Message']}}
							</div>
							<div class="float-right">
								{{date('F d, Y h:i:s A', strtotime($tickets['Date']))}}
							</div>
						</div>
					</div>
				</div>
			</div>
			@php Separator(15); @endphp
		@elseif($tickets["Type"] == '1')
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-9 badge-pill badge-secondary">
					<div class="row tar plr_15">
						<div class="col-md-12">
							<font class="b_i"> {{User::_fetch_UserGameInfo($tickets['RespUID'],'UserID')}} said:</font>
						</div>
					</div>
					<div class="row tar plr_15">
						<div class="col-md-12">
							<div class="float-left">
								{{$tickets['Message']}}
							</div>
							<div class="float-right">
								{{date('F d, Y h:i:s A', strtotime($tickets['Date']))}}
							</div>
						</div>
					</div>
				</div>
			</div>
            @php Separator(15); @endphp
		@endif
	@endforeach
</div>
<form class="edit_ticket">
<input type="hidden" name="Category" value="{{$Category}}"/>
<input type="hidden" name="UserUID" value="{{$UserUID}}"/>
<input type="hidden" name="TicketID" value="{{$TicketID}}"/>
<input type="hidden" name="Subject" value="{{$Subject}}"/>
    @if($Status==1 || $Status==2 || $Status==3)
        <div class="row m_b_10">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="text-center">
                    <label for="MessageTest">Message:</label>
                </div>
                <textarea name="Message" placeholder="Your message here..."
						  class="form-control form-custom b_i"></textarea>
            </div>
        </div>
		@php Separator(20); @endphp
        <div class="row m_b_10">
            <div class="col-md-5"></div>
            <div class="col-md-6">
                <button type="button" class="nk-btn nk-btn-color-main-1 text-center" id="edit_ticket_answer">Send
					Message <i class="fa fa-send"></i></button>
            </div>
        </div>
	@else
</form>
<div class="col-md-12 tac">
    <button class="btn btn-dark f_20">
        This ticket has been closed and is no longer available for editing.
    </button>
</div>
@endif
<script>
	$(document).ready(function(){
		$("button#edit_ticket_answer").click(function(){
			$.ajax({
				type: "POST",
				url:"/resources/jquery/addons/ajax/site/support/edit_ticket_answer.php",
				data: $("form.edit_ticket").serialize(),
				success: function(message){
					$("#get_e_ticket_modal #dynamic-content").html(message);
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>