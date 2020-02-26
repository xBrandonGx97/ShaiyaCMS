<?php
    class news {

        public function __construct(){
            $this->MSSQL   =   new Classes\DB\MSSQL;
        }

        public function getNews(){
            $this->MSSQL->query('SELECT * FROM '.$this->MSSQL->getTable('NEWS').' ORDER BY Date DESC');
            $res = $this->MSSQL->resultSet();
            return $res;
        }
    }