/* global Mishusoft, _root_ */

class InvoiceManager extends Mishusoft {
    constructor() {
        super();
        this.AllClientsURL = this.AppHostAddress + 'office/clients/getClientsOrderByName';
        this.AllItemsURL = this.AppHostAddress + 'office/items/getAvailableItemsOrderByName';
        this.AllBrandsURL = this.AppHostAddress + 'office/brands/getBrandsOrderByName';
        this.viewClientsForInvoices();
        this.viewItemsForInvoices();
    }

    viewClientsForInvoices() {
        this.ajax = new XMLHttpRequest();
        this.ajax.open(this.method, this.AllClientsURL, this.asynchronous);
        this.ajax.send();

        //receiving response from ajax
        this.ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                /*converting back to array*/
                this.data = JSON.parse(this.responseText);
                //replaceing previous data
                this.htmlpad = Mishusoft.detectElement('clnt_fl_nm');
                //html value for <body>
                this.html = '';
                this.html += '<option value=""> -- Select One -- </option>';
                this.html += '<option value="addNew" id="clients-add-btn" title="Click to add new client"> New client </option>';

                if (this.data.length !== 0) {
                    //looping through the data
                    for (let a = 0; a < this.data.length; a++) {
                        this.id = this.data[a].id;
                        this.clnt_fl_nm = this.data[a].name;
                        this.clnt_cntct_nmbr = this.data[a].mobile_number;
                        this.clnt_cntct_addrs = this.data[a].address;
                        //appeding at html
                        this.html += '<option value="' + this.id + '" title="' + this.clnt_fl_nm + ',&nbsp; Mob. Number:' + this.clnt_cntct_nmbr + ',&nbsp;Address:' + this.clnt_cntct_addrs + '">' + this.clnt_fl_nm + '</option>';

                        if (this.htmlpad) {
                            this.htmlpad.innerHTML = this.html;
                        }
                    }
                }
            }
        };
    }


    saveClients() {
        let data = '';
        let command = Mishusoft.detectElement('clients-data-btn').innerHTML;

        if (command === 'Save') {
            // Form fields, see IDs above
            data = {
                security_code: 1,
                name: Mishusoft.detectElement('fl_nm').value,
                mobile_number: Mishusoft.detectElement('cntct_nmbr').value,
                address: Mishusoft.detectElement('cntct_addrs').value,
                btnName: Mishusoft.detectElement('clients-data-btn').innerHTML
            };
        }

        let ajax = new XMLHttpRequest();
        ajax.open("POST", _root_ + 'office/clients/addClients', true);
        ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajax.send(JSON.stringify(data)); // Make sure to stringify
        //receiving response from ajax
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                //show message with another method
                Mishusoft.showMessage(this.responseText, Mishusoft.detectElement("message3"));
            }
        };
    }


    viewItemsForInvoices() {
        this.ajax = new XMLHttpRequest();
        this.ajax.open(this.method, this.AllItemsURL, this.asynchronous);
        this.ajax.send();

        //receiving response from ajax
        this.ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                /*converting back to array*/
                this.data = JSON.parse(this.responseText);
                //replaceing previous data
                this.htmlpad1 = Mishusoft.detectElement('inv-prd-item');
                this.htmlpad2 = Mishusoft.detectElement('prd-detls-item');
                //html value for <body>
                this.html = '';
                this.html += '<option value=""> -- Select One --</option>';
                this.html += '<option value="addNew" id="inv-item-add-btn"> New Item </option>';

                if (this.data.length !== 0) {
                    //looping through the data
                    for (let a = 0; a < this.data.length; a++) {
                        this.id = this.data[a].id;
                        this.name = this.data[a].name;
                        //appending at html
                        this.html += '<option value="' + this.id + '">' + this.name + '</option>';

                        if (this.htmlpad1) {
                            this.htmlpad1.innerHTML = this.html;
                        }
                        if (this.htmlpad2) {
                            this.htmlpad2.innerHTML = this.html;
                        }
                    }
                }
            }
        };
    }


    viewBrandsForProductDetails() {
        this.ajax = new XMLHttpRequest();
        this.ajax.open(this.method, this.AllBrandsURL, this.asynchronous);
        this.ajax.send();

        //receiving response from ajax
        this.ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                /*converting back to array*/
                this.data = JSON.parse(this.responseText);
                //replaceing previous data
                this.htmlpad = Mishusoft.detectElement('prd-detls-brand');
                //html value for <body>
                this.html = '';
                this.html += '<option value=""> -- Select One --</option>';
                this.html += '<option value="addNew" id="brand-add-btn"> New brand </option>';

                if (this.data.length !== 0) {
                    //looping through the data
                    for (let a = 0; a < this.data.length; a++) {
                        this.id = this.data[a].id;
                        this.name = this.data[a].name;
                        //appending at html
                        this.html += '<option value="' + this.id + '">' + this.name + '</option>';

                        if (this.htmlpad) {
                            this.htmlpad.innerHTML = this.html;
                        }
                    }
                }
            }
        };
    }


    saveItem() {
        let data = '';
        let command = Mishusoft.detectElement('item-data-btn').innerHTML;

        if (command === 'Save') {
            data = {
                security_code: 1,
                name: Mishusoft.detectElement('itemName').value,
                cStatus: Mishusoft.detectElement('current_status').value,
                btnName: Mishusoft.detectElement('item-data-btn').innerHTML
            };
        }

        let ajax = new XMLHttpRequest();
        ajax.open("POST", _root_ + 'office/items/addItem', true);
        ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajax.send(JSON.stringify(data)); // Make sure to stringify
        //receiving response from ajax
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                //show message with another method
                Mishusoft.showMessage(this.responseText, Mishusoft.detectElement("message4"));
            }
        };
    }


    saveProductDetails() {
        let data = '';
        let command = Mishusoft.detectElement('productdetails-data-btn').innerHTML;

        if (command === 'Save') {
            // Form fields, see IDs above
            data = {
                security_code: 1,
                branch: Mishusoft.detectElement('invoiceBranchId').value,
                item: Mishusoft.detectElement('prd-detls-item').value,
                brand: Mishusoft.detectElement('prd-detls-brand').value,
                modelNumber: Mishusoft.detectElement('modelNumber').value,
                serialNumber: Mishusoft.detectElement('serialNumber').value,
                unitPrice: Mishusoft.detectElement('unitPrice').value,
                warrantyTime: Mishusoft.detectElement('warrantyTime').value,
                ability: 'available',
                btnName: Mishusoft.detectElement('productdetails-data-btn').innerHTML
            };
        }

        let ajax = new XMLHttpRequest();
        ajax.open("POST", _root_ + 'office/productdetails/addProductDetail', true);
        ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajax.send(JSON.stringify(data)); // Make sure to stringify
        //receiving response from ajax
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                Mishusoft.showMessage(this.responseText, Mishusoft.detectElement("message6"));
            }
        };
    }

    verifyIsBrandAlreadyExists() {
        let dataB = {
            security_code: 1,
            name: Mishusoft.detectElement('brandName').value
        };

        let ajaxB = new XMLHttpRequest();
        ajaxB.open("POST", _root_ + 'office/brands/isBrandAlreadyExists', true);
        ajaxB.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajaxB.send(JSON.stringify(dataB)); // Make sure to stringify
        ajaxB.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                // converting back to array
                let dataC = JSON.parse(this.responseText);
                if (dataC.length !== 0) {
                    //looping through the data
                    for (let a = 0; a < dataC.length; a++) {
                        let status = dataC[a].status;

                        if (status === 'yes') {
                            Mishusoft.detectElement('inv-prd-brand').value = '';
                            Mishusoft.detectElement('message5').innerHTML = '';
                            Mishusoft.detectElement('modal04').style.display = 'none';

                            Mishusoft.detectElement('message6').innerHTML = '';
                            Mishusoft.detectElement('modal05').style.display = 'block';
                            Mishusoft.detectElement('productdetailsEditMode').innerHTML = 'New';
                            Mishusoft.detectElement('prd-detls-item').value = Mishusoft.detectElement('inv-prd-item').value;
                            Mishusoft.detectElement('prd-detls-brand').value = Mishusoft.detectElement('inv-prd-brand').value;
                            Mishusoft.detectElement('modelNumber').value = '';
                            Mishusoft.detectElement('serialNumber').value = '';
                            Mishusoft.detectElement('unitPrice').value = '';
                            Mishusoft.detectElement('warrantyTime').value = '';
                        } else {
                            alert(Mishusoft.detectElement('brandName').value + ' is not saved.');
                        }
                    }
                }
            }
        };
    }


    viewSoldItemsByInvId() {
        let branchNumber = Mishusoft.detectElement('invoiceBranchId').value;
        let invoiceNumber = Mishusoft.detectElement('invoiceID').value;
        if (Mishusoft.isNumber(invoiceNumber)) {
            let data = {
                security_code: 1,
                branch: branchNumber,
                invoice: invoiceNumber
            };
            let ajax = new XMLHttpRequest();
            ajax.open('POST', _root_ + 'office/invoices/getSoldItemsByInvId', true);
            ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
            ajax.send(JSON.stringify(data)); // Make sure to stringify

            //receiving response from ajax
            ajax.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    /*converting back to array*/
                    let data2 = JSON.parse(this.responseText);
                    //replacing previous data
                    let htmlpad = Mishusoft.detectElement('ordered_product_details');
                    //html value for <body>
                    let html = '';

                    let sumOfTotalPrice = 0;
                    let sumTotalPad = Mishusoft.detectElement('ordered_product_total_price');

                    if (data2.length !== 0) {
                        //looping through the data
                        for (let a = 0; a < data2.length; a++) {
                            let serialNumber = data2[a].serialNumber;
                            let id = data2[a].id;
                            let invoiceId = data2[a].invoiceId;
                            let clientId = data2[a].clientId;
                            let itemId = data2[a].itemId;
                            let itemName = data2[a].itemName;
                            let brandId = data2[a].brandId;
                            let brandName = data2[a].brandName;
                            let model = data2[a].model;
                            let serial = data2[a].serial;
                            let warrantyTime = data2[a].warrantyTime;
                            let unitPrice = data2[a].unitPrice;
                            let quantity = data2[a].quantity;
                            let totalPrice = data2[a].totalPrice;

                            sumOfTotalPrice += totalPrice;

                            //appeding at html
                            html += '<tr>';
                            html += '<td class="text-align-center">' + serialNumber + '</td>';
                            html += '<td class="text-align-left">';
                            html += brandName + '&nbsp;' + itemName + '&nbsp;' + model + '<br/>';
                            html += 'Serial:&nbsp;' + serial + '<br/>';
                            html += 'Warranty:&nbsp;' + warrantyTime + '&nbsp;days';
                            html += '</td>';
                            html += '<td class="text-align-center">' + quantity + '</td>';
                            html += '<td class="text-align-center">' + unitPrice + '.00</td>';
                            html += '<td class="text-align-center">' + totalPrice + '.00</td>';
                            html += '<td class="text-align-center">';
                            html += '<a href="javascript:void(0);" id="sld-itm-edit-btn" class="button button-xs button-success" data-id="' + id + '" data-invoiceId="' + invoiceId + '" data-clientId="' + clientId + '" data-itemId="' + itemId + '" data-itemName="' + itemName + '" data-brandId="' + brandId + '" data-brandName="' + brandName + '" data-model="' + model + '" data-serial="' + serial + '" data-unitPrice="' + unitPrice + '" data-warrentyTime="' + warrantyTime + '" data-quantity="' + quantity + '" data-totalPrice="' + totalPrice + '"> <i class="far fa-edit"></i></a>&nbsp;&nbsp;';
                            html += '<a href="javascript:void(0);" id="sld-itm-delete-btn" class="button button-xs button-danger" data-id="' + id + '"><i class="far fa-trash-alt"></i></i></a>';
                            html += '</td>';
                            html += '</tr>';

                            if (htmlpad) {
                                htmlpad.innerHTML = html;
                            }
                        }
                        sumTotalPad.innerHTML = sumOfTotalPrice;
                        //update total bill
                        InvoiceManager.manageBillMoney('update', sumOfTotalPrice);

                    } else {
                        //appending at html
                        html += '<tr>';
                        html += '<td class="text-align-center" colspan="6">No item added in cart.</td>';
                        html += '</tr>';

                        if (htmlpad) {
                            htmlpad.innerHTML = html;
                        }
                    }
                }
            };
        }
    }


    static manageBillMoney(mode, sumOfTotalPrice) {
        let dataBill = {
            security_code: 1,
            branch: Mishusoft.detectElement('invoiceBranchId').value,
            invoice: Mishusoft.detectElement('invoiceID').value,
            client: Mishusoft.detectElement('clnt_fl_nm').value,
            bill: sumOfTotalPrice,
            mode: mode
        };

        let ajaxBill = new XMLHttpRequest();
        ajaxBill.open("POST", _root_ + 'office/invoices/manageBill', true);
        ajaxBill.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajaxBill.send(JSON.stringify(dataBill)); // Make sure to stringify
    }

    viewBrandByItemId(InvPrdItmId) {
        if (Mishusoft.isNumber(InvPrdItmId)) {
            let data = {security_code: 1, id: InvPrdItmId};

            let ajax = new XMLHttpRequest();
            ajax.open("POST", _root_ + 'office/productdetails/getBrandByItemId', true);
            ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
            ajax.send(JSON.stringify(data)); // Make sure to stringify
            //receiving response from ajax
            ajax.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    /*converting back to array*/
                    let data = JSON.parse(this.responseText);
                    //replacing previous data
                    let htmlpad = Mishusoft.detectElement('inv-prd-brand');
                    //html value for <body>
                    let html = '';
                    html += '<option value=""> -- Select One -- </option>';
                    html += '<option value="addNew" id="inv-prd-brand-add-btn"> New brand </option>';

                    if (data.length !== 0) {
                        //looping through the data
                        for (let a = 0; a < data.length; a++) {
                            let id = data[a].id;
                            let name = data[a].name;

                            //appending at html
                            html += '<option value="' + id + '">' + name + '</option>';

                            if (htmlpad) {
                                htmlpad.innerHTML = html;
                            }
                        }
                    } else {
                        if (htmlpad) {
                            htmlpad.innerHTML = html;
                        }
                    }
                }
            };
        }
    }

    viewModelByItemBrand(InvPrdBrnId,InvPrdItmId, InvPrdBrdId) {
        if (Mishusoft.isNumber(InvPrdBrdId)) {
            let data = {security_code: 1, branch: InvPrdBrnId,  item: InvPrdItmId, brand: InvPrdBrdId};

            let ajax = new XMLHttpRequest();
            ajax.open("POST", _root_ + 'office/productdetails/getModelByItemBrandId', true);
            ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
            ajax.send(JSON.stringify(data)); // Make sure to stringify
            //receiving response from ajax
            ajax.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    /*converting back to array*/
                    let data = JSON.parse(this.responseText);
                    //replaceing previous data
                    let htmlpad = Mishusoft.detectElement('inv-prd-modelNumber');
                    //html value for <body>
                    let html = '';
                    html += '<option value=""> -- Select One -- </option>';

                    if (data.length !== 0) {
                        //looping through the data
                        for (let a = 0; a < data.length; a++) {
                            let value = data[a].value;
                            let name = data[a].name;

                            //appending at html
                            html += '<option value="' + value + '">' + name + '</option>';

                            if (htmlpad) {
                                htmlpad.innerHTML = html;
                            }
                        }
                    } else {
                        if (htmlpad) {
                            htmlpad.innerHTML = html;
                        }
                    }
                }
            };
        }
    }

    static printInvoice(id) {
        Mishusoft.PopUpWindowCenterPosition(_root_ + 'office/invoices/doprint/' + id, 'Invoice no: ' + id, '800', '1056');
    }

    static searchSpecificInvoice(){
        let brnc = Mishusoft.detectElement('inv_srh_branch').value;
        let inv = Mishusoft.detectElement('inv_srh_inv_id').value;
        let clnt_nm = Mishusoft.detectElement('inv_srh_clnt_nm').value;
        let clnt_nmbr = Mishusoft.detectElement('inv_srh_clnt_nmbr').value;

        let data = {security_code: 1, branch: brnc,  invoice: inv, client_name: clnt_nm, client_number: clnt_nmbr };

        let ajax = new XMLHttpRequest();
        ajax.open("POST", _root_ + 'office/invoices/searchSpecificInvoice', true);
        ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajax.send(JSON.stringify(data)); // Make sure to stringify
        //receiving response from ajax
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let res = this.responseText;
                if (res === typeof Object) {
                    console.log(this.responseText);
                }
            }
        };
    }


    // --------------------------------------------------

}

