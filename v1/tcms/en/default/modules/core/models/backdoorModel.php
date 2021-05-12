<?php

class backdoorModel extends Model {

    public function __construct(){
        parent::__construct();
    }

    public function notifications(){
        $data = $this->db->query("SELECT * FROM `" . DbPREFIX . "trackActivities` ORDER BY ID DESC LIMIT 5");
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inputClientData($sql){
        return $this->db->query($sql);
    }
}