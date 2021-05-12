<?php

    class invoicesModel extends Model
    {

        public function __construct ()
        {
            parent::__construct();
        }

        /* start of items add, update and delete section */

        public function getItemNameById ($id)
        {
            $id = (int)$id;
            $apps = $this->query("SELECT `name` FROM `" . DbPREFIX . "items` WHERE `id` = '$id';");
            $name = $apps->fetch(PDO::FETCH_ASSOC);
            return $name['name'];
        }

        public function getBrandNameById ($id)
        {
            $id = (int)$id;
            $apps = $this->query("SELECT `name` FROM `" . DbPREFIX . "brands` WHERE `id` = '$id';");
            $name = $apps->fetch(PDO::FETCH_ASSOC);
            return $name['name'];
        }

        public function getClientNameById ($id)
        {
            $id = (int)$id;
            $apps = $this->query("SELECT `name` FROM `" . DbPREFIX . "clients` WHERE `clntId` = '$id';");
            $name = $apps->fetch(PDO::FETCH_ASSOC);
            return $name['name'];
        }

        public function getSalesManUserIdBySession ()
        {
            if (Session::get('id_user'))
                return Session::get('id_user');
        }

        public function getSalesManUserIdByInvoiceId ($id)
        {
            $id = $this->query("SELECT `sales_man` FROM `" . DbPREFIX . "invoices` WHERE `invId` = '$id';");
            $id = $id->fetch(PDO::FETCH_ASSOC);
            return $id['sales_man'];
        }

        public function getSalesManActualNameById ($id)
        {
            $id = (int)$id;
            $data = '';
            $slsman = $this->query("SELECT * FROM `" . DbPREFIX . "users` WHERE `id` = '$id';");
            $slsman = $slsman->fetch(PDO::FETCH_ASSOC);
            if (empty($slsman['f_name']) or empty($slsman['l_name'])) {
                $data = ucfirst(preg_replace('/' . AppUsernamePrefix . '/is', '$1', $slsman['username']));
            } else {
                $data = $slsman['f_name'] . '&nbsp;' . $slsman['l_name'];
            }
            return $data;
        }

        public function getInvoicesAll ()
        {
            $invoice_details = $this->query("SELECT inv.*, clnt.*, invBl.* FROM " . DbPREFIX . "invoices inv, " . DbPREFIX . "clients clnt, " . DbPREFIX . "invoice_bill invBl WHERE inv.client = clnt.clntId AND inv.invId = invBl.invoiceId  ORDER BY inv.invId DESC;");
            $invoice_details = $invoice_details->fetchAll(PDO::FETCH_ASSOC);
            $data = array ();

            for ($i = 0; $i < count($invoice_details); $i++) {
                $data[$i] = array (
                    'serialNumber' => $i + 1,
                    'id' => $invoice_details[$i]['invId'],
                    'clientId' => $invoice_details[$i]['clntId'],
                    'client_name' => $invoice_details[$i]['name'],
                    'client_mobile_number' => $invoice_details[$i]['mobile_number'],
                    'client_address' => $invoice_details[$i]['address'],
                    'salesman' => $this->getSalesManActualNameById($this->getSalesManUserIdByInvoiceId($invoice_details[$i]['invId'])),
                    'sell_items' => $this->getSoldItemsByInvId($invoice_details[$i]['invId']),
                    'sold_total_price' => $invoice_details[$i]['totalBill'],
                    'invoice_created_time' => $invoice_details[$i]['invCreatedTime'],
                );
            }
            return $data;
        }

        public function getInvoiceDetailsById($id){
            $id = (int) $id;
            $invoice_details = $this->query("SELECT inv.*, clnt.*, invBl.* FROM " . DbPREFIX . "invoices inv, " . DbPREFIX . "clients clnt, " . DbPREFIX . "invoice_bill invBl WHERE inv.invId = $id AND invBl.invoiceId = $id AND inv.client = clnt.clntId ORDER BY inv.invId DESC;");
            $invoice_details = $invoice_details->fetchAll(PDO::FETCH_ASSOC);
            $data = array ();

            for ($i = 0; $i < count($invoice_details); $i++) {
                $data[$i] = array (
                    'serialNumber' => $i + 1,
                    'id' => $invoice_details[$i]['invId'],
                    'clientId' => $invoice_details[$i]['clntId'],
                    'client_name' => $invoice_details[$i]['name'],
                    'client_mobile_number' => $invoice_details[$i]['mobile_number'],
                    'client_address' => $invoice_details[$i]['address'],
                    'salesman' => $this->getSalesManActualNameById($this->getSalesManUserIdByInvoiceId($invoice_details[$i]['invId'])),
                    'sell_items' => $this->getSoldItemsByInvId($invoice_details[$i]['invId']),
                    'sold_total_price' => $invoice_details[$i]['totalBill'],
                    'sold_total_price_text' => $this->numberToWords($invoice_details[$i]['totalBill']),
                    'invoice_created_time' => $invoice_details[$i]['invCreatedTime'],
                );
            }
            return $data;
        }

        public function numberToWords($num)
        {
            $ones = array(
                1 => "one",
                2 => "two",
                3 => "three",
                4 => "four",
                5 => "five",
                6 => "six",
                7 => "seven",
                8 => "eight",
                9 => "nine",
                10 => "ten",
                11 => "eleven",
                12 => "twelve",
                13 => "thirteen",
                14 => "fourteen",
                15 => "fifteen",
                16 => "sixteen",
                17 => "seventeen",
                18 => "eighteen",
                19 => "nineteen"
            );
            $tens = array(
                1 => "ten",
                2 => "twenty",
                3 => "thirty",
                4 => "forty",
                5 => "fifty",
                6 => "sixty",
                7 => "seventy",
                8 => "eighty",
                9 => "ninety"
            );
            $hundreds = array(
                "hundred",
                "thousand",
                "million",
                "billion",
                "trillion",
                "quadrillion"
            ); //limit t quadrillion
            $num = number_format($num,2,".",",");
            $num_arr = explode(".",$num);
            $wholenum = $num_arr[0];
            $decnum = $num_arr[1];
            $whole_arr = array_reverse(explode(",",$wholenum));
            krsort($whole_arr);
            $rettxt = "";
            foreach($whole_arr as $key => $i){
                if($i < 20){
                    $rettxt .= $ones[$i];
                }elseif($i < 100){
                    $rettxt .= $tens[substr($i,0,1)];
                    $rettxt .= " ".$ones[substr($i,1,1)];
                }else{
                    $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0];
                    $rettxt .= " ".$tens[substr($i,1,1)];
                    $rettxt .= " ".$ones[substr($i,2,1)];
                }
                if($key > 0){
                    $rettxt .= " ".$hundreds[$key]." ";
                }
            }
            if($decnum > 0){
                $rettxt .= " and ";
                if($decnum < 20){
                    $rettxt .= $ones[$decnum];
                }elseif($decnum < 100){
                    $rettxt .= $tens[substr($decnum,0,1)];
                    $rettxt .= " ".$ones[substr($decnum,1,1)];
                }
            }
            return $rettxt;
        }

        public function insertInvoice ($client, $salesman, $CreatedUserID, $CreatedUserUsername, $CreatedUserFullName)
        {
            $client = (int)$client;
            $slsman = '';

            if (empty($salesman)) {
                $slsman = $this->getSalesManUserIdBySession();
            } else {
                $slsman = $salesman;
            }

            $this->db->prepare('INSERT INTO `' . DbPREFIX . 'invoices` VALUES (NULL, :client, :salesman, :CreatedUserID, :CreatedUserUsername, :CreatedUserFullName, now());')
                ->execute(
                    [
                        ':client' => $client,
                        ':salesman' => $slsman,
                        ':CreatedUserID' => $CreatedUserID,
                        ':CreatedUserUsername' => $CreatedUserUsername,
                        ':CreatedUserFullName' => $CreatedUserFullName
                    ]);
        }

        public function editInvoice ($id, $item, $brand, $model, $serial, $price, $warrenty, $ability, $CreatedUserID, $CreatedUserUsername, $CreatedUserFullName)
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
                $this->query("UPDATE `" . DbPREFIX . "invoices` SET $var WHERE `invId` = $id");
            }
        }

        public function deleteInvoice ($id)
        {
            $id = (int)$id;
            $this->query("DELETE from `" . DbPREFIX . "invoices` where `invId` = $id");
        }

        public function getLastInsertInvoiceId ()
        {
            $Id = $this->query("SELECT LAST_INSERT_ID() FROM `" . DbPREFIX . "clients`;");
            $Id = $Id->fetch(PDO::FETCH_ASSOC);
            return $Id['LAST_INSERT_ID()'];
        }

        public function getSoldItemsByInvId ($id)
        {
            $id = (int)$id;
            $d = $this->query("SELECT * FROM `" . DbPREFIX . "sold_items` WHERE `slditmInvoiceId` = '$id';");
            $d = $d->fetchAll(PDO::FETCH_ASSOC);
            $data = array ();

            for ($i = 0; $i < count($d); $i++) {
                $data[$i] = array (
                    'serialNumber' => $i + 1,
                    'id' => $d[$i]['slditmId'],
                    'invoiceId' => $d[$i]['slditmInvoiceId'],
                    'clientId' => $d[$i]['slditmClientId'],
                    'itemId' => $d[$i]['slditmItemId'],
                    'itemName' => $this->getItemNameById($d[$i]['slditmItemId']),
                    'brandId' => $d[$i]['slditmBrandId'],
                    'brandName' => $this->getBrandNameById($d[$i]['slditmBrandId']),
                    'model' => $d[$i]['slditmModel'],
                    'serial' => $d[$i]['slditmSerialNumber'],
                    'warrentyTime' => $d[$i]['slditmWarrentyTime'],
                    'unitPrice' => $d[$i]['slditmUnitPrice'],
                    'quantity' => $d[$i]['slditmQuantity'],
                    'totalPrice' => $d[$i]['slditmTotalPrice'],
                );
            }

            return $data;
        }

        public function getSoldItemsById ($id)
        {
            $id = (int)$id;
            $d = $this->query("SELECT * FROM `" . DbPREFIX . "sold_items` WHERE `slditmId` = '$id';");
            $d = $d->fetchAll(PDO::FETCH_ASSOC);
            $data = array ();

            for ($i = 0; $i < count($d); $i++) {
                $data[$i] = array (
                    'serialNumber' => $i + 1,
                    'id' => $d[$i]['slditmId'],
                    'invoiceId' => $d[$i]['slditmInvoiceId'],
                    'clientId' => $d[$i]['slditmClientId'],
                    'itemId' => $d[$i]['slditmItemId'],
                    'itemName' => $this->getItemNameById($d[$i]['slditmItemId']),
                    'brandId' => $d[$i]['slditmBrandId'],
                    'brandName' => $this->getBrandNameById($d[$i]['slditmBrandId']),
                    'model' => $d[$i]['slditmModel'],
                    'serial' => $d[$i]['slditmSerialNumber'],
                    'warrentyTime' => $d[$i]['slditmWarrentyTime'],
                    'unitPrice' => $d[$i]['slditmUnitPrice'],
                    'quantity' => $d[$i]['slditmQuantity'],
                    'totalPrice' => $d[$i]['slditmTotalPrice'],
                );
            }

            return $data;
        }

        public function addToCart ($invoice, $client,$item, $brand, $model, $serial, $warranty, $price, $quantity, $totalPrice, $CreatedUserID, $CreatedUserUsername, $CreatedUserFullName)
        {
            $invoice = (int)$invoice;
            $client = (int)$client;
            $item = (int)$item;
            $brand = (int)$brand;
            $warranty = (int)$warranty;
            $price = (int)$price;
            $quantity = (int)$quantity;
            $totalPrice = (int)$totalPrice;

            $this->db->prepare('INSERT INTO `' . DbPREFIX . 'sold_items` VALUES (NULL, :invoice, :client, :item, :brand, :model, :serial, :warranty, :price, :quantity, :totalPrice, :CreatedUserID, :CreatedUserUsername, :CreatedUserFullName, now());')
                ->execute(
                    [
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
                        ':CreatedUserID' => $CreatedUserID,
                        ':CreatedUserUsername' => $CreatedUserUsername,
                        ':CreatedUserFullName' => $CreatedUserFullName
                    ]);
        }

        public function updateToCart ($id, $invoice, $client,$item, $brand, $model, $serial, $warranty, $price, $quantity, $totalPrice, $CreatedUserID, $CreatedUserUsername, $CreatedUserFullName)
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

        public function deleteSoldItem ($id)
        {
            $id = (int)$id;
            $this->query("DELETE from `" . DbPREFIX . "sold_items` where `slditmId` = $id");
        }

        public function manageBill($mode, $invoice, $client, $bill, $CreatedUserID, $CreatedUserUsername, $CreatedUserFullName){
            $invoice = (int) $invoice;
            $client = (int) $client;
            $bill = (int) $bill;

            if ($mode === 'create'){
                $this->db->prepare('INSERT INTO `' . DbPREFIX . 'invoice_bill` VALUES (NULL, :invoice, :client, :bill, :CreatedUserID, :CreatedUserUsername, :CreatedUserFullName, now());')
                    ->execute(
                        [
                            ':invoice' => $invoice,
                            ':client' => $client,
                            ':bill' => $bill,
                            ':CreatedUserID' => $CreatedUserID,
                            ':CreatedUserUsername' => $CreatedUserUsername,
                            ':CreatedUserFullName' => $CreatedUserFullName
                        ]);
            }
            if ($mode === 'update'){
                $this->db->query("UPDATE `" . DbPREFIX . "invoice_bill` SET `totalBill` = $bill WHERE `invoiceId` = $invoice;");
            }
        }

        /* end of Item add, update and delete section */
    }