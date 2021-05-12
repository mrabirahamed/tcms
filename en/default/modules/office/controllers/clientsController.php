<?php

class clientsController extends officeController
{

    private $clients;

    public function __construct()
    {
        parent::__construct();
        $this->access_init();
        $this->clients = $this->loadModel('clients');
    }

    public function index()
    {
        $this->acl->access('system_access');
        //Tracker::addEvent(array('activity' => array('messageType' => 'success','message' => 'Navigate to apps page successfully')));
        $this->getLibrary('pagination');
        $pagination = new Pagination();

        $this->view->setJs(['main']);
        $this->view->assign('clients', $pagination->pager($this->clients->getClientsOrderByName()));
        $this->view->assign('pagination', $pagination->getView('ajax'));
        $this->view->assign('title', 'Clients');
        $this->view->render('index', 'Clients');
    }

    public function clientsPaginationAJAX()
    {
        $page = $this->getInt('page');
        $this->getLibrary('pagination');
        $pagination = new Pagination();

        $this->view->assign('clients', $pagination->pager($this->clients->getClientsOrderByName(), $page));
        $this->view->assign('pagination', $pagination->getView('ajax'));
        $this->view->render('index_p_ajax', false, true);
    }

    public function getClientsOrderById()
    {
        //$this->acl->access('get_shop_client');
        echo json_encode($this->clients->getClientsOrderById());
    }

    public function getClientsOrderByName()
    {
        //$this->acl->access('get_shop_client');
        echo json_encode($this->clients->getClientsOrderByName());
    }


    public function getSelectedClient()
    {
        //$this->acl->access('get_shop_client');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error', 'message' => 'Client\'s security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'New Client\'s security code not found.')));
                exit;
            }

            if (empty($data->id)) {
                echo json_encode([['type' => 'error', 'message' => 'Client\'s id not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Client\'s id not found.')));
                exit;
            }

