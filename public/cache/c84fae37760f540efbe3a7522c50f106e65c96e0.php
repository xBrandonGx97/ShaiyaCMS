<?php
    use \Classes\Utils\Session;
    Session::init('Default');
?>
<form class="create_forum">
    <div class="form-group row">
        <label for="Input-Value" class="col-sm-4 col-form-label tar">Forum Name</label>
        <div class="col-sm-8">
            <div class="input-group">
                <input class="form-control" name="ForumName" placeholder="Forum Name" type="text"/>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="Input-Value" class="col-sm-4 col-form-label tar">Sub Title</label>
        <div class="col-sm-8">
            <div class="input-group">
                <input class="form-control" name="SubTitle" placeholder="Sub Title" type="text"/>
            </div>
        </div>
    </div>
    <p class="text-center"><button type="button" class="nk-btn nk-btn-lg link-effect-4" id="create_forum_submit">Create New Forum</button></p>
</form>
<script>
	$(document).ready(function(){
		$("button#create_forum_submit").click(function(){
			$.ajax({
				type: "POST",
				url:"/resources/jquery/addons/ajax/site/forum/create_forum_submit.php",
				data: $("form.create_forum").serialize(),
				success: function(message){
					$("#create_forum_modal #dynamic-content").html(message);
					$(".nk-forum").load(location.href + " .nk-forum");
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>