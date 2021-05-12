<?php

class Acl
{

    private $registry;
    private $db;
    private $id;
    private $role;
    private $permissions;

    public function __construct($id = FALSE)
    {
        if ($id) {
            $this->id = (int)$id;
        } else {
            if (Session::get('id_user')) {
                $this->id = Session::get('id_user');
            } else {
                $this->id = 0;
            }
        }

        $this->registry = Registry::getInstance();
        $this->db = $this->registry->db;
        $this->role = $this->getRole();
        $this->permissions = $this->getPermissionsRole();
        $this->compilerAcl();
    }

    public function compilerAcl()
    {
        $this->permissions = array_merge(
            $this->permissions,
            $this->getPermissionsUser()
        );
    }

    public function getRole()
    {
        $data = $this->db->query("SELECT `role` FROM `" . DbPREFIX . "users`  WHERE `id` = '{$this->id}'");
        $data = $data->fetch();
        return $data['role'];
    }

    public function getPermissionsRoleId()
    {
        $ids = $this->db->query("SELECT `permission` FROM `" . DbPREFIX . "permissions_role`  WHERE `role` = '{$this->role}'");
        $ids = $ids->fetchAll(PDO::FETCH_ASSOC);
        $id = array();
        for ($i = 0; $i < count($ids); $i++) {
            $id[] = $ids[$i]['permission'];
        }
        return $id;
    }

    public function getPermissionsRole()
    {
        $permissions = $this->db->query("SELECT * FROM `" . DbPREFIX . "permissions_role`  WHERE `role` = '{$this->role}'");

        $permissions = $permissions->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for ($i = 0; $i < count($permissions); $i++) {
            $key = $this->getPermissionKey($permissions[$i]['permission']);
            if ($key === '') {
                continue;
            }

            if ($permissions[$i]['value'] === 1) {
                $v = true;
            } else {
                $v = false;
            }

            $data[$key] = array(
                'key' => $key,
                'permission' => $this->getPermissionNumber($permissions[$i]['permission']),
                'value' => $v,
                'inherit' => true,
                'id' => $permissions[$i]['permission']
            );
        }

        return $data;
    }

    public function getPermissionKey($permissionID)
    {
        $permissionID = (int)$permissionID;
        $key = $this->db->query("SELECT `key` FROM `" . DbPREFIX . "permissions` WHERE `id_permission` = '{$permissionID}'");
        $key = $key->fetch();
        return $key['key'];
    }

    public function getPermissionNumber($permissionID)
    {
        $permissionID = (int)$permissionID;
        $key = $this->db->query("SELECT `permission` FROM `" . DbPREFIX . "permissions` WHERE `id_permission` = '{$permissionID}'");
        $key = $key->fetch();
        return $key['permission'];
    }

    public function getPermissionsUser()
    {
        $ids = $this->getPermissionsRoleId();
        if (count($ids)) {
            $im_var = implode(", ", $ids);
            $permissions = $this->db->query("SELECT * FROM " . DbPREFIX . "permissions_user WHERE user = {$this->id} AND " .
                "permission in (" . $im_var . ")"
            );
            $permissions = $permissions->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $permissions = array();
        }

        $data = array();
        for ($i = 0; $i < count($permissions); $i++) {
            $key = $this->getPermissionKey($permissions[$i]['permission']);
            if ($key == '') {
                continue;
            }

            if ($permissions[$i]['value'] === 1) {
                $v = true;
            } else {
                $v = false;
            }

            $data[$key] = array(
                'key' => $key,
                'permission' => $this->getPermissionNumber($permissions[$i]['permission']),
                'value' => $v,
                'inherit' => false,
                'id' => $permissions[$i]['permission']
            );
        }

        return $data;
    }

    public function getPermissions()
    {
        if (isset($this->permissions) && count($this->permissions)) {
            return $this->permissions;
        }
    }

    public function permission($key)
    {
        if (array_key_exists($key, $this->permissions)) {
            if ($this->permissions[$key]['value'] === true || $this->permissions[$key]['value'] === 1) {
                return TRUE;
            }
        }
        return FALSE;
    }

    public function access($key)
    {
        if ($this->permission($key)) {
            Session::sessionTime();
            return;
        }
        Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'session time out')));
        header('location:' . BaseURL . 'error/access/401');
        exit;
    }
}
