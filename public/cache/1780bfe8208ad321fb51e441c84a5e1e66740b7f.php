<?php
    use Illuminate\Database\Capsule\Manager as Eloquent;

    $sql = ('
                SELECT COUNT(*) AS \'Players\',
                (SELECT COUNT(*) FROM PS_GameData.dbo.Chars WHERE LoginStatus=? AND Faction = ?) AS \'AoL\',
                (SELECT COUNT(*) FROM PS_GameData.dbo.Chars WHERE LoginStatus=? AND Faction = ?) AS \'UoF\'
                FROM PS_GameData.dbo.Chars WHERE LoginStatus=?
    ');

    $res = Eloquent::select(Eloquent::raw($sql), [1, 0, 1, 1, 1]);
    foreach ($res as $fet) {
        $pOnline = $fet->Players;
        $AoL = $fet->AoL;
        $UoF = $fet->UoF;
    }
?>
<div>
    <p>Players Online: <span><?php echo e($pOnline); ?></span></p>
    <p>AoL: <span><?php echo e($AoL); ?></span></p>
    <p>UoF: <span><?php echo e($UoF); ?></span></p>
</div><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\app\widgets\playerCount\php/script.blade.php ENDPATH**/ ?>