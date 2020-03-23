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
        $this->MSSQL = new \Classes\DB\MSSQL;
    }

    public function ServerStatus()
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

    public function PlayersOnline()
    {
        $select = (
            '
                    COUNT(*) AS \'Players Online\',
                    (SELECT COUNT(*) FROM ' . table('SH_CHARDATA') . ' WHERE LoginStatus=1 AND Faction = 0)
                    AS AoL,
                    (SELECT COUNT(*) FROM ' . table('SH_CHARDATA') . ' WHERE LoginStatus=1 AND Faction = 1)
                    AS UoF
                '
        );

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

        /* $fet = $this->MSSQL->query()
            ->select('COUNT(*)')
            ->as('Players')
            ->select('COUNT(*)', 1)
            ->from('SH_CHARDATA')
            ->where('LoginStatus', ':status1')
            ->where('Faction', ':faction1', 'AND')
            ->as('AoL', 1)
            ->select('COUNT(*)', 1)
            ->from('SH_CHARDATA')
            ->where('LoginStatus', ':status2')
            ->where('Faction', ':faction2', 'AND')
            ->as('UoF', 2)
            /* ->bind(':status1', 1)
            ->bind(':faction1', 0)
            ->bind(':status2', 1)
            ->bind(':faction2', 1) */
        //->get('single');
        /* $sql = (
           "
                   SELECT COUNT(*) AS 'Players Online',
                   (SELECT COUNT(*) FROM " . $this->MSSQL->getTable('SH_CHARDATA') . " WHERE LoginStatus=1 AND Faction = '0') AS 'AoL',
                   (SELECT COUNT(*) FROM " . $this->MSSQL->getTable('SH_CHARDATA') . " WHERE LoginStatus=1 AND Faction = '1') AS 'UoF'
                   FROM " . $this->MSSQL->getTable('SH_CHARDATA') . ' WHERE LoginStatus=:status'
         );
         $this->MSSQL->query($sql);
         $this->MSSQL->bind(':status', 1);

         $fet = $this->MSSQL->single(true); */
        /* $this->pOnline = $fet['Players'];
        $this->AoL = $fet['AoL'];
        $this->UoF = $fet['UoF']; */
    }
}
