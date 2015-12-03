<?php
/**
 * Created by PhpStorm.
 * User: bancuadrian
 * Date: 12/3/15
 * Time: 2:11 PM
 */

namespace MysqlBackup\Persistence;


interface PersistenceInterface
{
    /**
     * @param string $database
     * @throws PersistenceException
     * @return null
     */
    public function persist($database);
}