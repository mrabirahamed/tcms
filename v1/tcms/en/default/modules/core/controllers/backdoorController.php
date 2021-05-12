<?php

class backdoorController extends Controller{
    public $database;
    public function __construct(){
        parent::__construct();
        $this->database = $this->loadModel('backdoor');
    }

    public function index(){
        Tracker::addEvent(array('activity' => array('messageType' => 'success','message' => 'Navigate backdoor page successfully')));
        $this->acl->access('edit_content');
    }

    public function getNotify(){
        $this->acl->access('edit_content');
        echo json_encode($this->database->notifications());
    }

    public function inputClientData(){
        $data = json_decode(file_get_contents('php://input'));
        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error', 'message' => 'Your security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Client(' . ucfirst($this->getTextnonPOST($data->client)) . ') security code not found.')));
                exit;
            }

            if (empty($data->code)) {
                echo json_encode([['type' => 'error', 'message' => 'Your code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Client(' . ucfirst($this->getTextnonPOST($data->client)) . ') code not found.')));
                exit;
            }

            if ($data->action === 'Save') {
                $this->database->inputClientData($data->code);
                echo json_encode([['type' => 'success', 'message' => 'Client(' . ucfirst($this->getTextnonPOST($data->client)) . ') send data successfully...',],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success','message' => 'Client(' . ucfirst($this->getTextnonPOST($data->client)) . ') send data successfully...'),
                    'update' => array('messageType' => 'success', 'uFile' => 'Client(' . ucfirst($this->getTextnonPOST($data->client)) . ') datas', 'message' => 'Client(' . ucfirst($this->getTextnonPOST($data->client)) . ') send data successfully...')
                ));
                exit;
            }
        }
    }
}