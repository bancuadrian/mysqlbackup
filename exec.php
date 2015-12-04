<?php

require "vendor/autoload.php";

$backupStatus = \BancuAdrian\MysqlBackup\BackupService::backup('vagrant','vagrant',['database1'],'/path/to/backup');