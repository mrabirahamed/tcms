<?php

class productdetailsController extends Controller
{
    private $productdetails;

    public function __construct()
    {
        parent::__construct();
        $this->access_init();
        $this->productdetails = $this->loadModel('productdetails');
    }

    public function index()
    {
        $this->acl->access('system_access');
        $this->getLibrary('pagination');
        $pagination = new Pagination();

        $this->view->setJs(['main']);
        $this->view->assign('product_details', $pagination->pager($this->productdetails->getProductDetails()));
        $this->view->assign('pagination', $pagination->getView('ajax'));
        $this->view->assign('title', 'Product Details with price');
        $this->view->render('index', 'Product Details with price');
    }

    public function productDetailsPaginationAJAX() {
        $page = $this->getInt('page');
        $this->getLibrary('pagination');
        $pagination = new Pagination();

        $this->view->assign('product_details', $pagination->pager($this->productdetails->getProductDetails(), $page));
        $this->view->assign('pagination', $pagination->getView('ajax'));
        $this->view->render('index_p_ajax', false, true);
    }

    public function getProductDetails()
    {
        $this->acl->access('get_product_details');
        echo json_encode($this->productdetails->getProductDetails());
    }

    public function getBrandByItemId()
    {
        $this->acl->access('get_product_brand');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error', 'message' => 'Brand\'s security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'New Brand\'s security code not found.')));
                exit;
            }

            if (empty($data->id)) {
                echo json_encode([['type' => 'error', 'message' => 'Item\'s id not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Item\'s id not found.')));
                exit;
            }

            echo json_encode($this->productdetails->getBrandByItemId($this->filterInt($data->id)));
        }
    }

    public function getModelByItemBrandId(){
        $this->acl->access('get_product_details');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error', 'message' => 'Security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Security code not found.')));
                exit;
            }

            if (empty($data->item)) {
                echo json_encode([['type' => 'error', 'message' => 'Item\'s id not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Item\'s id not found.')));
                exit;
            }

            if (empty($data->brand)) {
                echo json_encode([['type' => 'error', 'message' => 'Brand\'s id not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Brand\'s id not found.')));
                exit;
            }

            echo json_encode($this->productdetails->getModelByItemBrandId($this->filterInt($data->item),$this->filterInt($data->brand)));
        }
    }

    public function getDetailsByItemBrandModelName(){
        $this->acl->access('get_product_details');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error', 'message' => 'Security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Security code not found.')));
                exit;
            }

            if (empty($data->item)) {
                echo json_encode([['type' => 'error', 'message' => 'Item\'s id not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Item\'s id not found.')));
                exit;
            }

            if (empty($data->brand)) {
                echo json_encode([['type' => 'error', 'message' => 'Brand\'s id not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Brand\'s id not found.')));
                exit;
            }

            if (empty($data->model)) {
                echo json_encode([['type' => 'error', 'message' => 'Model not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Model not found.')));
                exit;
            }

            echo json_encode($this->productdetails->getDetailsByItemBrandModelName($this->filterInt($data->item),$this->filterInt($data->brand), $this->getTextnonPOST($data->model)));
        }
    }

    public function getItemName($id){
        $this->acl->access('get_product_item');
        echo json_encode($this->productdetails->getItemNameById($id));
    }

    public function addProductDetail()
    {
        $this->acl->access('edit_product_details');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error', 'message' => 'Product\'s security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'New product\'s security code not found.')));
                exit;
            }

            if (empty($data->item)) {
                echo json_encode([['type' => 'error', 'message' => 'Item name not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Item name not found.')));
                exit;
            }

            if (empty($data->brand)) {
                echo json_encode([['type' => 'error', 'message' => ucfirst($this->productdetails->getItemNameById($data->item)) . '\'s brand name not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => ucfirst($this->productdetails->getItemNameById($data->item)) . '\'s brand name not found.')));
                exit;
            }

            if (empty($data->modelNumber)) {
                echo json_encode([['type' => 'error', 'message' => ucfirst($this->productdetails->getBrandNameById($data->brand)) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($data->item)) .  '\'s model Number not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => ucfirst($this->productdetails->getBrandNameById($data->brand)) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($data->item)) .  '\'s model Number not found.')));
                exit;
            }

            if (empty($data->unitPrice)) {
                echo json_encode([['type' => 'error', 'message' => ucfirst($this->productdetails->getBrandNameById($data->brand)) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($data->item)) .  '&nbsp;(Model: '. $data->modelNumber . ')&nbsp;(Serial: '. $data->serialNumber . ')\'s unit price not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => ucfirst($this->productdetails->getBrandNameById($data->brand)) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($data->item)) .  '&nbsp;(Model: '. $data->modelNumber .')&nbsp;(Serial: '. $data->serialNumber . ')\'s unit price not found.')));
                exit;
            }

            if (empty($data->ability)) {
                echo json_encode([['type' => 'error', 'message' => ucfirst($this->productdetails->getBrandNameById($data->brand)) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($data->item)) .  '&nbsp;(Model: '. $data->modelNumber . ')&nbsp;(Serial: '. $data->serialNumber . ')&nbsp; price: ' . $data->unitPrice .' BDT\'s ability not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => ucfirst($this->productdetails->getBrandNameById($data->brand)) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($data->item)) .  '&nbsp;(Model: '. $data->modelNumber . ')&nbsp;(Serial: '. $data->serialNumber . ')&nbsp; price: ' . $data->unitPrice .' BDT\'s ability not found.')));
                exit;
            }

            /*if($this->productdetails->isProductDetailAlreadyExists($this->filterInt($data->item), $this->filterInt($data->brand), $this->getTextnonPOST($data->modelNumber), $this->getTextnonPOST($data->serialNumber), $this->filterInt($data->unitPrice), $this->getTextnonPOST($data->ability))) {
                echo json_encode([['type' => 'error', 'message' => ucfirst($this->productdetails->getBrandName($data->brand)) . '&nbsp;' . ucfirst($this->productdetails->getItemName($data->item)) .  '&nbsp;(Model: '. $data->modelNumber . ')&nbsp;(Serial: '. $data->serialNumber . ')&nbsp;price: ' . $data->unitPrice .' BDT already exists.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => ucfirst($this->productdetails->getBrandName($data->brand)) . '&nbsp;' . ucfirst($this->productdetails->getItemName($data->item)) .  ' (Model: '. $data->modelNumber . ')&nbsp;(Serial: '. $data->serialNumber . ')&nbsp; price: ' . $data->unitPrice .' BDT already exists.')));
                exit;
            }*/

            if ($data->btnName === 'Save') {
                $this->productdetails->insertProductDetail($this->filterInt($data->item), $this->filterInt($data->brand), $this->getTextnonPOST($data->modelNumber), $this->getTextnonPOST($data->serialNumber), $this->filterInt($data->unitPrice), $this->getTextnonPOST($data->warrantyTime), $this->getTextnonPOST($data->ability), Session::get('id_user'), Session::get('username'), Session::get('f_name') . ' ' . Session::get('l_name'));
                echo json_encode([['type' => 'success', 'message' => ucfirst($this->productdetails->getBrandNameById($data->brand)) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($data->item)) .  '&nbsp;(Model: '. $data->modelNumber . ')&nbsp;(Serial: '. $data->serialNumber . ')&nbsp;price: ' . $data->unitPrice .' BDT added successfully...',],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success', 'message' => ucfirst($this->productdetails->getBrandNameById($data->brand)) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($data->item)) .  ' (Model: '. $data->modelNumber . ')&nbsp;(Serial: '. $data->serialNumber . ')&nbsp; price: ' . $data->unitPrice .' BDT added successfully...'),
                    'update' => array('messageType' => 'success', 'uFile' => 'Product Details with price', 'message' => ucfirst($this->productdetails->getBrandNameById($data->brand)) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($data->item)) .  ' (Model: '. $data->modelNumber . ')&nbsp;(Serial: '. $data->serialNumber . ')&nbsp; price: ' . $data->unitPrice .' BDT added successfully...')
                ));
                exit;
            }

            if ($data->btnName === 'Update') {
                $prd_dtl = $this->productdetails->getProductDetail($this->filterInt($data->id));
                $this->productdetails->editProductDetail($this->filterInt($data->id), $this->filterInt($data->item), $this->filterInt($data->brand), $this->getTextnonPOST($data->modelNumber), $this->getTextnonPOST($data->serialNumber), $this->filterInt($data->unitPrice),  $this->filterInt($data->warrantyTime), $this->getTextnonPOST($data->ability), Session::get('id_user'), Session::get('username'), Session::get('f_name') . ' ' . Session::get('l_name'));
                echo json_encode([['type' => 'success', 'message' => ucfirst($this->productdetails->getBrandNameById($prd_dtl[0]['brand'])) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($prd_dtl[0]['item'])) .  ' (Model: '. $prd_dtl[0]['Model'] . ')&nbsp;(Serial: '. $prd_dtl[0]['serial'] . ')&nbsp; price: ' . $prd_dtl[0]['price'] .' BDT to ' . ucfirst($this->productdetails->getBrandNameById($data->brand)) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($data->item)) .  ' (Model: '. $data->modelNumber . ')&nbsp;(Serial: '. $data->serialNumber . ')&nbsp; price: ' . $data->unitPrice .' BDT updated successfully...'],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success', 'message' => ucfirst($this->productdetails->getBrandNameById($prd_dtl[0]['brand'])) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($prd_dtl[0]['item'])) .  ' (Model: '. $prd_dtl[0]['Model'] . ')&nbsp;(Serial: '. $prd_dtl[0]['serial'] . ')&nbsp; price: ' . $prd_dtl[0]['price'] .' BDT to ' . ucfirst($this->productdetails->getBrandNameById($data->brand)) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($data->item)) .  ' (Model: '. $data->modelNumber . ')&nbsp;(Serial: '. $data->serialNumber . ')&nbsp; price: ' . $data->unitPrice .' BDT updated successfully...'),
                    'update' => array('messageType' => 'success', 'uFile' => 'Product Details with price', 'message' => ucfirst($this->productdetails->getBrandNameById($prd_dtl[0]['brand'])) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($prd_dtl[0]['item'])) .  ' (Model: '. $prd_dtl[0]['Model'] . ')&nbsp;(Serial: '. $prd_dtl[0]['serial'] . ')&nbsp; price: ' . $prd_dtl[0]['price'] .' BDT to ' . ucfirst($this->productdetails->getBrandNameById($data->brand)) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($data->item)) .  ' (Model: '. $data->modelNumber . ')&nbsp;(Serial: '. $data->serialNumber . ')&nbsp; price: ' . $data->unitPrice .' BDT updated successfully...')
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

    public function deleteProductDetail()
    {
        $this->acl->access('delete_product_details');
        $data = json_decode(file_get_contents('php://input'));
        if (count($data) > 0) {
            $prd_dtl = $this->productdetails->getProductDetail($this->filterInt($data->id));
            $this->productdetails->deleteProductDetail($data->id);
            echo json_encode([['type' => 'success', 'message' => ucfirst($this->productdetails->getBrandNameById($prd_dtl[0]['brand'])) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($prd_dtl[0]['item'])) .  ' (Model: '. $prd_dtl[0]['Model'] . ')&nbsp;(Serial: '. $prd_dtl[0]['serial'] . ')&nbsp; price: ' . $prd_dtl[0]['price'] .' BDT deleted successfully...',],]);
            Tracker::addEvent(array(
                'activity' => array('messageType' => 'success', 'message' => ucfirst($this->productdetails->getBrandNameById($prd_dtl[0]['brand'])) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($prd_dtl[0]['item'])) .  ' (Model: '. $prd_dtl[0]['Model'] . ')&nbsp;(Serial: '. $prd_dtl[0]['serial'] . ')&nbsp; price: ' . $prd_dtl[0]['price'] .' BDT deleted successfully....'),
                'update' => array('messageType' => 'success', 'uFile' => 'Product Details', 'message' => ucfirst($this->productdetails->getBrandNameById($prd_dtl[0]['brand'])) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($prd_dtl[0]['item'])) .  ' (Model: '. $prd_dtl[0]['Model'] . ')&nbsp;(Serial: '. $prd_dtl[0]['serial'] . ')&nbsp; price: ' . $prd_dtl[0]['price'] .' BDT deleted successfully....')));
            exit;
        }
    }

    public function ChangeProductAbility() {
        $this->acl->access('edit_product_item');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error','message' => 'Product\'s security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Product\'s security code not found.')));
                exit;
            }

            if (empty($data->current_status)) {
                echo json_encode([['type' => 'error','message' => 'Product\'s current status not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Product\'s current status not found.')));
                exit;
            }

            if (empty($data->newAbility)) {
                echo json_encode([['type' => 'error','message' => 'Product\'s new status not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Product\'s new status not found.')));
                exit;
            }

            $prd_dtl = $this->productdetails->getProductDetail($this->filterInt($data->id));
            $this->productdetails->ChangeProductAbility($this->filterInt($data->id), $this->getTextnonPOST($data->current_status), $data->newAbility);
            echo json_encode([['type' => 'success','message' => ucfirst($this->productdetails->getBrandNameById($prd_dtl[0]['brand'])) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($prd_dtl[0]['item'])) .  ' (Model: '. $prd_dtl[0]['Model'] . ')&nbsp;(Serial: '. $prd_dtl[0]['serial'] . ')&nbsp; price: ' . $prd_dtl[0]['price'] .' BDT changed successfully...',],]);
            Tracker::addEvent(array(
                'activity' => array('messageType' => 'success','message' => ucfirst($this->productdetails->getBrandNameById($prd_dtl[0]['brand'])) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($prd_dtl[0]['item'])) .  ' (Model: '. $prd_dtl[0]['Model'] . ')&nbsp;(Serial: '. $prd_dtl[0]['serial'] . ')&nbsp; price: ' . $prd_dtl[0]['price'] .' BDT changed successfully...'),
                'update' => array('messageType' => 'success', 'uFile' => 'Product Details', 'message' => ucfirst($this->productdetails->getBrandNameById($prd_dtl[0]['brand'])) . '&nbsp;' . ucfirst($this->productdetails->getItemNameById($prd_dtl[0]['item'])) .  ' (Model: '. $prd_dtl[0]['Model'] . ')&nbsp;(Serial: '. $prd_dtl[0]['serial'] . ')&nbsp; price: ' . $prd_dtl[0]['price'] .' BDT changed successfully...')
            ));
            exit;
        }
    }
    //--------------------------------------------------

}
