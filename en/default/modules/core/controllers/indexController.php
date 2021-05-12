<?php

class indexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->setJs(array('index'));
        $this->view->assign('title', 'Home');
        $this->view->render('index', 'Home');
    }
}
