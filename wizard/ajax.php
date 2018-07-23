<?php
session_start();
require_once "../classes/db.class.php";

if (isset($_POST['username'])) {
    (new ajax())->index();
}


class ajax
{
    public function index()
    {
        $host = "localhost";
        $RootUsername = "root";
        $RootPassword = "";

        $username = $_POST['username'];
        $password = $_POST['password'] ?? '';
        $dbName = $_POST['dbName'];
        $data = [
            "username" => $username,
            "password" => $password,
            "dbName" => $dbName,
        ];
        try {
            $connection = new PDO('mysql:host=' . $host, $RootUsername, $RootPassword);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //create DB
            $sql = "CREATE DATABASE " . $dbName;
            $connection->exec($sql);
            //create DB user
            $sql = sprintf("CREATE USER '%s'@'%s' IDENTIFIED BY '%s';
                GRANT ALL ON %s.* TO '%s'@'%s'"
                , $username, $host, $password
                , $dbName, $username, $host);
            $connection->exec($sql);
            $this->addDbDataToConfig($data);

            $this->createTablesFromFile();
        } catch (PDOException $exception) {
            //rollback DB creation
            //1007 mean database is exits
            if ($exception->errorInfo[1] != 1007)
                $connection->exec('Drop DATABASE IF EXISTS ' . $dbName);
            if ($exception->errorInfo[1] != 1396)
                $connection->exec('Drop USER IF EXISTS ' . $username);
            echo "false";
            exit();
        }
        $step_count = file_get_contents("step_value.txt");
        $step_count = intval($step_count) + 1;
        file_put_contents("step_value.txt", $step_count);
        echo "true";
    }

    private function addDbDataToConfig($data)
    {
        $text = "<?php
        define('_SERVER', 'localhost');
        define('_UserName', '{$data['username']}');
        define('_PassWord', '{$data['password']}');
        define('_DBname', '{$data['dbName']}');";
        file_put_contents("../includes/config.php", $text);

    }

    private function createTablesFromFile($file = "tables.sql")
    {
        //delay the method for 0.1 to add the tables to new Database
        $sql = file_get_contents($file);
        $statement = db::getConnection()->prepare($sql);
        $statement->execute();
    }
}
