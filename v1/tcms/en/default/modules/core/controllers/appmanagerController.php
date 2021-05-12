<?php

class appmanagerController extends Controller {

    private $appmanager;
    private $user;

    public function __construct() {
        parent::__construct();
        $this->access_init();
        $this->appmanager = $this->loadModel('appmanager');
        $this->user = $this->loadModel('user');
    }

    public function index() {
        $this->acl->access('edit_content');
        Tracker::addEvent(array('activity' => array('messageType' => 'success','message' => 'Navigate to app manager page successfully')));

        $this->view->setJs(['main']);
        $this->view->assign('title', 'App Manager');
        $this->view->render('index', 'App Manager');
    }

    public function getAdminMenus() {
        $this->acl->access('edit_content');
        //getting data from database
        echo json_encode($this->appmanager->getAdminMenus());
    }


    //--------------------------------------------------

    public function permissions() {
        $this->acl->access('edit_content');
        Tracker::addEvent(array('activity' => array('messageType' => 'success','message' => 'Navigate to permissions page successfully')));

        $this->getLibrary('pagination');
        $pagination = new Pagination();

        $this->view->setJs(['main']);
        $this->view->assign('permissions', $pagination->pager($this->appmanager->getPermissions()));
        $this->view->assign('pagination', $pagination->getView('ajax'));
        $this->view->assign('title', 'Permissions');
        $this->view->render('permissions', 'Permissions');
    }

    public function permissionsPaginationAJAX() {
        $page = $this->getInt('page');

        $this->getLibrary('pagination');
        $pagination = new Pagination();

        $this->view->assign('permissions', $pagination->pager($this->appmanager->getPermissions(), $page));
        $this->view->assign('pagination', $pagination->getView('ajax'));
        $this->view->render('permissions_p_ajax', false, true);
    }

    public function getPermissions() {
        $this->acl->access('edit_content');
        echo json_encode($this->appmanager->getPermissions());
    }

    public function getPermissionsAll() {
        $this->acl->access('edit_content');
        echo json_encode($this->appmanager->getPermissionsAll());
    }

