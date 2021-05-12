<?php

class itemsModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /* start of items add, update and delete section */

    public function getItemsOrderById()
    {
        $itms = $this->query("SELECT * FROM `" . DbPREFIX . "items` ORDER BY `id` ASC;");
        $itms = $itms->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for ($i = 0; $i < count($itms); $i++) {
            $data[$i] = array(
                'serialNumber' => $i + 1,
                'id' => $itms[$i]['id'],
                'name' => $itms[$i]['name'],
                'c_status' => $itms[$i]['c_status']
            );
        }

        return $data;
    }

    public function getItemsOrderByName()
    {
        $itms = $this->query("SELECT * FROM `" . DbPREFIX . "items` ORDER BY `name` ASC;");
        $itms = $itms->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for ($i = 0; $i < count($itms); $i++) {
            $data[$i] = array(
                'serialNumber' => $i + 1,
                'id' => $itms[$i]['id'],
                'name' => $itms[$i]['name'],
                'c_status' => $itms[$i]['c_status']
            );
        }

        return $data;
    }

    public function getAvailableItemsOrderByName()
    {
        $apps = $this->query("SELECT * FROM `" . DbPREFIX . "items` WHERE `c_status` = 'available' ORDER BY `name` ASC;");
        return $apps->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getItem($id)
    {
        $app = $this->query("SELECT * FROM `" . DbPREFIX . "items` WHERE `id` = '$id'");
        return $app->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isItemAlreadyExists($name)
    {
        $app = $this->query("SELECT * FROM `" . DbPREFIX . "items` WHERE `name` = '$name'");
        if ($app->fetch(PDO::FETCH_ASSOC)) {
            return TRUE;
        }
        return FALSE;
    }

    public function insertItem($name, $CStatus, $CreatedUserID, $CreatedUserUsername, $CreatedUserFullName)
    {
        $this->db->prepare('INSERT INTO `' . DbPREFIX . 'items` VALUES (NULL, :itemName, :CStatus, :CreatedUserID, :CreatedUserUsername, :CreatedUserFullName, now());')
            ->execute(
                [
                    ':itemName' => $name,
                    ':CStatus' => $CStatus,
                    ':CreatedUserID' => $CreatedUserID,
                    ':CreatedUserUsername' => $CreatedUserUsername,
                    ':CreatedUserFullName' => $CreatedUserFullName
                ]);
    }

    public function editItem($id, $name, $CStatus, $CreatedUserID, $CreatedUserUsername, $CreatedUserFullName)
    {
        $id = (int)$id;
        $edit = [];

        if (!empty($name)) {
            $edit[] = "`name` = '$name'";
        }
        if (!empty($CStatus)) {
            $edit[] = "`c_status` = '$CStatus'";
        }
        if (!empty($CreatedUserID)) {
            $edit[] = "`CreatedUserID` = '$CreatedUserID'";
        }
        if (!empty($CreatedUserUsername)) {
            $edit[] = "`CreatedUserUsername` = '$CreatedUserUsername'";
        }
        if (!empty($CreatedUserFullName)) {
            $edit[] = "`CreatedUserFullName` = '$CreatedUserFullName'";
        }

        $var = implode(',', $edit);

        if (!empty($id)) {
            $this->query("UPDATE `" . DbPREFIX . "items` SET $var WHERE `id` = $id");
        }
    }

    public function deleteItem($id)
    {
        $id = (int)$id;
        $this->query("DELETE from `" . DbPREFIX . "items` where `id` = $id");
    }

    public function ChangeProductAbility($id, $current_status, $new_status)
    {
        $data = $this->db->prepare("UPDATE `" . DbPREFIX . "items` SET `c_status` = :new_status WHERE `id` = :id and `c_status` = :current_status");
        $data->execute(
            array(
                ':id' => $id,
                ':current_status' => $current_status,
                ':new_status' => $new_status
            )
        );
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    /* end of Item add, update and delete section */
}