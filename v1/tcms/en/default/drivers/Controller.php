<?php

abstract class Controller {

    private $registry;
    protected $view;
    protected $acl;
    protected $request;

    public function __construct() {
        $this->registry = Registry::getInstance();
        $this->acl = $this->registry->acl;
        $this->request = $this->registry->request;
        $this->view = new View($this->request, $this->acl);
    }

    abstract public function index();

    protected function access_init() {
        if (!Session::get('auth')) {
            $this->redirect('user/login?redirect=' . $this->getNextURL($_SERVER['REQUEST_URI']));
        }
    }

    protected function loadModel($model, $module = FALSE) {
        $model = $model . 'Model';
        $rootModel = ModulesDIR . 'core' . DS . 'models' . DS . $model . '.php';

        if (!$module) {
            $module = $this->request->getModule();
        }

        if ($module) {
            if ($module !== 'core') {
                $rootModel = ModulesDIR . $module . DS . 'models' . DS . $model . '.php';
            }
        }

        if (is_readable($rootModel)) {
            require_once $rootModel;
            $model = new $model;
            return $model;
        } else {
			Tracker::addEvent(array( 'activity' => array('messageType' => 'error', 'message' => 'Required Model not found or could not load.')));
            throw new Exception('Required Model not found or could not load.');
        }
    }

    protected function getLibrary($library) {
        $rootLibrary = LibraryDIR . 'class.' . $library . '.module';
        if (is_readable($rootLibrary)) {
            require_once $rootLibrary;
            $library = new $library;
            return $library;
        } else {
			Tracker::addEvent(array( 'activity' => array('messageType' => 'error', 'message' => 'Library files not found or could not load.')));
            throw new Exception('Library files not found or could not load.');
        }
    }

    protected function getText($value) {
        if (isset($_POST[$value]) && !empty($_POST[$value])) {
            $_POST[$value] = htmlspecialchars($_POST[$value], ENT_QUOTES);
            return $_POST[$value];
        }
        return '';
    }

    protected function getTextnonPOST($value) {
        if (isset($value) && !empty($value)) {
            $value = htmlspecialchars($value, ENT_QUOTES);
            return $value;
        }
        return '';
    }

    protected function getInt($value) {
        if (isset($_POST[$value]) && !empty($_POST[$value])) {
            $_POST[$value] = filter_input(INPUT_POST, $value, FILTER_VALIDATE_INT);
            return $_POST[$value];
        }
        return 0;
    }

    protected function redirect($url = FALSE) {
        if (!empty($url) || !$url === ' ') {
            header('location:' . BaseURL . $url);
            exit;
        } else {
            header('location:' . BaseURL);
            exit;
        }
    }

    protected function redirectURI($url = FALSE) {
        if (!empty($url) || !$url === ' ') {
            header('location:' . rtrim(BaseURL, DS) . $url);
            exit;
        } else {
            header('location:' . rtrim(BaseURL, DS));
            exit;
        }
    }

    protected function filterInt($int) {
        $int = (int) $int;

        if (is_int($int)) {
            return $int;
        } else {
            return 0;
        }
    }

    protected function getWordParam($value) {
        if (isset($_POST[$value])) {
            return $_POST[$value];
        }
    }

    protected function getSql($value) {
        if (isset($_POST[$value]) && !empty($_POST[$value])) {
            $_POST[$value] = strip_tags($_POST[$value]);
            return trim($_POST[$value]);
        }
    }

    protected function getAlphaNum($value) {
        if (isset($_POST[$value]) && !empty($_POST[$value])) {
            $_POST[$value] = (string) preg_replace('/[^A-Z0-9_]/i', '', $_POST[$value]);
            return trim($_POST[$value]);
        }
    }

    public function validEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return FALSE;
        }
        return TRUE;
    }

    public function getSearchText($value) {
        if (isset($_GET[$value]) && !empty($_GET[$value])) {
            $_GET[$value] = htmlspecialchars($_GET[$value], ENT_QUOTES);
            return $_GET[$value];
        }
        return '';
    }

    public function expandCamelCase($source) {
        return preg_replace('/(?<!^)([A-Z][a-z]|(?<=[a-z])[^a-z]|(?<=[A-Z])[0-9_])/', ' $1', $source);
    }

    public function findUSERNAME($subject) {
        return preg_replace(DS . AppUsernamePrefix . '/is', '$1', $subject);
    }

    public function getNextURL($url) {
        $homeFOLDER = str_replace(DS, '_', HomeFOLDER);
        $fetchURL = str_replace(DS, '_', $url);
        $data = str_replace($homeFOLDER, '', $fetchURL);
        return $nextURL = str_replace('_', DS, $data);
    }

    public function deleteFolder($folderpath) {
        if(!is_dir(folderpath)){
			Tracker::addEvent(array( 'activity' => array('messageType' => 'error', 'message' => '$folderpath must be a directory.')));
            throw new InvalidArgumentException('$folderpath must be a directory.');
        }
        if(substr($folderpath, strlen($folderpath) -1,1) !== '/'){
            $folderpath = '/';
        }
        $files = glob($folderpath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if(is_dir($file)){
                $this->deleteFolder($file);
            } else {
                unlink($file);
            }
        }
        rmdir($folderpath);
    }
	
	function chmodFileFolder($dir) {
		$perms['file'] = 0644; // chmod value for files don't enclose value in quotes.
		$perms['folder'] = 0755; // chmod value for folders don't enclose value in quotes.
        
		$dh=@opendir($dir);
    
		if ($dh) {

			while (false!==($file = readdir($dh))) {

				if($file!="." && $file!="..") {

					$fullpath = $dir .'/'. $file;
					if(!is_dir($fullpath)) {

						if(chmod($fullpath, $perms['file'])) {
							Tracker::addEvent(array( 'activity' => array('messageType' => 'success', 'message' => '\n<br><span style="font-weight:bold;">File</span> '. $fullpath .' permissions changed to '. decoct($perms['file']))));
							echo "\n<br><span style=\"font-weight:bold;\">File</span> ". $fullpath .' permissions changed to '. decoct($perms['file']);
						}else {
							Tracker::addEvent(array( 'activity' => array('messageType' => 'error', 'message' => '\n<br><span style="font-weight:bold; color:#ff0000;">Failed</span> to set file permissions on '. $fullpath)));
							echo "\n<br><span style=\"font-weight:bold; color:#ff0000;\">Failed</span> to set file permissions on ". $fullpath;
						}
					}else {

						if(chmod($fullpath, $perms['folder'])) {
							Tracker::addEvent(array( 'activity' => array('messageType' => 'success', 'message' => '\n<br><span style="font-weight:bold;">Directory</span> '. $fullpath .' permissions changed to '. decoct($perms['folder']))));
							echo "\n<br><span style=\"font-weight:bold;\">Directory</span> ". $fullpath .' permissions changed to '. decoct($perms['folder']);
							chmod_file_folder($fullpath);
						}else {
							Tracker::addEvent(array( 'activity' => array('messageType' => 'error', 'message' => '\n<br><span style="font-weight:bold; color:#ff0000;">Failed</span> to set directory permissions on '. $fullpath)));
							echo "\n<br><span style=\"font-weight:bold; color:#ff0000;\">Failed</span> to set directory permissions on ". $fullpath;
						}
					}
				}
			}
			closedir($dh);
		}
	}

}
