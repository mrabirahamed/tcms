<?php

class Database extends PDO {
    public function __construct($host, $db, $user, $pass, $char) {
        parent::__construct(
            'mysql:host='. $host .';dbname=' . $db, $user, $pass,
            array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $char
            ));

        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $this->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
}