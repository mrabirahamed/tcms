/* global Mishusoft, _root_ */

class ClientsManager extends Mishusoft {
    constructor() {
        super();
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
        } else {
            // Form fields, see IDs above
            data = {
                security_code: 1,
                id: Mishusoft.detectElement('clientsID').value,
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
                Mishusoft.showMessage(this.responseText, Mishusoft.detectElement("message2"));
            }
        };
    }
    ;

    // --------------------------------------------------

}

let myApp = new ClientsManager();


$('#clients-data-table').on('click', '.page', function () {
    let url = 'office/clients/clientsPaginationAJAX';
    Mishusoft.pagination($(this).attr('page'), url, 'clients-data-table');
});


/*start of clients section*/
//hide edit pad by default
if (Mishusoft.detectElement('clientsEditMode')) {
    Mishusoft.detectElement('clientsEditMode').innerHTML = 'New';
    Mishusoft.detectElement('clients-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('clients-reset-btn').innerHTML = 'Reset';
}
//set textbox value change dynamic after dropbox had changed.
$(document).on('keyup', '#fl_nm', function () {
    let checkClientsNameInputAbilityURL = _root_ + "office/clients/checkClientsNameInputAbility";
    let value = Mishusoft.detectElement("fl_nm").value;
    let htmlpad = Mishusoft.detectElement("message2");

    return Mishusoft.checkInputDataAbility(checkClientsNameInputAbilityURL, value, htmlpad);
});
//add data form by clicking add button
$(document).on('click', '#clients-add-btn', function () {
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('clientsEditMode').innerHTML = 'New';
    Mishusoft.detectElement('clients-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('fl_nm').value = '';
    Mishusoft.detectElement('cntct_nmbr').value = '';
    Mishusoft.detectElement('cntct_addrs').value = '';
});

//save data by clicking data button
$(document).on('click', '#clients-data-btn', myApp.saveClients);

//edit data by clicking edit button
$(document).on('click', '#clients-edit-btn', function () {
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('clientsEditMode').innerHTML = 'Edit';
    Mishusoft.detectElement('clients-data-btn').innerHTML = 'Update';
    Mishusoft.detectElement('clientsID').value = $(this).attr('data-id');
    Mishusoft.detectElement('fl_nm').value = $(this).attr('data-name');
    Mishusoft.detectElement('cntct_nmbr').value = $(this).attr('data-mobile-number');
    Mishusoft.detectElement('cntct_addrs').value = $(this).attr('data-address');
});

//reset inputbox by clicking reset button
$(document).on('click', '#clients-reset-btn', function () {
    Mishusoft.detectElement('clientsID').value = '';
    Mishusoft.detectElement('fl_nm').value = '';
    Mishusoft.detectElement('cntct_nmbr').value = '';
    Mishusoft.detectElement('cntct_addrs').value = '';
});
//close popupbox
$(document).on('click', '#clients-close-btn', function () {
    Mishusoft.detectElement('clientsID').value = '';
    Mishusoft.detectElement('fl_nm').value = '';
    Mishusoft.detectElement('cntct_nmbr').value = '';
    Mishusoft.detectElement('cntct_addrs').value = '';
    Mishusoft.detectElement('modal01').style.display = 'none';
    myApp.viewClients();
});

//delete data by clicking delete button

$(document).on('click', '#clients-delete-btn', function () {
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
            ajax.open("POST", _root_ + 'office/clients/deleteClient', true);
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
        myApp.viewClients();
    });
});

// end of  clients section of app manager*/