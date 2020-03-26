<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Eloquent;

class ServerInfo
{
    protected $ServerIP = '127.0.0.1';
    protected $ServerPorts = [6249, 6264];
    public $pOnline;
    public $AoL;
    public $UoF;

    public function __construct()
    {
        $this->db = new \Classes\DB\MSSQL;
    }

    public function serverStatus()
    {
        $LoginConn = @fsockopen($this->ServerIP, $this->ServerPorts[0], $errno, $errstr, 0.01);
        $GameConn = @fsockopen($this->ServerIP, $this->ServerPorts[1], $errno, $errstr, 0.01);
        echo '<p class="lead">Login Server: ';
        if ($LoginConn) {
            echo '<span style="color:lime" class="b">Online</span>';
        } else {
            echo '<span style="color:red" class="b">Offline</span></p>';
        }
        @fclose($LoginConn);
        echo '<p class="lead">Game Server: ';
        if ($GameConn) {
            echo '<span style="color:lime">Online</span>';
        } else {
            echo '<span style="color:red"">Offline</span></p>';
        }
        @fclose($GameConn);
    }

    public function playersOnline()
    {
        $sql = ('
                    SELECT COUNT(*) AS \'Players\',
                    (SELECT COUNT(*) FROM PS_GameData.dbo.Chars WHERE LoginStatus=? AND Faction = ?) AS \'AoL\',
                    (SELECT COUNT(*) FROM PS_GameData.dbo.Chars WHERE LoginStatus=? AND Faction = ?) AS \'UoF\'
                    FROM PS_GameData.dbo.Chars WHERE LoginStatus=?
        ');

        $res = Eloquent::select(Eloquent::raw($sql), [1, 0, 1, 1, 1]);
        foreach ($res as $fet) {
            $this->pOnline = $fet->Players;
            $this->AoL = $fet->AoL;
            $this->UoF = $fet->UoF;
        }
    }
}
