<?php

class productdetailsModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /* start of productdetails add, update and delete section */

    public function getProductDetails()
    {
        $prd_dtls = $this->query("SELECT * FROM `" . DbPREFIX . "productdetails` ORDER BY `id` ASC;");
        $prd_dtls = $prd_dtls->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for($i = 0; $i < count($prd_dtls); $i++){
            $data[$i] = array(
                'serialNumber'   =>  $i + 1,
                'id'   =>  $prd_dtls[$i]['id'],
                'item'   =>  $this->getItemNameById($prd_dtls[$i]['item']),
                'itemId'   =>  $prd_dtls[$i]['item'],
                'brand'   =>  $this->getBrandNameById($prd_dtls[$i]['brand']),
                'brandId'   =>  $prd_dtls[$i]['brand'],
                'model'   =>  $prd_dtls[$i]['Model'],
                'serial'   =>  $prd_dtls[$i]['serial'],
                'price'   =>  $prd_dtls[$i]['price'],
                'warrenty'   =>  $prd_dtls[$i]['warrenty'],
                'ability'   =>  $prd_dtls[$i]['ability']
            );
        }

        return $data;
    }

    public function getItemNameById($id)
    {
        $id = (int) $id;
        $apps = $this->query("SELECT `name` FROM `" . DbPREFIX . "items` WHERE `id` = '$id';");
        $name = $apps->fetch(PDO::FETCH_ASSOC);
        return $name['name'];
    }

    public function getBrandNameById($id)
    {
        $id = (int) $id;
        $apps = $this->query("SELECT `name` FROM `" . DbPREFIX . "brands` WHERE `id` = '$id';");
        $name = $apps->fetch(PDO::FETCH_ASSOC);
        return $name['name'];
    }

    public function getBrandByItemId($id)
    {
        $id = (int) $id;
        $brnd = $this->query("SELECT DISTINCT `brand` FROM `" . DbPREFIX . "productdetails` WHERE `item` = '$id';");
        $brnd = $brnd->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for($i = 0; $i < count($brnd); $i++){
            $data[$i] = array(
                'id'   =>  $brnd[$i]['brand'],
                'name'   => $this->getBrandNameById($brnd[$i]['brand'])
            );
        }
        return $data;
    }

    public function getModelByItemBrandId($item, $brand)
    {
        $item = (int) $item;
        $brand = (int) $brand;
        $model = $this->query("SELECT DISTINCT `model` FROM `" . DbPREFIX . "productdetails` WHERE `item` = '$item' AND `brand` = '$brand';");
        $model = $model->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for($i = 0; $i < count($model); $i++){
            $data[$i] = array(
                'value'   =>  $model[$i]['model'],
                'name'   => $model[$i]['model']
            );
        }
        return $data;
    }

    public function getDetailsByItemBrandModelName($item, $brand, $model)
    {
        $item = (int) $item;
        $brand = (int) $brand;
        $prd_dtls = $this->query("SELECT DISTINCT * FROM `" . DbPREFIX . "productdetails` WHERE `item` = '$item' AND `brand` = '$brand' AND `model` = '$model';");
        $prd_dtls = $prd_dtls->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for($i = 0; $i < count($prd_dtls); $i++){
            $data[$i] = array(
                'serialNumber'   =>  $i + 1,
                'id'   =>  $prd_dtls[$i]['id'],
                'item'   =>  $this->getItemNameById($prd_dtls[$i]['item']),
                'itemId'   =>  $prd_dtls[$i]['item'],
                'brand'   =>  $this->getBrandNameById($prd_dtls[$i]['brand']),
                'brandId'   =>  $prd_dtls[$i]['brand'],
                'model'   =>  $prd_dtls[$i]['Model'],
                'serial'   =>  $prd_dtls[$i]['serial'],
                'price'   =>  $prd_dtls[$i]['price'],
                'warrenty'   =>  $prd_dtls[$i]['warrenty'],
                'ability'   =>  $prd_dtls[$i]['ability']
            );
        }
        return $data;
    }

    public function getProductDetail($id)
    {
        $app = $this->query("SELECT * FROM `" . DbPREFIX . "productdetails` WHERE `id` = '$id'");
        return $app->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isProductDetailAlreadyExists($item, $brand, $model, $serial, $price)
    {
        $app = $this->query("SELECT * FROM `" . DbPREFIX . "productdetails` WHERE `item` = '$item', `brand` = '$brand', `Model` = '$model', `serial` = '$serial', `price` = '$price'");
        if ($app->fetch(PDO::FETCH_ASSOC)) {
            return TRUE;
        }
        return FALSE;
    }

    public function insertProductDetail($item, $brand, $model, $serial, $price,$warrenty,$ability,$CreatedUserID,$CreatedUserUsername,$CreatedUserFullName)
    {
        $this->db->prepare('INSERT INTO `' . DbPREFIX . 'productdetails` VALUES (NULL, :item, :brand, :model, :serial, :price, :warrenty, :ability, :CreatedUserID, :CreatedUserUsername, :CreatedUserFullName, now());')
            ->execute(
                [
                    ':item' => $item,
                    ':brand' => $brand,
                    ':model' => $model,
                    ':serial' => $serial,
                    ':price' => $price,
                    ':warrenty' => $warrenty,
                    ':ability' => $ability,
                    ':CreatedUserID' => $CreatedUserID,
                    ':CreatedUserUsername' => $CreatedUserUsername,
                    ':CreatedUserFullName' => $CreatedUserFullName
                ]);
    }

    public function editProductDetail($id, $item, $brand, $model, $serial, $price,$warrenty,$ability,$CreatedUserID,$CreatedUserUsername,$CreatedUserFullName)
    {
        $id = (int)$id;
        $item = (int)$item;
        $brand = (int)$brand;
        $price = (int)$price;
        $warrenty = (int)$warrenty;
        $edit = [];

        if (!empty($item)) {
            $edit[] = "`item` = '$item'";
        }
        if (!empty($brand)) {
            $edit[] = "`brand` = '$brand'";
        }
        if (!empty($model)) {
            $edit[] = "`model` = '$model'";
        }
        if (!empty($serial)) {
            $edit[] = "`serial` = '$serial'";
        }
        if (!empty($price)) {
            $edit[] = "`price` = '$price'";
        }
        if (!empty($warrenty)) {
            $edit[] = "`warrenty` = '$warrenty'";
        }
        if (!empty($ability)) {
            $edit[] = "`ability` = '$ability'";
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
            $this->query("UPDATE `" . DbPREFIX . "productdetails` SET $var WHERE `id` = $id");
        }
    }

    public function deleteProductDetail($id)
    {
        $id = (int)$id;
        $this->query("DELETE from `" . DbPREFIX . "productdetails` where `id` = $id");
    }

    public function ChangeProductAbility($id, $current_status, $new_status) {
        $data = $this->db->prepare("UPDATE `" . DbPREFIX . "productdetails` SET `ability` = :new_status WHERE `id` = :id and `ability` = :current_status");
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