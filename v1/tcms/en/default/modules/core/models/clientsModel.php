<?php

class clientsModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /* start of items add, update and delete section */

    public function getClientsOrderById()
    {
        $clients = $this->query("SELECT * FROM `" . DbPREFIX . "clients` ORDER BY `clntId` ASC;");
        $clients = $clients->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for($i = 0; $i < count($clients); $i++){
            $data[$i] = array(
                'serialNumber'   =>  $i + 1,
                'id'   =>  $clients[$i]['clntId'],
                'name'   =>  $clients[$i]['name'],
                'mobile_number'   =>  $clients[$i]['mobile_number'],
                'address'   =>  $clients[$i]['address']
            );
        }

        return $data;
    }

    public function getClientsOrderByName()
    {
        $clients = $this->query("SELECT * FROM `" . DbPREFIX . "clients` ORDER BY `name` ASC;");
        $clients = $clients->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for($i = 0; $i < count($clients); $i++){
            $data[$i] = array(
                'serialNumber'   =>  $i + 1,
                'id'   =>  $clients[$i]['clntId'],
                'name'   =>  $clients[$i]['name'],
                'mobile_number'   =>  $clients[$i]['mobile_number'],
                'address'   =>  $clients[$i]['address']
            );
        }

        return $data;
    }

    public function getSelectedClientById($id)
    {
        $id = (int) $id;
        $apps = $this->query("SELECT * FROM `" . DbPREFIX . "clients` WHERE `clntId` = '$id';");
        return $apps->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkClientsInputAbility($name)
    {
        $app = $this->query("SELECT * FROM `" . DbPREFIX . "clients` WHERE `name` = '$name'");
        if ($app->fetch(PDO::FETCH_ASSOC)) {
            return TRUE;
        }
        return FALSE;
    }

    public function insertClients($name, $mob_number, $address,$CreatedUserID,$CreatedUserUsername,$CreatedUserFullName)
    {
        $this->db->prepare('INSERT INTO `' . DbPREFIX . 'clients` VALUES (NULL, :name, :mob_number, :address, :CreatedUserID, :CreatedUserUsername, :CreatedUserFullName, now());')
            ->execute(
                [
                    ':name' => $name,
                    ':mob_number' => $mob_number,
                    ':address' => $address,
                    ':CreatedUserID' => $CreatedUserID,
                    ':CreatedUserUsername' => $CreatedUserUsername,
                    ':CreatedUserFullName' => $CreatedUserFullName
                ]);
    }

    public function editClients($id, $name, $mob_number, $address,$CreatedUserID,$CreatedUserUsername,$CreatedUserFullName)
    {
        $id = (int)$id;
        $edit = [];

        if (!empty($name)) {
            $edit[] = "`name` = '$name'";
        }
        if (!empty($mob_number)) {
            $edit[] = "`mobile_number` = '$mob_number'";
        }
        if (!empty($address)) {
            $edit[] = "`address` = '$address'";
        }
        if (!empty($CreatedUserID)) {
            $edit[] = "`clntCreatedUserID` = '$CreatedUserID'";
        }
        if (!empty($CreatedUserUsername)) {
            $edit[] = "`clntCreatedUserUsername` = '$CreatedUserUsername'";
        }
        if (!empty($CreatedUserFullName)) {
            $edit[] = "`clntCreatedUserFullName` = '$CreatedUserFullName'";
        }

        $var = implode(',', $edit);

        if (!empty($id)) {
            $this->query("UPDATE `" . DbPREFIX . "clients` SET $var WHERE `clntId` = $id");
        }
    }

    public function deleteClients($id)
    {
        $id = (int)$id;
        $this->query("DELETE from `" . DbPREFIX . "clients` WHERE `clntId` = $id");
    }

    /* end of clients add, update and delete section */
}