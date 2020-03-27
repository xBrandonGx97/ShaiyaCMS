<?php

namespace App\Models;

use Classes\Utils;

class DropFinder
{
    public $fet;

    public function __construct()
    {
        $this->db = new \Classes\DB\MSSQL;
        $this->data = new Utils\Data;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
        $this->getDropFinder();
    }

    public function getDropFinder()
    {
        $Item = isset($_POST['item']) ? $this->data->purify(trim($_POST['item'])) : false;
        $ItemName = $this->data->purify($Item);
        $MobID = isset($_POST['MobID']) ? $this->data->purify(trim($_POST['MobID'])) : false;
        $ItemID = isset($_POST['ItemID']) ? $this->data->purify(trim($_POST['ItemID'])) : false;
        if (isset($_POST['SCN'])) {
            $sql = (
                    '
						SELECT DISTINCT m.ItemName,m.Grade,m.ItemID,mi.MobID,mi.ItemOrder
						FROM ' . table('SH_ITEMS') . '
						m INNER JOIN ' . table('SH_MOBITEMS') . "
						mi on mi.Grade = m.Grade Where mi.MobID = :mobid AND m.ItemName NOT LIKE '%'+'???'+'%'"
            );
            $this->db->query($sql);
            $this->db->bind(':mobid', $MobID);
            $res = $this->db->resultSet();
            $this->fet = $res;
        } elseif (isset($_POST['SC'])) {
            $sql = (
                    '
					    SELECT DISTINCT ItemName,ItemID
						FROM ' . table('SH_ITEMS') . '
						WHERE ItemName LIKE :item ORDER BY ItemID'
            );
            $this->db->query($sql);
            $this->db->bind(':item', '%' . $ItemName . '%');
            $res = $this->db->resultSet(true);
            $this->fet = $res;
        } elseif (isset($_POST['SCI'])) {
            $sql = (
                    '
						SELECT DISTINCT m.MobName,m.MobID,mi.Grade,mi.DropRate,drp.MapID,m.Attrib,m.Level,mi.ItemOrder
						FROM ' . table('SH_MOBS') . '
						m INNER JOIN ' . table('SH_MOBITEMS') . ' mi on mi.MobID = m.MobID
						INNER JOIN ' . table('SH_ITEMS') . ' i on mi.Grade = i.Grade
						INNER JOIN ' . table('drop_finder') . " drp on m.MobID = drp.MobID
						WHERE i.ItemID = :item AND m.MobName not like '%Error Monster%' order by m.MobID"
            );
            $this->db->query($sql);
            $this->db->bind(':item', $ItemID);
            $res = $this->db->resultSet(true);
            $this->fet = $res;
        }
    }

    public function getMaps($Map)
    {
        echo $this->user->get_Map($Map);
    }
}
