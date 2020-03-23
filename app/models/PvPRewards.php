<?php

namespace App\Models;

    class PvPRewards
    {
        public $fet;
        public $row;
        public $rowCount;
        public $k1;
        // Kill Requirements
        public $Kills = [
            'K1' => '1',
            'K2' => '50',
            'K3' => '300',
            'K4' => '1000',
            'K5' => '5000',
            'K6' => '10000',
            'K7' => '20000',
            'K8' => '30000',
            'K9' => '40000',
            'K10' => '50000',
            'K11' => '70000',
            'K12' => '90000',
            'K13' => '110000',
            'K14' => '130000',
            'K15' => '150000',
            'K16' => '200000',
            'K17' => '250000',
            'K18' => '300000',
            'K19' => '350000',
            'K20' => '400000',
            'K21' => '450000',
            'K22' => '500000',
            'K23' => '550000',
            'K24' => '600000',
            'K25' => '650000',
            'K26' => '700000',
            'K27' => '750000',
            'K28' => '800000',
            'K29' => '850000',
            'K30' => '900000',
            'K31' => '1000000',
        ];
        // Kill Rewards
        public $Rewards = [
            'K1' => '1 DP',
            'K2' => '5 DP',
            'K3' => '10 DP',
            'K4' => '15 DP',
            'K5' => '20 DP',
            'K6' => '25 DP',
            'K7' => '30 DP',
            'K8' => '35 DP',
            'K9' => '40 DP',
            'K10' => '45 DP',
            'K11' => '50 DP',
            'K12' => '55 DP',
            'K13' => '60 DP',
            'K14' => '65 DP',
            'K15' => '70 DP',
            'K16' => '75 DP',
            'K17' => '80 DP',
            'K18' => '85 DP',
            'K19' => '90 DP',
            'K20' => '95 DP',
            'K21' => '100 DP',
            'K22' => '105 DP',
            'K23' => '110 DP',
            'K24' => '115 DP',
            'K25' => '120 DP',
            'K26' => '125 DP',
            'K27' => '130 DP',
            'K28' => '135 DP',
            'K29' => '140 DP',
            'K30' => '145 DP',
            'K31' => '150 DP',
        ];

        public function __construct()
        {
            $this->MSSQL = new \Classes\DB\MSSQL;
            $this->Data = new \Classes\Utils\Data;
            $this->User = new \Classes\Utils\User;
            $this->User->run();
            $this->User = $this->User->_fetch_User();
            $this->getPvPRewards();
        }

        public function getPvPRewards()
        {
            $this->MSSQL->query('SELECT TOP 1 K1
                                    FROM PS_GameData.dbo.Chars
                                    WHERE UserUID=:uid AND DEL=:del
                                    ORDER BY K1 DESC');
            $this->MSSQL->bind(':uid', $this->User['UserUID']);
            $this->MSSQL->bind(':del', 0);
            $this->fet = $this->MSSQL->single(true);
            $this->k1 = $this->fet['K1'];
        }

        public function validateKills($id)
        {
            $this->MSSQL->query('SELECT * FROM ShaiyaCMS.dbo.PVP_RWRDS WHERE UserUID=:uid AND PrizeID=:id');
            $this->MSSQL->bind(':uid', $this->User['UserUID']);
            $this->MSSQL->bind(':id', $id);
            $this->row = $this->MSSQL->resultSet();
            $this->rowCount = count($this->row);
        }
    }
