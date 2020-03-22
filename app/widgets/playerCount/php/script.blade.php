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
    echo '<div>';
        echo '<p>Players Online: ' . '<span>'.$pOnline.'</span></p>';
        echo '<p>AoL: ' . '<span>'.$AoL.'</span></p>';
        echo '<p>UoF: ' . '<span>'.$UoF.'</span></p>';
    echo '</div>';
