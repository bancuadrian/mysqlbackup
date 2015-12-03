<?php
/**
 * Created by PhpStorm.
 * User: bancuadrian
 * Date: 12/3/15
 * Time: 3:58 PM
 */

namespace MysqlBackup\Dumpers;


interface DumperInterface
{
    /**
     * Returns dump from the database
     * @param string $database
     * @throws Exception
     * @return string
     */
    public function getDump($database);
}