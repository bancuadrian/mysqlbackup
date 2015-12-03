<?php

require "vendor/autoload.php";

$bm = new \MysqlBackup\BackupManager(
    new \MysqlBackup\Dumpers\SimpleDumper("vagrant","vagrant"),
    new \MysqlBackup\Persistence\FilePersistence('/home/vagrant/')
);

$bm->backup('bancu.io');