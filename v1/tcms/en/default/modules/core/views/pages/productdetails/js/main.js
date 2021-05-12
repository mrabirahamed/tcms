/* global Mishusoft, _root_ */

class ProductDetailsManager extends Mishusoft {
    constructor() {
        super();
        this.AllAvailableItemsURL = this.AppHostAddress + 'items/getAvailableItemsOrderByName';
        this.AllBrandsURL = this.AppHostAddress + 'brands/getBrandsOrderByName';
        this.viewItemsForProductDetails();
        this.viewBrandsForProductDetails();
    }


    viewItemsForProductDetails() {
        this.ajax = new XMLHttpRequest();
        this.ajax.open(this.method, this.AllAvailableItemsURL, this.asynchronous);
        this.ajax.send();

        //receiving response from ajax
        this.ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                /*converting back to array*/
                this.data = JSON.parse(this.responseText);
                //replaceing previous data
                this.htmlpad = Mishusoft.detectElement('prd-detls-item');
                //html value for <body>
                this.html = '';
                this.html += '<option value=""> -- Select One --</option>';
                this.html += '<option value="addNew" id="item-add-btn"> New Item </option>';

                if (this.data.length !== 0) {
                    //looping through the data
                    for (let a = 0; a < this.data.length; a++) {
                        this.id = this.data[a].id;
                        this.name = this.data[a].name;
                        //appeding at html
                        this.html += '<option value="' + this.id + '">' + this.name + '</option>';

                        if (this.htmlpad) {
                            this.htmlpad.innerHTML = this.html;
                        }
                    }
                }
            }
        };
    }
    ;

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
                        //appeding at html
                        this.html += '<option value="' + this.id + '">' + this.name + '</option>';

                        if (this.htmlpad) {
                            this.htmlpad.innerHTML = this.html;
                        }
                    }
                }
            }
        };
    }
    ;

    saveItem() {
        let data = '';
        let command = Mishusoft.detectElement('item-data-btn').innerHTML;

        if (command === 'Save') {
            // Form fields, see IDs above
            data = {
                security_code: 1,
                name: Mishusoft.detectElement('itemName').value,
                cStatus: Mishusoft.detectElement('current_status').value,
                btnName: Mishusoft.detectElement('item-data-btn').innerHTML
            };
        }

        let ajax = new XMLHttpRequest();
        ajax.open("POST", _root_ + 'items/addItem', true);
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
    ;

    saveBrand() {
        let data = '';
        let command = Mishusoft.detectElement('brand-data-btn').innerHTML;

        if (command === 'Save') {
            // Form fields, see IDs above
            data = {
                security_code: 1,
                name:  Mishusoft.detectElement('brandName').value,
                btnName: Mishusoft.detectElement('brand-data-btn').innerHTML
            };
        }

        let ajax = new XMLHttpRequest();
        ajax.open("POST", _root_ + 'brands/addBrand', true);
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
    ;

    saveProductDetails() {
        let data = '';
        let command = Mishusoft.detectElement('productdetails-data-btn').innerHTML;

        if (command === 'Save') {
            // Form fields, see IDs above
            data = {
                security_code: 1,
                item: Mishusoft.detectElement('prd-detls-item').value,
                brand: Mishusoft.detectElement('prd-detls-brand').value,
                modelNumber: Mishusoft.detectElement('modelNumber').value,
                serialNumber: Mishusoft.detectElement('serialNumber').value,
                unitPrice: Mishusoft.detectElement('unitPrice').value,
                warrantyTime: Mishusoft.detectElement('warrantyTime').value,
                ability: Mishusoft.detectElement('ability').value,
                btnName: Mishusoft.detectElement('productdetails-data-btn').innerHTML
            };
        } else {
            // Form fields, see IDs above
            data = {
                security_code: 1,
                id: Mishusoft.detectElement('productdetailsID').value,
                item: Mishusoft.detectElement('prd-detls-item').value,
                brand: Mishusoft.detectElement('prd-detls-brand').value,
                modelNumber: Mishusoft.detectElement('modelNumber').value,
                serialNumber: Mishusoft.detectElement('serialNumber').value,
                unitPrice: Mishusoft.detectElement('unitPrice').value,
                warrantyTime: Mishusoft.detectElement('warrantyTime').value,
                ability: Mishusoft.detectElement('ability').value,
                btnName: Mishusoft.detectElement('productdetails-data-btn').innerHTML
            };
        }

        let ajax = new XMLHttpRequest();
        ajax.open("POST", _root_ + 'productdetails/addProductDetail', true);
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
    ;
    // --------------------------------------------------

}

let myApp = new ProductDetailsManager();

$('#productdetails-data-table').on('click', '.page', function () {
    let url = 'productdetails/productDetailsPaginationAJAX';
    Mishusoft.pagination($(this).attr('page'), url, 'productdetails-data-table');
});


/*start of item section*/
//hide edit pad by default
if (Mishusoft.detectElement('itemEditMode')) {
    Mishusoft.detectElement('itemEditMode').innerHTML = 'New';
    Mishusoft.detectElement('item-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('item-reset-btn').innerHTML = 'Reset';
}
//add data form by clicking add button
$(document).on('change', '#prd-detls-item', function () {
    if (Mishusoft.detectElement('prd-detls-item').value === 'addNew') {
        Mishusoft.detectElement('message3').innerHTML = '';
        Mishusoft.detectElement('modal02').style.display = 'block';
        Mishusoft.detectElement('itemEditMode').innerHTML = 'New';
        Mishusoft.detectElement('item-data-btn').innerHTML = 'Save';
        Mishusoft.detectElement('itemName').value = '';
        Mishusoft.detectElement('current_status').value = ''
    }
});
//check new item name ability.
$(document).on('keyup', '#itemName', function () {
    let checkItemNameAbilityURL = _root_ + "items/checkItemNameAbility";
    let value = Mishusoft.detectElement("itemName").value;
    let htmlpad = Mishusoft.detectElement("message3");

    return Mishusoft.checkInputDataAbility(checkItemNameAbilityURL, value, htmlpad);
});
//save data by clicking data button
$(document).on('click', '#item-data-btn', myApp.saveItem);

//reset inputbox by clicking reset button
$(document).on('click', '#item-reset-btn', function () {
    Mishusoft.detectElement('itemID').value = '';
    Mishusoft.detectElement('itemName').value = '';
    Mishusoft.detectElement('current_status').value = '';
});
//close inputbox by clicking cancel button
$(document).on('click', '#item-close-btn', function () {
    Mishusoft.detectElement('modal02').style.display = 'none'
    Mishusoft.detectElement('prd-detls-item').value = '';
    myApp.viewItemsForProductDetails();
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
$(document).on('change', '#prd-detls-brand', function () {
    if (Mishusoft.detectElement('prd-detls-brand').value === 'addNew') {
        Mishusoft.detectElement('message4').innerHTML = '';
        Mishusoft.detectElement('modal03').style.display = 'block';
        Mishusoft.detectElement('brandEditMode').innerHTML = 'New';
        Mishusoft.detectElement('brand-data-btn').innerHTML = 'Save';
        Mishusoft.detectElement('brandName').value = '';
    }
});
//set textbox value change dynamic after dropbox had changed.
$(document).on('keyup', '#brandName', function () {
    let checkBrandNameAbilityURL = _root_ + "brands/checkBrandNameAbility";
    let value = Mishusoft.detectElement("brandName").value;
    let htmlpad = Mishusoft.detectElement("message4");

    return Mishusoft.checkInputDataAbility(checkBrandNameAbilityURL, value, htmlpad);
});
//save data by clicking data button
$(document).on('click', '#brand-data-btn', myApp.saveBrand);
//reset inputbox by clicking reset button
$(document).on('click', '#brand-reset-btn', function () {
    Mishusoft.detectElement('brandID').value = '';
    Mishusoft.detectElement('brandName').value = '';
});
//close inputbox by clicking cancel button
$(document).on('click', '#brand-close-btn', function () {
    Mishusoft.detectElement('modal03').style.display = 'none'
    Mishusoft.detectElement('prd-detls-brand').value = '';
    myApp.viewBrandsForProductDetails();
});


/*start of Product Details section*/
//hide edit pad by default
if (Mishusoft.detectElement('productdetailsEditMode')) {
    Mishusoft.detectElement('productdetailsEditMode').innerHTML = 'New';
    Mishusoft.detectElement('productdetails-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('productdetails-reset-btn').innerHTML = 'Reset';
}


//add data form by clicking add button
$(document).on('click', '#productdetails-add-btn', function () {
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('productdetailsEditMode').innerHTML = 'New';
    Mishusoft.detectElement('productdetails-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('productdetailsID').value = '';
    Mishusoft.detectElement('prd-detls-item').value = '';
    Mishusoft.detectElement('prd-detls-brand').value = '';
    Mishusoft.detectElement('modelNumber').value = '';
    Mishusoft.detectElement('serialNumber').value = '';
    Mishusoft.detectElement('unitPrice').value = '';
    Mishusoft.detectElement('warrantyTime').value = '';
    Mishusoft.detectElement('ability').value = '';
});

//save data by clicking data button
$(document).on('click', '#productdetails-data-btn', myApp.saveProductDetails);
//reset inputbox by clicking reset button
$(document).on('click', '#productdetails-reset-btn', function () {
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('productdetailsEditMode').innerHTML = 'Add new';
    Mishusoft.detectElement('productdetails-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('productdetailsID').value = '';
    Mishusoft.detectElement('prd-detls-item').value = '';
    Mishusoft.detectElement('prd-detls-brand').value = '';
    Mishusoft.detectElement('modelNumber').value = '';
    Mishusoft.detectElement('serialNumber').value = '';
    Mishusoft.detectElement('unitPrice').value = '';
    Mishusoft.detectElement('warrantyTime').value = '';
    Mishusoft.detectElement('ability').value = '';
});
//select data by clicking select button
$(document).on('click', '#productdetails-select', function () {
    if (this.checked) {
        Mishusoft.detectElement('message2').innerHTML = '';
        Mishusoft.detectElement('modal01').style.display = 'block';
        Mishusoft.detectElement('productdetailsEditMode').innerHTML = 'Edit';
        Mishusoft.detectElement('productdetails-data-btn').innerHTML = 'Update';
        Mishusoft.detectElement('productdetailsID').value = $(this).attr('data-id');
        Mishusoft.detectElement('prd-detls-item').value = $(this).attr('data-prd-detls-item');
        Mishusoft.detectElement('prd-detls-brand').value = $(this).attr('data-prd-detls-brand');
        Mishusoft.detectElement('modelNumber').value = $(this).attr('data-modelNumber');
        Mishusoft.detectElement('serialNumber').value = $(this).attr('data-serialNumber');
        Mishusoft.detectElement('unitPrice').value = $(this).attr('data-unitPrice');
        Mishusoft.detectElement('warrantyTime').value = $(this).attr('data-warrantyTime');
        Mishusoft.detectElement('ability').value = $(this).attr('data-ability');
    }
});
//edit data by clicking edit button
$(document).on('click', '#productdetails-edit-btn', function () {
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('productdetailsEditMode').innerHTML = 'Edit';
    Mishusoft.detectElement('productdetails-data-btn').innerHTML = 'Update';
    Mishusoft.detectElement('productdetailsID').value = $(this).attr('data-id');
    Mishusoft.detectElement('prd-detls-item').value = $(this).attr('data-prd-detls-item');
    Mishusoft.detectElement('prd-detls-brand').value = $(this).attr('data-prd-detls-brand');
    Mishusoft.detectElement('modelNumber').value = $(this).attr('data-modelNumber');
    Mishusoft.detectElement('serialNumber').value = $(this).attr('data-serialNumber');
    Mishusoft.detectElement('unitPrice').value = $(this).attr('data-unitPrice');
    Mishusoft.detectElement('warrantyTime').value = $(this).attr('data-warrantyTime');
    Mishusoft.detectElement('ability').value = $(this).attr('data-ability');
});

// change ability by clicking this button
$(document).on('click', '#changeProductDetailAbility', function () {
    Mishusoft.detectElement('PopUpDialogBox').style.display = 'block';
    Mishusoft.detectElement('PopUpDialogBoxTitle').innerHTML = 'Message';
    Mishusoft.detectElement('message5').innerHTML = '<div style="font-size:15px;">Are you want to change this?</div>';
    Mishusoft.detectElement('message-done-btn').innerHTML = 'Change';

    let dataID = $(this).attr('data-id');
    let current_status = $(this).attr('data-curent_status');
    let commandBtn = Mishusoft.detectElement('message-done-btn').innerHTML;

    $(document).on('click', '#message-done-btn', function () {
        if (commandBtn === 'Change') {

            // Form fields, see IDs above
            let newAbility;
            if (current_status === 'available') {
                newAbility = 'unavailable'
            }
            else if (current_status === 'unavailable') {
                newAbility = 'available'
            }
            else {
                alert('Ability Not Found..');
            }

            // Form fields, see IDs above
            let data = {
                security_code: 1,
                id: dataID,
                current_status: current_status,
                newAbility: newAbility
            };

            let ajax = new XMLHttpRequest();
            ajax.open("POST", _root_ + 'productdetails/ChangeProductAbility', true);
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


//delete data by clicking delete button

$(document).on('click', '#productdetails-delete-btn', function () {
    Mishusoft.detectElement('PopUpDialogBox').style.display = 'block';
    Mishusoft.detectElement('PopUpDialogBoxTitle').innerHTML = 'Message';
    Mishusoft.detectElement('message5').innerHTML = '<div style="font-size:15px;">Are you want to delete this?</div>';
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
            ajax.open("POST", _root_ + 'productdetails/deleteProductDetail', true);
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

