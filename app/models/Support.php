<?php
	
	class Support {
		public $fet;
		public $Status;
		public $row;
		
		public function __construct() {
			$this->MSSQL = new Classes\DB\MSSQL;
			$this->Data = new Classes\Utils\Data;
			$this->User = new Classes\Utils\User;
			$this->User->run();
			$this->User = $this->User->_fetch_User();
			$this->getTickets();
		}
		
		public function getTickets() {
			$this->MSSQL->query('SELECT * FROM ' . $this->MSSQL->getTable('SH_TICKETS') . ' WHERE UserUID=:uid AND Main=:main ORDER BY Date ASC');
			$this->MSSQL->bind(':uid', $this->User['UserUID']);
			$this->MSSQL->bind(':main', 1);
			$res = $this->MSSQL->resultSet(true);
			$this->fet	=	$res;
		}
		public function getStatus($Status) {
			$this->Status	=	$this->Data->_do('tracker',$Status);
			return $this->Status;
		}
		public function editTicket($UserUID,$TicketID) {
			$this->MSSQL->query('SELECT *
					FROM ShaiyaCMS.dbo.TICKETS
					WHERE UserUID=:uid AND ticketID=:tid
					ORDER BY Date ASC');
			$this->MSSQL->bind(':uid', $UserUID);
			$this->MSSQL->bind(':tid', $TicketID);
			$res = $this->MSSQL->resultSet(true);
			$this->row	=	$res;
		}
	}