let myApp = new InvoiceManager();


$('#invoices-data-table').on('click', '.page', function () {
    let url = 'office/invoices/invoicesPaginationAJAX';
    Mishusoft.pagination($(this).attr('page'), url, 'invoices-data-table');
});


/*start of clients section*/
//hide edit pad by default
if (Mishusoft.detectElement('clientsEditMode')) {
    Mishusoft.detectElement('clientsEditMode').innerHTML = 'New';
    Mishusoft.detectElement('clients-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('clients-reset-btn').innerHTML = 'Reset';
}
//add data form by clicking add button
$(document).on('change', '#clnt_fl_nm', function () {
    if (Mishusoft.detectElement('clnt_fl_nm').value === 'addNew') {
        Mishusoft.detectElement('message3').innerHTML = '';
        Mishusoft.detectElement('modal02').style.display = 'block';
        Mishusoft.detectElement('clientsEditMode').innerHTML = 'New';
        Mishusoft.detectElement('clients-data-btn').innerHTML = 'Save';
        Mishusoft.detectElement('fl_nm').value = '';
        Mishusoft.detectElement('cntct_nmbr').value = '';
        Mishusoft.detectElement('cntct_addrs').value = '';
    }

    let clntId = Mishusoft.detectElement('clnt_fl_nm').value;
    if (Mishusoft.isNumber(clntId)) {

        let data = {security_code: 1, id: clntId};

        let ajax = new XMLHttpRequest();
        ajax.open("POST", _root_ + 'office/clients/getSelectedClient', true);
        ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajax.send(JSON.stringify(data)); // Make sure to stringify

        //receiving response from ajax
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                /*converting back to array*/
                let data = JSON.parse(this.responseText);
                if (data.length !== 0) {
                    //looping through the data
                    for (let a = 0; a < data.length; a++) {
                        let id = data[a].clntId;
                        let clnt_cntct_nmbr = data[a].mobile_number;
                        let clnt_cntct_addrs = data[a].address;

                        //appeding at html
                        Mishusoft.detectElement('clnt_fl_nm').value = id;
                        Mishusoft.detectElement('clnt_cntct_nmbr').value = clnt_cntct_nmbr;
                        Mishusoft.detectElement('clnt_cntct_addrs').value = clnt_cntct_addrs;
                    }
                }
            }
        };
    } else {
        Mishusoft.detectElement('clnt_fl_nm').value = '';
        Mishusoft.detectElement('clnt_cntct_nmbr').value = '';
        Mishusoft.detectElement('clnt_cntct_addrs').value = '';
    }
});

