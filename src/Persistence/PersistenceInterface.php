<?php
/**
 * Created by PhpStorm.
 * User: bancuadrian
 * Date: 12/3/15
 * Time: 2:11 PM
 */

namespace BancuAdrian\MysqlBackup\Persistence;


interface PersistenceInterface
{
    /**
     * @param string $database
     * @param string $suffix
     * @throws \Exception
     * @return null
     */
    public function persist($database,$suffix);

    /**
     * Reads a file and returns the result
     * @param string $filename
     * @return string
     */
    public function read($filename);

    public function getPath();
}