<?php

include "config.php";
include "errors.php";

class connection extends errors {

    protected function connect() {
        $serverName = servername;
        $connectionInfo = array("Database" => database, "UID" => uid, "PWD" => pwd, "CharacterSet" => characterset);
        $link = sqlsrv_connect($serverName, $connectionInfo);
        if ($link) {
            return $link;
        } else {
            $this->error = parent::getErrorSql();
            return false;
        }
    }

    protected function disconnect($link) {
        return sqlsrv_close($link);
    }

}
