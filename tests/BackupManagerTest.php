<?php

/**
 * Created by PhpStorm.
 * User: bancuadrian
 * Date: 12/3/15
 * Time: 10:24 AM
 */
class BackupManager extends PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $this->assertInstanceOf('MysqlBackup\BackupManager',new \MysqlBackup\BackupManager());
    }
}