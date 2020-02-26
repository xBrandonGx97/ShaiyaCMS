<?php
    class patch_notes {

        public function __construct(){
            $this->MSSQL   =   new Classes\DB\MSSQL;
        }

        public function getPatchNotes(){
            $this->MSSQL->query('SELECT * FROM '.$this->MSSQL->getTable('PATCHNOTES').' ORDER BY Date DESC');
            $res = $this->MSSQL->resultSet();
            return $res;
        }
    }