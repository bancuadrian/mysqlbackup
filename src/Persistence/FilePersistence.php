<?php
/**
 * Created by PhpStorm.
 * User: bancuadrian
 * Date: 12/3/15
 * Time: 5:41 PM
 */

namespace MysqlBackup\Persistence;


class FilePersistence implements PersistenceInterface
{
    /**
     * Saves a new file and returns the name
     *
     * @param string $contents
     * @throws \Exception
     * @return string
     */
    public function persist($contents)
    {
        $filename = date("YmdHis")."_".uniqid();

        file_put_contents($filename,$contents);

        return $filename;
    }

    /**
     * Reads a file and returns the result
     * @param string $filename
     * @return string
     */
    public function read($filename)
    {
        return file_get_contents($filename);
    }
}