<?php

class Model
{
    private $registry;
    protected $db;
    public $dbc;

    public function __construct()
    {
        $this->registry = Registry::getInstance();
        $this->db = $this->registry->db;
        $this->dbc = $this->db;
    }

    protected function query($sql)
    {
        try {
            if ($this->db) {
                return $this->db->query($sql);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    protected function prepare($sql)
    {
        try {
            if ($this->db) {
                return $this->db->prepare($sql);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    protected function isTableExistsOnDatabase($table)
    {
        $tbl = $this->query("SHOW TABLES LIKE %" . DbPREFIX . "$table`;");
        if ($tbl->fetch(PDO::FETCH_ASSOC)) {
            return TRUE;
        }
        return FALSE;
    }
}
