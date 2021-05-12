<?php

class searchController extends Controller {
    private $search;

    public function __construct() {
        parent::__construct();
        $this->search = $this->loadModel('search');
        Session::set('Message_Type', 'Success');
        Session::set('Message', 'Successfully visited.');
    }
    public function index() {
        $this->view->setJs(array('index'));
        $this->view->assign('title', 'Searching');

        if ($this->getSearchText('q')) {
            $this->view->assign('q', $_GET);

            if (!$this->getSearchText('q')) {
                $this->view->assign('error', 'Please input any word.');
                $this->view->render('index', 'Search');
                exit;
            }

            $row = $this->search->getWord($this->getSearchText('q'));

            if (!$row) {
                $this->view->assign('error', 'Sorry, but nothing matched your search terms. Please try again with some different keywords.');
                $this->view->render('index', 'Search');
                exit;
            }

            $this->view->assign('data', $row);
        }
        
        $this->view->assign('datas', $this->search->getWords());
        $this->view->render('index', 'Search');
    }
}
