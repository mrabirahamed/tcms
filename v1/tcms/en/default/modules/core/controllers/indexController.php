<?php

class indexController extends Controller {

    private $database;
    public function __construct() {
        parent::__construct();
        $this->database = $this->loadModel('backdoor');
    }

    public function index() {
        $this->access_init();
        $this->acl->access('system_access');
        $this->view->setJs(array('index'));
        $this->view->assign('title', 'Home');
        $this->view->render('index', 'Home');
    }
}
