<?php

class menuModelWidget extends Model {
    public function __construct() {
        parent::__construct();
    }

    public function getMenus(){
        $data = $this->db->query("SELECT * FROM `" . DbPREFIX . "menus`");
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMenu($menu){
        $data = $this->db->query("SELECT * FROM `" . DbPREFIX . "menus` WHERE `position` = '{$menu}'");
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMenuConfig(){
        $data = $this->db->query("SELECT * FROM `" . DbPREFIX . "menuConfig`");
       return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function getSiteInfo() {
        $data = $this->db->query("SELECT * FROM `" . DbPREFIX . "siteInfo`");
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }
    
}