<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Classes\Utils as Utils;

class Support extends Model
{
    protected $table;

    public $fet;
    public $Status;
    public $row;

    public function __construct()
    {
        $this->table = table('SH_TICKETS');

        $this->db = new \Classes\DB\MSSQL;
        $this->data = new Utils\Data;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
        $this->user->fetchUser();
        //$this->getTickets();
    }

    public function getTickets()
    {
        $tickets = self::select()
            ->where('UserUID', $this->user->UserUID)
            ->where('Main', 1)
            ->orderBy('Date', 'ASC')
            ->get();
        return $tickets;

        /* $this->MSSQL->query('SELECT * FROM ' . $this->MSSQL->getTable('SH_TICKETS') . ' WHERE UserUID=:uid AND Main=:main ORDER BY Date ASC');
        $this->MSSQL->bind(':uid', $this->User['UserUID']);
        $this->MSSQL->bind(':main', 1);
        $res = $this->MSSQL->resultSet(true);
        $this->fet = $res; */
    }

    public function getStatus($Status)
    {
        $this->Status = $this->data->do('tracker', $Status);
        return $this->Status;
    }

    public function editTicket($UserUID, $TicketID)
    {
        $this->db->query('SELECT *
					FROM ShaiyaCMS.dbo.TICKETS
					WHERE UserUID=:uid AND ticketID=:tid
					ORDER BY Date ASC');
        $this->db->bind(':uid', $UserUID);
        $this->db->bind(':tid', $TicketID);
        $res = $this->db->resultSet(true);
        $this->row = $res;
    }
}
