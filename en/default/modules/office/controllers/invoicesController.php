<?php

class invoicesController extends officeController
{
    private $invoices;

    public function __construct()
    {
        parent::__construct();
        $this->access_init();
        $this->invoices = $this->loadModel('invoices');
    }

    public function index()
    {
        $this->acl->access('system_access');
        $this->getLibrary('pagination');
        $pagination = new Pagination();

        $this->view->setJs(['main']);
        $this->view->assign('branch', $this->invoices->getBranchDetailsById($this->invoices->getBranchIdByUserId(Session::get(('id_user')))));
        $this->view->assign('invoices', $pagination->pager($this->invoices->getInvoicesAll()));
        $this->view->assign('pagination', $pagination->getView('ajax'));
        $this->view->assign('branches', $this->invoices->getBranches());
        $this->view->assign('title', 'Invoices');
        $this->view->render('index', 'Invoices');
    }

    public function invoicesPaginationAJAX()
    {
        $page = $this->getInt('page');
        $this->getLibrary('pagination');
        $pagination = new Pagination();

        $this->view->assign('branch', $this->invoices->getBranchDetailsById($this->invoices->getBranchIdByUserId(Session::get(('id_user')))));
        $this->view->assign('invoices', $pagination->pager($this->invoices->getInvoicesAll(), $page));
        $this->view->assign('pagination', $pagination->getView('ajax'));
        $this->view->render('index_p_ajax', false, true);
    }

    public function getInvoicesAll()
    {
        $this->acl->access('get_clients_invoice');
        echo json_encode($this->invoices->getInvoicesAll());
    }

