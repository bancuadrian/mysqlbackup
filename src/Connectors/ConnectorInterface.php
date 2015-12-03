<?php
/**
 * Created by PhpStorm.
 * User: bancuadrian
 * Date: 12/3/15
 * Time: 11:11 AM
 */

namespace MysqlBackup\Connectors;


interface ConnectorInterface
{
    /**
     * Returns dump from the database
     * @param string $database
     * @throws ConnectorException
     * @return string
     */
    public function getDump($database);
}