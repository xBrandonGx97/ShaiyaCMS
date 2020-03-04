<?php
	use \Classes\Utils\Data;
    use \Classes\DB\MSSQL;
    use \Classes\Utils\User;
    \Classes\Utils\Session::init('Default');
    $content = trim(file_get_contents("php://input"));
	$decoded = json_decode($content, true);
	if(is_array($decoded)) {
	    if(isset($decoded['id'])){
		    list($TopicTitle,$TopicID,$ForumID) = explode("~",$decoded["id"]);
		}
	}
?>
<form class="move_topic">
    <div class="form-group row">
        <label for="Input-Value" class="col-sm-4 col-form-label tar">Topic Title</label>
        <div class="col-sm-8">
            <div class="input-group">
                <input class="form-control" name="TopicTitle" placeholder="Topic Title" value="{{$TopicTitle}}" type="text"/>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="Input-Value" class="col-sm-4 col-form-label tar">Destination Forum</label>
        <div class="col-sm-8">
            <div class="input-group">
                @php
                    echo \Classes\Utils\Select::getForumDestinations($ForumID);
                @endphp
                {{--<select class="form-control tac" name="Destination">
                    <option value="1">test</option>
                    <option value="2">test1</option>
                    <option value="3">test2</option>
                </select>--}}
            </div>
        </div>
    </div>
    <p class="text-center"><button type="button" class="nk-btn nk-btn-lg link-effect-4" id="move_topic_submit">Move Topic</button></p>
    <input type="hidden" name="TopicID" value="{{$TopicID}}"/>
</form>
<script>
	$(document).ready(function(){
		$("button#move_topic_submit").click(function(){
			$.ajax({
				type: "POST",
				url:"/resources/jquery/addons/ajax/site/forum/topic/move_topic_submit.php",
				data: $("form.move_topic").serialize(),
				success: function(message){
					$("#move_topic_modal #dynamic-content").html(message);
					$(".alert").show();
					$(".alert-text").text('Topic has been moved successfully.');
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>