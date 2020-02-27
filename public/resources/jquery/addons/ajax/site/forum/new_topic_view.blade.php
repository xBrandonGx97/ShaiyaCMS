<?php
	use \Classes\Utils\Data;
    use \Classes\DB\MSSQL;
    use \Classes\Utils\User;
    \Classes\Utils\Session::init('Default');
    list($ForumID,$TopicAuthor) = explode("~",$_POST["id"]);
?>
<!-- init summernote -->
<script src="/resources/themes/Godlike/js/godlike-init.js"></script>
<form class="new_topic">
    <div class="form-group row">
        <label for="Input-Value" class="col-sm-4 col-form-label tar">Topic Title</label>
        <div class="col-sm-8">
            <div class="input-group">
                <input class="form-control" name="TopicTitle" placeholder="Topic Title" type="text"/>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="Input-Value" class="col-sm-4 col-form-label tar">Topic Body</label>
        <div class="col-sm-8">
            <div class="input-group">
                <textarea class="nk-summernote" name="TopicBody" id="TopicBody"></textarea>
            </div>
        </div>
    </div>
    <p class="text-center"><button type="button" class="nk-btn nk-btn-lg link-effect-4" id="new_topic_submit">Create New Topic</button></p>
    <input type="hidden" name="ForumID" value="{{$ForumID}}"/>
    <input type="hidden" name="TopicAuthor" value="{{$TopicAuthor}}"/>
</form>
<script>
	$(document).ready(function(){
		$("button#new_topic_submit").click(function(){
			$.ajax({
				type: "POST",
				url:"/resources/jquery/addons/ajax/site/forum/new_topic_submit.php",
				data: $("form.new_topic").serialize(),
				success: function(message){
					$("#new_topic_modal #dynamic-content").html(message);
					$(".nk-forum").load(location.href + " .nk-forum");
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>