<?php

   namespace Classes\DB;

   if (!defined('IN_CMS')) {
       die('<b>' . __NAMESPACE__ . '\queryBuilder</b>: unauthorized access detected, exiting...');
   }

    class queryBuilder
    {
        private $connection;

        private $as;
        private $join;
        private $joinQuery;
        private $from;
        private $params;
        private $table;
        private $ret;
        private $columns;
        private $values;
        private $where;
        private $andWhere;
        private $orWhere;
        private $whereIn;
        private $groupBy;
        private $order;
        private $binds = [];
        private $update;
        private $delete;

        private $stmt;

        public function __construct($connection)
        {
            $this->connection = $connection;
        }

        /*
          Usage:
          $select = MSSQL::query()->select('UserID,Status')->from('WEB_PRESENCE')->get();

          - Select columns from a table
        */

        public function select($params = [])
        {
            $this->queryType = 'SELECT';
            $this->params = $params;
            return $this;
        }

        /*
          Usage:
          $select = MSSQL::query()->select('UserID,Status')->from('WEB_PRESENCE')->get();

          - Calls a table to select from
        */

        public function from($table)
        {
            $this->table = MSSQL::getTable($table);
            $this->from = 'FROM';

            return $this;
        }

        /*
           Usage:
           $select = MSSQL::query()->table('NEWS')->insert($array);

           - Calls a table to perform a action on
        */

        public function table($table)
        {
            $this->table = MSSQL::getTable($table);

            return $this;
        }

        /*
           Usage:
           $select = MSSQL::query()->select('WP.UserID,WP.Status')->from('WEB_PRESENCE')->as('WP')->join('SH_USERDATA', 'WP.UserID', 'UM.UserID', 'UM')->get();

           - Join another table into the query
        */

        public function join($join, $column1, $column2, $as, $left = false)
        {
            if ($left) {
                $this->join = 'LEFT JOIN';
            } else {
                $this->join = 'INNER JOIN';
            }
            $this->joinQuery = MSSQL::getTable($join) . ' AS' . ' ' . $as . ' ON' . ' ' . $column1 . ' =' . ' ' . $column2;
            return $this;
        }

        /*
           Usage:
           $select = MSSQL::query()->select('UserID,Status')->from('WEB_PRESENCE')->as('N')->get();

           - Defines table as a specific name
        */

        public function as($as)
        {
            $this->as = 'AS' . ' ' . $as;
            return $this;
        }

        /*
           Usage:
           $users = MSSQL::query()
            ->table('NEWS')
            ->update('Detail', 'test467')
            ->update('UserID', 'newUser', ',')
            ->where('Title', 'test1113');

           - Updates a table
        */

        public function update($key, $value, $logic = null)
        {
            $this->queryType = 'UPDATE';

            // $this->update = "SET " . $key . " = " . $value";
            if (!$logic) {
                $this->update = 'SET ' . $key . ' = ' . $value;
            //$this->update = 'SET ' . $key . " = '" . $value . "'";
            } else {
                $this->update = $this->update . ', ' . $key . " = '" . $value . "'";
            }

            return $this;
        }

        /*
            Usage:
            $users = MSSQL::query()
            ->table('NEWS')
            ->delete()
            ->where('Title', 'testTitle');

            - Deletes a row from a table
        */

        public function delete()
        {
            $this->queryType = 'DELETE';
            $this->delete = ' FROM';
            return $this;
        }

        /*
           Usage:
           $array = [
                'column1' => 'value1',
                'column2' => 'value2'
           ];
           $select = MSSQL::query()->table('NEWS')->insert($array);
        */

        public function insert($array)
        {
            /* $this->queryType = 'INSERT INTO ';
            $this->table = MSSQL::getTable($table);

            return $this; */

            $this->queryType = 'INSERT INTO ';
            $this->columns = array_keys($array);
            $this->values = array_values($array);

            $this->stmt = $this->connection->prepare($this->buildQuery());
            //var_dump($this->stmt);

            $this->ret = $this->stmt->execute();
            return $this->ret;
        }

        /*
            Unused
        */
        public function columns($columns)
        {
            $params = explode(', ', $columns);
            $columns = func_get_args($params);

            $columns = implode(',', $columns);

            $this->columns = ' ' . '(' . $columns . ')';
            return $this;
            // (UserID,Pw)
        }

        /*
            Unused
        */

        public function values($values)
        {
            $params = explode(', ', $values);
            $values = func_get_args($params);

            $values = "'" . implode("', '", $values) . "'";

            $this->values = ' ' . 'VALUES(' . $values . ')';
            return $this;

            // values(?,?)
        }

        /*
            Usage:
            $select = MSSQL::query()->select('UserID, Status')->from('WEB_PRESENCE')->groupBy('UserID','Status')->get();
        */
        public function groupBy($columns)
        {
            $params = explode(', ', $columns);
            $columns = func_get_args($params);

            $columns = implode(',', $columns);

            $this->groupBy = 'GROUP BY ' . $columns;
            return $this;

            // group by
        }

        /*
            Usage:
            $select = MSSQL::query()->select('UserID, Status')->from('WEB_PRESENCE')->orderBy('Status','DESC')->get();

            Options:
            DESC
            ASC
        */

        public function orderBy($column, $order)
        {
            $this->order = 'ORDER BY ' . $column . ' ' . $order;

            return $this;

            // order by
        }

        /*
            Unused
        */

        public function min()
        {
        }

        /*
            Unused
        */
        public function max()
        {
        }

        /*
            Usage:
            $select = MSSQL::query()->select('UserID, Status')->from('WEB_PRESENCE')->where('UserID', 'Brandon', 'LIKE')->get();
            $select = MSSQL::query()->select('UserID, Status')->from('WEB_PRESENCE')->where('UserID', ['Brandon', 'Velocity'], 'IN'), 'IN')->get();

            Options:
            LIKE
            OR LIKE
            IN
            OR IN
            AND
            OR
        */

        public function where($key, $value, $logic = null)
        {
            if (!is_array($value)) {
                $value = explode(', ', $value);
                if ($logic === 'LIKE' || $logic === 'OR LIKE') {
                    $value = "'%" . implode("', '", $value) . "%'";
                } else {
                    $value = implode("', '", $value);

                    if (substr($value, 0, 1) === ':') {
                        $value = explode(', ', $value);

                        $value = implode("', '", $value);

                        echo 'value: ' . $value;
                    } else {
                        $value = explode(', ', $value);

                        $value = "'" . implode("', '", $value) . "'";
                    }
                }
            } else {
                $value = "'" . implode("', '", $value) . "'";
            }

            if ($logic === 'IN') {
                $this->where = 'WHERE ' . $key . ' IN' . ' ' . '(' . $value . ')';
            } elseif ($logic == 'OR IN') {
                if ($this->where) {
                    $this->where = $this->where . ' OR ' . $key . ' IN' . ' ' . '(' . $value . ')';
                } else {
                    $this->where = 'OR ' . $key . ' IN' . ' ' . '(' . $value . ')';
                }
            } elseif ($logic == 'LIKE') {
                $this->where = 'WHERE ' . $key . ' LIKE' . ' ' . $value . '';
            } elseif ($logic == 'OR LIKE') {
                if ($this->where) {
                    $this->where = $this->where . ' OR ' . $key . ' LIKE' . ' ' . $value . '';
                } else {
                    $this->where = 'OR ' . $key . ' LIKE' . ' ' . $value . '';
                }
            } else {
                $this->where = ((!isset($logic)) ? 'WHERE ' : (isset($this->where) ? $this->where . ' ' : '') . $logic . ' ') . $key . ' ' . '=' . ' ' . $value;
            }

            if ($this->queryType === 'UPDATE') {
                $this->stmt = $this->connection->prepare($this->buildQuery());
                var_dump($this->stmt);
                echo 'update: ' . $this->update;
                if ($this->binds) {
                    foreach ($this->binds as $key => $bind) {
                        $this->stmt->bindValue($key, $bind['value'], $bind['type']);
                    }
                }

                $this->ret = $this->stmt->execute();
                return $this->ret;
            } elseif ($this->queryType === 'DELETE') {
                $this->stmt = $this->connection->prepare($this->buildQuery());
                //var_dump($this->stmt);
                echo 'update: ' . $this->update;

                $this->ret = $this->stmt->execute();
                return $this->ret;
            }

            return $this;
        }

        /*
            Usage:
            $select = MSSQL::query()->select('UserID, Status')->from('WEB_PRESENCE')->where('UserID', :user)->bind(':user', 'Brandon')->get();
        */

        public function bind($key, $value, $type = null)
        {
            if (is_null($type)) {
                switch (true) {
                    case is_int($value):
                        $type = \PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = \PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = \PDO::PARAM_NULL;
                        break;
                    default:
                        $type = \PDO::PARAM_STR;
                }
            }

            $this->binds[$key] = ['value' => $value, 'type' => $type];

            return $this;
        }

        /*
            Unused
        */

        public function getSqlQuery()
        {
            if (!$this->as) {
                $this->as = '';
            } elseif (!$this->join) {
                $this->join = '';
            } elseif (!$this->joinQuery) {
                $this->joinQuery = '';
            } elseif (!$this->from) {
                $this->from = '';
            } elseif (!$this->params) {
                $this->params = '';
            } elseif (!$this->table) {
                $this->table = '';
            } elseif (!$this->columns) {
                $this->columns = '';
            } elseif (!$this->values) {
                $this->values = '';
            } elseif (!$this->where) {
                $this->where = '';
            }
            return $this->queryType . ' ' . $this->params . ' ' . $this->from . ' ' . $this->table . ' ' . $this->where . ' ' . $this->andWhere . ' ' . $this->orWhere . $this->columns . $this->values . ' ' . $this->as . ' ' . $this->join . ' ' . $this->joinQuery;
        }

        /*
           - Builds query together into one
        */

        public function buildQuery()
        {
            // find a way to process spacing only if variable has data
            if (!$this->as) {
                $this->as = '';
            } elseif (!$this->join) {
                $this->join = '';
            } elseif (!$this->joinQuery) {
                $this->joinQuery = '';
            } elseif (!$this->from) {
                $this->from = '';
            } elseif (!$this->params) {
                $this->params = '';
            } elseif (!$this->table) {
                $this->table = '';
            } elseif (!$this->columns) {
                $this->columns = '';
            } elseif (!$this->values) {
                $this->values = '';
            } elseif (!$this->where) {
                $this->where = '';
            } elseif (!$this->order) {
                $this->order = '';
            }

            if ($this->columns) {
                $columns = implode(',', $this->columns);

                $this->columns = ' ' . '(' . $columns . ')';

                echo $this->columns;
            }

            if ($this->values) {
                $values = "'" . implode("', '", $this->values) . "'";

                $this->values = ' ' . 'VALUES(' . $values . ')';

                echo $this->values;
            }

            $query = $this->queryType . $this->delete . ' ' . $this->params . ' ' . $this->from . ' ' . $this->table . ' ' . $this->as . ' ' . $this->update . ' ' . $this->columns . $this->values . ' ' . $this->join . ' ' . $this->joinQuery . ' ' . $this->where . ' ' . $this->groupBy . ' ' . $this->order;

            return $query;
        }

        /*
           Usage:
           $select = MSSQL::query()->select('UserID, Status')->from('WEB_PRESENCE')->get();

           - Gets results from query
        */

        public function get($type = null)
        {
            // if not select then dont run command here
            if ($this->queryType == 'SELECT') {
                $this->stmt = $this->connection->prepare($this->buildQuery());
                if ($this->binds) {
                    foreach ($this->binds as $key => $bind) {
                        $this->stmt->bindValue($key, $bind['value'], $bind['type']);
                    }
                }
                //var_dump($this->stmt);
                $this->stmt->execute();
                if ($type === 'single') {
                    $fetch = $this->stmt->fetch();
                } elseif ($type === 'singleObject') {
                    $fetch = $this->stmt->fetch(\PDO::FETCH_OBJ);
                } elseif ($type === 'object') {
                    $fetch = $this->stmt->fetchAll(\PDO::FETCH_OBJ);
                } elseif ($type === 'array') {
                    $fetch = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
                } else {
                    $fetch = $this->stmt->fetchAll();
                }
                return $fetch;
            }
        }

        /*
            Unused
        */

        public function save()
        {
            if ($this->queryType == 'INSERT INTO ') {
                $this->stmt = $this->connection->prepare($this->buildQuery());
                //var_dump($this->stmt);

                $this->ret = $this->stmt->execute();
                return $this->ret;
            }
        }

        /*
            Unused
        */
        public function ifExecuted()
        {
        }
    }
