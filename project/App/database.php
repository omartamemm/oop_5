<?php
 
 namespace App;
 use PDO;
 use PDOException;

 class database{

    private static ?database $instance =null;
    private PDO $connection ;

    private function __construct(array $connect)
    {
        try {
     $dsn="mysql:host={$connect['host_name']};dbname={$connect['db_name']}";
     $this->connection=new PDO($dsn,$connect['user_name'],$connect['password']);

        } catch (PDOException $e) {
            die($e->getMessage());
        }
        
        
    }

    public static function get_instance(array $connect):database{
        if (is_null(self::$instance)){

           self::$instance = new database($connect);
        }
        return self::$instance;
    }
     function get_connect():PDO{
        return $this->connection;
     }
 }
 
    