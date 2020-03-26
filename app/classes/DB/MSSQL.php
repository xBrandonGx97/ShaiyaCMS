<?php

namespace Classes\DB;

use \PDO;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Exceptions\DatabaseException;

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
            throw new DatabaseException($e->getMessage());
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
