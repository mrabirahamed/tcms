/* global Mishusoft, _root_ */

class BrandsManager extends Mishusoft {
    constructor() {
        super();
    }

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
        } else {
            // Form fields, see IDs above
            data = {
                security_code: 1,
                id: Mishusoft.detectElement('brandID').value,
                name: Mishusoft.detectElement('brandName').value,
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
                Mishusoft.showMessage(this.responseText, Mishusoft.detectElement("message2"));
            }
        };
    }
    ;

}

let myApp = new BrandsManager();

$('#brands-data-table').on('click', '.page', function () {
    let url = 'brands/brandsPaginationAJAX';
    Mishusoft.pagination($(this).attr('page'), url, 'brands-data-table');
});

/*start of brand section*/
//hide edit pad by default
if (Mishusoft.detectElement('brandEditMode')) {
    Mishusoft.detectElement('brandEditMode').innerHTML = 'Add new';
    Mishusoft.detectElement('brand-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('brand-reset-btn').innerHTML = 'Reset';
}

//set textbox value change dynamic after dropbox had changed.
$(document).on('keyup', '#brandName', function () {
    let checkBrandNameAbilityURL = _root_ + "brands/checkBrandNameAbility";
    let value = Mishusoft.detectElement("brandName").value;
    let htmlpad = Mishusoft.detectElement("message2");

    return Mishusoft.checkInputDataAbility(checkBrandNameAbilityURL, value, htmlpad);
});

//save data by clicking data button
$(document).on('click', '#brand-data-btn', myApp.saveBrand);
//reset inputbox by clicking reset button
$(document).on('click', '#brand-reset-btn', function () {
    Mishusoft.detectElement('brandID').value = '';
    Mishusoft.detectElement('brandName').value = '';
});


//add data form by clicking add button
$(document).on('click', '#brand-add-btn', function () {
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('brandEditMode').innerHTML = 'Add new';
    Mishusoft.detectElement('brand-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('brandID').value = '';
    Mishusoft.detectElement('brandName').value = '';
});
//select data by clicking select button
$(document).on('click', '#brand-select', function () {
    if (this.checked) {
        Mishusoft.detectElement('message2').innerHTML = '';
        Mishusoft.detectElement('modal01').style.display = 'block';
        Mishusoft.detectElement('brandEditMode').innerHTML = 'Edit';
        Mishusoft.detectElement('brand-data-btn').innerHTML = 'Update';
        Mishusoft.detectElement('brandID').value = $(this).attr('data-id');
        Mishusoft.detectElement('brandName').value = $(this).attr('data-name');
    }
});
//edit data by clicking edit button
$(document).on('click', '#brand-edit-btn', function () {
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('brandEditMode').innerHTML = 'Edit';
    Mishusoft.detectElement('brand-data-btn').innerHTML = 'Update';
    Mishusoft.detectElement('brandID').value = $(this).attr('data-id');
    Mishusoft.detectElement('brandName').value = $(this).attr('data-name');
});
//delete data by clicking delete button

$(document).on('click', '#brand-delete-btn', function () {
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
            ajax.open("POST", _root_ + 'brands/deleteBrand', true);
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

/*end of brand section of app manager*/

