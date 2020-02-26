<?php
    class server_info {
        protected $ServerIP	=	'127.0.0.1';
        protected $ServerPorts = array(6249, 6264);
        public $pOnline;
        public $AoL;
        public $UoF;

        public function __construct(){
            $this->MSSQL   =   new Classes\DB\MSSQL;
        }

        public function ServerStatus(){
            $LoginConn = @fsockopen($this->ServerIP, $this->ServerPorts[0], $errno, $errstr, 0.01);
            $GameConn = @fsockopen($this->ServerIP, $this->ServerPorts[1], $errno, $errstr, 0.01);
            echo '<p class="lead">Login Server: ';
            if ($LoginConn){
                echo '<span style="color:lime" class="b">Online</span>';
            }
            else{
                echo '<span style="color:red" class="b">Offline</span></p>';
            }
            @fclose($LoginConn);
            echo '<p class="lead">Game Server: ';
            if ($GameConn){
                echo '<span style="color:lime">Online</span>';
            }
            else{
                echo '<span style="color:red"">Offline</span></p>';
            }
            @fclose($GameConn);
        }

        public function PlayersOnline(){
            $sql = ("
                        SELECT COUNT(*) AS 'Players Online',
                        (SELECT COUNT(*) FROM ".$this->MSSQL->getTable('SH_CHARDATA')." WHERE LoginStatus=1 AND Faction = '0') AS 'AoL',
                        (SELECT COUNT(*) FROM ".$this->MSSQL->getTable('SH_CHARDATA')." WHERE LoginStatus=1 AND Faction = '1') AS 'UoF'
                        FROM ".$this->MSSQL->getTable('SH_CHARDATA')." WHERE LoginStatus=:status"
            );
            $this->MSSQL->query($sql);
            $this->MSSQL->bind(':status', 1);

            $fet = $this->MSSQL->single(true);
            $this->pOnline = $fet['Players Online'];
            $this->AoL     = $fet['AoL'];
            $this->UoF     = $fet['UoF'];
         }
    }