<?php

class brandsController extends Controller
{

    private $brands;

    public function __construct()
    {
        parent::__construct();
        $this->access_init();
        $this->brands = $this->loadModel('brands');
    }

    public function index()
    {
        $this->acl->access('system_access');
        //Tracker::addEvent(array('activity' => array('messageType' => 'success','message' => 'Navigate to apps page successfully')));

        $this->getLibrary('pagination');
        $pagination = new Pagination();

        $this->view->setJs(['main']);
        $this->view->assign('brands', $pagination->pager($this->brands->getBrandsOrderByName()));
        $this->view->assign('pagination', $pagination->getView('ajax'));
        $this->view->assign('title', 'Brands');
        $this->view->render('index', 'Brands');
    }

    public function brandsPaginationAJAX() {
        $page = $this->getInt('page');
        $this->getLibrary('pagination');
        $pagination = new Pagination();

        $this->view->assign('brands', $pagination->pager($this->brands->getBrandsOrderByName(), $page));
        $this->view->assign('pagination', $pagination->getView('ajax'));
        $this->view->render('index_p_ajax', false, true);
    }


    public function getBrandsOrderById()
    {
        $this->acl->access('get_product_brand');
        echo json_encode($this->brands->getBrandsOrderById());
    }

    public function getBrandsOrderByName()
    {
        $this->acl->access('get_product_brand');
        echo json_encode($this->brands->getBrandsOrderByName());
    }

    public function isBrandAlreadyExists(){
        $this->acl->access('edit_product_brand');
        $data = json_decode(file_get_contents('php://input'));
        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['status' => 'no',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Brand\'s security code not found.')));
                exit;
            }
            if ($this->brands->isBrandAlreadyExists(ucfirst($this->getTextnonPOST($data->name)))) {
                echo json_encode([['status' => 'yes',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'The brand <b>' . $data->name . '</b> has already exist. Please enter new one.')));
                exit;
            }

            echo json_encode([['status' => 'no',],]);
            Tracker::addEvent(array('activity' => array('messageType' => 'success', 'message' => '<b>' . $data->name . '</b> is available.')));
            exit;
        }
    }

    public function checkBrandNameAbility()
    {
        $this->acl->access('edit_product_brand');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error', 'message' => 'Brand\'s security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Brand\'s security code not found.')));
                exit;
            }

            if (empty($data->name)) {
                echo json_encode([['type' => 'error', 'message' => 'Please fil out item name.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Brand\'s name not found.')));
                exit;
            }

            if ($this->brands->isBrandAlreadyExists(ucfirst($this->getTextnonPOST($data->name)))) {
                echo json_encode([['type' => 'error', 'message' => 'The brand <b>' . $data->name . '</b> has already exist. Please enter new one.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'The brand <b>' . $data->name . '</b> has already exist. Please enter new one.')));
                exit;
            }

            echo json_encode([['type' => 'success', 'message' => '<b>' . $data->name . '</b> is available.',],]);
            Tracker::addEvent(array('activity' => array('messageType' => 'success', 'message' => '<b>' . $data->name . '</b> is available.')));
            exit;
        }
    }

    public function addBrand()
    {
        $this->acl->access('edit_product_brand');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error', 'message' => 'Brand\'s security_code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'New brand\'s security code not found.')));
                exit;
            }

            if (empty($data->name)) {
                echo json_encode([['type' => 'error', 'message' => 'Brand\'s name not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Brand\'s name not found.')));
                exit;
            }

            if ($data->btnName === 'Save') {
                if ($this->brands->isBrandAlreadyExists($data->name)) {
                    echo json_encode([['type' => 'error', 'message' => 'The brand <b>' . $data->name . '</b> has already exist. Please enter new one.',],]);
                    Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'The brand <b>' . $data->name . '</b> has already exist. Please enter new one.')));
                    exit;
                } else {
                    $this->brands->insertBrand(ucfirst($this->getTextnonPOST($data->name)), Session::get('id_user'), Session::get('username'), Session::get('f_name') . ' ' . Session::get('l_name'));
                    echo json_encode([['type' => 'success', 'message' => 'A new brand (' . ucfirst($this->getTextnonPOST($data->name)) . ') added successfully...',],]);
                    Tracker::addEvent(array(
                        'activity' => array('messageType' => 'success', 'message' => 'A new brand (' . ucfirst($this->getTextnonPOST($data->name)) . ') added successfully...'),
                        'update' => array('messageType' => 'success', 'uFile' => 'Brand', 'message' => 'A new brand (' . ucfirst($this->getTextnonPOST($data->name)) . ') added successfully...')
                    ));
                    exit;
                }
            }

            if ($data->btnName === 'Update') {
                $brand = $this->brands->getBrand($this->filterInt($data->id));
                $this->brands->editBrand($this->filterInt($data->id), ucfirst($this->getTextnonPOST($data->name)), Session::get('id_user'), Session::get('username'), Session::get('f_name') . ' ' . Session::get('l_name'));
                echo json_encode([['type' => 'success', 'message' => '<b>' . $brand[0]['name'] . ' </b> to <b>' . ucfirst($this->getTextnonPOST($data->name)) . ' </b> updated successfully...'],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success', 'message' => '<b>' . $brand[0]['name'] . ' </b> to <b>' . ucfirst($this->getTextnonPOST($data->name)) . ' </b> updated successfully...'),
                    'update' => array('messageType' => 'success', 'uFile' => 'Brand', 'message' => '<b>' . $brand[0]['name'] . ' </b> to <b>' . ucfirst($this->getTextnonPOST($data->name)) . ' </b> updated successfully...')
                ));
                exit;
            }

            if ($data->btnName !== 'Save' || $data->btnName !== 'Update') {
                echo json_encode([['type' => 'error', 'message' => 'Job command not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Job command not found.')));
                exit;
            }
        }
    }

    public function deleteBrand()
    {
        $this->acl->access('delete_product_brand');
        $data = json_decode(file_get_contents('php://input'));
        if (count($data) > 0) {
            $brand = $this->brands->getBrand($this->filterInt($data->id));
            $this->brands->deleteBrand($data->id);
            echo json_encode([['type' => 'success', 'message' => ucfirst($brand[0]['name']) . ' brand deleted successfully...',],]);
            Tracker::addEvent(array(
                'activity' => array('messageType' => 'success', 'message' => '<b>' . ucfirst($brand[0]['name']) . ' </b> brand deleted successfully....'),
                'update' => array('messageType' => 'success', 'uFile' => 'Item', 'message' => '<b>' . ucfirst($brand[0]['name']) . ' </b> brand deleted successfully....')));
            exit;
        }
    }
    //--------------------------------------------------

}
