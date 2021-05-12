/* global Mishusoft, _root_ */

class ItemsManager extends Mishusoft {
    constructor() {
        super();
    }

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
        } else {
            // Form fields, see IDs above
            data = {
                security_code: 1,
                id: Mishusoft.detectElement('itemID').value,
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
                Mishusoft.showMessage(this.responseText, Mishusoft.detectElement("message2"));
            }
        };
    }
    ;

    // --------------------------------------------------

}

let myApp = new ItemsManager();

$('#item-data-table').on('click', '.page', function () {
    let url = 'office/items/itemsPaginationAJAX';
    Mishusoft.pagination($(this).attr('page'), url, 'item-data-table');
});

/*start of item section*/
//hide edit pad by default
if (Mishusoft.detectElement('itemEditMode')) {
    Mishusoft.detectElement('itemEditMode').innerHTML = 'Add new';
    Mishusoft.detectElement('item-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('item-reset-btn').innerHTML = 'Reset';
}

//set textbox value change dynamic after dropbox had changed.
$(document).on('keyup', '#itemName', function () {
    let checkItemNameAbilityURL = _root_ + "office/items/checkItemNameAbility";
    let value = Mishusoft.detectElement("itemName").value;
    let htmlpad = Mishusoft.detectElement("message2");

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
//add data form by clicking add button
$(document).on('click', '#item-add-btn', function () {
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('itemEditMode').innerHTML = 'Add new';
    Mishusoft.detectElement('item-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('itemID').value = '';
    Mishusoft.detectElement('itemName').value = '';
    Mishusoft.detectElement('current_status').value = ''
});
//select data by clicking select button
$(document).on('click', '#item-select', function () {
    if (this.checked) {
        Mishusoft.detectElement('message2').innerHTML = '';
        Mishusoft.detectElement('modal01').style.display = 'block';
        Mishusoft.detectElement('itemEditMode').innerHTML = 'Edit';
        Mishusoft.detectElement('item-data-btn').innerHTML = 'Update';
        Mishusoft.detectElement('itemID').value = $(this).attr('data-id');
        Mishusoft.detectElement('itemName').value = $(this).attr('data-name');
        Mishusoft.detectElement('current_status').value = $(this).attr('data-c_status');
    }
});
//edit data by clicking edit button
$(document).on('click', '#item-edit-btn', function () {
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('itemEditMode').innerHTML = 'Edit';
    Mishusoft.detectElement('item-data-btn').innerHTML = 'Update';
    Mishusoft.detectElement('itemID').value = $(this).attr('data-id');
    Mishusoft.detectElement('itemName').value = $(this).attr('data-name');
    Mishusoft.detectElement('current_status').value = $(this).attr('data-c_status');
});

// change ability by clicking this button
$(document).on('click', '#changeItemAbility', function () {
    Mishusoft.detectElement('PopUpDialogBox').style.display = 'block';
    Mishusoft.detectElement('PopUpDialogBoxTitle').innerHTML = 'Message';
    Mishusoft.detectElement('message3').innerHTML = '<div style="font-size:15px;">Are you want to change this?</div>';
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
            } else if (current_status === 'unavailable') {
                newAbility = 'available'
            } else {
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
            ajax.open("POST", _root_ + 'office/items/ChangeProductAbility', true);
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

/*$(document).on('click', '#item-delete-btn',
    Mishusoft.PopUpDialogBox( 'Message', '<div style="font-size:15px;">Are you want to delete this?</div>',
        Mishusoft.detectElement('item-delete-btn'), 'Delete', 'items/deleteItem'));*/

$(document).on('click', '#item-delete-btn', function () {
    Mishusoft.detectElement('PopUpDialogBox').style.display = 'block';
    Mishusoft.detectElement('PopUpDialogBoxTitle').innerHTML = 'Message';
    Mishusoft.detectElement('message3').innerHTML = '<div style="font-size:15px;">Are you want to delete this?</div>';
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
            ajax.open("POST", _root_ + 'office/items/deleteItem', true);
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

/*end of app section of app manager*/

