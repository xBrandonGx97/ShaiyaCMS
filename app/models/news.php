<?php
    class news
    {
        public function __construct()
        {
            $this->MSSQL = new Classes\DB\MSSQL;
        }

        public function getNews()
        {
            $news = $this->MSSQL->query()
                ->select('*')
                ->from('NEWS')
                ->orderBy('Date', 'DESC')
                ->get('object');
            return $news;

            /* $this->MSSQL->query('SELECT * FROM ' . $this->MSSQL->getTable('NEWS') . ' ORDER BY Date DESC');
            $res = $this->MSSQL->resultSet();
            return $res; */
        }
    }
