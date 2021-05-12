<?php

class officeController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->setModuleTemplate('office');
        $this->access_init();
    }

    public function index()
    {
    }
}