<?php
include_once __DIR__ . "\..\includes/config.php";

class db
{
    private static $connection;

    private function __construct()
    {
        self::$connection = new PDO('mysql:host=' . _SERVER . ';dbname=' . _DBname . ';charset=utf8', _UserName, _PassWord);
        self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        date_default_timezone_set('Asia/Gaza');
    }

    /**
     * this function initialised the connection if not exist, then return it
     *
     * @return PDO connection
     */
    public static function getConnection()
    {
        if (self::$connection == null)
            new self();
        return self::$connection;

    }

    /**
     * @param $table : name
     * @param $parameters : this parameter must be an accusative array with name and value to insert
     * @return bool: insert status
     */
    public static function insert($table, $parameters)
    {
        //this statement will be like( insert into $table (name) values(:name))
        $sql = sprintf('Insert into %s (%s) values (:%s)'
            , $table,
            implode(', ', array_keys($parameters)),
            implode(', :', array_keys($parameters))
        );
        $statement = self::getConnection()->prepare($sql);
        $boolean = $statement->execute($parameters);
        if ($boolean)
            return true;
        else
            return false;
    }

    /**
     * @param $table
     * @param $parameters : this parameter must be an accusative array with name and value to update
     * @param $id
     * @return bool:update status
     */
    public static function update($table, $parameters, $id)
    {
        //this function will return an array with $key and $value but in one variable
        //Ex:['name'=>'Algeneral'] the returned array will be [0=>'name=:obayda']
        $array = array_map(function ($key) {
            return $key . "=:" . $key;
        }, array_keys($parameters));
        //implode all array variable with ',' to put it in update query
        $array = implode(', ', $array);

        $sql = sprintf('Update %s Set %s where id=:id'
            , $table, $array, $id
        );
        $parameters['id'] = $id;
        $statement = self::getConnection()->prepare($sql);
        $boolean = $statement->execute($parameters);
        return $boolean;
    }

    /**
     * for delete function, there's no delete,we just use softDelete by change the active status to -1
     *
     * @param $table
     * @param $id
     * @return bool
     */
    public static function delete($table, $id)
    {
        return self::update($table, ['active' => -1], $id);
    }

    /**
     * @param $table
     * @param null $where :this is where close,the programmer can enter 1 where close like "id=1"
     * @param int $active : item status,the default is 2 that retrieve active and not active data
     * @return array :the fetched data,it can be an empty array if there's no data
     */
    public static function FetchData($table, $where = null, $active = 2)
    {

        $operator = $active == 2 ? '<>' : '=';
        $active = $active == 2 ? '-1' : $active;
        $where = $where != null ? ' and ' . $where : '';
        $data = [];
        $sql = sprintf("select * from %s where active%s:active %s", $table, $operator, $where);
        $statement = self::getConnection()->prepare($sql);
        $statement->execute(['active' => $active]);
        $data = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * this function is for fetching query that programmer enter
     *
     * @param $sql :the query
     * @param null $id :if there's an id
     * @return array
     */
    public static function FetchQuery($sql, $id = null)
    {
        $data = [];
        $bindingData = $id != null ? ['id' => $id] : [];
        $statement = self::getConnection()->prepare($sql);
//        dd($sql);
        $statement->execute($bindingData);
        while ($row = $statement->fetch(PDO::FETCH_BOTH)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * this function get last recode inserted in specific table
     *
     * @param $table
     * @return array
     */
    public static function LastRecord($table)
    {
        $sql = sprintf("Select * from %s  where active <> -1 order by id desc limit 1", $table);
        $statement = self::getConnection()->prepare($sql);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * this function get data with limit like from 10 to 20
     *
     * @param $table
     * @param $from :10 for example
     * @param $to : 20 for example
     * @param int $active : item status,the default is 2 that retrieve active and not active data
     * @return array
     */
    public static function FetchWithLimit($table, $from, $to, $active = 2)
    {
        $operator = $active == 2 ? '<>' : '=';
        $active = $active == 2 ? '-1' : $active;
        $sql = sprintf("select * from %s where active%s:active order by id limit :start , :pre", $table, $operator);
        $statement = self::getConnection()->prepare($sql);
        $statement->bindParam(':active', $active, PDO::PARAM_INT);
        $statement->bindParam(':start', $from, PDO::PARAM_INT);
        $statement->bindParam(':pre', $to, PDO::PARAM_INT);
        $statement->execute();
        $data = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * this function check if there's data like an email then return a filed that user choose it
     *
     * @param $table
     * @param $keyToSearch : like email
     * @param $valueToSearch :like obayda@hotmail.com
     * @param string $returnedFiled : what filed programmer need to return,
     * @param int $active : item status,the default is 2 that retrieve active and not active data
     * @return null if there's no data ,attribute if there's
     */
    public static function checkIfExist($table, $keyToSearch, $valueToSearch, $returnedFiled = "id", $active = 2)
    {
        $operator = $active == 2 ? '<>' : '=';
        $active = $active == 2 ? '-1' : $active;
        $sql = sprintf("select * from %s where %s=:%s and active%s:active", $table, $keyToSearch, $keyToSearch, $operator);
        $statement = self::getConnection()->prepare($sql);
        $statement->execute([$keyToSearch => $valueToSearch, "active" => $active]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($statement->rowCount() != 0) {
            return $row[$returnedFiled];
        }
        return null;
    }

    /**
     * return value of specific attribute
     *
     * @param $attribute
     * @param $table
     * @param $indicator : value of attribute
     * @param string $where :attribute name
     * @return array
     */
    public function GetAttribute($attribute, $table, $indicator, $where = 'id')
    {
        $sql = sprintf("select %s from %s where %s=:%s", $attribute, $table, $where, $where);
        $statement = self::getConnection()->prepare($sql);
        $statement->execute([$where => $indicator]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $row[$attribute];
    }
}