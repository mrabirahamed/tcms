<?php

class productsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getApps()
    {
        $apps = $this->query("SELECT * FROM `" . DbPREFIX . "apps` WHERE `app_status` = 'active' ");
        return $apps->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getForwardedProducts()
    {
        $apps = $this->query("SELECT * FROM `" . DbPREFIX . "apps` WHERE `app_status` = 'active'");
        return $apps->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getQuickAccessProducts()
    {
        $apps = $this->query("SELECT * FROM `" . DbPREFIX . "apps` WHERE `app_status` = 'active' AND `quickAccess` = 'enable'");
        return $apps->fetchAll(PDO::FETCH_ASSOC);
    }
}