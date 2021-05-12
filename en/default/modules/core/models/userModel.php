<?php

class userModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getUser($username, $password)
    {
        $username = AppUsernamePrefix . $username;
        $password = Hash::passwordENCRYPT($password);
        $data = $this->db->prepare("SELECT * from `" . DbPREFIX . "users` WHERE `username` = :username AND password = :password");
        $data->execute(
            array(
                ':username' => $username,
                ':password' => $password
            )
        );
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByEmail($email)
    {
        $data = $this->db->prepare("SELECT * from `" . DbPREFIX . "users` WHERE email = :email");
        $data->execute(
            array(
                ':email' => $email
            )
        );
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function addNewCode($email)
    {
        $random = rand(124578, 999999999);
        $data = $this->db->prepare("UPDATE `" . DbPREFIX . "users` SET `status` = :random WHERE `email` = :email");
        $data->execute(
            array(
                ':random' => $random,
                ':email' => $email
            )
        );
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserName($username)
    {
        $username = AppUsernamePrefix . $username;
        $data = $this->db->prepare("SELECT `username` FROM `" . DbPREFIX . "users` WHERE `username` = :username");
        $data->execute(array(':username' => $username));
        if ($data->fetch(PDO::FETCH_ASSOC)) {
            return TRUE;
        }
        return FALSE;
    }

    public function getUserPassWord($username)
    {
        $username = AppUsernamePrefix . $username;
        $data = $this->query("SELECT `password` FROM `" . DbPREFIX . "users` " .
            "WHERE username = '{$username}'");
        $row = $data->fetch(PDO::FETCH_ASSOC);
        return $row["password"];
    }

    public function varifyusername($username)
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

    public function addUser($fName, $lName, $email, $password, $username)
    {
        $password = Hash::passwordENCRYPT($password);
        $username = (string)AppUsernamePrefix . $username;
        $role = '4';
        $random = rand(124578, 999999999);

        $this->prepare("INSERT INTO `" . DbPREFIX . "users` VALUES (null, :fName, :lName, :email, :password, :username, 'active', :role, 0, now(), :code)")
            ->execute(
                array(
                    ':fName' => $fName,
                    ':lName' => $lName,
                    ':email' => $email,
                    ':password' => $password,
                    ':username' => $username,
                    ':role' => $role,
                    ':code' => $random
                ));
    }

    public function getInactiveUSER($id, $code)
    {
        $data = $this->db->prepare("SELECT `id` FROM `" . DbPREFIX . "users` WHERE `id` = :id and `code` = :code");
        $data->execute(
            array(
                ':id' => $id,
                ':code' => $code
            )
        );
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function activeUser($id, $code)
    {
        $data = $this->db->prepare("UPDATE `" . DbPREFIX . "users` SET `status` = 1 WHERE `id` = :id and `code` = :code");
        $data->execute(
            array(
                ':id' => $id,
                ':code' => $code
            )
        );
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function userNewLog($id, $type)
    {
        if ($type === 'LOGIN') {
            $this->prepare("INSERT INTO `" . DbPREFIX . "userslog_details` VALUES (null, :id, now(), '')")
                ->execute(array(':id' => $id));
        }

        if ($type === 'LOGOUT') {
            $this->prepare("INSERT INTO `" . DbPREFIX . "userslog_details` VALUES (null, :id, '', now()")
                ->execute(array(':id' => $id));
        }
    }

    public function getLogedInUserDetails($id)
    {
        $id = (int)$id;
        $mInfo = $this->db->query("SELECT * FROM `" . DbPREFIX . "users` WHERE `id` = $id");
        $data1 = $mInfo->fetch(PDO::FETCH_ASSOC);
        $mDetails = $this->db->query("SELECT * FROM `" . DbPREFIX . "users_details` WHERE `id` = $id");
        $data2 = $mDetails->fetch(PDO::FETCH_ASSOC);
        return array_merge($data1, $data2);
    }

    public function notificationsAll()
    {
        $data = $this->db->query("SELECT * FROM `" . DbPREFIX . "trackActivities` ORDER BY `ID` DESC;");
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBranchIdByUserId($id)
    {
        $data = $this->query("SELECT * FROM `" . DbPREFIX . "branch_user` WHERE `user` = '$id' ");
        $data = $data->fetch(PDO::FETCH_ASSOC);
        return $data['branch'];
    }

    public function getBranchNameById($id)
    {
        $branch = $this->query("SELECT * FROM " . DbPREFIX . "branches WHERE `id` = '$id'; ");
        $branch = $branch->fetch(PDO::FETCH_ASSOC);
        return $branch['name'];
    }

}