//save data by clicking data button
$(document).on('click', '#clients-data-btn', myApp.saveClients);

//reset inputbox by clicking reset button
$(document).on('click', '#clients-reset-btn', function () {
    Mishusoft.detectElement('fl_nm').value = '';
    Mishusoft.detectElement('cntct_nmbr').value = '';
    Mishusoft.detectElement('cntct_addrs').value = '';
});
//close popupbox
$(document).on('click', '#clients-close-btn', function () {
    Mishusoft.detectElement('clnt_fl_nm').value = '';
    Mishusoft.detectElement('modal02').style.display = 'none';
    myApp.viewClientsForInvoices();
});
// end of  clients section


/*start of item section*/
//hide edit pad by default
if (Mishusoft.detectElement('itemEditMode')) {
    Mishusoft.detectElement('itemEditMode').innerHTML = 'New';
    Mishusoft.detectElement('item-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('item-reset-btn').innerHTML = 'Reset';
}
//add data form by clicking add button
$(document).on('change', '#inv-prd-item', function () {
    if (Mishusoft.detectElement('inv-prd-item').value === 'addNew') {
        Mishusoft.detectElement('message4').innerHTML = '';
        Mishusoft.detectElement('modal03').style.display = 'block';
        Mishusoft.detectElement('itemEditMode').innerHTML = 'New';
        Mishusoft.detectElement('item-data-btn').innerHTML = 'Save';
        Mishusoft.detectElement('itemName').value = '';
        Mishusoft.detectElement('current_status').value = '';
    } else if (Mishusoft.detectElement('inv-prd-item').value !== '' && Mishusoft.isNumber(Mishusoft.detectElement('inv-prd-item').value)) {
        Mishusoft.detectElement('inv-prd-brand').value = '';
        myApp.viewBrandByItemId(Mishusoft.detectElement('inv-prd-item').value);
    }
});
//check new item name ability.
$(document).on('keyup', '#itemName', function () {
    let checkItemNameAbilityURL = _root_ + "office/items/checkItemNameAbility";
    let value = Mishusoft.detectElement("itemName").value;
    let htmlpad = Mishusoft.detectElement("message4");

    return Mishusoft.checkInputDataAbility(checkItemNameAbilityURL, value, htmlpad);
});
//save data by clicking data button
$(document).on('click', '#item-data-btn', myApp.saveItem);

//reset inputbox by clicking reset button
$(document).on('click', '#item-reset-btn', function () {
    Mishusoft.detectElement('itemName').value = '';
    Mishusoft.detectElement('current_status').value = '';
});
//close inputbox by clicking cancel button
$(document).on('click', '#item-close-btn', function () {
    Mishusoft.detectElement('modal03').style.display = 'none';
    Mishusoft.detectElement('inv-prd-item').value = '';
    myApp.viewItemsForInvoices();
});
// end item section


//start brand section
//hide edit pad by default
if (Mishusoft.detectElement('brandEditMode')) {
    Mishusoft.detectElement('brandEditMode').innerHTML = 'New';
    Mishusoft.detectElement('brand-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('brand-reset-btn').innerHTML = 'Reset';
}
//add data form by clicking add button
$(document).on('change', '#inv-prd-brand', function () {
    if (Mishusoft.detectElement('inv-prd-brand').value === 'addNew') {
        Mishusoft.detectElement('message5').innerHTML = '';
        Mishusoft.detectElement('modal04').style.display = 'block';
        Mishusoft.detectElement('brandEditMode').innerHTML = 'New';
        Mishusoft.detectElement('brand-data-btn').innerHTML = 'Save';
        Mishusoft.detectElement('brandName').value = '';
    } else if (Mishusoft.detectElement('inv-prd-brand').value !== '' && Mishusoft.isNumber(Mishusoft.detectElement('inv-prd-brand').value)) {
        Mishusoft.detectElement('inv-prd-modelNumber').value = '';
        myApp.viewModelByItemBrand(Mishusoft.detectElement('invoiceBranchId').value,Mishusoft.detectElement('inv-prd-item').value, Mishusoft.detectElement('inv-prd-brand').value);
    }
});
//set textbox value change dynamic after dropbox had changed.
$(document).on('keyup', '#brandName', function () {
    let checkBrandNameAbilityURL = _root_ + "office/brands/checkBrandNameAbility";
    let value = Mishusoft.detectElement("brandName").value;
    let htmlpad = Mishusoft.detectElement("message5");

    return Mishusoft.checkInputDataAbility(checkBrandNameAbilityURL, value, htmlpad);
});
//save data by clicking data button
$(document).on('click', '#brand-data-btn', function () {
    //adding data
    if (Mishusoft.detectElement('brand-data-btn').innerHTML === 'Save') {
        // Form fields, see IDs above
        let data = {
            security_code: 1,
            name: Mishusoft.detectElement('brandName').value,
            btnName: Mishusoft.detectElement('brand-data-btn').innerHTML
        };

        let ajax = new XMLHttpRequest();
        ajax.open("POST", _root_ + 'office/brands/addBrand', true);
        ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajax.send(JSON.stringify(data)); // Make sure to stringify
        //receiving response from ajax
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                //show message with another method
                Mishusoft.showMessage(this.responseText, Mishusoft.detectElement("message5"));
                myApp.viewBrandsForProductDetails();
                myApp.verifyIsBrandAlreadyExists();
            }
        };
    }

});
//reset inputbox by clicking reset button
$(document).on('click', '#brand-reset-btn', function () {
    Mishusoft.detectElement('brandName').value = '';
});
//close inputbox by clicking cancel button
$(document).on('click', '#brand-close-btn', function () {
    Mishusoft.detectElement('modal04').style.display = 'none';
    Mishusoft.detectElement('inv-prd-brand').value = '';
});

