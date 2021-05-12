<?php

class invoicesModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /* start of items add, update and delete section */

    public function getBranches(){
        $apps = $this->query("SELECT * FROM `" . DbPREFIX . "branches`;");
        return $apps->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getBranchDetailsById($id)
    {
        $id = (int)$id;
        $apps = $this->query("SELECT * FROM `" . DbPREFIX . "branches` WHERE `id` = '$id';");
        return $apps->fetch(PDO::FETCH_ASSOC);
    }

    public function getBranchIdByUserId($id)
    {
        $id = (int)$id;
        $apps = $this->query("SELECT `branch` FROM `" . DbPREFIX . "branch_user` WHERE `user` = '$id';");
        $name = $apps->fetch(PDO::FETCH_ASSOC);
        return $name['branch'];
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

    public function getBranchNameById($id)
    {
        $id = (int)$id;
        $apps = $this->query("SELECT `name` FROM `" . DbPREFIX . "branches` WHERE `id` = '$id';");
        $name = $apps->fetch(PDO::FETCH_ASSOC);
        return $name['name'];
    }

    public function getBranchAddressById($id)
    {
        $id = (int)$id;
        $apps = $this->query("SELECT `location` FROM `" . DbPREFIX . "branches` WHERE `id` = '$id';");
        $name = $apps->fetch(PDO::FETCH_ASSOC);
        return $name['location'];
    }

    public function getClientNameById($id)
    {
        $id = (int)$id;
        $apps = $this->query("SELECT `name` FROM `" . DbPREFIX . "clients` WHERE `clntId` = '$id';");
        $name = $apps->fetch(PDO::FETCH_ASSOC);
        return $name['name'];
    }

    public function getSalesManUserIdBySession()
    {
        if (Session::get('id_user'))
            return Session::get('id_user');
    }

    public function getSalesManUserIdByInvoiceId($id)
    {
        $id = $this->query("SELECT `sales_man` FROM `" . DbPREFIX . "invoices` WHERE `invId` = '$id';");
        $id = $id->fetch(PDO::FETCH_ASSOC);
        return $id['sales_man'];
    }

    public function getSalesManActualNameById($id)
    {
        $id = (int)$id;
        $data = '';
        $slsman = $this->query("SELECT * FROM `" . DbPREFIX . "users` WHERE `id` = '$id';");
        $slsman = $slsman->fetch(PDO::FETCH_ASSOC);
        if (empty($slsman['f_name']) or empty($slsman['l_name'])) {
            $data = ucfirst(preg_replace('/' . AppUsernamePrefix . '/is', '$1', $slsman['username']));
        } else {
            $data = $slsman['f_name'] . ' ' . $slsman['l_name'];
        }
        return $data;
    }

    public function getInvoiceBySearchData($branch, $invoice, $client_name, $client_number){
        $branch = (string) $branch;
        $invoice = (int) $invoice;
        $client_name = (string) $client_name;
        $client_number = (int) $client_number;

        $srch_cond = array();
        if(!empty($branch)){$srch_cond []= "inv.branch = $branch";}
        if(!empty($invoice)){$srch_cond []= "inv.invId = $invoice AND invBl.invoiceId = $invoice";}
        if(!empty($client_name)){$srch_cond []= "clnt.name = $client_name";}
        if(!empty($client_number)){$srch_cond []= "clnt.number = $client_number";}
        /*$srch_cond []= $invoice ? "inv.invId = $invoice AND invBl.invoiceId = $invoice" : "";*/

        $exec_cond = ' WHERE ' . implode(',', $srch_cond);

        $invoice_details = $this->query("SELECT inv.*, clnt.*, invBl.* FROM " . DbPREFIX . "invoices inv, " . DbPREFIX . "clients clnt, " . DbPREFIX . "invoice_bill invBl $exec_cond AND inv.client = clnt.clntId AND invBl.clientId = clnt.clntId;");
        $invoice_details = $invoice_details->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for ($i = 0; $i < count($invoice_details); $i++) {
            $data[$i] = array(
                'serialNumber' => $i + 1,
                'id' => $invoice_details[$i]['invId'],
                'invIndex' => $invoice_details[$i]['inv_no'],
                'branchId' => $invoice_details[$i]['branch'],
                'branch_name' => $this->getBranchNameById($invoice_details[$i]['branch']),
                'branch_address' => $this->getBranchAddressById($invoice_details[$i]['branch']),
                'clientId' => $invoice_details[$i]['clntId'],
                'client_name' => $invoice_details[$i]['name'],
                'client_mobile_number' => $invoice_details[$i]['mobile_number'],
                'client_address' => $invoice_details[$i]['address'],
                'salesman' => $this->getSalesManActualNameById($this->getSalesManUserIdByInvoiceId($invoice_details[$i]['invId'])),
                'sell_items' => $this->getSoldItemsByIdOrderBySerialNumber($invoice_details[$i]['invId']),
                'sold_total_price' => $invoice_details[$i]['totalBill'],
                'sold_total_price_text' => Translator::TranslateNumberToWords($invoice_details[$i]['totalBill']),
                'invoice_created_time' => date("d-m-y", strtotime($invoice_details[$i]['invCreatedTime']))
            );
        }
        return $data;
    }

    public function getInvoicesAll()
    {
        $invoice_details = $this->query("SELECT inv.*, clnt.*, invBl.* FROM " . DbPREFIX . "invoices inv, " . DbPREFIX . "clients clnt, " . DbPREFIX . "invoice_bill invBl WHERE inv.client = clnt.clntId AND inv.invId = invBl.invoiceId  ORDER BY inv.invId DESC;");
        $invoice_details = $invoice_details->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for ($i = 0; $i < count($invoice_details); $i++) {
            $data[$i] = array(
                'serialNumber' => $i + 1,
                'id' => $invoice_details[$i]['invId'],
                'invIndex' => $invoice_details[$i]['inv_no'],
                'branchId' => $invoice_details[$i]['branch'],
                'branch_name' => $this->getBranchNameById($invoice_details[$i]['branch']),
                'clientId' => $invoice_details[$i]['clntId'],
                'client_name' => $invoice_details[$i]['name'],
                'client_mobile_number' => $invoice_details[$i]['mobile_number'],
                'client_address' => $invoice_details[$i]['address'],
                'salesman' => $this->getSalesManActualNameById($this->getSalesManUserIdByInvoiceId($invoice_details[$i]['invId'])),
                'sell_items' => $this->getSoldItemsByInvId($invoice_details[$i]['invId']),
                'sold_total_price' => $invoice_details[$i]['totalBill'],
                'invoice_created_time' => date("d/m/y", strtotime($invoice_details[$i]['invCreatedTime'])),
            );
        }
        return $data;
    }

    public function getInvoiceDetailsById($id)
    {
        $id = (int)$id;
        $invoice_details = $this->query("SELECT inv.*, clnt.*, invBl.* FROM " . DbPREFIX . "invoices inv, " . DbPREFIX . "clients clnt, " . DbPREFIX . "invoice_bill invBl WHERE inv.invId = $id AND invBl.invoiceId = $id AND inv.client = clnt.clntId ORDER BY inv.invId DESC;");
        $invoice_details = $invoice_details->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for ($i = 0; $i < count($invoice_details); $i++) {
            $data[$i] = array(
                'serialNumber' => $i + 1,
                'id' => $invoice_details[$i]['invId'],
                'invIndex' => $invoice_details[$i]['inv_no'],
                'branchId' => $invoice_details[$i]['branch'],
                'branch_name' => $this->getBranchNameById($invoice_details[$i]['branch']),
                'branch_address' => $this->getBranchAddressById($invoice_details[$i]['branch']),
                'clientId' => $invoice_details[$i]['clntId'],
                'client_name' => $invoice_details[$i]['name'],
                'client_mobile_number' => $invoice_details[$i]['mobile_number'],
                'client_address' => $invoice_details[$i]['address'],
                'salesman' => $this->getSalesManActualNameById($this->getSalesManUserIdByInvoiceId($invoice_details[$i]['invId'])),
                'sell_items' => $this->getSoldItemsByIdOrderBySerialNumber($invoice_details[$i]['invId']),
                'sold_total_price' => $invoice_details[$i]['totalBill'],
                'sold_total_price_text' => Translator::TranslateNumberToWords($invoice_details[$i]['totalBill']),
                'invoice_created_time' => date("d-m-y", strtotime($invoice_details[$i]['invCreatedTime']))
            );
        }
        return $data;
    }

    public function insertInvoice($branch, $client, $salesman, $CreatedUserID, $CreatedUserUsername, $CreatedUserFullName)
    {
        $branch = (int)$branch;
        $client = (int)$client;
        $lstinv = (int)$this->getLastInsertInvoiceIdSpecific();
        $branchId = sprintf("%02d", $branch);
        $lstinvid = sprintf("%04d", $lstinv + 1);
        $inv_no = 'INV/' . $branchId . '/' . Date('Y') . '/' . $lstinvid;
        $slsman = '';


        if (empty($salesman)) {
            $slsman = $this->getSalesManUserIdBySession();
        } else {
            $slsman = $salesman;
        }

        $this->db->prepare('INSERT INTO `' . DbPREFIX . 'invoices` VALUES (NULL, :branch, :inv_no, :client, :salesman, :CreatedUserID, :CreatedUserUsername, :CreatedUserFullName, now());')
            ->execute(
                [
                    ':branch' => $branch,
                    ':inv_no' => $inv_no,
                    ':client' => $client,
                    ':salesman' => $slsman,
                    ':CreatedUserID' => $CreatedUserID,
                    ':CreatedUserUsername' => $CreatedUserUsername,
                    ':CreatedUserFullName' => $CreatedUserFullName
                ]);
    }

    public function editInvoice($id, $branch, $client)
    {
        $id = (int)$id;
        $branch = (int)$branch;
        $client = (int)$client;

        if (!empty($id)) {
            $this->query("UPDATE `" . DbPREFIX . "invoices` SET `branch` = '$branch', `client` = '$client' WHERE `invId` = $id");
        }
    }

    public function deleteInvoice($id)
    {
        $id = (int)$id;
        $this->query("DELETE from `" . DbPREFIX . "invoices` where `invId` = $id");
    }

    public function getLastInsertInvoiceIdSpecific()
    {
        $Id = $this->query("SELECT * FROM `" . DbPREFIX . "invoices` ORDER BY `invId` DESC LIMIT 1;");
        $Id = $Id->fetch(PDO::FETCH_ASSOC);
        return $Id['invId'];
    }

    public function getLastInsertInvoiceId()
    {
        $Id = $this->query("SELECT LAST_INSERT_ID() FROM `" . DbPREFIX . "invoices`;");
        $Id = $Id->fetch(PDO::FETCH_ASSOC);
        return $Id['LAST_INSERT_ID()'];
    }

    public function getSoldItemsByInvId($id)
    {
        $id = (int)$id;
        $d = $this->query("SELECT * FROM `" . DbPREFIX . "sold_items` WHERE `slditmInvoiceId` = '$id';");
        $d = $d->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for ($i = 0; $i < count($d); $i++) {
            $data[$i] = array(
                'serialNumber' => $d[$i]['slditmOdrN'],
                'id' => $d[$i]['slditmId'],
                'invoiceId' => $d[$i]['slditmInvoiceId'],
                'clientId' => $d[$i]['slditmClientId'],
                'itemId' => $d[$i]['slditmItemId'],
                'itemName' => $this->getItemNameById($d[$i]['slditmItemId']),
                'brandId' => $d[$i]['slditmBrandId'],
                'brandName' => $this->getBrandNameById($d[$i]['slditmBrandId']),
                'model' => $d[$i]['slditmModel'],
                'serial' => $d[$i]['slditmSerialNumber'],
                'warrantyTime' => $d[$i]['slditmWarrantyTime'],
                'unitPrice' => $d[$i]['slditmUnitPrice'],
                'quantity' => $d[$i]['slditmQuantity'],
                'totalPrice' => $d[$i]['slditmTotalPrice'],
            );
        }

        return $data;
    }

    public function getSoldItemsByIdOrderBySerialNumber($id)
    {
        $id = (int)$id;
        $d = $this->query("SELECT * FROM `" . DbPREFIX . "sold_items` WHERE `slditmInvoiceId` = '$id' ORDER BY `slditmOdrN` ASC;");
        $d = $d->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for ($i = 0; $i < count($d); $i++) {
            $data[$i] = array(
                'serialNumber' => $d[$i]['slditmOdrN'],
                'id' => $d[$i]['slditmId'],
                'invoiceId' => $d[$i]['slditmInvoiceId'],
                'clientId' => $d[$i]['slditmClientId'],
                'itemId' => $d[$i]['slditmItemId'],
                'itemName' => $this->getItemNameById($d[$i]['slditmItemId']),
                'brandId' => $d[$i]['slditmBrandId'],
                'brandName' => $this->getBrandNameById($d[$i]['slditmBrandId']),
                'model' => $d[$i]['slditmModel'],
                'serial' => $d[$i]['slditmSerialNumber'],
                'warrantyTime' => $d[$i]['slditmWarrantyTime'],
                'unitPrice' => $d[$i]['slditmUnitPrice'],
                'quantity' => $d[$i]['slditmQuantity'],
                'totalPrice' => $d[$i]['slditmTotalPrice'],
            );
        }

        return $data;
    }

    public function getSoldItemsById($id)
    {
        $id = (int)$id;
        $d = $this->query("SELECT * FROM `" . DbPREFIX . "sold_items` WHERE `slditmId` = '$id' ORDER BY `slditmId` ASC;");
        $d = $d->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for ($i = 0; $i < count($d); $i++) {
            $data[$i] = array(
                'serialNumber' => $d[$i]['slditmOdrN'],
                'id' => $d[$i]['slditmId'],
                'invoiceId' => $d[$i]['slditmInvoiceId'],
                'clientId' => $d[$i]['slditmClientId'],
                'itemId' => $d[$i]['slditmItemId'],
                'itemName' => $this->getItemNameById($d[$i]['slditmItemId']),
                'brandId' => $d[$i]['slditmBrandId'],
                'brandName' => $this->getBrandNameById($d[$i]['slditmBrandId']),
                'model' => $d[$i]['slditmModel'],
                'serial' => $d[$i]['slditmSerialNumber'],
                'warrantyTime' => $d[$i]['slditmWarrantyTime'],
                'unitPrice' => $d[$i]['slditmUnitPrice'],
                'quantity' => $d[$i]['slditmQuantity'],
                'totalPrice' => $d[$i]['slditmTotalPrice'],
            );
        }

        return $data;
    }

    public function updateSellItemsOrderNumber($data, $id)
    {
        $id = (int)$id;

        foreach ($data as $key => $value){
            $value = "'$value'";
            $updates[] = "$key = $value";
        }

        $implodeArray = implode(',', $updates);
        $this->db->query("UPDATE `" . DbPREFIX . "sold_items` SET $implodeArray WHERE `slditmId` ='$id';");
    }

    public function addToCart($branch, $invoice, $client, $item, $brand, $model, $serial, $warranty, $price, $quantity, $totalPrice, $CreatedUserID, $CreatedUserUsername, $CreatedUserFullName)
    {
        $branch = (int)$branch;
        $invoice = (int)$invoice;
        $client = (int)$client;
        $item = (int)$item;
        $brand = (int)$brand;
        $warranty = (int)$warranty;
        $price = (int)$price;
        $quantity = (int)$quantity;
        $totalPrice = (int)$totalPrice;
        $orderNumber = 1;
        $data = $this->getInsertedSoldItems($invoice);
        if (count($data) > 0){
            for ($i = 0; $i < count($data); $i++){
                $orderNumber++;
            }
        }

        $this->db->prepare('INSERT INTO `' . DbPREFIX . 'sold_items` VALUES (NULL, :branch, :invoice, :client, :item, :brand, :model, :serial, :warranty, :price, :quantity, :totalPrice, :orderNumber, :CreatedUserID, :CreatedUserUsername, :CreatedUserFullName, now());')
            ->execute(
                [
                    ':branch' => $branch,
                    ':invoice' => $invoice,
                    ':client' => $client,
                    ':item' => $item,
                    ':brand' => $brand,
                    ':model' => $model,
                    ':serial' => $serial,
                    ':warranty' => $warranty,
                    ':price' => $price,
                    ':quantity' => $quantity,
                    ':totalPrice' => $totalPrice,
                    ':orderNumber' => $orderNumber,
                    ':CreatedUserID' => $CreatedUserID,
                    ':CreatedUserUsername' => $CreatedUserUsername,
                    ':CreatedUserFullName' => $CreatedUserFullName
                ]);
    }

    public function updateToCart($id, $invoice, $client, $item, $brand, $model, $serial, $warranty, $price, $quantity, $totalPrice, $CreatedUserID, $CreatedUserUsername, $CreatedUserFullName)
    {
        $id = (int)$id;
        $invoice = (int)$invoice;
        $client = (int)$client;
        $item = (int)$item;
        $brand = (int)$brand;
        $warranty = (int)$warranty;
        $price = (int)$price;
        $quantity = (int)$quantity;
        $totalPrice = (int)$totalPrice;

        $this->db->query("UPDATE `" . DbPREFIX . "sold_items` SET `slditmInvoiceId`='$invoice',`slditmClientId`='$client',`slditmItemId`='$item',`slditmBrandId`='$brand',`slditmModel`='$model',`slditmSerialNumber`='$serial',`slditmWarrentyTime`='$warranty',`slditmUnitPrice`='$price',`slditmQuantity`='$quantity',`slditmTotalPrice`=$totalPrice,`sldItmCreatedUserID`='$CreatedUserID',`sldItmCreatedUserUsername`='$CreatedUserUsername',`sldItmCreatedUserFullName`='$CreatedUserFullName',`sldItmCreatedTime`=now() WHERE `slditmId` ='$id';");
    }

    public function deleteSoldItem($id)
    {
        $id = (int)$id;
        $this->query("DELETE from `" . DbPREFIX . "sold_items` where `slditmId` = $id");
    }

    public function getInsertedSoldItems($invoice)
    {
        $invoice = (int) $invoice;
        $data = $this->query("SELECT * FROM `" . DbPREFIX . "sold_items` WHERE `slditmInvoiceId`='$invoice' ORDER BY `slditmId`;");
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function manageBill($mode, $branch, $invoice, $client, $bill, $CreatedUserID, $CreatedUserUsername, $CreatedUserFullName)
    {
        $branch = (int)$branch;
        $invoice = (int)$invoice;
        $client = (int)$client;
        $bill = (int)$bill;

        if ($mode === 'create') {
            $this->db->prepare('INSERT INTO `' . DbPREFIX . 'invoice_bill` VALUES (NULL, :branch, :invoice, :client, :bill, :CreatedUserID, :CreatedUserUsername, :CreatedUserFullName, now());')
                ->execute(
                    [
                        ':branch' => $branch,
                        ':invoice' => $invoice,
                        ':client' => $client,
                        ':bill' => $bill,
                        ':CreatedUserID' => $CreatedUserID,
                        ':CreatedUserUsername' => $CreatedUserUsername,
                        ':CreatedUserFullName' => $CreatedUserFullName
                    ]);
        }
        if ($mode === 'update') {
            $this->db->query("UPDATE `" . DbPREFIX . "invoice_bill` SET `totalBill` = $bill WHERE `invoiceId` = $invoice;");
        }
    }

    /* end of Item add, update and delete section */
}