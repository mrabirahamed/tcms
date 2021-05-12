<?php

class itemsController extends Controller
{

    private $items;

    public function __construct()
    {
        parent::__construct();
        $this->access_init();
        $this->items = $this->loadModel('items');
    }

    public function index()
    {
        $this->acl->access('system_access');
        //Tracker::addEvent(array('activity' => array('messageType' => 'success','message' => 'Navigate to apps page successfully')));

        $this->getLibrary('pagination');
        $pagination = new Pagination();

        $this->view->setJs(['main']);
        $this->view->assign('items', $pagination->pager($this->items->getItemsOrderById()));
        $this->view->assign('pagination', $pagination->getView('ajax'));
        $this->view->assign('title', 'Items');
        $this->view->render('index', 'Items');
    }

    public function itemsPaginationAJAX() {
        $page = $this->getInt('page');
        $this->getLibrary('pagination');
        $pagination = new Pagination();

        $this->view->assign('items', $pagination->pager($this->items->getItemsOrderById(), $page));
        $this->view->assign('pagination', $pagination->getView('ajax'));
        $this->view->render('index_p_ajax', false, true);
    }


    public function getItemsOrderById()
    {
        $this->acl->access('get_product_item');
        echo json_encode($this->items->getItemsOrderById());
    }

    public function getAvailableItemsOrderByName()
    {
        $this->acl->access('get_product_item');
        echo json_encode($this->items->getAvailableItemsOrderByName());
    }

    public function checkItemNameAbility()
    {
        $this->acl->access('edit_product_item');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error', 'message' => 'Item\'s security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Item\'s security code not found.')));
                exit;
            }

            if (empty($data->name)) {
                echo json_encode([['type' => 'error', 'message' => 'Please fil out item name.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Item\'s name not found.')));
                exit;
            }

            if ($this->items->isItemAlreadyExists($data->name)) {
                echo json_encode([['type' => 'error', 'message' => 'The item <b>' . $data->name . '</b> has already exist. Please enter new one.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'The item <b>' . $data->name . '</b> has already exist. Please enter new one.')));
                exit;
            }

            echo json_encode([['type' => 'success', 'message' => '<b>' . $data->name . '</b> is available.',],]);
            Tracker::addEvent(array('activity' => array('messageType' => 'success', 'message' => '<b>' . $data->name . '</b> is available.')));
            exit;
        }
    }

    public function addItem()
    {
        $this->acl->access('edit_product_item');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error', 'message' => 'Item\'s security_code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'New item\'s security code not found.')));
                exit;
            }

            if (empty($data->name)) {
                echo json_encode([['type' => 'error', 'message' => 'Item\'s name not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Item\'s name not found.')));
                exit;
            }

            if (empty($data->cStatus)) {
                echo json_encode([['type' => 'error', 'message' => 'Item (' . ucfirst($this->getTextnonPOST($data->name)) . ')\'s current status not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Item (' . ucfirst($this->getTextnonPOST($data->name)) . ')\'s current status not found.')));
                exit;
            }

            if ($data->btnName === 'Save') {
                if ($this->items->isItemAlreadyExists($data->name)) {
                    echo json_encode([['type' => 'error', 'message' => 'The item <b>' . $data->name . '</b> has already exist. Please enter new one.',],]);
                    Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'The item <b>' . $data->name . '</b> has already exist. Please enter new one.')));
                    exit;
                } else {
                    $this->items->insertItem(ucfirst($this->getTextnonPOST($data->name)), $this->getTextnonPOST($data->cStatus), Session::get('id_user'), Session::get('username'), Session::get('f_name') . ' ' . Session::get('l_name'));
                    echo json_encode([['type' => 'success', 'message' => 'A new item (' . ucfirst($this->getTextnonPOST($data->name)) . ') added successfully...',],]);
                    Tracker::addEvent(array(
                        'activity' => array('messageType' => 'success', 'message' => 'A new item (' . ucfirst($this->getTextnonPOST($data->name)) . ') added successfully...'),
                        'update' => array('messageType' => 'success', 'uFile' => 'Item', 'message' => 'A new item (' . ucfirst($this->getTextnonPOST($data->name)) . ') added successfully...')
                    ));
                    exit;
                }
            }

            if ($data->btnName === 'Update') {
                $Item = $this->items->getItem($this->filterInt($data->id));
                $this->items->editItem($this->filterInt($data->id), ucfirst($this->getTextnonPOST($data->name)), $this->getTextnonPOST($data->cStatus), Session::get('id_user'), Session::get('username'), Session::get('f_name') . ' ' . Session::get('l_name'));
                echo json_encode([['type' => 'success', 'message' => '<b>' . $Item[0]['name'] . ' </b> to <b>' . ucfirst($this->getTextnonPOST($data->name)) . ' </b> updated successfully...'],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success', 'message' => '<b>' . $Item[0]['name'] . '('.$Item[0]['c_status'].') </b> to <b>' . ucfirst($this->getTextnonPOST($data->name)) . '('.$this->getTextnonPOST($data->cStatus).') </b> updated successfully...'),
                    'update' => array('messageType' => 'success', 'uFile' => 'Item', 'message' => '<b>' . $Item[0]['name'] . ' </b> to <b>' . ucfirst($this->getTextnonPOST($data->name)) . ' </b> updated successfully...')
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

    public function deleteItem()
    {
        $this->acl->access('delete_product_item');
        $data = json_decode(file_get_contents('php://input'));
        if (count($data) > 0) {
            $Item = $this->items->getItem($this->filterInt($data->id));
            $this->items->deleteItem($data->id);
            echo json_encode([['type' => 'success', 'message' => ucfirst($Item[0]['name']) . ' item deleted successfully...',],]);
            Tracker::addEvent(array(
                'activity' => array('messageType' => 'success', 'message' => '<b>' . ucfirst($Item[0]['name']) . ' </b> item deleted successfully....'),
                'update' => array('messageType' => 'success', 'uFile' => 'Item', 'message' => '<b>' . ucfirst($Item[0]['name']) . ' </b> item deleted successfully....')));
            exit;
        }
    }

    public function ChangeProductAbility() {
        $this->acl->access('edit_product_item');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error','message' => 'Item\'s security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Item\'s security code not found.')));
                exit;
            }

            if (empty($data->current_status)) {
                echo json_encode([['type' => 'error','message' => 'Item\'s current status not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Item\'s current status not found.')));
                exit;
            }

            if (empty($data->newAbility)) {
                echo json_encode([['type' => 'error','message' => 'Item\'s new status not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Item\'s new status not found.')));
                exit;
            }

            $Item = $this->items->getItem($this->filterInt($data->id));
            $this->items->ChangeProductAbility($this->filterInt($data->id), $this->getTextnonPOST($data->current_status), $data->newAbility);
            echo json_encode([['type' => 'success','message' => ucfirst($Item[0]['name']) . ' changed successfully...',],]);
            Tracker::addEvent(array(
                'activity' => array('messageType' => 'success','message' => ucfirst($Item[0]['name']) . ' changed successfully...'),
                'update' => array('messageType' => 'success', 'uFile' => 'user', 'message' => ucfirst($Item[0]['name']) . ' changed successfully...')
            ));
            exit;
        }
    }
    //--------------------------------------------------

}
