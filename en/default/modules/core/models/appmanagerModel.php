<?php

class appmanagerModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAdminMenus()
    {
        $data = $this->db->query("SELECT * FROM `" . DbPREFIX . "admin_menu` ORDER BY `am_id` ASC;");
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    /* start of Branches add, update and delete section */

    public function getBranches()
    {
        $branch = $this->query("SELECT * FROM " . DbPREFIX . "branches ORDER BY `id` ASC;");
        return $branch->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBranch($id)
    {
        $branch = $this->query("SELECT * FROM " . DbPREFIX . "branches WHERE `id` = '$id'; ");
        return $branch->fetch(PDO::FETCH_ASSOC);
    }

    public function getBranchNameById($id)
    {
        $branch = $this->query("SELECT * FROM " . DbPREFIX . "branches WHERE `id` = '$id'; ");
        $branch = $branch->fetch(PDO::FETCH_ASSOC);
        return $branch['name'];
    }

    public function getBranchNameByUserId($id)
    {
        $branch = $this->query("SELECT * FROM " . DbPREFIX . "branch_user WHERE `id` = '$id'; ");
        $branch = $branch->fetch(PDO::FETCH_ASSOC);
        return $branch['user'];
    }

    public function isBranchAlreadyExists($name)
    {
        $branch = $this->db->prepare("SELECT * FROM `" . DbPREFIX . "branches` WHERE `name` = :name");
        $branch->execute(
            array(
                ':name' => $name
            )
        );
        if ($branch->fetch(PDO::FETCH_ASSOC)) {
            return TRUE;
        }
        return FALSE;
    }

    public function insertBranch($name, $status, $location)
    {
        $this->prepare("INSERT INTO `" . DbPREFIX . "branches` VALUES (null, :name, :status, :location)")
            ->execute(
                [
                    ':name' => $name,
                    ':status' => $status,
                    ':location' => $location
                ]);
    }

    public function editBranch($id, $name, $status, $location)
    {
        $id = (int)$id;
        $this->prepare("UPDATE `" . DbPREFIX . "branches` SET `name` = :name, `status` = :status, `location` = :location  WHERE id = :id")
            ->execute(
                [
                    ':id' => $id,
                    ':name' => $name,
                    ':status' => $status,
                    ':location' => $location
                ]);
    }

    public function deleteBranch($id)
    {
        $id = (int)$id;
        $this->query("DELETE from `" . DbPREFIX . "branches` where `id` = $id;");
    }

    public function isStuffAlreadyExists($branch, $stuff)
    {
        $data = $this->db->prepare("SELECT * FROM `" . DbPREFIX . "branch_user` WHERE `branch` = :branch AND `user` = :stuff");
        $data->execute(
            array(
                ':branch' => $branch,
                ':stuff' => $stuff
            )
        );
        if ($data->fetch(PDO::FETCH_ASSOC)) {
            return TRUE;
        }
        return FALSE;
    }

    public function addStuffToBranch($branch, $stuff)
    {
        $branch = (int)$branch;
        $stuff = (int)$stuff;
        $this->prepare("INSERT INTO `" . DbPREFIX . "branch_user` VALUES (null, :branch, :stuff);")
            ->execute(
                [
                    ':branch' => $branch,
                    ':stuff' => $stuff,
                ]);
    }

    public function removeStuffFromBranch($branch, $stuff)
    {
        $branch = (int)$branch;
        $stuff = (int)$stuff;
        $this->query("DELETE from `" . DbPREFIX . "branch_user` where `branch` = $branch AND `user` = $stuff");
    }

    /* end of Branches add, update and delete sectioin */

    /* start of Role add, update and delete sectioin */

    public function getRoles()
    {
        $role = $this->query("SELECT * FROM `" . DbPREFIX . "roles`");
        return $role->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRole($roleId)
    {
        $role = $this->query("SELECT * FROM " . DbPREFIX . "roles WHERE id_role = '$roleId' ");
        return $role->fetch(PDO::FETCH_ASSOC);
    }

    public function getRoleById($id)
    {
        $role = $this->query("SELECT * FROM " . DbPREFIX . "roles WHERE id_role = '$id' ");
        $role = $role->fetch(PDO::FETCH_ASSOC);
        return $role['role'];
    }

    public function isRoleAlreadyExists($roleName)
    {
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

    public function insertRole($role)
    {
        $this->prepare("INSERT INTO " . DbPREFIX . "roles VALUES (null, :role)")
            ->execute(
                [
                    ':role' => $role,
                ]);
    }

    public function editRole($roleId, $role)
    {
        $id = (int)$roleId;
        $this->prepare("UPDATE " . DbPREFIX . "roles SET role = :role WHERE id_role = :id")
            ->execute(
                [
                    ':id' => $id,
                    ':role' => $role,
                ]);
    }

    public function deleteRole($id)
    {
        $id = (int)$id;
        $this->query("DELETE from " . DbPREFIX . "roles where id_role = $id");
    }

    public function getRolePermissions($roleId)
    {
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

    public function editRolePermission($roleId, $permissionId, $value)
    {
        $this->query("REPLACE INTO " . DbPREFIX . "permissions_role SET role = '$roleId', permission = '$permissionId', value = '$value'");
    }

    public function deleteRolePermission($roleId, $permissionId)
    {
        $this->query("DELETE FROM " . DbPREFIX . "permissions_role WHERE role = '$roleId' AND permission = '$permissionId'");
    }

    /* end of Role add, update and delete sectioin */

    /* start of Permission add, update and delete sectioin */

    public function insertPermission($permission, $key, $PKID)
    {
        $this->prepare("INSERT INTO " . DbPREFIX . "permissions VALUES (null, :permission, :key, :PKID)")
            ->execute(
                [
                    ':permission' => $permission,
                    ':key' => $key,
                    ':PKID' => $PKID,
                ]);
    }

    public function editPermission($id, $permission, $key, $PKID)
    {
        $id = (int)$id;
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

    public function deletePermission($id)
    {
        $id = (int)$id;
        $this->query("DELETE from " . DbPREFIX . "permissions where id_permission = $id");
    }

    public function getPermission($permissionID)
    {
        $permissionID = (int)$permissionID;

        $key = $this->query(
            "SELECT * FROM " . DbPREFIX . "permissions " .
            "WHERE id_permission = '{$permissionID}'"
        );

        return $key->fetch(PDO::FETCH_ASSOC);
    }

    public function getPermissions()
    {
        $permissions = $this->query("SELECT * FROM " . DbPREFIX . "permissions");
        return $permissions->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPermissionsAll()
    {
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

    public function getPermissionKey($permissionID)
    {
        $permissionID = (int)$permissionID;
        $key = $this->query(
            "SELECT `key` FROM " . DbPREFIX . "permissions " .
            "WHERE id_permission = '{$permissionID}'"
        );
        $key = $key->fetch(PDO::FETCH_ASSOC);
        return $key['key'];
    }

    public function getPermissionName($permissionID)
    {
        $permissionID = (int)$permissionID;
        $name = $this->query(
            "SELECT `permission` FROM " . DbPREFIX . "permissions " .
            "WHERE id_permission = '{$permissionID}'"
        );
        $name = $name->fetch(PDO::FETCH_ASSOC);
        return $name['permission'];
    }

    public function getPermissionPKID($permissionID)
    {
        $permissionID = (int)$permissionID;
        $PKID = $this->query("SELECT `PKID` FROM " . DbPREFIX . "permissions WHERE id_permission = '{$permissionID}'");
        $PKID = $PKID->fetch(PDO::FETCH_ASSOC);
        return $PKID['PKID'];
    }

    /* end of Permission add, update and delete sectioin */

    /* end of tool add, update and delete section */

    public function isUserCreatedCheckedByUserId($id)
    {
        $app = $this->query("SELECT u.*, ui.* FROM " . DbPREFIX . "users u, " . DbPREFIX . "users_details ui WHERE u.id = $id AND ui.id = $id");
        if ($app->fetch(PDO::FETCH_ASSOC)) {
            return TRUE;
        }
        return FALSE;
    }


    public function getUser($id)
    {
        $User = $this->query("SELECT * FROM `" . DbPREFIX . "users` WHERE `id` = $id");
        return $User->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsersAll()
    {
        $Users = $this->query("SELECT u.*, ui.* FROM " . DbPREFIX . "users u, " . DbPREFIX . "users_details ui WHERE u.id = ui.id");
        $Users = $Users->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for ($i = 0; $i < count($Users); $i++) {
            $data[$i] = array(
                'serialNumber' => $i + 1,
                'id' => $Users[$i]['id'],
                'first_name' => $Users[$i]['f_name'],
                'last_name' => $Users[$i]['l_name'],
                'email' => $Users[$i]['email'],
                'password' => Hash::passwordDECRYPT($Users[$i]['password']),
                'username' => ucfirst(preg_replace('/' . AppUsernamePrefix . '/is', '$1', $Users[$i]['username'])),
                'gender' => $Users[$i]['gender'],
                'date_of_birth' => date("Y-m-d", strtotime($Users[$i]['dob'])),
                'profession' => $Users[$i]['profession'],
                'profile_picture' => $Users[$i]['pro_pic'],
                'activity' => $Users[$i]['activity'],
                'role' => $this->getRoleById($Users[$i]['role']),
                'roleid' => $Users[$i]['role'],
                'status' => $Users[$i]['status'],
                'code' => $Users[$i]['code'],
                'r_date' => date("m/d/Y", strtotime($Users[$i]['r_date'])),
                'working_time' => $this->getTimeDurration($Users[$i]['r_date'], date("Y-m-d H:i:s")),
                'branch' => $this->getBranchIdByUserId($Users[$i]['id']),
                'branchName' => $this->getBranchNameById($this->getBranchIdByUserId($Users[$i]['id']))

            );
        }
        return $data;
    }

    public function getBranchUsersDetailsWithWorkingTime($branch)
    {
        $branch = (int)$branch;
        $Users = $this->query("SELECT u.*, ui.* FROM " . DbPREFIX . "users u, " . DbPREFIX . "users_details ui WHERE u.id = ui.id");
        $Users = $Users->fetchAll(PDO::FETCH_ASSOC);
        $data = array();
        $subData1 = array();
        $subData2 = array();

        for ($i = 0; $i < count($Users); $i++) {
            if ($Users[$i]['id'] === $this->getUserIdByBranchNUserId($branch, $Users[$i]['id'])) {
                $subData1[$i] = array(
                    'serialNumber' => $i + 1,
                    'id' => $Users[$i]['id'],
                    'full_name' => $Users[$i]['f_name'] . ' ' . $Users[$i]['l_name'],
                    'email' => $Users[$i]['email'],
                    'password' => Hash::passwordDECRYPT($Users[$i]['password']),
                    'username' => ucfirst(preg_replace('/' . AppUsernamePrefix . '/is', '$1', $Users[$i]['username'])),
                    'activity' => $Users[$i]['activity'],
                    'role' => $this->getRoleById($Users[$i]['role']),
                    'r_date' => date("d-m-y", strtotime($Users[$i]['r_date'])),
                    'profile_picture' => $Users[$i]['pro_pic'],
                    'working_time' => $this->getTimeDurration($Users[$i]['r_date'], date("Y-m-d H:i:s")),
                    'branch' => $this->getBranchIdByUserId($Users[$i]['id']),
                    'branchName' => $this->getBranchNameById($this->getBranchIdByUserId($Users[$i]['id']))

                );
            }

            if ($Users[$i]['id'] !== $this->getUserIdFromBranchUserByUserId($Users[$i]['id'])) {
                $subData2[$i] = array(
                    'serialNumber' => $i + 1,
                    'id' => $Users[$i]['id'],
                    'full_name' => $Users[$i]['f_name'] . ' ' . $Users[$i]['l_name'],
                    'email' => $Users[$i]['email'],
                    'password' => Hash::passwordDECRYPT($Users[$i]['password']),
                    'username' => ucfirst(preg_replace('/' . AppUsernamePrefix . '/is', '$1', $Users[$i]['username'])),
                    'activity' => $Users[$i]['activity'],
                    'role' => $this->getRoleById($Users[$i]['role']),
                    'r_date' => date("d-m-y", strtotime($Users[$i]['r_date'])),
                    'profile_picture' => $Users[$i]['pro_pic'],
                    'working_time' => $this->getTimeDurration($Users[$i]['r_date'], date("Y-m-d H:i:s")),
                    'branch' => $this->getBranchIdByUserId($Users[$i]['id']),
                    'branchName' => $this->getBranchNameById($this->getBranchIdByUserId($Users[$i]['id']))

                );
            }

            $data = array_merge($subData1, $subData2);
        }

        return $data;
    }

    public function getUserIdByBranchNUserId($branch, $user)
    {
        $branch = (int)$branch;
        $user = (int)$user;
        $data = $this->query("SELECT * FROM `" . DbPREFIX . "branch_user` WHERE `branch` = '$branch' AND `user` = '$user' ");
        $data = $data->fetch(PDO::FETCH_ASSOC);
        return $data['user'];
    }

    public function getUserIdFromBranchUserByUserId($id)
    {
        $data = $this->query("SELECT * FROM `" . DbPREFIX . "branch_user` WHERE `user` = '$id' ");
        $data = $data->fetch(PDO::FETCH_ASSOC);
        return $data['user'];
    }

    public function getBranchIdByUserId($id)
    {
        $data = $this->query("SELECT * FROM `" . DbPREFIX . "branch_user` WHERE `user` = '$id' ");
        $data = $data->fetch(PDO::FETCH_ASSOC);
        return $data['branch'];
    }

    public function getTimeDurration($start, $end)
    {
        $diff = abs(strtotime($start) - strtotime($end));

        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $data = '';
        if ($days !== 0) {
            $data = $days . ' days';
        }
        if ($months !== 0) {
            $data = $months . ' months, ' . $days . ' days';
        }
        if ($years !== 0) {
            $data = $years . ' years, ' . $months . ' months, ' . $days . ' days';
        }
        return $data;
    }

    public function getStuffNameById($id)
    {
        $stuff = $this->query("SELECT * FROM " . DbPREFIX . "users WHERE `id` = '$id'; ");
        $stuff = $stuff->fetch(PDO::FETCH_ASSOC);
        return $stuff['f_name'] . ' ' . $stuff['l_name'];
    }

    public function insertUserBasicInfo($FName, $LName, $email, $username, $password, $activity, $role)
    {
        $password = Hash::passwordENCRYPT($password);
        $username = (string)AppUsernamePrefix . $username;
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

    public function insertUserDetailsInfo($dob, $gender, $profession)
    {
        $this->db->prepare("INSERT INTO `" . DbPREFIX . "users_details`  VALUES (null, :dob, :gender, :profession, null)")
            ->execute(
                array(
                    ':dob' => $dob,
                    ':gender' => $gender,
                    ':profession' => $profession
                ));
    }

    public function editUserBasicInfo($id, $FName, $LName, $email, $username, $password, $activity, $role)
    {
        $id = (int)$id;
        $password = Hash::passwordENCRYPT($password);
        $username = (string)AppUsernamePrefix . $username;
        $random = rand(124578, 999999999);
        $this->db->query("UPDATE `" . DbPREFIX . "users` SET `f_name` = '$FName', `l_name` = '$LName', `email` = '$email', `password` = '$password',  `username` = '$username', `activity` = '$activity', `role` = '$role', `status` = '0', `code` = '$random' WHERE `id` = $id");
    }

    public function editUserDetailsInfo($id, $dob, $gender, $profession)
    {
        $id = (int)$id;
        $this->db->query("UPDATE `" . DbPREFIX . "users_details` SET `dob` = '$dob', `gender` = '$gender', `profession` = '$profession' WHERE `id` = $id");
    }

    public function deleteUser($id)
    {
        $id = (int)$id;
        $this->db->query("DELETE FROM `" . DbPREFIX . "users` where `id` = $id;");
        $this->db->query("DELETE FROM `" . DbPREFIX . "users_details` WHERE `id` = $id;");
    }

    public function UserLastInsertId()
    {
        $stuff = $this->query("SELECT LAST_INSERT_ID() FROM `" . DbPREFIX . "users`; ");
        $stuff = $stuff->fetch(PDO::FETCH_ASSOC);
        return $stuff['LAST_INSERT_ID()'];
    }

    public function insertUserProfilePicture($user, $imageName, $imageMime, $imageActualSize, $imageContent)
    {
        $this->db->prepare("INSERT INTO `" . DbPREFIX . "users_profiles_photos`  VALUES (null, :imageUser, :imageName, :imageMime, :imageActualSize, :imageContent)")
            ->execute(
                array(
                    ':imageUser' => $user,
                    ':imageName' => $imageName,
                    ':imageMime' => $imageMime,
                    ':imageActualSize' => $imageActualSize,
                    ':imageContent' => $imageContent
                ));
    }

    public function UserProfilePictureLastInsertId()
    {
        $stuff = $this->query("SELECT LAST_INSERT_ID() FROM `" . DbPREFIX . "users_profiles_photos`; ");
        $stuff = $stuff->fetch(PDO::FETCH_ASSOC);
        return $stuff['LAST_INSERT_ID()'];
    }

    public function setUserProfilePictureId($user, $picture)
    {
        $user = (int)$user;
        $picture = (int)$picture;
        $this->db->query("UPDATE `" . DbPREFIX . "users_details` SET `pro_pic` = '$picture' WHERE `id` = $user");
    }

    public function viewUserCurrentProfilePicture($user, $picture)
    {
        $user = (int)$user;
        $picture = (int)$picture;
        $data = $this->query("SELECT * FROM " . DbPREFIX . "users_profiles_photos WHERE `id` = '$picture' AND `user` = '$user';");
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function varifyUsername($username)
    {
        $username = AppUsernamePrefix . $username;
        $data = $this->db->prepare("SELECT `id`, `code` FROM `" . DbPREFIX . "users` WHERE `username` = :username");
        $data->execute(
            array(
                ':username' => $username
            )
        );
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function varifyEmail($email)
    {
        $id = $this->db->prepare("SELECT `id` FROM `" . DbPREFIX . "users` WHERE `email` = :email");
        $id->execute(
            array(
                ':email' => $email
            )
        );
        if ($id->fetch(PDO::FETCH_ASSOC)) {
            return TRUE;
        }
        return FALSE;
    }

    /* end of tool add, update and delete sectioin */
}
