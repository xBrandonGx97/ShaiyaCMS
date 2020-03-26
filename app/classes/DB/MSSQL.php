<?php

namespace Classes\DB;

use \PDO;
use Illuminate\Database\Capsule\Manager as Eloquent;
use App\Exceptions\DatabaseException;

class MSSQL
{
    public function __construct()
    {
        $this->connect();
    }

    public function connect(): Eloquent
    {
        // Set DSN
        $dsn = 'sqlsrv:Server=' . DB['host'] . ';Database=' . DB['database'];

        // Create PDO instance
        try {
            $dbh = new PDO($dsn, DB['username'], DB['password'], DB['options']);
        } catch (\PDOException $e) {
            throw new DatabaseException($e->getMessage());
        }

        // Init Eloquent
        $eloquent = new Eloquent;
        $eloquent->addConnection(DB);
        $eloquent->setAsGlobal();
        $eloquent->bootEloquent();

        return $eloquent;
    }
}
