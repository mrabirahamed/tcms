<?php

class productdetailsModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /* start of productdetails add, update and delete section */

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


    public function getProductDetails()
    {
        $prd_dtls = $this->query("SELECT * FROM `" . DbPREFIX . "productdetails` ORDER BY `id` ASC;");
        $prd_dtls = $prd_dtls->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for ($i = 0; $i < count($prd_dtls); $i++) {
            $data[$i] = array(
                'serialNumber' => $i + 1,
                'id' => $prd_dtls[$i]['id'],
                'branch' => $this->getBranchNameById($prd_dtls[$i]['branch']),
                'branchId' => $prd_dtls[$i]['branch'],
                'item' => $this->getItemNameById($prd_dtls[$i]['item']),
                'itemId' => $prd_dtls[$i]['item'],
                'brand' => $this->getBrandNameById($prd_dtls[$i]['brand']),
                'brandId' => $prd_dtls[$i]['brand'],
                'model' => $prd_dtls[$i]['model'],
                'serial' => $prd_dtls[$i]['serial'],
                'price' => $prd_dtls[$i]['price'],
                'warranty' => $prd_dtls[$i]['warranty'],
                'ability' => $prd_dtls[$i]['ability']
            );
        }

        return $data;
    }

    public function getItemNameById($id)
    {
        $id = (int)$id;
        $apps = $this->query("SELECT `name` FROM `" . DbPREFIX . "items` WHERE `id` = '$id';");
        $name = $apps->fetch(PDO::FETCH_ASSOC);
        return $name['name'];
    }

    public function getBrandNameById($id)
    {
        $id = (int)$id;
        $apps = $this->query("SELECT `name` FROM `" . DbPREFIX . "brands` WHERE `id` = '$id';");
        $name = $apps->fetch(PDO::FETCH_ASSOC);
        return $name['name'];
    }

    public function getBrandByItemId($id)
    {
        $id = (int)$id;
        $brnd = $this->query("SELECT DISTINCT `brand` FROM `" . DbPREFIX . "productdetails` WHERE `item` = '$id';");
        $brnd = $brnd->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for ($i = 0; $i < count($brnd); $i++) {
            $data[$i] = array(
                'id' => $brnd[$i]['brand'],
                'name' => $this->getBrandNameById($brnd[$i]['brand'])
            );
        }
        return $data;
    }

    public function getModelByItemBrandId($branch, $item, $brand)
    {
        $branch = (int)$branch;
        $item = (int)$item;
        $brand = (int)$brand;
        $model = $this->query("SELECT DISTINCT `model` FROM `" . DbPREFIX . "productdetails` WHERE `branch` = '$branch' AND  `item` = '$item' AND `brand` = '$brand';");
        $model = $model->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for ($i = 0; $i < count($model); $i++) {
            $data[$i] = array(
                'value' => $model[$i]['model'],
                'name' => $model[$i]['model']
            );
        }
        return $data;
    }

    public function getDetailsByItemBrandModelName($branch, $item, $brand, $model)
    {
        $branch = (int)$branch;
        $item = (int)$item;
        $brand = (int)$brand;
        $prd_dtls = $this->query("SELECT DISTINCT * FROM `" . DbPREFIX . "productdetails` WHERE `branch` = '$branch' AND `item` = '$item' AND `brand` = '$brand' AND `model` = '$model';");
        $prd_dtls = $prd_dtls->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for ($i = 0; $i < count($prd_dtls); $i++) {
            $data[$i] = array(
                'serialNumber' => $i + 1,
                'id' => $prd_dtls[$i]['id'],
                'branch' => $this->getBranchNameById($prd_dtls[$i]['branch']),
                'branchId' => $prd_dtls[$i]['branch'],
                'item' => $this->getItemNameById($prd_dtls[$i]['item']),
                'itemId' => $prd_dtls[$i]['item'],
                'brand' => $this->getBrandNameById($prd_dtls[$i]['brand']),
                'brandId' => $prd_dtls[$i]['brand'],
                'model' => $prd_dtls[$i]['model'],
                'serial' => $prd_dtls[$i]['serial'],
                'price' => $prd_dtls[$i]['price'],
                'warranty' => $prd_dtls[$i]['warranty'],
                'ability' => $prd_dtls[$i]['ability']
            );
        }
        return $data;
    }

    public function getProductDetail($id)
    {
        $app = $this->query("SELECT * FROM `" . DbPREFIX . "productdetails` WHERE `id` = '$id';");
        return $app->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isProductDetailAlreadyExists($branch, $item, $brand, $model, $serial, $price)
    {
        $app = $this->query("SELECT * FROM `" . DbPREFIX . "productdetails` WHERE `branch` = '$branch' AND `item` = '$item' AND `brand` = '$brand' AND `model` = '$model' AND `serial` = '$serial' AND `price` = '$price';");
        if ($app->fetchAll(PDO::FETCH_ASSOC)) {
            return TRUE;
        }
        return FALSE;
    }

    public function insertProductDetail($branch, $item, $brand, $model, $serial, $price, $warranty, $ability, $CreatedUserID, $CreatedUserUsername, $CreatedUserFullName)
    {
        $this->db->prepare('INSERT INTO `' . DbPREFIX . 'productdetails` VALUES (NULL, :branch, :item, :brand, :model, :serial, :price, :warranty, :ability, :CreatedUserID, :CreatedUserUsername, :CreatedUserFullName, now());')
            ->execute(
                [
                    ':branch' => $branch,
                    ':item' => $item,
                    ':brand' => $brand,
                    ':model' => $model,
                    ':serial' => $serial,
                    ':price' => $price,
                    ':warranty' => $warranty,
                    ':ability' => $ability,
                    ':CreatedUserID' => $CreatedUserID,
                    ':CreatedUserUsername' => $CreatedUserUsername,
                    ':CreatedUserFullName' => $CreatedUserFullName
                ]);
    }

    public function editProductDetail($id, $branch, $item, $brand, $model, $serial, $price, $warranty, $ability, $CreatedUserID, $CreatedUserUsername, $CreatedUserFullName)
    {
        $id = (int)$id;
        $branch = (int)$branch;
        $item = (int)$item;
        $brand = (int)$brand;
        $price = (int)$price;
        $warranty = (int)$warranty;
        $edit = [];

        if (!empty($item)) {
            $edit[] = "`branch` = '$branch'";
        }
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
            $edit[] = "`warranty` = '$warranty'";
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

    public function ChangeProductAbility($id, $current_status, $new_status)
    {
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