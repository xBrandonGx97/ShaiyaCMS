<?php
	use Classes\Utils\Data;
	use Classes\Utils\User;
    class drop_finder {
		public $fet;
        public function __construct(){
            $this->MSSQL   =   new Classes\DB\MSSQL;
            $this->getDropFinder();
        }

        public function getDropFinder(){
        	$Item		=	isset($_POST["item"])			?	Data::_do('escData',trim($_POST["item"]))		:	false;
        	$ItemName	=	Data::_do('escData',$Item);
			$MobID		=	isset($_POST["MobID"])			?	Data::_do('escData',trim($_POST["MobID"]))		:	false;
			$ItemID		=	isset($_POST["ItemID"])			?	Data::_do('escData',trim($_POST["ItemID"]))		:	false;
			if (isset($_POST['SCN'])){
				$sql    =   ("
								SELECT DISTINCT m.ItemName,m.Grade,m.ItemID,mi.MobID,mi.ItemOrder
								FROM ".$this->MSSQL->getTable("SH_ITEMS")."
								m INNER JOIN ".$this->MSSQL->getTable("SH_MOBITEMS")."
								mi on mi.Grade = m.Grade Where mi.MobID = :mobid AND m.ItemName NOT LIKE '%'+'???'+'%'"
				);
				$this->MSSQL->query($sql);
				$this->MSSQL->bind(':mobid', $MobID);
				$res = $this->MSSQL->resultSet();
				$this->fet = $res;
			}elseif (isset($_POST['SC'])){
				$sql    =   ("
								SELECT DISTINCT ItemName,ItemID
								FROM ".$this->MSSQL->getTable("SH_ITEMS")."
								WHERE ItemName LIKE :item ORDER BY ItemID"
				);
				$this->MSSQL->query($sql);
				$this->MSSQL->bind(':item', '%'.$ItemName.'%');
				$res = $this->MSSQL->resultSet(true);
				$this->fet = $res;
			}elseif (isset($_POST['SCI'])){
				$sql    =   ("
								SELECT DISTINCT m.MobName,m.MobID,mi.Grade,mi.DropRate,drp.MapID,m.Attrib,m.Level,mi.ItemOrder
								FROM ".$this->MSSQL->getTable("SH_MOBS")."
								m INNER JOIN ".$this->MSSQL->getTable("SH_MOBITEMS")." mi on mi.MobID = m.MobID
								INNER JOIN ".$this->MSSQL->getTable("SH_ITEMS")." i on mi.Grade = i.Grade
								INNER JOIN ".$this->MSSQL->getTable("SH_DROP_FINDER")." drp on m.MobID = drp.MobID
								WHERE i.ItemID = :item AND m.MobName not like '%Error Monster%' order by m.MobID"
				);
				$this->MSSQL->query($sql);
				$this->MSSQL->bind(':item', $ItemID);
				$res = $this->MSSQL->resultSet(true);
				$this->fet = $res;
			}
        }
        public function getMaps($Map){
        	echo User::get_Map($Map);
        }
    }