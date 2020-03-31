<?php

    namespace App\Models\Community;

    class Rankings
    {
        public $data;

        public function __construct()
        {
            $this->MSSQL = new \Classes\DB\MSSQL;
        }

        public function getRankings()
        {
            $sql = ('
        			SELECT * FROM PS_GameData.dbo.Chars
        	');
            $this->MSSQL->query($sql);
            $res = $this->MSSQL->resultSet();
            $this->data = $res;
        }

        public function get_Faction($Faction)
        {
            switch ($Faction) {
                case '0':	return	'AoL';		break;
                case '1':	return	'UoF';			break;
            }
            return null;
        }

        public function get_Rank($K1)
        {
            if ($K1 <= 0) {
                return 0;
            } elseif ($K1 < 50) {
                return 1;
            } elseif ($K1 < 300) {
                return 2;
            } elseif ($K1 < 1000) {
                return 3;
            } elseif ($K1 < 5000) {
                return 4;
            } elseif ($K1 < 10000) {
                return 5;
            } elseif ($K1 < 20000) {
                return 6;
            } elseif ($K1 < 30000) {
                return 7;
            } elseif ($K1 < 40000) {
                return 8;
            } elseif ($K1 < 50000) {
                return 9;
            } elseif ($K1 < 70000) {
                return 10;
            } elseif ($K1 < 90000) {
                return 11;
            } elseif ($K1 < 110000) {
                return 12;
            } elseif ($K1 < 130000) {
                return 13;
            } elseif ($K1 < 150000) {
                return 14;
            } elseif ($K1 < 200000) {
                return 15;
            } elseif ($K1 < 250000) {
                return 16;
            } elseif ($K1 < 300000) {
                return 17;
            } elseif ($K1 < 350000) {
                return 18;
            } elseif ($K1 < 400000) {
                return 19;
            } elseif ($K1 < 450000) {
                return 20;
            } elseif ($K1 < 500000) {
                return 21;
            } elseif ($K1 < 550000) {
                return 22;
            } elseif ($K1 < 600000) {
                return 23;
            } elseif ($K1 < 650000) {
                return 24;
            } elseif ($K1 < 700000) {
                return 25;
            } elseif ($K1 < 750000) {
                return 26;
            } elseif ($K1 < 800000) {
                return 27;
            } elseif ($K1 < 850000) {
                return 28;
            } elseif ($K1 < 900000) {
                return 29;
            } elseif ($K1 < 1000000) {
                return 30;
            } else {
                return 31;
            }
        }

        public function get_Class($Faction, $Class)
        {
            if ($Faction == 0) {
                switch ($Class) {
                    case 0:	return 'Fighter'; 				break;
                    case 1:	return 'Defender'; 				break;
                    case 2:	return 'Archer'; 				break;
                    case 3:	return 'Ranger'; 				break;
                    case 4:	return 'Mage'; 					break;
                    case 5:	return 'Priest'; 				break;
                }
            } else {
                switch ($Class) {
                    case 0:	return 'Warrior'; 				break;
                    case 1:	return 'Guardian'; 				break;
                    case 2:	return 'Hunter'; 				break;
                    case 3:	return 'Assassin'; 				break;
                    case 4:	return 'Pagan'; 				break;
                    case 5:	return 'Oracle'; 				break;
                }
            }
        }
    }
