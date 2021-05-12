<?php

class Setting {
    private static $db;
    private static $base_url;
    private static $checkedurl;
    public static $hosturl;
    public static $init;

    public static function init() {
        if (!self::$init instanceof self) {
            self::$init = new Setting();
        }

        self::$db = new Database(DbHOST, DbNAME, DbUSER, DbPASS, DbCHAR);
        self::$hosturl = $_SERVER['HTTP_HOST'];
        self::$checkedurl = self::checkedadd();
        self::$base_url = self::$checkedurl;
        return self::$init;
    }

    public static function siteName() {
        $result = self::query("SELECT `name` FROM `" . DbPREFIX . "siteInfo`");
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['name'];
    }

    public static function siteDescription() {
        $result = self::query("SELECT `description` FROM `" . DbPREFIX . "siteInfo`");
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['description'];
    }

    public static function siteCompany() {
        $result = self::query("SELECT `company` FROM `" . DbPREFIX . "siteInfo`");
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['company'];
    }

    public static function siteHostAdd() {
        $result = self::query("SELECT `http_host_add` FROM `" . DbPREFIX . "siteInfo`");
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['http_host_add'];
    }

    public static function siteHostIP() {
        $result = self::query("SELECT `http_host_ip` FROM `" . DbPREFIX . "siteInfo`");
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['http_host_ip'];
    }

    public static function siteDefaultLayout() {
        $result = self::query("SELECT `default_layout` FROM `" . DbPREFIX . "siteInfo`");
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['default_layout'];
    }

    public static function siteFevicon() {
        $result = self::query("SELECT `favicon` FROM `" . DbPREFIX . "siteInfo`");
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['favicon'];
    }

    public static function checkedadd() {
        if (is_numeric(self::getAlphaNum(self::$hosturl))) {
            return self::siteHostIP();
        } else {
            return self::siteHostAdd();
        }
    }

    private static function getAlphaNum($value) {
        if (isset($value) && !empty($value)) {
            $value = (string)preg_replace('/[^A-Z0-9_]/i', '', $value);
            return trim($value);
        }
    }

    private static function query($sql) {
        try {
            if (self::$db) {
                return self::$db->query($sql);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}