    public function searchSpecificInvoice()
    {
        $this->acl->access('system_access');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            $extract = $this->invoices->getInvoiceBySearchData($this->filterInt($data->branch),$this->filterInt($data->invoice),$this->getTextnonPOST($data->client_name),$this->filterInt($data->client_number));
            echo json_encode($extract);
        }
    }

    public function addInvoice()
    {
        $this->acl->access('edit_clients_invoice');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error', 'message' => 'Invoice\'s security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Invoice\'s security code not found.')));
                exit;
            }

            if (empty($data->branch)) {
                echo json_encode([['type' => 'error', 'message' => 'Branch\'s name not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Branch\'s name not found.')));
                exit;
            }
            if (empty($data->client)) {
                echo json_encode([['type' => 'error', 'message' => 'Client\'s name not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Client\'s name not found.')));
                exit;
            }

            if ($data->btnName === 'Save') {
                $this->invoices->insertInvoice($this->filterInt($data->branch), $this->filterInt($data->client), $this->filterInt($data->sls_mn), Session::get('id_user'), Session::get('username'), Session::get('f_name') . ' ' . Session::get('l_name'));
                $slsman = $this->invoices->getSalesManActualNameById($this->invoices->getSalesManUserIdByInvoiceId($this->invoices->getLastInsertInvoiceId()));
                echo json_encode([['type' => 'success', 'inv_id' => $this->invoices->getLastInsertInvoiceId(), 'inv_sls_man' => $slsman, 'message' => 'Invoice no. ' . $this->invoices->getLastInsertInvoiceId() . ' is ready.',],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success', 'message' => 'Invoice no. ' . $this->invoices->getLastInsertInvoiceId() . ' is ready.'),
                    'update' => array('messageType' => 'success', 'uFile' => 'Invoice', 'message' => 'Invoice no. ' . $this->invoices->getLastInsertInvoiceId() . ' is ready.')
                ));
                exit;
            }

            if ($data->btnName === 'Update') {
                $inv_dtl = $this->invoices->getInvoiceDetailsById($this->filterInt($data->id));
                $this->invoices->editInvoice($this->filterInt($data->id), $this->filterInt($data->branch), $this->filterInt($data->client));
                echo json_encode([['type' => 'success', 'message' => 'Invoice no: ' . $this->filterInt($data->id) . ' updated successfully...'],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success', 'message' => 'Invoice no: ' . $this->filterInt($data->id) . ' updated successfully...'),
                    'update' => array('messageType' => 'success', 'uFile' => 'Invoice', 'message' => 'Invoice no: ' . $this->filterInt($data->id) . ' updated successfully...')
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

    public function manageBill()
    {
        $this->acl->access('edit_clients_invoice');
        $data = json_decode(file_get_contents('php://input'));
        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error', 'message' => 'Security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Security code not found.')));
                exit;
            }
            if (empty($data->branch)) {
                echo json_encode([['type' => 'error', 'message' => 'Branch number not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Branch number not found.')));
                exit;
            }
            if (empty($data->invoice)) {
                echo json_encode([['type' => 'error', 'message' => 'Invoice number not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Invoice number not found.')));
                exit;
            }
            if (empty($data->client)) {
                echo json_encode([['type' => 'error', 'message' => 'Client number not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Client number not found.')));
                exit;
            }

            if ($data->mode === 'create' OR $data->mode === 'update') {
                $this->invoices->manageBill($this->getTextnonPOST($data->mode), $this->filterInt($data->branch), $this->filterInt($data->invoice), $this->filterInt($data->client), $this->filterInt($data->bill), Session::get('id_user'), Session::get('username'), Session::get('f_name') . ' ' . Session::get('l_name'));
                echo json_encode([['type' => 'success', 'message' => 'Bill created.',],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success', 'message' => 'Bill created.'),
                    'update' => array('messageType' => 'success', 'uFile' => 'Invoice', 'message' => 'Bill created.')
                ));
                exit;
            }
        }
    }

    public function getSoldItemsByInvId()
    {
        $this->acl->access('edit_clients_invoice');
        $data = json_decode(file_get_contents('php://input'));
        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error', 'message' => 'Security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Security code not found.')));
                exit;
            }
            if (empty($data->branch)) {
                echo json_encode([['type' => 'error', 'message' => 'Branch number not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Branch number not found.')));
                exit;
            }
            if (empty($data->invoice)) {
                echo json_encode([['type' => 'error', 'message' => 'Invoice number not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Invoice number not found.')));
                exit;
            }

            echo json_encode($this->invoices->getSoldItemsByInvId($data->invoice));
            Tracker::addEvent(array('activity' => array('messageType' => 'success', 'message' => 'Sold item send to user.')));
            exit;
        }
    }

    public function addToCart()
    {
        $this->acl->access('edit_clients_invoice');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error', 'message' => 'Invoice\'s security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Invoice\'s security code not found.')));
                exit;
            }

            if (empty($data->branch)) {
                echo json_encode([['type' => 'error', 'message' => 'Branch number not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Branch number not found.')));
                exit;
            }

            if (empty($data->invId)) {
                echo json_encode([['type' => 'error', 'message' => 'Invoice number not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Invoice number not found.')));
                exit;
            }

            if (empty($data->clientId)) {
                echo json_encode([['type' => 'error', 'message' => 'Client\'s user id not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Client\'s user id not found.')));
                exit;
            }

            if (empty($data->item)) {
                echo json_encode([['type' => 'error', 'message' => 'Item number not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Item number not found.')));
                exit;
            }

            if (empty($data->brand)) {
                echo json_encode([['type' => 'error', 'message' => 'The brand name of ' . $this->invoices->getItemNameById($data->item) . ' not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'The brand name of ' . $this->invoices->getItemNameById($data->item) . ' not found.')));
                exit;
            }

            if (empty($data->model)) {
                echo json_encode([['type' => 'error', 'message' => 'The model name of ' . $this->invoices->getBrandNameById($data->brand) . ' ' . $this->invoices->getItemNameById($data->item) . ' not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'The model name of ' . $this->invoices->getBrandNameById($data->brand) . ' ' . $this->invoices->getItemNameById($data->item) . ' not found.')));
                exit;
            }

            if (empty($data->unitPrice)) {
                echo json_encode([['type' => 'error', 'message' => 'The unit price name of ' . $this->invoices->getBrandNameById($data->brand) . ' ' . $this->invoices->getItemNameById($data->item) . '&nbsp;(Model:&nbsp;' . $data->model . ')&nbsp;(Serial:&nbsp;' . $data->serialNumber . ') not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'The unit price of ' . $this->invoices->getBrandNameById($data->brand) . ' ' . $this->invoices->getItemNameById($data->item) . '&nbsp;(Model:&nbsp;' . $data->model . ')&nbsp;(Serial:&nbsp;' . $data->serialNumber . ') not found.')));
                exit;
            }

            if (empty($data->itemQuantity)) {
                echo json_encode([['type' => 'error', 'message' => 'The item quantity name of ' . $this->invoices->getBrandNameById($data->brand) . ' ' . $this->invoices->getItemNameById($data->item) . '&nbsp;(Model:&nbsp;' . $data->model . ')&nbsp;(Serial:&nbsp;' . $data->serialNumber . ')&nbsp;(Unit price:&nbsp;' . $data->unitPrice . ') not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'The item quantity of ' . $this->invoices->getBrandNameById($data->brand) . ' ' . $this->invoices->getItemNameById($data->item) . '&nbsp;(Model:&nbsp;' . $data->model . ')&nbsp;(Serial:&nbsp;' . $data->serialNumber . ')&nbsp;(Unit price:&nbsp;' . $data->unitPrice . ') not found.')));
                exit;
            }

            if (empty($data->totalPrice)) {
                echo json_encode([['type' => 'error', 'message' => 'Total price name of ' . $this->invoices->getBrandNameById($data->brand) . ' ' . $this->invoices->getItemNameById($data->item) . '&nbsp;(Model:&nbsp;' . $data->model . ')&nbsp;(Serial:&nbsp;' . $data->serialNumber . ') not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Total price of ' . $this->invoices->getBrandNameById($data->brand) . ' ' . $this->invoices->getItemNameById($data->item) . '&nbsp;(Model:&nbsp;' . $data->model . ')&nbsp;(Serial:&nbsp;' . $data->serialNumber . ') not found.')));
                exit;
            }

            if ($data->btnName === '<i class="fas fa-plus-circle"></i>&nbsp;Add&nbsp;to&nbsp;Cart') {
                $this->invoices->addToCart(
                    $this->filterInt($data->branch),
                    $this->filterInt($data->invId),
                    $this->filterInt($data->clientId),
                    $this->filterInt($data->item),
                    $this->filterInt($data->brand),
                    $this->getTextnonPOST($data->model),
                    $this->getTextnonPOST($data->serialNumber),
                    $this->filterInt($data->warrantyTime),
                    $this->filterInt($data->unitPrice),
                    $this->filterInt($data->itemQuantity),
                    $this->filterInt($data->totalPrice),
                    Session::get('id_user'), Session::get('username'), Session::get('f_name') . ' ' . Session::get('l_name'));
                echo json_encode([['type' => 'success', 'message' => $this->invoices->getBrandNameById($data->brand) . ' ' . $this->invoices->getItemNameById($data->item) . '&nbsp;(Model:&nbsp;' . $data->model . ')&nbsp;(Serial:&nbsp;' . $data->serialNumber . ')&nbsp;(Warranty:&nbsp;' . $data->warrantyTime . ' days)&nbsp;(Unit Price:&nbsp;' . $data->unitPrice . ' days)&nbsp;(Quantity:&nbsp;' . $data->itemQuantity . ')&nbsp;(Total Price:&nbsp;' . $data->totalPrice . ' BDT) is added in cart.',],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success', 'message' => $this->invoices->getBrandNameById($data->brand) . ' ' . $this->invoices->getItemNameById($data->item) . '&nbsp;(Model:&nbsp;' . $data->model . ')&nbsp;(Serial:&nbsp;' . $data->serialNumber . ')&nbsp;(Warranty:&nbsp;' . $data->warrantyTime . ' days)&nbsp;(Unit Price:&nbsp;' . $data->unitPrice . ' days)&nbsp;(Quantity:&nbsp;' . $data->itemQuantity . ')&nbsp;(Total Price:&nbsp;' . $data->totalPrice . ' BDT) is added in cart.'),
                    'update' => array('messageType' => 'success', 'uFile' => 'Invoice', 'message' => $this->invoices->getBrandNameById($data->brand) . ' ' . $this->invoices->getItemNameById($data->item) . '&nbsp;(Model:&nbsp;' . $data->model . ')&nbsp;(Serial:&nbsp;' . $data->serialNumber . ')&nbsp;(Warranty:&nbsp;' . $data->warrantyTime . ' days)&nbsp;(Unit Price:&nbsp;' . $data->unitPrice . ' days)&nbsp;(Quantity:&nbsp;' . $data->itemQuantity . ' days)&nbsp;(Total Price:&nbsp;' . $data->totalPrice . ' BDT) is added in cart.')
                ));
                exit;
            }

            if ($data->btnName === 'Update') {
                $prd_dtl = $this->invoices->getSoldItemsByInvId($this->filterInt($data->invId));
                $this->invoices->updateToCart(
                    $this->filterInt($data->id),
                    $this->filterInt($data->branch),
                    $this->filterInt($data->invId),
                    $this->filterInt($data->clientId),
                    $this->filterInt($data->item),
                    $this->filterInt($data->brand),
                    $this->getTextnonPOST($data->model),
                    $this->getTextnonPOST($data->serialNumber),
                    $this->filterInt($data->warrantyTime),
                    $this->filterInt($data->unitPrice),
                    $this->filterInt($data->itemQuantity),
                    $this->filterInt($data->totalPrice),
                    Session::get('id_user'), Session::get('username'), Session::get('f_name') . ' ' . Session::get('l_name'));
                echo json_encode([['type' => 'success', 'message' => ucfirst($prd_dtl[0]['brandName']) . '&nbsp;' . ucfirst($prd_dtl[0]['itemName']) . ' (Model: ' . $prd_dtl[0]['model'] . ')&nbsp;(Serial: ' . $prd_dtl[0]['serial'] . ')&nbsp;(Warranty: ' . $prd_dtl[0]['warrentyTime'] . ' days)&nbsp; (Unit Price: ' . $prd_dtl[0]['unitPrice'] . ' BDT)&nbsp;(Quantity:&nbsp;' . $prd_dtl[0]['quantity'] . ')&nbsp;(Total Price:&nbsp;' . $prd_dtl[0]['totalPrice'] . ' BDT) to ' . $this->invoices->getBrandNameById($data->brand) . ' ' . $this->invoices->getItemNameById($data->item) . '&nbsp;(Model:&nbsp;' . $data->model . ')&nbsp;(Serial:&nbsp;' . $data->serialNumber . ')&nbsp;(Warranty:&nbsp;' . $data->warrantyTime . ' days)&nbsp;(Unit Price:&nbsp;' . $data->unitPrice . ' days)&nbsp;(Quantity:&nbsp;' . $data->itemQuantity . ')&nbsp;(Total Price:&nbsp;' . $data->totalPrice . ' BDT) updated successfully...'],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success', 'message' => ucfirst($prd_dtl[0]['brandName']) . '&nbsp;' . ucfirst($prd_dtl[0]['itemName']) . ' (Model: ' . $prd_dtl[0]['model'] . ')&nbsp;(Serial: ' . $prd_dtl[0]['serial'] . ')&nbsp;(Warranty: ' . $prd_dtl[0]['warrentyTime'] . ' days)&nbsp; (Unit Price: ' . $prd_dtl[0]['unitPrice'] . ' BDT)&nbsp;(Quantity:&nbsp;' . $prd_dtl[0]['quantity'] . ')&nbsp;(Total Price:&nbsp;' . $prd_dtl[0]['totalPrice'] . ' BDT) to ' . $this->invoices->getBrandNameById($data->brand) . ' ' . $this->invoices->getItemNameById($data->item) . '&nbsp;(Model:&nbsp;' . $data->model . ')&nbsp;(Serial:&nbsp;' . $data->serialNumber . ')&nbsp;(Warranty:&nbsp;' . $data->warrantyTime . ' days)&nbsp;(Unit Price:&nbsp;' . $data->unitPrice . ' days)&nbsp;(Quantity:&nbsp;' . $data->itemQuantity . ')&nbsp;(Total Price:&nbsp;' . $data->totalPrice . ' BDT) updated successfully...'),
                    'update' => array('messageType' => 'success', 'uFile' => 'Invoice', 'message' => ucfirst($prd_dtl[0]['brandName']) . '&nbsp;' . ucfirst($prd_dtl[0]['itemName']) . ' (Model: ' . $prd_dtl[0]['model'] . ')&nbsp;(Serial: ' . $prd_dtl[0]['serial'] . ')&nbsp;(Warranty: ' . $prd_dtl[0]['warrentyTime'] . ' days)&nbsp; (Unit Price: ' . $prd_dtl[0]['unitPrice'] . ' BDT)&nbsp;(Quantity:&nbsp;' . $prd_dtl[0]['quantity'] . ')&nbsp;(Total Price:&nbsp;' . $prd_dtl[0]['totalPrice'] . ' BDT) to ' . $this->invoices->getBrandNameById($data->brand) . ' ' . $this->invoices->getItemNameById($data->item) . '&nbsp;(Model:&nbsp;' . $data->model . ')&nbsp;(Serial:&nbsp;' . $data->serialNumber . ')&nbsp;(Warranty:&nbsp;' . $data->warrantyTime . ' days)&nbsp;(Unit Price:&nbsp;' . $data->unitPrice . ' days)&nbsp;(Quantity:&nbsp;' . $data->itemQuantity . ')&nbsp;(Total Price:&nbsp;' . $data->totalPrice . ' BDT) updated successfully...')
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

    public function deleteSoldItem()
    {
        //$this->acl->access('delete_client_invoice');
        $data = json_decode(file_get_contents('php://input'));
        if (count($data) > 0) {
            $prd_dtl = $this->invoices->getSoldItemsById($this->filterInt($data->id));
            $this->invoices->deleteSoldItem($data->id);
            echo json_encode([['type' => 'success', 'message' => ucfirst($prd_dtl[0]['brandName']) . '&nbsp;' . ucfirst($prd_dtl[0]['itemName']) . ' (Model: ' . $prd_dtl[0]['model'] . ')&nbsp;(Serial: ' . $prd_dtl[0]['serial'] . ')&nbsp;(Warranty: ' . $prd_dtl[0]['warrentyTime'] . ' days)&nbsp; (Unit Price: ' . $prd_dtl[0]['unitPrice'] . ' BDT)&nbsp;(Quantity:&nbsp;' . $prd_dtl[0]['quantity'] . ')&nbsp;(Total Price:&nbsp;' . $prd_dtl[0]['totalPrice'] . ' BDT) deleted successfully...',],]);
            Tracker::addEvent(array(
                'activity' => array('messageType' => 'success', 'message' => ucfirst($prd_dtl[0]['brandName']) . '&nbsp;' . ucfirst($prd_dtl[0]['itemName']) . ' (Model: ' . $prd_dtl[0]['model'] . ')&nbsp;(Serial: ' . $prd_dtl[0]['serial'] . ')&nbsp;(Warranty: ' . $prd_dtl[0]['warrentyTime'] . ' days)&nbsp; (Unit Price: ' . $prd_dtl[0]['unitPrice'] . ' BDT)&nbsp;(Quantity:&nbsp;' . $prd_dtl[0]['quantity'] . ')&nbsp;(Total Price:&nbsp;' . $prd_dtl[0]['totalPrice'] . ' BDT) deleted successfully....'),
                'update' => array('messageType' => 'success', 'uFile' => 'Invoice', 'message' => ucfirst($prd_dtl[0]['brandName']) . '&nbsp;' . ucfirst($prd_dtl[0]['itemName']) . ' (Model: ' . $prd_dtl[0]['model'] . ')&nbsp;(Serial: ' . $prd_dtl[0]['serial'] . ')&nbsp;(Warranty: ' . $prd_dtl[0]['warrentyTime'] . ' days)&nbsp; (Unit Price: ' . $prd_dtl[0]['unitPrice'] . ' BDT)&nbsp;(Quantity:&nbsp;' . $prd_dtl[0]['quantity'] . ')&nbsp;(Total Price:&nbsp;' . $prd_dtl[0]['totalPrice'] . ' BDT) deleted successfully....')));
            exit;
        }
    }

    public function deleteInvoice()
    {
        //$this->acl->access('delete_client_invoice');
        $data = json_decode(file_get_contents('php://input'));
        if (count($data) > 0) {
            $inv_dtl = $this->invoices->getInvoiceDetailsById($this->filterInt($data->id));
            $this->invoices->deleteInvoice($data->id);
            echo json_encode([['type' => 'success', 'message' => 'Invoice no: ' . $this->filterInt($data->id) . ',&nbsp;Client ' . ucfirst($inv_dtl[0]['client_name']) . ',&nbsp;Mobile:' . $inv_dtl[0]['client_mobile_number'] . ' deleted successfully...',],]);
            Tracker::addEvent(array(
                'activity' => array('messageType' => 'success', 'message' => 'Invoice no: ' . $this->filterInt($data->id) . 'Client ' . ucfirst($inv_dtl[0]['client_name']) . ',&nbsp;Mobile:' . $inv_dtl[0]['client_mobile_number'] . ' deleted successfully....'),
                'update' => array('messageType' => 'success', 'uFile' => 'Invoice', 'message' => 'Invoice no: ' . $this->filterInt($data->id) . 'Client ' . ucfirst($inv_dtl[0]['client_name']) . ',&nbsp;Mobile:' . $inv_dtl[0]['client_mobile_number'] . ' deleted successfully....')));
            exit;
        }
    }

    public function doprint($invoice)
    {
        $this->acl->access('system_access');
        $this->view->assign('data', $this->invoices->getInvoiceDetailsById($invoice));
        $this->view->assign('title', 'Invoice');
        $this->view->assign('MyRootAddress', BaseURL);
        $this->view->render('doprint', 'Invoice_print_page',true);
    }

    public function getReadyInvoicesSellItems()
    {
        $this->acl->access('system_access');
        $data = json_decode(file_get_contents('php://input'));
        if (count($data) > 0) {
            echo json_encode($this->invoices->getSoldItemsByIdOrderBySerialNumber($data->invoice));
        }
    }

    public function reorderSellItems()
    {
        foreach ($_POST['value'] as $k => $v){
            $data['slditmOdrN'] = $k + 1;
            $this->invoices->updateSellItemsOrderNumber($data, $v);
        }

    }
    //--------------------------------------------------
}
