<?php

return [
    /**
     *  -----------------------------------------
     *  define the user that has access to the
     *  databases that you want to backup
     * -----------------------------------------
     */
    "usr" => "vagrant",
    /*
     *  -----------------------------------------
     *  define the password for connecting to mysql
     *  -----------------------------------------
     */
    "pwd" => "vagrant",
    /*
     *  -----------------------------------------
     *  set the absolute path where you want to
     *  backup you databases. it MUST end with a
     *  trailing slash "/" . Example :
     *  /var/www/project/backup_folder/
     *  -----------------------------------------
     */
    "absolute_path" => "",
    /*
     *  -----------------------------------------
     *  define an array of databases that you
     *  want to backup
     *  -----------------------------------------
     */
    "databases" => ['database1','database2']
];