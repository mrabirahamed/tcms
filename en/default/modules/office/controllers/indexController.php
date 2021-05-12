<?php

class indexController extends officeController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->access_init();
        $this->acl->access('system_access');
        $this->view->setJs(array('index'));
        $this->view->assign('title', 'Office');
        $this->view->render('index', 'Office');
    }
}
