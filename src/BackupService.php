<?php
/**
 * Created by PhpStorm.
 * User: bancuadrian
 * Date: 12/4/15
 * Time: 1:46 PM
 */

namespace BancuAdrian\MysqlBackup;

use BancuAdrian\MysqlBackup\Dumpers\SimpleDumper;
use BancuAdrian\MysqlBackup\Persistence\FilePersistence;

class BackupService
{
    public static function backup($user = null,$password = null,$databases = null,$path = '')
    {
        $bm = new BackupManager(
            new SimpleDumper($user,$password),
            new FilePersistence($path)
        );

        $bm->setDatabases($databases);

        return $bm->backupAll();
    }
}