//view data form by changing button
$(document).on('change', '#inv-prd-modelNumber', function () {
    if (Mishusoft.detectElement('inv-prd-modelNumber').value !== '') {
        let InvPrdBrnId = Mishusoft.detectElement('invoiceBranchId').value;
        let InvPrdItmId = Mishusoft.detectElement('inv-prd-item').value;
        let InvPrdBrdId = Mishusoft.detectElement('inv-prd-brand').value;
        let InvPrdMdlNm = Mishusoft.detectElement('inv-prd-modelNumber').value;

        let data = {
            security_code: 1,
            branch: InvPrdBrnId,
            item: InvPrdItmId,
            brand: InvPrdBrdId,
            model: InvPrdMdlNm
        };

        let ajax = new XMLHttpRequest();
        ajax.open("POST", _root_ + 'office/productdetails/getDetailsByItemBrandModelName', true);
        ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajax.send(JSON.stringify(data)); // Make sure to stringify
        //receiving response from ajax
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                /*converting back to array*/
                let data = JSON.parse(this.responseText);
                if (data.length !== 0) {
                    //looping through the data
                    for (let a = 0; a < data.length; a++) {
                        let serialNumber = data[a].serial;
                        let warrantyTime = data[a].warranty;
                        let unitPrice = data[a].price;

                        //appending at html
                        Mishusoft.detectElement('inv-prd-serialNumber').value = serialNumber;
                        Mishusoft.detectElement('inv-prd-warrantyTime').value = warrantyTime;
                        Mishusoft.detectElement('inv-prd-unitPrice').value = unitPrice;
                        Mishusoft.detectElement('inv-prd-quantity').value = '';
                        Mishusoft.detectElement('inv-prd-TotalPrice').value = '';
                    }
                }
            }
        };
    }
});

