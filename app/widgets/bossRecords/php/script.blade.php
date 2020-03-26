<?php
    use Illuminate\Database\Capsule\Manager as Eloquent;

    $res = Eloquent::table('ShaiyaCMS.dbo.polls')
        ->select('id', 'poll_question')
        ->get();
?>
<div>
    <p>Question here</p>
    <input type="radio" name="1" value="1"> Option here<br>
    <input type="radio" name="1" value="1"> Option here<br><br>
    <button>Vote</button><br><br>
</div>
