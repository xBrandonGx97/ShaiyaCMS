<?php
	use \Classes\Utils\Data;
    use \Classes\DB\MSSQL;
    use \Classes\Utils\User;
    \Classes\Utils\Session::init('Default');
    list($TopicTitle,) = explode("~",$_POST["id"]);
?>
<form class="move_topic">
    <div class="form-group row">
        <label for="Input-Value" class="col-sm-4 col-form-label tar">Topic Title</label>
        <div class="col-sm-8">
            <div class="input-group">
                <input class="form-control" name="TopicTitle" placeholder="Topic Title" value="<?php echo e($TopicTitle); ?>" type="text"/>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="Input-Value" class="col-sm-4 col-form-label tar">Destination Forum</label>
        <div class="col-sm-8">
            <div class="input-group">
                <?php 
                    echo \Classes\Utils\Select::getForumDestinations();
                 ?>
                
            </div>
        </div>
    </div>
    <p class="text-center"><button type="button" class="nk-btn nk-btn-lg link-effect-4" id="new_topic_submit">Move Topic</button></p>
</form>