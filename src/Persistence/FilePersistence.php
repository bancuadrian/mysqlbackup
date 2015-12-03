<?php
/**
 * Created by PhpStorm.
 * User: bancuadrian
 * Date: 12/3/15
 * Time: 5:41 PM
 */

namespace BancuAdrian\MysqlBackup\Persistence;


class FilePersistence implements PersistenceInterface
{
    protected $path;

    public function __construct($path = '')
    {
        $this->path = $path;
    }

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

        file_put_contents($this->path.$filename,$contents);

        return $this->path.$filename;
    }

    /**
     * Reads a file and returns the result
     * @param string $filename
     * @return string
     */
    public function read($filename)
    {
        return file_get_contents($this->path.$filename);
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}