//set textbox value change dynamic after inputox had changed.
$(document).on('keyup', '#inv-prd-unitPrice', function () {
    let quantity = Mishusoft.detectElement('inv-prd-quantity').value;
    if (Mishusoft.isNumber(quantity)) {
        let unitPrice = Mishusoft.detectElement('inv-prd-unitPrice').value;
        Mishusoft.detectElement('inv-prd-TotalPrice').value = quantity * unitPrice;
    }
});
//set textbox value change dynamic after inputox had changed.
$(document).on('keyup', '#inv-prd-quantity', function () {
    let quantity = Mishusoft.detectElement('inv-prd-quantity').value;
    let unitPrice = Mishusoft.detectElement('inv-prd-unitPrice').value;
    Mishusoft.detectElement('inv-prd-TotalPrice').value = quantity * unitPrice;
});
//set textbox value change dynamic after inputox had changed.
$(document).on('keyup', '#inv-prd-Discount', function () {
    let quantity = Mishusoft.detectElement('inv-prd-quantity').value;
    let unitPrice = Mishusoft.detectElement('inv-prd-unitPrice').value;
    let Discount = Mishusoft.detectElement('inv-prd-Discount').value;
    if (Mishusoft.isNumber(unitPrice)) {
        let newUnitPrice = unitPrice - (unitPrice * (Discount / 100));
        Mishusoft.detectElement('inv-prd-unitPrice').value = newUnitPrice;
        Mishusoft.detectElement('inv-prd-TotalPrice').value = quantity * newUnitPrice;
    }
});

/*start of Product Details section*/
//hide edit pad by default
if (Mishusoft.detectElement('productdetailsEditMode')) {
    Mishusoft.detectElement('productdetailsEditMode').innerHTML = 'New';
    Mishusoft.detectElement('productdetails-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('productdetails-reset-btn').innerHTML = 'Reset';
}

//save data by clicking data button
$(document).on('click', '#productdetails-data-btn', myApp.saveProductDetails);
//reset inputbox by clicking reset button
$(document).on('click', '#productdetails-reset-btn', function () {
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('productdetailsEditMode').innerHTML = 'Add new';
    Mishusoft.detectElement('productdetails-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('prd-detls-item').value = '';
    Mishusoft.detectElement('prd-detls-brand').value = '';
    Mishusoft.detectElement('modelNumber').value = '';
    Mishusoft.detectElement('serialNumber').value = '';
    Mishusoft.detectElement('unitPrice').value = '';
    Mishusoft.detectElement('warrantyTime').value = '';
});
//close inputbox by clicking cancel button
$(document).on('click', '#productdetails-close-btn', function () {
    Mishusoft.detectElement('modal05').style.display = 'none';
    Mishusoft.detectElement('prd-detls-item').value = '';
    Mishusoft.detectElement('prd-detls-brand').value = '';
    Mishusoft.detectElement('modelNumber').value = '';
    Mishusoft.detectElement('serialNumber').value = '';
    Mishusoft.detectElement('unitPrice').value = '';
    Mishusoft.detectElement('warrantyTime').value = '';
});
//end of product details

//start of add to cart section

//save data by clicking data button
$(document).on('click', '#cart-add-btn', function () {

    let data = '';
    if (Mishusoft.detectElement('cart-add-btn').innerHTML === '<i class="fas fa-plus-circle"></i>&nbsp;Add&nbsp;to&nbsp;Cart') {
        data = {
            security_code: 1,
            branch: Mishusoft.detectElement('invoiceBranchId').value,
            invId: Mishusoft.detectElement('invoiceID').value,
            clientId: Mishusoft.detectElement('clnt_fl_nm').value,
            item: Mishusoft.detectElement('inv-prd-item').value,
            brand: Mishusoft.detectElement('inv-prd-brand').value,
            model: Mishusoft.detectElement('inv-prd-modelNumber').value,
            serialNumber: Mishusoft.detectElement('inv-prd-serialNumber').value,
            warrantyTime: Mishusoft.detectElement('inv-prd-warrantyTime').value,
            unitPrice: Mishusoft.detectElement('inv-prd-unitPrice').value,
            itemQuantity: Mishusoft.detectElement('inv-prd-quantity').value,
            totalPrice: Mishusoft.detectElement('inv-prd-TotalPrice').value,
            btnName: Mishusoft.detectElement('cart-add-btn').innerHTML
        };
    } else if (Mishusoft.detectElement('cart-add-btn').innerHTML === 'Update') {
        data = {
            security_code: 1,
            id: Mishusoft.detectElement('sld-itm-id').value,
            branch: Mishusoft.detectElement('invoiceBranchId').value,
            invId: Mishusoft.detectElement('invoiceID').value,
            clientId: Mishusoft.detectElement('clnt_fl_nm').value,
            item: Mishusoft.detectElement('inv-prd-item').value,
            brand: Mishusoft.detectElement('inv-prd-brand').value,
            model: Mishusoft.detectElement('inv-prd-modelNumber').value,
            serialNumber: Mishusoft.detectElement('inv-prd-serialNumber').value,
            warrantyTime: Mishusoft.detectElement('inv-prd-warrantyTime').value,
            unitPrice: Mishusoft.detectElement('inv-prd-unitPrice').value,
            itemQuantity: Mishusoft.detectElement('inv-prd-quantity').value,
            totalPrice: Mishusoft.detectElement('inv-prd-TotalPrice').value,
            btnName: Mishusoft.detectElement('cart-add-btn').innerHTML
        };
    }

    if (data !== '') {
        let ajax = new XMLHttpRequest();
        ajax.open("POST", _root_ + 'office/invoices/addToCart', true);
        ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajax.send(JSON.stringify(data)); // Make sure to stringify
        //receiving response from ajax
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                myApp.viewSoldItemsByInvId();
                //show message with another method
                Mishusoft.showMessage(this.responseText, Mishusoft.detectElement("message2"));

                Mishusoft.detectElement('inv-prd-item').value = '';
                Mishusoft.detectElement('inv-prd-brand').value = '';
                Mishusoft.detectElement('inv-prd-modelNumber').value = '';
                Mishusoft.detectElement('inv-prd-serialNumber').value = '';
                Mishusoft.detectElement('inv-prd-warrantyTime').value = '';
                Mishusoft.detectElement('inv-prd-unitPrice').value = '';
                Mishusoft.detectElement('inv-prd-quantity').value = '';
                Mishusoft.detectElement('inv-prd-TotalPrice').value = '';
                Mishusoft.detectElement('inv-prd-Discount').value = '';
            }
        };
    }
});
//reset cart items data form by clicking add button
$(document).on('click', '#cart-reset-btn', function () {
    Mishusoft.detectElement('inv-prd-item').value = '';
    Mishusoft.detectElement('inv-prd-brand').value = '';
    Mishusoft.detectElement('inv-prd-modelNumber').value = '';
    Mishusoft.detectElement('inv-prd-serialNumber').value = '';
    Mishusoft.detectElement('inv-prd-warrantyTime').value = '';
    Mishusoft.detectElement('inv-prd-unitPrice').value = '';
    Mishusoft.detectElement('inv-prd-quantity').value = '';
    Mishusoft.detectElement('inv-prd-TotalPrice').value = '';
});


