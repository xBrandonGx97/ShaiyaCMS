<?php
    list($Discord,$DisplayName) = explode("~",$_POST["id"]);
?>
<div class="discord_popup">
    <i class="fab fa-discord"></i> {{$DisplayName}}
    <p>Discord Handle: <span class="handle">{{$Discord}}</span></p>
</div>