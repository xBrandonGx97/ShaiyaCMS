<?php
	
	class Promotions {
		public $Code;
		public $NumOfUses;
		public $MaxUses;
		public $Points;
		public $fet;
		
		public function __construct() {
			$this->MSSQL = new Classes\DB\MSSQL;
			$this->Data = new Classes\Utils\Data;
			$this->User = new Classes\Utils\User;
			$this->User->run();
			$this->User = $this->User->_fetch_User();
			$this->getPromotions();
		}
		
		public function getPromotions() {
			
			$Code = isset($_POST["code"]) ? $this->Data->_do('escData', trim($_POST["code"])) : false;
			$this->Code = $Code;
			
			$this->MSSQL->query('SELECT * FROM ' . $this->MSSQL->getTable('SH_PROMOS') . ' WHERE Code=:code');
			$this->MSSQL->bind(':code', $Code, PDO::PARAM_STR);
			$res = $this->MSSQL->resultSet(true);
			foreach ($res as $data) {
				$this->fet = $data;
				$this->NumOfUses = $data['NumOfUses'];
				$this->MaxUses = $data['MaxUses'];
				$this->Points = $data['Points'];
			}
			
		}
		
		public function validations() {
			$this->MSSQL->query('SELECT * FROM PS_UserData.dbo.Users_Master WHERE UserUID=:uid');
			$this->MSSQL->bind(':uid', $this->User['UserUID']);
			$this->MSSQL->execute();
			$fet = $this->MSSQL->single(true);
			$NewPoints = $fet['Point'] + $this->Points;
			
			$this->MSSQL->query(' UPDATE PS_UserData.dbo.Users_Master SET Point=:point WHERE UserUID=:uid');
			$this->MSSQL->bind(':point', $NewPoints);
			$this->MSSQL->bind(':uid', $this->User['UserUID']);
			$this->MSSQL->execute();
			
			$NewNumOfUses = $this->NumOfUses + 1;
			
			$this->MSSQL->query(' UPDATE ' . $this->MSSQL->getTable('SH_PROMOS') . ' SET Used=:used,NumOfUses=:num WHERE Code=:code');
			$this->MSSQL->bind(':used', 1);
			$this->MSSQL->bind(':num', $NewNumOfUses);
			$this->MSSQL->bind(':code', $this->Code);
			$this->MSSQL->execute();
			
			$sql = ('
                                    INSERT INTO ' . $this->MSSQL->getTable('SH_PROMOS_LOGS') . '
                                    (Code,UserUID,UserID)
                                    VALUES (?,?,?)
            ');
			$stmt = $this->MSSQL->connect()->prepare($sql);
			$stmt->bindParam(1, $this->Code, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->User['UserUID'], PDO::PARAM_INT);
			$stmt->bindParam(3, $this->User['UserID'], PDO::PARAM_STR);
			$stmt->execute();
		}
	}