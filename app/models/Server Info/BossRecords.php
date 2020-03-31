<?php

namespace App\Models\ServerInfo;

use Illuminate\Database\Capsule\Manager as Eloquent;

class BossRecords
{
    public $MobID = ['2839', '2785', '2821', '2803', '3010', '3040', '3041', '3042', '3005', '3028', '3023', '3015', '3539', '1259', '3984', '3836', '3837', '3838', '768', '798', '3833', '3834', '1129', '1159', '934', '964', '835', '1977', '1978', '871', '872', '901', '902', '1704', '1804', '1706', '1806', '1702', '1802', '1701', '1801', '1714', '1814', '1703', '1803', '1705', '1805', '1700', '1800', '1716', '1816', '2414', '2472'];
    public $MobName;
    public $CharName;
    public $ActionTime;

    public function __construct()
    {
        $this->db = new \Classes\DB\MSSQL;
    }

    public function getBossRecords($time, $value)
    {
        $records = Eloquent::table(table('logBossDeath'))
             ->select('MobName', 'CharName', 'ActionTime')
             ->where('MobID', $value)
             ->limit(1)
             ->orderBy('ActionTime', 'DESC')
             ->get();
        foreach ($records as $fet) {
            $this->MobName = $fet->MobName;
            $this->CharName = $fet->CharName;
            $this->ActionTime = $fet->ActionTime;

            if ($this->MobName != null) {
                // WHEN YOU ADD A MOB REMEMBER TO ADD THE TIME
                switch ($value) {
                    case 2839:	$hours = 7;	    break;	// LUMEN
                    case 2785:	$hours = 7;	    break;	// ALES
                    case 2821:	$hours = 7;	    break;	// SECRETA
                    case 2803:	$hours = 7;	    break;	// DENTATUS
                    case 3010:	$hours = 11;	break;	// Cryptic Bulldozer
                    case 3040:	$hours = 12;	break;	// Cryptic Back
                    case 3041:	$hours = 16;	break;	// Cryptic The Immortal
                    case 3042:	$hours = 10;	break;	// Cryptic The Last
                    case 3005:	$hours = 12;	break;	// Cryptic Peri Queen
                    case 3028:	$hours = 12;	break;	// Cannibal Hydra
                    case 3023:	$hours = 12;	break;	// Dlizabeth Eathory
                    case 3015:	$hours = 12;	break;	// Fury Kirhiross
                    case 3539:	$hours = 18;	break;	// Opalus
                    case 1259:	$hours = 6; 	break;	// Greendieta Seraphim
                    case 3984:	$hours = 48;	break;	// Luminous Brigand
                    case 3836:	$hours = 6;		break;	// Commander Opal Hammer
                    case 3837:	$hours = 6;		break;	// Field Staff Hermo
                    case 3838:	$hours = 6;		break;	// Killer Megantos
                    case 768:	$hours = 2;		break;	// Asmo (CR)
                    case 798:	$hours = 2;		break;	// Knight (AR)
                    case 3833:	$hours = 6;		break;	// Killer Dynos: X
                    case 3834:	$hours = 6;		break;	// Killer Dynos: 2X
                    case 1129:	$hours = 3;		break;	// Ajuha
                    case 1159:	$hours = 3;		break;	// Elkid
                    case 934:	$hours = 3;		break;	// Ankylul
                    case 964:	$hours = 3;		break;	// Astaroth
                    case 835:	$hours = 12;	break;	// Kimu
                    case 1977:	$hours = 12;	break;	// Freezing Mirage
                    case 1978:	$hours = 12;	break;	// Haruhion
                    case 871:	$hours = 12;	break;	// Cloron
                    case 872:	$hours = 12;	break;	// Cloron Dragon
                    case 901:	$hours = 12;	break;	// Fantasma
                    case 902:	$hours = 12;	break;	// Fantasma Dragon
                    case 1704:	$hours = 12;	break;	// Deinos The Dream
                    case 1804:	$hours = 12;	break;	// Deinos The Dream
                    case 1706:	$hours = 12;	break;	// Nantarios
                    case 1806:	$hours = 12;	break;	// Nantarios
                    case 1702:	$hours = 12;	break;	// Blizabeth Eathory
                    case 1802:	$hours = 12;	break;	// Blizabeth Eathory
                    case 1701:	$hours = 12;	break;	// Parrdalis
                    case 1801:	$hours = 12;	break;	// Parrdalis
                    case 1714:	$hours = 12;	break;	// Alcarian The Flame
                    case 1814:	$hours = 12;	break;	// Alcarian The Flame
                    case 1703:	$hours = 12;	break;	// Alcarian The Flame
                    case 1803:	$hours = 12;	break;	// Alcarian The Flame
                    case 1705:	$hours = 12;	break;	// Kirhiross
                    case 1805:	$hours = 12;	break;	// Kirhiross
                    case 1700:	$hours = 12;	break;	// Cryptic One
                    case 1800:	$hours = 12;	break;	// Cryptic One
                    case 1716:	$hours = 12;	break;	// Cryptic The Immortal
                    case 1816:	$hours = 12;	break;	// Cryptic The Immortal
                    case 2414:	$hours = 12;	break;	// Evilmidget Clavi
                    case 2472:	$hours = 12;	break;	// Dios
                }
                $nextTime = date('Y-m-d H:i:s', strtotime($this->ActionTime . '+' . $hours . ' hours'));
                if ($nextTime < $time) {
                    $time_Result = '<span style="color:green; margin: 3px;">Respawned</span>';
                } else {
                    $newTime = strtotime($nextTime);
                    $time1 = strtotime($time);

                    $countdown = $newTime - $time1;
                    $days_left = gmdate('d', $countdown);
                    $hours_left = gmdate('H', $countdown);
                    $min_left = gmdate('i', $countdown);
                    $sec_left = gmdate('s', $countdown);

                    $daysstr = 'd';
                    if ($days_left != '1') {
                        $daysstr = 'd';
                    } else {
                        $daysstr = '';
                        $days_left = '';
                    }

                    $hstr = 'h';
                    if ($hours_left != '1') {
                        $hstr = 'h';
                    }

                    $mstr = 'm';
                    if ($min_left != '1') {
                        $mstr = 'm';
                    }

                    $sstr = 's';
                    if ($sec_left != '1') {
                        $sstr = 's';
                    }

                    $time_Result = '<span style="colorrange; margin: 3px; ">' . $days_left . ' ' . $daysstr . ' ' . $hours_left . ' ' . $hstr . ' ' . $min_left . ' ' . $mstr . ' ' . $sec_left . ' ' . $sstr . ' </span>';
                }
                echo '<tbody>';
                echo '<tr>';
                echo '<td>' . $this->MobName . '</td>';
                echo '<td>' . $this->CharName . '</td>';
                echo '<td>' . $time_Result . '</td>';
                echo '</tr>';
                echo '</tbody>';
            }
        }
        return $records;
    }
}
