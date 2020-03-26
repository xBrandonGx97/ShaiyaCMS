<?php

namespace Classes\DB;

use \PDO;
use Illuminate\Database\Capsule\Manager as Capsule;

class MSSQL
{
    private $dbh;
    private $error;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        // Set DSN
        $dsn = 'sqlsrv:Server=' . DB['host'] . ';Database=' . DB['name'];

        // Create PDO instance
        try {
            $this->dbh = new PDO($dsn, DB['user'], DB['pass'], DB['options']);
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
            throw new \Classes\Exception\SystemException($e->getMessage(), 0, 0, __FILE__, __LINE__);
        }

        $this->initEloquent();

        return $this->dbh;
    }

    public function initEloquent()
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver' => DB['driver'],
            'host' => DB['host'],
            'database' => DB['name'],
            'username' => DB['user'],
            'password' => DB['pass']
        ]);

        // Make this Capsule instance available globally via static methods
        $capsule->setAsGlobal();

        // Setup the Eloquent ORM
        $capsule->bootEloquent();
    }
}
