<?php
/**
 * Created by PhpStorm.
 * User: bancuadrian
 * Date: 12/3/15
 * Time: 3:24 PM
 */

namespace MysqlBackup\Connectors;


final class SimpleMysqlConnector
{
    private static $instance;
    private static $host;
    private static $user;
    private static $password;

    private $connection;
    /**
     * SimpleMysqlConnector constructor.
     * @param mysqli $connection
     */
    private function __construct(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public static function connect($host,$user,$password)
    {
        if(self::$instance && $host == self::$host && $user == self::$user && $password == self::$password)
        {
            return static::$instance;
        }

        $connection = new \mysqli($host,$user,$password);

        if($connection->connect_errno > 0)
        {
            die('Unable to connect to database [' . $db->connect_error . ']');
        }

        static::$host = $host;
        static::$user = $user;
        static::$password = $password;

        self::$instance = new SimpleMysqlConnector($connection);

        return self::$instance;
    }

}