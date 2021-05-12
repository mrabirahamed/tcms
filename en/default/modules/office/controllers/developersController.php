<?php

class developersController extends officeController
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
        $this->view->assign('title', 'Developers');
        $this->view->render('index', 'Developers');
    }
}