//edit sold item
$(document).on('click', '#sld-itm-edit-btn', function () {
    Mishusoft.detectElement('cart-add-btn').innerHTML = 'Update';
    Mishusoft.detectElement('sld-itm-id').value = $(this).attr('data-id');
    Mishusoft.detectElement('invoiceID').value = $(this).attr('data-invoiceid');
    Mishusoft.detectElement('clnt_fl_nm').value = $(this).attr('data-clientid');
    Mishusoft.detectElement('inv-prd-item').value = $(this).attr('data-itemid');
    myApp.viewBrandByItemId($(this).attr('data-itemid'));
    Mishusoft.detectElement('inv-prd-serialNumber').value = $(this).attr('data-serial');
    Mishusoft.detectElement('inv-prd-warrantyTime').value = $(this).attr('data-warrentytime');
    Mishusoft.detectElement('inv-prd-unitPrice').value = $(this).attr('data-unitprice');
    Mishusoft.detectElement('inv-prd-quantity').value = $(this).attr('data-quantity');
    Mishusoft.detectElement('inv-prd-TotalPrice').value = $(this).attr('data-totalprice');
});
//delete sold item
$(document).on('click', '#sld-itm-delete-btn', function () {
    Mishusoft.detectElement('PopUpDialogBox').style.display = 'block';
    Mishusoft.detectElement('PopUpDialogBoxTitle').innerHTML = 'Message';
    Mishusoft.detectElement('PopUpDialogBoxMessage').innerHTML = '<div style="font-size:15px;">Are you want to delete this?</div>';
    Mishusoft.detectElement('message-done-btn').innerHTML = 'Delete';

    let dataID = $(this).attr('data-id');
    let commandBtn = Mishusoft.detectElement('message-done-btn').innerHTML;

    $(document).on('click', '#message-done-btn', function () {
        if (commandBtn === 'Delete') {
            // Form fields, see IDs above
            let data = {
                security_code: 1,
                id: dataID
            };

            let ajax = new XMLHttpRequest();
            ajax.open("POST", _root_ + 'office/invoices/deleteSoldItem', true);
            ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
            ajax.send(JSON.stringify(data)); // Make sure to stringify
            //receiving response from ajax
            ajax.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    //show message with another method
                    Mishusoft.showMessage(this.responseText, Mishusoft.detectElement("message2"));
                }
            };
        }
        myApp.viewSoldItemsByInvId();
        Mishusoft.detectElement('PopUpDialogBox').style.display = 'none';
    });
});
//end of add to cart section

//search section

//reset inputbox by clicking reset button
$(document).on('click', '#invoice-search-btn', function () {
    Mishusoft.detectElement('message7').innerHTML = '';
    Mishusoft.detectElement('modal06').style.display = 'block';
    Mishusoft.detectElement('productdetailsEditMode').innerHTML = 'Add new';
    Mishusoft.detectElement('invoice-close-btn').innerHTML = 'Close';
    Mishusoft.detectElement('invoice-search-data-btn').innerHTML = 'Search';
    Mishusoft.detectElement('invoice-search-reset-btn').innerHTML = 'Reset';
    Mishusoft.detectElement('prd-detls-item').value = '';
    Mishusoft.detectElement('prd-detls-brand').value = '';
    Mishusoft.detectElement('modelNumber').value = '';
    Mishusoft.detectElement('serialNumber').value = '';
    Mishusoft.detectElement('unitPrice').value = '';
    Mishusoft.detectElement('warrantyTime').value = '';
});

//close popupbox
$(document).on('click', '#invoice-search-close-btn', function () {
    Mishusoft.detectElement('modal06').style.display = 'none';
});

$(document).on('change','#inv_srh_branch', function () {
    InvoiceManager.searchSpecificInvoice();
});
$(document).on('input','#inv_srh_inv_id', function () {
        let invElement = Mishusoft.detectElement('inv_srh_inv_id');
        let invNumber = invElement.value;
        if (invNumber === null || !Mishusoft.isNumber(invNumber)) {
            alert('Please enter valid invoice number.');
        } else {
            InvoiceManager.searchSpecificInvoice();
        }
});
$(document).on('input','#inv_srh_clnt_nm', function () {
        let ClntElement = Mishusoft.detectElement('inv_srh_clnt_nm');
        let ClntName = ClntElement.value;
        if (ClntName === '') {
            ClntElement.value = '';
            alert('Please write client name.');
        } else {
            InvoiceManager.searchSpecificInvoice();
        }
});

$(document).on('input','#inv_srh_clnt_nmbr', function () {
    let ClntMobileNumberElement = Mishusoft.detectElement('inv_srh_clnt_nmbr');
    let ClntMobileNumber = ClntMobileNumberElement.value;
    if (ClntMobileNumber === null || !Mishusoft.isNumber(ClntMobileNumber)) {
        ClntMobileNumberElement.value = '';
        alert('Please enter valid number.');
    } else {
        InvoiceManager.searchSpecificInvoice();
    }
});



/*end of search option*/


