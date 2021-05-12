<?php

class brandsModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /* start of items add, update and delete section */


    public function getBrandsOrderById()
    {
        $brands = $this->query("SELECT * FROM `" . DbPREFIX . "brands` ORDER BY `id` ASC;");
        $brands = $brands->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for($i = 0; $i < count($brands); $i++){
            $data[$i] = array(
                'serialNumber'   =>  $i + 1,
                'id'   =>  $brands[$i]['id'],
                'name'   =>  $brands[$i]['name']
            );
        }

        return $data;
    }

    public function getBrandsOrderByName()
    {
        $brands = $this->query("SELECT * FROM `" . DbPREFIX . "brands` ORDER BY `name` ASC;");
        $brands = $brands->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for($i = 0; $i < count($brands); $i++){
            $data[$i] = array(
                'serialNumber'   =>  $i + 1,
                'id'   =>  $brands[$i]['id'],
                'name'   =>  $brands[$i]['name']
            );
        }

        return $data;
    }

    public function getBrand($id)
    {
        $app = $this->query("SELECT * FROM `" . DbPREFIX . "brands` WHERE `id` = '$id'");
        return $app->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isBrandAlreadyExists($name)
    {
        $app = $this->query("SELECT * FROM `" . DbPREFIX . "brands` WHERE `name` = '$name'");
        if ($app->fetch(PDO::FETCH_ASSOC)) {
            return TRUE;
        }
        return FALSE;
    }

    public function insertBrand($name,$CreatedUserID,$CreatedUserUsername,$CreatedUserFullName)
    {
        $this->db->prepare('INSERT INTO `' . DbPREFIX . 'brands` VALUES (NULL, :itemName, :CreatedUserID, :CreatedUserUsername, :CreatedUserFullName, now());')
            ->execute(
                [
                    ':itemName' => $name,
                    ':CreatedUserID' => $CreatedUserID,
                    ':CreatedUserUsername' => $CreatedUserUsername,
                    ':CreatedUserFullName' => $CreatedUserFullName
                ]);
    }

    public function editBrand($id, $name,$CreatedUserID,$CreatedUserUsername,$CreatedUserFullName)
    {
        $id = (int)$id;
        $edit = [];

        if (!empty($name)) {
            $edit[] = "`name` = '$name'";
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
            $this->query("UPDATE `" . DbPREFIX . "brands` SET $var WHERE `id` = $id");
        }
    }

    public function deleteBrand($id)
    {
        $id = (int)$id;
        $this->query("DELETE from `" . DbPREFIX . "brands` where `id` = $id");
    }

    /* end of Item add, update and delete section */
}