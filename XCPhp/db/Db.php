<?php


namespace XCPhp\db;
use PDOException;
use PDO;

class Db
{
    private static $pdo = null;
    public static function pdo()
    {
        if(self::$pdo !== null)
        {
            return self::$pdo;
        }else{
            try{
                $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8', DB_HOST, DB_NAME);
                $option = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
                return self::$pdo = new PDO($dsn,DB_USER,DB_PASS,$option);
            }catch (PDOException $e){
                exit($e->getMessage());
            }
        }
    }
}