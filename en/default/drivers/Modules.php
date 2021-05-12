<?php

class Modules
{
    protected $db;
    private $HiddenModules;

    public function __construct()
    {
        $this->HiddenModules = CoreApp;
        $this->db = new Database(DbHOST, DbNAME, DbUSER, DbPASS, DbCHAR);
        $this->ModulesCheck();
    }

    public function getModules()
    {
        $m = $this->db->prepare("SELECT `md_name` FROM `" . DbPREFIX . "modules` WHERE `md_status` = 'enable'");
        $m->execute();
        $data = $m->fetchAll(PDO::FETCH_ASSOC);

        $var = array();
        $i = 0;
        while ($i < count($data)) {
            $var[] = $data[$i]['md_name'];
            $i++;
        }

        return $var;
    }

    public function getAllModules()
    {
        $m = $this->db->query("SELECT * FROM `" . DbPREFIX . "modules`");
        $data = $m->fetchAll(PDO::FETCH_ASSOC);

        $var = array();
        $i = 0;
        while ($i < count($data)) {
            $var[] = $data[$i]['md_name'];
            $i++;
        }

        return $var;
    }

    public function rootModule($module)
    {
        return ModulesDIR . 'core' . DS . 'controllers' . DS . $module . 'Controller.php';
    }

    public function ModulesCheck()
    {
        $mod = $this->getAllModules();
        $i = 0;

        while ($i < count($mod)) {
            if (!file_exists($this->rootModule($mod[$i]))) {
                if ($mod[$i] !== $this->HiddenModules) {
                    Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'The root controller of installed module <b>" . $mod[$i] . "</b> is not found.')));
                    throw new Exception("<b>Error:</b> The root controller of installed module <b>" . $mod[$i] . "</b> is not found.");
                }
            }
            $i++;
        }

        foreach (scandir(ModulesDIR, SCANDIR_SORT_ASCENDING) as $dir) {
            if ($dir === '.' or $dir === '..') {
                continue;
            } else {
                if (!in_array($dir, $this->getAllModules())) {
                    if ($dir !== $this->HiddenModules) {
                        Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'The module <b>" . $dir . "</b> is not installed.')));
                        throw new Exception("<b>Error:</b> The module <b>" . $dir . "</b> is not installed.");
                    }
                }
            }
        }
    }

    public function getNewModule()
    {
        foreach (scandir(ModulesDIR, SCANDIR_SORT_ASCENDING) as $dir) {
            if ($dir === "." or $dir === "..") {
                continue;
            } else {
                if (!in_array($dir, $this->getModules())) {
                    if ($dir !== $this->HiddenModules) {
                        if (is_dir($dir)) {
                            return $dir;
                        }
                    }
                }
            }
        }
    }

    private function isModuleEnable($module)
    {
        $mod = $this->db->query("SELECT `md_name` FROM `" . DbPREFIX . "modules` WHERE `md_status` = 'enable' AND `md_name` = '$module'");

        if ($mod->fetch()) {
            return FALSE;
        }

        return TRUE;
    }

    private function isModuleInstalled($module)
    {
        $mod = $this->db->query("SELECT `md_name` FROM `" . DbPREFIX . "modules` WHERE `md_name` = '$module'");

        if ($mod->fetch()) {
            return FALSE;
        }

        return TRUE;
    }

    public static function setDBPREFIX($data)
    {
        $pattern = '/{DB_PREFIX}/';
        $replace = DbPREFIX;

        return preg_replace($pattern, $replace, $data);
    }

    public static function config($db, $filename, $db_prefix = false, $pattern = false)
    {
        if (!$db_prefix) {
            $db_prefix = DbPREFIX;
        }

        if (!$pattern) {
            $pattern = '/{DB_PREFIX}/';
        }

        $templine = '';
        $lines = file($filename); // Read entire file

        foreach ($lines as $line) {
            // Skip it if it's a comment
            if (substr($line, 0, 2) === '--' || $line === '' || substr($line, 0, 2) === '/*')
                continue;

            // Add this line to the current segment
            $templine .= $line;
            // If it has a semicolon at the end, it's the end of the query
            if (substr(trim($line), -1, 1) === ';') {
                $realdata = preg_replace($pattern, $db_prefix, $templine);
                $status = $db->query($realdata);
                if (!$status) {
                    print('Error performing query: \'<strong>' . $realdata . '\'. <br /><br />');
                }
                $templine = '';
            }
        }
    }
}