/*start of invoice section*/
//hide edit pad by default
if (Mishusoft.detectElement('invoiceEditMode')) {
    Mishusoft.detectElement('invoiceEditMode').innerHTML = 'New invoice';
    Mishusoft.detectElement('invoice-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('invoice-reset-btn').innerHTML = 'Reset';

    Mishusoft.detectElement('popup-invoice-print-btn').style.display = 'none';
    Mishusoft.detectElement('product_zone').style.display = 'none';
    Mishusoft.detectElement('ordered_product_zone').style.display = 'none';
}

//add data form by clicking add button
$(document).on('click', '#invoice-add-btn', function () {
    let invoiceBranchName = Mishusoft.detectElement('invoiceBranchName').value;
    let declareInvoiceBranchDescription = '[ ' + invoiceBranchName + ' ]';
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('invoiceEditMode').innerHTML = declareInvoiceBranchDescription + ' New Invoice';
    Mishusoft.detectElement('invoice-data-btn').style.display = 'block';
    Mishusoft.detectElement('invoice-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('popup-invoice-print-btn').style.display = 'none';
    Mishusoft.detectElement('invoiceID').value = '';
    Mishusoft.detectElement('clnt_fl_nm').value = '';
    Mishusoft.detectElement('clnt_cntct_nmbr').value = '';
    Mishusoft.detectElement('sls_mn').value = '';
    Mishusoft.detectElement('clnt_cntct_addrs').value = '';
    Mishusoft.detectElement('inv-prd-item').value = '';
    Mishusoft.detectElement('inv-prd-brand').value = '';
    Mishusoft.detectElement('inv-prd-modelNumber').value = '';
    Mishusoft.detectElement('inv-prd-serialNumber').value = '';
    Mishusoft.detectElement('inv-prd-warrantyTime').value = '';
    Mishusoft.detectElement('inv-prd-unitPrice').value = '';
    Mishusoft.detectElement('inv-prd-quantity').value = '';
    Mishusoft.detectElement('inv-prd-TotalPrice').value = '';
    Mishusoft.detectElement('product_zone').style.display = 'none';
    Mishusoft.detectElement('ordered_product_zone').style.display = 'none';
});


//save data by clicking data button
$(document).on('click', '#invoice-data-btn', function () {
    let data = '';
    let command = Mishusoft.detectElement('invoice-data-btn').innerHTML;

    if (command === 'Save') {
        // Form fields, see IDs above
        data = {
            security_code: 1,
            branch: Mishusoft.detectElement('invoiceBranchId').value,
            client: Mishusoft.detectElement('clnt_fl_nm').value,
            sls_mn: Mishusoft.detectElement('sls_mn').value,
            btnName: Mishusoft.detectElement('invoice-data-btn').innerHTML
        };
    } else if (command === 'Update') {
        // Form fields, see IDs above
        data = {
            security_code: 1,
            id: Mishusoft.detectElement('invoiceID').value,
            branch: Mishusoft.detectElement('invoiceBranchId').value,
            client: Mishusoft.detectElement('clnt_fl_nm').value,
            sls_mn: Mishusoft.detectElement('sls_mn').value,
            btnName: Mishusoft.detectElement('invoice-data-btn').innerHTML
        };
    } else if (command === 'Print') {
        InvoiceManager.printInvoice(Mishusoft.detectElement('invoiceID').value);
    }


    let ajax = new XMLHttpRequest();
    ajax.open("POST", _root_ + 'office/invoices/addInvoice', true);
    ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
    ajax.send(JSON.stringify(data)); // Make sure to stringify
    //receiving response from ajax
    ajax.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (Mishusoft.IsJsonString(this.responseText)) {
                // converting back to array
                let d = JSON.parse(this.responseText);
                let ElementId = Mishusoft.detectElement("message2");
                //html value for <body>
                let html = "";
                //looping through the data
                for (let a = 0; a < d.length; a++) {
                    let type = d[a].type;
                    let message = d[a].message;
                    let inv_id = d[a].inv_id;
                    let inv_sls_man = d[a].inv_sls_man;
                    let errClass = '';
                    let symbol = '';

                    if (type === "error") {
                        errClass += 'danger';
                        symbol += "&times;";
                    }
                    if (type === "success") {
                        errClass += 'success';
                        symbol += "&radic;";

                        let invoiceBranchName = Mishusoft.detectElement('invoiceBranchName').value;
                        let declareInvoiceBranchDescription = '[ ' + invoiceBranchName + ' ]';
                        Mishusoft.detectElement('invoiceEditMode').innerHTML = declareInvoiceBranchDescription + ' Invoice no:&nbsp;' + inv_id;
                        Mishusoft.detectElement('invoiceID').value = inv_id;
                        Mishusoft.detectElement('sls_mn').value = 'You (' + inv_sls_man + ')';
                        Mishusoft.detectElement('invoice-data-btn').style.display = 'none';
                        Mishusoft.detectElement('popup-invoice-print-btn').style.display = 'block';
                        Mishusoft.createAttributeWithValue('popup-invoice-print-btn', 'data-id', inv_id);
                        Mishusoft.detectElement('product_zone').style.display = 'block';
                        Mishusoft.detectElement('ordered_product_zone').style.display = 'block';
                        myApp.viewBrandsForProductDetails();
                        Mishusoft.detectElement('cart-add-btn').innerHTML = '<i class="fas fa-plus-circle"></i>&nbsp;Add&nbsp;to&nbsp;Cart';

                    }

                    //appending at html
                    html += '<div class="box-message box-' + errClass + ' box-shadow-light">';
                    html += '<span class="box-' + errClass + '-symbol">' + symbol + '</span>';
                    html += '&nbsp;&nbsp;' + message + '';
                    html += '</div>';

                    if (ElementId) {
                        ElementId.innerHTML = html;
                        myApp.viewSoldItemsByInvId();
                        InvoiceManager.manageBillMoney('create', 0);
                    }
                }
            } else {
                alert(this.responseText);
            }
        }
    };
});


