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
            $config = config['database'];
            // Set DSN
            $dsn = 'sqlsrv:Server=' . $config['host'] . ';Database=' . $config['name'];

            // Create PDO instance
            try {
                $this->dbh = new PDO($dsn, $config['user'], $config['pass'], $config['options']);
            } catch (\PDOException $e) {
                $this->error = $e->getMessage();
                throw new \Classes\Exception\SystemException($e->getMessage(), 0, 0, __FILE__, __LINE__);
            }

            $this->initEloquent();

            return $this->dbh;
        }

        public function initEloquent()
        {
            $config = config['database'];

            $capsule = new Capsule;

            $capsule->addConnection([
                'driver' => $config['driver'],
                'host' => $config['host'],
                'database' => $config['name'],
                'username' => $config['user'],
                'password' => $config['pass']
            ]);

            // Make this Capsule instance available globally via static methods
            $capsule->setAsGlobal();

            // Setup the Eloquent ORM
            $capsule->bootEloquent();
        }
    }