            echo json_encode($this->clients->getSelectedClientById($data->id));
        }
    }

    public function checkClientsNameInputAbility()
    {
        //$this->acl->access('edit_shop_client');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error', 'message' => 'Client\'s security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Client\'s security code not found.')));
                exit;
            }

            if (empty($data->name)) {
                echo json_encode([['type' => 'error', 'message' => 'Please fil out item name.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Client\'s name not found.')));
                exit;
            }

            if ($this->clients->checkClientsInputAbility($data->name)) {
                echo json_encode([['type' => 'error', 'message' => 'The client <b>' . $data->name . '</b> has already exist. Please enter new one.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'The client <b>' . $data->name . '</b> has already exist. Please enter new one.')));
                exit;
            }

            echo json_encode([['type' => 'success', 'message' => '<b>' . $data->name . '</b> is available.',],]);
            Tracker::addEvent(array('activity' => array('messageType' => 'success', 'message' => '<b>' . $data->name . '</b> is available.')));
            exit;
        }
    }

    public function addClients()
    {
        //$this->acl->access('add_shop_client');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error', 'message' => 'Client\'s security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'New Client\'s security code not found.')));
                exit;
            }

            if (empty($data->name)) {
                echo json_encode([['type' => 'error', 'message' => 'Client\'s name not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Client\'s name not found.')));
                exit;
            }

            if (empty($data->mobile_number)) {
                echo json_encode([['type' => 'error', 'message' => ucfirst($data->name) . '\'s mobile number not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => ucfirst($data->name) . '\'s mobile number not found.')));
                exit;
            }

            if (empty($data->address)) {
                echo json_encode([['type' => 'error', 'message' => ucfirst($data->name) . ', mob. number:' . $data->mobile_number . '\'s address not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => ucfirst($data->name) . ' mob. number:' . $data->mobile_number . '\'s address not found.')));
                exit;
            }

            /*if($this->invoices->isProductDetailAlreadyExists($this->filterInt($data->item), $this->filterInt($data->brand), $this->getTextnonPOST($data->modelNumber), $this->getTextnonPOST($data->serialNumber), $this->filterInt($data->unitPrice), $this->getTextnonPOST($data->ability))) {
                echo json_encode([['type' => 'error', 'message' => ucfirst($this->invoices->getBrandName($data->brand)) . '&nbsp;' . ucfirst($this->invoices->getItemName($data->item)) .  '&nbsp;(Model: '. $data->modelNumber . ')&nbsp;(Serial: '. $data->serialNumber . ')&nbsp;price: ' . $data->unitPrice .' BDT already exists.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => ucfirst($this->invoices->getBrandName($data->brand)) . '&nbsp;' . ucfirst($this->productdetails->getItemName($data->item)) .  ' (Model: '. $data->modelNumber . ')&nbsp;(Serial: '. $data->serialNumber . ')&nbsp; price: ' . $data->unitPrice .' BDT already exists.')));
                exit;
            }*/

            if ($data->btnName === 'Save') {
                $this->clients->insertClients($this->getTextnonPOST($data->name), $this->getTextnonPOST($data->mobile_number), $this->getTextnonPOST($data->address), Session::get('id_user'), Session::get('username'), Session::get('f_name') . ' ' . Session::get('l_name'));
                echo json_encode([['type' => 'success', 'message' => ucfirst($data->name) . ', mob. number:' . $data->mobile_number . ', address: ' . $this->getTextnonPOST($data->address) . ' added successfully...',],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success', 'message' => ucfirst($data->name) . ',&nbsp;mob.&nbsp;number:&nbsp;' . $data->mobile_number . ',&nbsp;address:&nbsp;' . $this->getTextnonPOST($data->address) . ' added successfully...'),
                    'update' => array('messageType' => 'success', 'uFile' => 'Clients', 'message' => ucfirst($data->name) . ',&nbsp;mob.&nbsp;number:' . $data->mobile_number . ', address: ' . $this->getTextnonPOST($data->address) . ' added successfully...')
                ));
                exit;
            }

            if ($data->btnName === 'Update') {
                $clts = $this->clients->getSelectedClientById($this->filterInt($data->id));
                $this->clients->editClients($this->filterInt($data->id), $this->getTextnonPOST($data->name), $this->getTextnonPOST($data->mobile_number), $this->getTextnonPOST($data->address), Session::get('id_user'), Session::get('username'), Session::get('f_name') . ' ' . Session::get('l_name'));
                echo json_encode([['type' => 'success', 'message' => ucfirst($clts[0]['name']) . '&nbsp;mob.&nbsp;number:&nbsp;' . $clts[0]['mobile_number'] . ',&nbsp;address:&nbsp;' . $clts[0]['address'] . ' to ' . ucfirst($data->name) . '&nbsp;mob.&nbsp;number:&nbsp;' . $data->mobile_number . ',&nbsp;address:&nbsp;' . $this->getTextnonPOST($data->address) . ' updated successfully...'],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success', 'message' => ucfirst($clts[0]['name']) . '&nbsp;mob.&nbsp;number:&nbsp;' . $clts[0]['mobile_number'] . ',&nbsp;address:&nbsp;' . $clts[0]['address'] . ' to ' . ucfirst($data->name) . '&nbsp;mob.&nbsp;number:&nbsp;' . $data->mobile_number . ',&nbsp;address:&nbsp;' . $this->getTextnonPOST($data->address) . ' updated successfully...'),
                    'update' => array('messageType' => 'success', 'uFile' => 'Clients', 'message' => ucfirst($clts[0]['name']) . '&nbsp;mob.&nbsp;number:&nbsp;' . $clts[0]['mobile_number'] . ',&nbsp;address:&nbsp;' . $clts[0]['address'] . ' to ' . ucfirst($data->name) . '&nbsp;mob.&nbsp;number:&nbsp;' . $data->mobile_number . ',&nbsp;address:&nbsp;' . $this->getTextnonPOST($data->address) . ' updated successfully...')
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

    public function deleteClient()
    {
        //$this->acl->access('delete_shop_client');
        $data = json_decode(file_get_contents('php://input'));
        if (count($data) > 0) {
            $clts = $this->clients->getSelectedClientById($this->filterInt($data->id));
            $this->clients->deleteClients($data->id);
            echo json_encode([['type' => 'success', 'message' => ucfirst($clts[0]['name']) . ',&nbsp;mob.&nbsp;number:&nbsp;' . $clts[0]['mobile_number'] . ',&nbsp;address:&nbsp;' . $clts[0]['address'] . ' deleted successfully...',],]);
            Tracker::addEvent(array(
                'activity' => array('messageType' => 'success', 'message' => ucfirst($clts[0]['name']) . ',&nbsp;mob.&nbsp;number:&nbsp;' . $clts[0]['mobile_number'] . ',&nbsp;address:&nbsp;' . $clts[0]['address'] . ' deleted successfully....'),
                'update' => array('messageType' => 'success', 'uFile' => 'Clients', 'message' => ucfirst($clts[0]['name']) . ',&nbsp;mob.&nbsp;number:&nbsp;' . $clts[0]['mobile_number'] . ',&nbsp;address:&nbsp;' . $clts[0]['address'] . ' deleted successfully....')));
            exit;
        }
    }

    //--------------------------------------------------

}
