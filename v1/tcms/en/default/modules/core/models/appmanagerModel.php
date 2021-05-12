<?php

class appmanagerModel extends Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function getAdminMenus() {
        $data = $this->db->query("SELECT * FROM `" . DbPREFIX . "admin_menu` ORDER BY `am_id` ASC;");
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }
    /* start of Role add, update and delete sectioin */

    public function getRoles() {
        $role = $this->query("SELECT * FROM " . DbPREFIX . "roles");
        return $role->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRole($roleId) {
        $role = $this->query("SELECT * FROM " . DbPREFIX . "roles WHERE id_role = '$roleId' ");
        return $role->fetch(PDO::FETCH_ASSOC);
    }

    public function isRoleAlreadyExists($roleName) {
        $role = $this->db->prepare("SELECT * FROM `" . DbPREFIX . "roles` WHERE `role` = :role");
        $role->execute(
                array(
                    ':role' => $roleName
                )
        );
        if ($role->fetch(PDO::FETCH_ASSOC)) {
            return TRUE;
        }
        return FALSE;
    }

    public function insertRole($role) {
        $this->prepare("INSERT INTO " . DbPREFIX . "roles VALUES (null, :role)")
                ->execute(
                        [
                            ':role' => $role,
        ]);
    }

    public function editRole($roleId, $role) {
        $id = (int) $roleId;
        $this->prepare("UPDATE " . DbPREFIX . "roles SET role = :role WHERE id_role = :id")
                ->execute(
                        [
                            ':id' => $id,
                            ':role' => $role,
        ]);
    }

    public function deleteRole($id) {
        $id = (int) $id;
        $this->query("DELETE from " . DbPREFIX . "roles where id_role = $id");
    }
    
    public function getRolePermissions($roleId) {
        $data = [];

        $permissions = $this->query("SELECT * FROM " . DbPREFIX . "permissions_role WHERE role = '$roleId'");
        $permissions = $permissions->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($permissions); $i++) {
            $key = $this->getPermissionKey($permissions[$i]['permission']);

            if ($key === '') {
                continue;
            }

            if ($permissions[$i]['value'] === 1) {
                $v = 1;
            } else {
                $v = 0;
            }

            $data[$key] = [
                'PKID' => $this->getPermissionPKID($permissions[$i]['permission']),
                'key' => $key,
                'value' => $v,
                'name' => $this->getPermissionName($permissions[$i]['permission']),
                'id' => $permissions[$i]['permission'],
            ];
        }

        $data = array_merge($this->getPermissionsAll(), $data);
        return $data;
    }

    public function editRolePermission($roleId, $permissionId, $value) {
        $this->query("REPLACE INTO " . DbPREFIX . "permissions_role SET role = '$roleId', permission = '$permissionId', value = '$value'");
    }

    public function deleteRolePermission($roleId, $permissionId) {
        $this->query("DELETE FROM " . DbPREFIX . "permissions_role WHERE role = '$roleId' AND permission = '$permissionId'");
    }

    /* end of Role add, update and delete sectioin */

    /* start of Permission add, update and delete sectioin */

    public function insertPermission($permission, $key, $PKID) {
        $this->prepare("INSERT INTO " . DbPREFIX . "permissions VALUES (null, :permission, :key, :PKID)")
                ->execute(
                        [
                            ':permission' => $permission,
                            ':key' => $key,
                            ':PKID' => $PKID,
        ]);
    }

    public function editPermission($id, $permission, $key, $PKID) {
        $id = (int) $id;
        $this->prepare('UPDATE ' . DbPREFIX . 'permissions SET `permission` = :permission, ' .
                        '`key` = :key, `PKID` = :PKID WHERE `id_permission` = :id')
                ->execute(
                        [
                            ':id' => $id,
                            ':permission' => $permission,
                            ':key' => $key,
                            ':PKID' => $PKID,
        ]);
    }

    public function deletePermission($id) {
        $id = (int) $id;
        $this->query("DELETE from " . DbPREFIX . "permissions where id_permission = $id");
    }

    public function getPermission($permissionID) {
        $permissionID = (int) $permissionID;

        $key = $this->query(
                "SELECT * FROM " . DbPREFIX . "permissions " .
                "WHERE id_permission = '{$permissionID}'"
        );

        return $key->fetch(PDO::FETCH_ASSOC);
    }

    public function getPermissions() {
        $permissions = $this->query("SELECT * FROM " . DbPREFIX . "permissions");
        return $permissions->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPermissionsAll() {
        $permissions = $this->query("SELECT * FROM " . DbPREFIX . "permissions");
        $permissions = $permissions->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($permissions); $i++) {
            if ($permissions[$i]['key'] === '') {
                continue;
            }

            $data[$permissions[$i]['key']] = [
                'PKID' => $permissions[$i]['PKID'],
                'key' => $permissions[$i]['key'],
                'value' => 'x',
                'name' => $permissions[$i]['permission'],
                'id' => $permissions[$i]['id_permission']
            ];
        }

        return $data;
    }

    public function getPermissionKey($permissionID) {
        $permissionID = (int) $permissionID;
        $key = $this->query(
                "SELECT `key` FROM " . DbPREFIX . "permissions " .
                "WHERE id_permission = '{$permissionID}'"
        );
        $key = $key->fetch(PDO::FETCH_ASSOC);
        return $key['key'];
    }

    public function getPermissionName($permissionID) {
        $permissionID = (int) $permissionID;
        $name = $this->query(
                "SELECT `permission` FROM " . DbPREFIX . "permissions " .
                "WHERE id_permission = '{$permissionID}'"
        );
        $name = $name->fetch(PDO::FETCH_ASSOC);
        return $name['permission'];
    }

    public function getPermissionPKID($permissionID) {
        $permissionID = (int) $permissionID;
        $PKID = $this->query(
                "SELECT `PKID` FROM " . DbPREFIX . "permissions " .
                "WHERE id_permission = '{$permissionID}'"
        );
        $PKID = $PKID->fetch(PDO::FETCH_ASSOC);
        return $PKID['PKID'];
    }

    /* end of Permission add, update and delete sectioin */

    /* end of tool add, update and delete sectioin */
    public function getUsers() {
        $UsersAll = $this->query("SELECT * FROM `" . DbPREFIX . "users`");
        return $UsersAll->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsersAll() {
        $UsersAll = $this->query("SELECT u.*, ui.* FROM " . DbPREFIX . "users u, " . DbPREFIX . "usersInfo ui WHERE u.id = ui.id");
        return $UsersAll->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUser($id) {
        $User = $this->query("SELECT * FROM `" . DbPREFIX . "users` WHERE `id` = $id");
        return $User->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertUserBasicInfo(  $FName,   $LName,   $email,  $username, $password, $activity,   $role) {
        $password = Hash::passwordENCRYPT($password);
        $username = (string) AppUsernamePrefix . $username;
        $random = rand(124578, 999999999);
        $this->db->prepare("INSERT INTO `" . DbPREFIX . "users`  VALUES (null, :FName, :LName, :email, :password, :username, :activity, :role, '0', now(), :code)")
                ->execute(
                        array(
                            ':FName' => $FName,
                            ':LName' => $LName,
                            ':email' => $email,
                            ':password' => $password,
                            ':username' => $username,
                            ':activity' => $activity,
                            ':role' => $role,
                            ':code' => $random
        ));
    }

    public function editUser($id, $FName,   $LName,   $email,  $username, $password, $activity,   $role) {
        $id = (int) $id;
        $password = Hash::passwordENCRYPT($password);
        //$username = (string) AppUsernamePrefix . $username;
        $random = rand(124578, 999999999);
        //UPDATE `msu_users` SET `f_name` = 'me', `l_name` = 'user', `email` = 'me@mail.com', `username` = 'msu_test', `activity` = 'Inactive', `role` = '2', `status` = '0', `r_date` = '2018-10-31 11:26:22', `code` = '44633' WHERE `msu_users`.`id` = 3;
        $this->db->query("UPDATE `" . DbPREFIX . "users` SET `f_name` = '$FName', `l_name` = '$LName', `email` = '$email', `password` = '$password',  `username` = '$username', `activity` = '$activity', `role` = '$role', `status` = '0', `r_date` = now(), `code` = '$random' WHERE `id` = $id");
    }

    public function deleteUser($id) {
        $id = (int) $id;
        $this->db->query("DELETE from `" . DbPREFIX . "users` where id = $id; ");
    }

    /* end of tool add, update and delete sectioin */
}