//reset inputbox by clicking reset button
$(document).on('click', '#invoice-reset-btn', function () {
    let invoiceBranchName = Mishusoft.detectElement('invoiceBranchName').value;
    let declareInvoiceBranchDescription = '[ ' + invoiceBranchName + ' ]';
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('invoiceEditMode').innerHTML = declareInvoiceBranchDescription + ' New Invoice';
    Mishusoft.detectElement('invoice-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('invoiceID').value = '';
    Mishusoft.detectElement('clnt_fl_nm').value = '';
    Mishusoft.detectElement('clnt_cntct_nmbr').value = '';
    Mishusoft.detectElement('clnt_cntct_addrs').value = '';
    Mishusoft.detectElement('inv-prd-item').value = '';
    Mishusoft.detectElement('inv-prd-brand').value = '';
    Mishusoft.detectElement('inv-prd-modelNumber').value = '';
    Mishusoft.detectElement('inv-prd-serialNumber').value = '';
    Mishusoft.detectElement('inv-prd-warrantyTime').value = '';
    Mishusoft.detectElement('inv-prd-unitPrice').value = '';
    Mishusoft.detectElement('inv-prd-quantity').value = '';
    Mishusoft.detectElement('inv-prd-TotalPrice').value = '';
});

//close popupbox
$(document).on('click', '#invoice-close-btn', function () {
    Mishusoft.detectElement('modal01').style.display = 'none';
});
//print invoice
$(document).on('click', '#popup-invoice-print-btn', function () {
    InvoiceManager.printInvoice($(this).attr('data-id'));
});
//print invoice
$(document).on('click', '#invoice-print-btn', function () {
    InvoiceManager.printInvoice($(this).attr('data-id'));
});
//print page
$(document).on('click', '#print-btn', function () {
    Mishusoft.detectElement('cmd-btn-area').style.display = 'none';
    window.print();
    window.close();
});
//close page
$(document).on('click', '#close-btn', function () {
    window.close();
});


//select data by clicking select button
$(document).on('click', '#invoice-select', function () {
    if (this.checked) {
        let invoiceBranchName = Mishusoft.detectElement('invoiceBranchName').value;
        let declareInvoiceBranchDescription = '[ ' + invoiceBranchName + ' ]';
        Mishusoft.detectElement('message2').innerHTML = '';
        Mishusoft.detectElement('modal01').style.display = 'block';
        Mishusoft.detectElement('invoiceEditMode').innerHTML = declareInvoiceBranchDescription + ' Invoice no: ' + $(this).attr('data-id');
        Mishusoft.detectElement('invoice-data-btn').innerHTML = 'Update';
        Mishusoft.detectElement('invoiceID').value = $(this).attr('data-id');
        Mishusoft.detectElement('clnt_fl_nm').value = $(this).attr('data-clntFlNm');
        Mishusoft.detectElement('clnt_cntct_nmbr').value = $(this).attr('data-clntCntctNmbr');
        Mishusoft.detectElement('clnt_cntct_addrs').value = $(this).attr('data-clientAddress');
        Mishusoft.detectElement('sls_mn').value = $(this).attr('data-slsMn');
        Mishusoft.detectElement('inv-prd-item').value = '';
        Mishusoft.detectElement('inv-prd-brand').value = '';
        Mishusoft.detectElement('inv-prd-modelNumber').value = '';
        Mishusoft.detectElement('inv-prd-serialNumber').value = '';
        Mishusoft.detectElement('inv-prd-warrantyTime').value = '';
        Mishusoft.detectElement('inv-prd-unitPrice').value = '';
        Mishusoft.detectElement('inv-prd-quantity').value = '';
        Mishusoft.detectElement('inv-prd-TotalPrice').value = '';

        Mishusoft.detectElement('popup-invoice-print-btn').style.display = 'block';
        Mishusoft.detectElement('product_zone').style.display = 'block';
        Mishusoft.detectElement('ordered_product_zone').style.display = 'block';

        myApp.viewSoldItemsByInvId();
    }
});
//edit data by clicking edit button
$(document).on('click', '#invoice-edit-btn', function () {
    let invoiceBranchName = Mishusoft.detectElement('invoiceBranchName').value;
    let declareInvoiceBranchDescription = '[ ' + invoiceBranchName + ' ]';
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('invoiceEditMode').innerHTML = declareInvoiceBranchDescription + ' Invoice no: ' + $(this).attr('data-id');
    Mishusoft.detectElement('invoice-data-btn').innerHTML = 'Update';
    Mishusoft.detectElement('invoiceID').value = $(this).attr('data-id');
    Mishusoft.detectElement('clnt_fl_nm').value = $(this).attr('data-clntFlNm');
    Mishusoft.detectElement('clnt_cntct_nmbr').value = $(this).attr('data-clntCntctNmbr');
    Mishusoft.detectElement('clnt_cntct_addrs').value = $(this).attr('data-clientAddress');
    Mishusoft.detectElement('sls_mn').value = $(this).attr('data-slsMn');
    Mishusoft.detectElement('inv-prd-item').value = '';
    Mishusoft.detectElement('inv-prd-brand').value = '';
    Mishusoft.detectElement('inv-prd-modelNumber').value = '';
    Mishusoft.detectElement('inv-prd-serialNumber').value = '';
    Mishusoft.detectElement('inv-prd-warrantyTime').value = '';
    Mishusoft.detectElement('inv-prd-unitPrice').value = '';
    Mishusoft.detectElement('inv-prd-quantity').value = '';
    Mishusoft.detectElement('inv-prd-TotalPrice').value = '';

    Mishusoft.detectElement('popup-invoice-print-btn').style.display = 'block';

    Mishusoft.createAttributeWithValue('popup-invoice-print-btn', 'data-id', $(this).attr('data-id'));
    Mishusoft.detectElement('product_zone').style.display = 'block';
    Mishusoft.detectElement('ordered_product_zone').style.display = 'block';
    Mishusoft.detectElement('cart-add-btn').innerHTML = '<i class="fas fa-plus-circle"></i>&nbsp;Add&nbsp;to&nbsp;Cart';
    Mishusoft.detectElement('cart-reset-btn').innerHTML = 'Reset';

    myApp.viewSoldItemsByInvId();
});


//delete data by clicking delete button

/*$(document).on('click', '#item-delete-btn',
    Mishusoft.PopUpDialogBox( 'Message', '<div style="font-size:15px;">Are you want to delete this?</div>',
        Mishusoft.detectElement('item-delete-btn'), 'Delete', 'items/deleteItem'));*/

$(document).on('click', '#invoice-delete-btn', function () {
    Mishusoft.detectElement('PopUpDialogBox').style.display = 'block';
    Mishusoft.detectElement('PopUpDialogBoxTitle').innerHTML = 'Message';
    Mishusoft.detectElement('PopUpDialogBoxMessage').innerHTML = '<div style="font-size:15px;">Are you want to delete this?</div>';
    Mishusoft.detectElement('message-done-btn').innerHTML = 'Delete';

    let dataID = $(this).attr('data-id');
    let commandBtn = Mishusoft.detectElement('message-done-btn').innerHTML;

    $(document).on('click', '#message-done-btn', function () {
        if (commandBtn === 'Delete') {
            // Form fields, see IDs above
            let data = {
                security_code: 1,
                id: dataID
            };

            let ajax = new XMLHttpRequest();
            ajax.open("POST", _root_ + 'office/invoices/deleteInvoice', true);
            ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
            ajax.send(JSON.stringify(data)); // Make sure to stringify
            //receiving response from ajax
            ajax.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    //show message with another method
                    Mishusoft.showMessage(this.responseText, Mishusoft.detectElement("message"));
                }
            };
        }

        Mishusoft.detectElement('PopUpDialogBox').style.display = 'none';
    });
});


/*end of product details section of app manager*/