    public function addPermission() {
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            if (empty($data->security_code) || $data->security_code !== 1) {
                echo json_encode([['type' => 'error','message' => 'Permission\'s security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Permission\'s security code not found.')));
                exit;
            }

            if (empty($data->name)) {
                echo json_encode([['type' => 'error','message' => 'Permission\'s name not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Permission\'s name not found.')));
                exit;
            }

            if (empty($data->key)) {
                echo json_encode([['type' => 'error','message' => 'Permission\'s key not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Permission\'s key not found.')));
                exit;
            }

            if (empty($data->PKID)) {
                echo json_encode([['type' => 'error','message' => 'Permission\'s key id not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Permission\'s key id not found.')));
                exit;
            }

            if ($data->btnName === 'Save') {
                $this->appmanager->insertPermission($this->getTextnonPOST($data->name), $this->getTextnonPOST($data->key), $this->getTextnonPOST($data->PKID));
                echo json_encode([['type' => 'success','message' => 'New Permission <b>' . ucfirst($this->getTextnonPOST($data->name)) . '</b> added successfully....',],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success','message' => 'New Permission <b>' . ucfirst($this->getTextnonPOST($data->name)) . '</b> added successfully....'),
                    'update' => array('messageType' => 'success', 'uFile' => 'Permission', 'message' => 'New Permission <b>' . ucfirst($this->getTextnonPOST($data->name)) . '</b> added successfully....')
                ));
                exit;
            }

            if ($data->btnName === 'Update') {
                $p = $this->appmanager->getPermission($this->filterInt($data->id));
                $this->appmanager->editPermission($this->filterInt($data->id), $this->getTextnonPOST($data->name), $this->getTextnonPOST($data->key), $this->getTextnonPOST($data->PKID));
                echo json_encode([['type' => 'success','message' => 'Permission ' . ucfirst($p['permission']) . ' to ' . ucfirst($this->getTextnonPOST($data->name)) . ' updated successfully....',],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success','message' => 'Permission ' . ucfirst($p['permission']) . ' to ' . ucfirst($this->getTextnonPOST($data->name)) . ' updated successfully....'),
                    'update' => array('messageType' => 'success', 'uFile' => 'Permission', 'message' => 'Permission ' . ucfirst($p['permission']) . ' to ' . ucfirst($this->getTextnonPOST($data->name)) . ' updated successfully....')
                ));
                exit;
            }

            if ($data->btnName !== 'Save' || $data->btnName !== 'Update') {
                echo json_encode([['type' => 'error','message' => 'Job command not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Job command not found.')));
                exit;
            }
        }
    }

    public function deletePermission() {
        $this->acl->access('edit_content');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            $permission = $this->appmanager->getPermission($this->filterInt($data->id));
            $this->appmanager->deletePermission($this->filterInt($data->id));
            echo json_encode([['type' => 'success','message' => 'The permission (' . $permission['permission'] . ') deleted successfully....',],]);
            Tracker::addEvent(array(
                'activity' => array('messageType' => 'success','message' => 'The permission (' . $permission['permission'] . ') deleted successfully....'),
                'update' => array('messageType' => 'success', 'uFile' => 'permission', 'message' => 'The permission (' . $permission['permission'] . ') deleted successfully....')
            ));
            exit;
        }
    }

    public function getPermissionsRole($id) {
        $this->acl->access('edit_content');
        echo json_encode($this->appmanager->getPermissionsRole($id));
    }

    // -------------------------------------

    public function roles() {
        $this->acl->access('edit_content');
        Tracker::addEvent(array('activity' => array('messageType' => 'success','message' => 'Navigate to roles page successfully')));

        $this->view->setJs(['main']);
        $this->view->assign('title', 'Roles');
        $this->view->render('roles', 'Roles');
    }

    public function getRoles() {
        $this->acl->access('edit_content');
        echo json_encode($this->appmanager->getRoles());
    }

    public function getRole($id) {
        $this->acl->access('edit_content');
        echo json_encode($this->appmanager->getRole($id));
    }

    public function addRole() {
        $data = json_decode(file_get_contents('php://input'));
        if (count($data) > 0) {
            if (empty($data->security_code) || $data->security_code !== 1) {
                echo json_encode([['type' => 'error','message' => 'Role\'s security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Role\'s security code not found.')));
                exit;
            }

            if (empty($data->name)) {
                echo json_encode([['type' => 'error','message' => 'Role\'s name not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Role\'s name not found.')));
                exit;
            }

            if ($data->btnName === 'Save') {
                if ($this->appmanager->isRoleAlreadyExists($data->name)) {
                    echo json_encode([['type' => 'error','message' => 'New role (' . $data->name . ') already exists.',],]);
                    Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'New role (' . $data->name . ') already exists.')));
                    exit;
                }
                $this->appmanager->insertRole($this->getTextnonPOST($data->name));
                echo json_encode([['type' => 'success','message' => 'New role (' . $this->getTextnonPOST($data->name) . ') added successfully....',],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success','message' => 'New role (' . $this->getTextnonPOST($data->name) . ') added successfully....'),
                    'update' => array('messageType' => 'success', 'uFile' => 'Role', 'message' => 'New role (' . $this->getTextnonPOST($data->name) . ') added successfully....')
                ));
                exit;
            }

            if ($data->btnName === 'Update') {
                $item = $this->appmanager->getRole($this->filterInt($data->id));
                $this->appmanager->editRole($this->filterInt($data->id), $this->getTextnonPOST($data->name));
                echo json_encode([['type' => 'success','message' => 'Role (' . $item['role'] . ' to ' . $this->getTextnonPOST($data->name) . ') updated successfully....',],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success','message' => 'Role (' . $item['role'] . ' to ' . $this->getTextnonPOST($data->name) . ') updated successfully....'),
                    'update' => array('messageType' => 'success', 'uFile' => 'Role', 'message' => 'Role (' . $item['role'] . ' to ' . $this->getTextnonPOST($data->name) . ') updated successfully....')
                ));
                exit;
            }

            if ($data->btnName !== 'Save' || $data->btnName !== 'Update') {
                echo json_encode([['type' => 'error','message' => 'Job command not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Job command not found.')));
                exit;
            }
        }
    }

    public function deleteRole() {
        $this->acl->access('edit_content');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            $item = $this->appmanager->getRole($this->filterInt($data->id));
            $this->appmanager->deleteRole($this->filterInt($data->id));
            echo json_encode([['type' => 'success','message' => '<b>' . $item['role'] . '</b> role deleted successfully....',],]);
            Tracker::addEvent(array(
                'activity' => array('messageType' => 'success','message' => '<b>' . $item['role'] . '</b> role deleted successfully....'),
                'update' => array('messageType' => 'success', 'uFile' => 'role', 'message' => '<b>' . $item['role'] . '</b> role deleted successfully....')
            ));
            exit;
        }
    }

    public function rolePermissions($id) {
        $this->acl->access('edit_content');
        Tracker::addEvent(array('activity' => array('messageType' => 'success','message' => 'Navigate to role permissions page successfully')));

        $id = $this->filterInt($id);
        if (!$id) {
            $this->redirect('appManager/roles');
        }

        if (!$this->appmanager->getRole($id)) { $this->redirect('appManager/roles'); }

        $this->view->setJs(['main']);
        $this->view->assign('role_id', $id);
        $this->view->assign('role', $this->appmanager->getRole($id));
        $this->view->assign('rolePermissions', $this->appmanager->getRolePermissions($id));
        $this->view->assign('title', 'Role permissions ');
        $this->view->render('r_permissions', 'Role permissions');
    }

    public function updateRolePermission() {
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error','message' => 'Permission\'s security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Permission\'s security code not found.')));
                exit;
            }

            if (empty($data->role)) {
                echo json_encode([['type' => 'error','message' => 'Permitted role not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Permitted role not found.')));
                exit;
            }

            if (empty($data->permission)) {
                echo json_encode([['type' => 'error','message' => 'Permission\'s name not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Permission\'s name not found.')));
                exit;
            }

            /*if (empty($data->value)) {
                echo json_encode([['type' => 'error','message' => 'Permission\'s value not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Permission\'s value not found.')));
                exit;
            }*/

            if ($data->value === '0' || $data->value === '1') {
                $this->appmanager->editRolePermission($this->filterInt($data->role), $this->filterInt($data->permission), $this->filterInt($data->value));
                echo json_encode([['type' => 'success','message' => 'Permission changes Successfully...',],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success','message' => 'Permission (' . $data->permission . ') changes Successfully...'),
                    'update' => array('messageType' => 'success', 'uFile' => 'RolePermission', 'message' => 'Permission (' . $data->permission . ') changes Successfully...')
                ));
                exit;
            }

            if ($data->value === 'x') {
                $this->appmanager->deleteRolePermission($this->filterInt($data->role), $this->filterInt($data->permission));
                echo json_encode([['type' => 'success', 'message' => 'Permission changes Successfully...'],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success','message' => 'Permission (' . $data->permission . ') deleted Successfully...'),
                    'update' => array('messageType' => 'success', 'uFile' => 'RolePermission', 'message' => 'Permission (' . $data->permission . ') deleted Successfully...')
                ));
                exit;
            }
        }
    }

    //--------------------------------------------------

    public function users() {

        $this->acl->access('edit_content');
        Tracker::addEvent(array('activity' => array('messageType' => 'success','message' => 'Navigate to users page successfully')));

        $this->getLibrary('pagination');
        $pagination = new Pagination();

        $this->view->assign('users', $pagination->pager($this->appmanager->getUsers()));
        $this->view->assign('roles', $this->appmanager->getRoles());
        $this->view->assign('pagination', $pagination->getView('ajax'));

        $this->view->setJs(['main']);
        $this->view->assign('title', 'Users');
        $this->view->render('users', 'Users');
    }

    public function usersPaginationDATA() {
        $this->acl->access('edit_content');
        $this->getLibrary('pagination');
        $pagination = new Pagination();
        echo json_encode($pagination->pager($this->appmanager->getUsers()));
    }

    public function usersPaginationAJAX() {
        $page = $this->getInt('page');

        $this->getLibrary('pagination');
        $pagination = new Pagination();

        $this->view->assign('users', $pagination->pager($this->appmanager->getUsers(), $page));
        $this->view->assign('pagination', $pagination->getView('ajax'));
        $this->view->render('users_p_ajax', false, true);
    }

    public function getUsers() {
        $this->acl->access('edit_content');
        echo json_encode($this->appmanager->getUsers());
    }

    public function getUsersAll() {
        $this->acl->access('edit_content');
        echo json_encode($this->appmanager->getUsersAll());
    }

    public function addUser() {
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error','message' => 'User\'s security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'User\'s security code not found.')));
                exit;
            }

            if (empty($data->FName)) {
                echo json_encode([['type' => 'error','message' => 'User\'s first name not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'User\'s first name not found.')));
                exit;
            }

            if (empty($data->LName)) {
                echo json_encode([['type' => 'error','message' => 'User\'s last name not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'User\'s last name not found.')));
                exit;
            }

            if (empty($data->email)) {
                echo json_encode([['type' => 'error','message' => 'User\'s email address not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'User\'s email address not found.')));
                exit;
            }

            if (empty($data->username)) {
                echo json_encode([['type' => 'error','message' => 'User\'s username not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'User\'s username not found.')));
                exit;
            }

            if (empty($data->password)) {
                echo json_encode([['type' => 'error','message' => 'User\'s password not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'User\'s password not found.')));
                exit;
            }

            if (empty($data->activity)) {
                echo json_encode([['type' => 'error','message' => 'User\'s activity not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'User\'s activity not found.')));
                exit;
            }

            if (empty($data->role)) {
                echo json_encode([['type' => 'error','message' => 'User\'s role not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'User\'s role not found.')));
                exit;
            }

            if ($data->btnName === 'Save') {
                $this->appmanager->insertUserBasicInfo($this->getTextnonPOST($data->FName), $this->getTextnonPOST($data->LName), $this->getTextnonPOST($data->email), $this->getTextnonPOST($data->username), $this->getTextnonPOST($data->password), $this->getTextnonPOST($data->activity), $this->filterInt($data->role));
                echo json_encode([['type' => 'success','message' => 'New user (' . ucfirst($this->getTextnonPOST($data->FName)) . ' ' . $this->getTextnonPOST($data->LName) . ') added successfully...',],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success','message' => 'New user (' . ucfirst($this->getTextnonPOST($data->FName)) . ' ' . $this->getTextnonPOST($data->LName) . ') added successfully...'),
                    'update' => array('messageType' => 'success', 'uFile' => 'user', 'message' => 'New user (' . ucfirst($this->getTextnonPOST($data->FName)) . ' ' . $this->getTextnonPOST($data->LName) . ') added successfully...')
                ));
                exit;
            }

            if ($data->btnName === 'Update') {
                $user = $this->appmanager->getUser($this->filterInt($data->id));
                $this->appmanager->editUser($this->filterInt($data->id), $this->getTextnonPOST($data->FName), $this->getTextnonPOST($data->LName), $this->getTextnonPOST($data->email), $this->getTextnonPOST($data->username), $this->getTextnonPOST($data->password), $this->getTextnonPOST($data->activity), $this->filterInt($data->role));
                echo json_encode([['type' => 'success','message' => 'New user (' . ucfirst($user[0]['f_name']) . ' ' . $user[0]['l_name'] . ' to ' . ucfirst($this->getTextnonPOST($data->FName)) . ' ' . $this->getTextnonPOST($data->LName) . ') updated successfully...',],]);
                Tracker::addEvent(array(
                    'activity' => array('messageType' => 'success','message' => 'New user (' . ucfirst($user[0]['f_name']) . ' ' . $user[0]['l_name'] . ' to ' . ucfirst($this->getTextnonPOST($data->FName)) . ' ' . $this->getTextnonPOST($data->LName) . ') updated successfully...'),
                    'update' => array('messageType' => 'success', 'uFile' => 'user', 'message' => 'New user (' . ucfirst($user[0]['f_name']) . ' ' . $user[0]['l_name'] . ' to ' . ucfirst($this->getTextnonPOST($data->FName)) . ' ' . $this->getTextnonPOST($data->LName) . ') updated successfully...')
                ));
                exit;
            }

            if ($data->btnName !== 'Save' || $data->btnName !== 'Update') {
                echo json_encode([['type' => 'error','message' => 'Job command not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'Job command not found.')));
                exit;
            }
        }
    }

    public function deleteUser() {
        $this->acl->access('edit_content');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            $user = $this->appmanager->getUser($this->filterInt($data->id));
            $this->appmanager->deleteUser($data->id);
            echo json_encode([['type' => 'success','message' => ucfirst($user[0]['f_name']) . ' ' . $user[0]['l_name'] . ' deleted successfully...',],]);
            Tracker::addEvent(array(
                'activity' => array('messageType' => 'success','message' => ucfirst($user[0]['f_name']) . ' ' . $user[0]['l_name'] . ' deleted successfully...'),
                'update' => array('messageType' => 'success', 'uFile' => 'user', 'message' => ucfirst($user[0]['f_name']) . ' ' . $user[0]['l_name'] . ' deleted successfully...')
            ));
            exit;
        }
    }

    public function verifyUser() {
        $this->acl->access('edit_content');
        $data = json_decode(file_get_contents('php://input'));

        if (count($data) > 0) {
            if (empty($data->security_code) OR $data->security_code !== 1) {
                echo json_encode([['type' => 'error','message' => 'User\'s security code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'User\'s security code not found.')));
                exit;
            }

            if (empty($data->code)) {
                echo json_encode([['type' => 'error','message' => 'User\'s code not found.',],]);
                Tracker::addEvent(array('activity' => array('messageType' => 'error','message' => 'User\'s code not found.')));
                exit;
            }

            $user = $this->appmanager->getUser($this->filterInt($data->id));
            $this->user->activeUser($this->filterInt($data->id), $this->filterInt($data->code));
            echo json_encode([['type' => 'success','message' => ucfirst($user[0]['f_name']) . ' ' . $user[0]['l_name'] . ' verified successfully...',],]);
            Tracker::addEvent(array(
                'activity' => array('messageType' => 'success','message' => ucfirst($user[0]['f_name']) . ' ' . $user[0]['l_name'] . ' verified successfully...'),
                'update' => array('messageType' => 'success', 'uFile' => 'user', 'message' => ucfirst($user[0]['f_name']) . ' ' . $user[0]['l_name'] . ' verified successfully...')
            ));
            exit;
        }
    }

    //--------------------------------------------------
    
    }
