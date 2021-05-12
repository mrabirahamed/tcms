/* global Mishusoft, _root_ */

class AppManager extends Mishusoft {
    constructor() {
        super();;
        this.permissionsURL = this.AppHostAddress + 'appmanager/getPermissions';
        this.permissionsAllURL = this.AppHostAddress + 'appmanager/getPermissionsAll';
        this.rolesURL = this.AppHostAddress + 'appmanager/getRoles';
        this.adminMenuURL = this.AppHostAddress + "appmanager/getAdminMenus";

        this.viewAdminMenus();
        this.viewPermissions();
        this.viewRoles();
    }

    /* -- start -- make data update with interval*/
    updateDATA() {
        let self = this;
        this.dataInterval = setInterval(function () {
            self.viewAdminMenus();
            self.viewPermissions();
            self.viewRoles();
            console.clear();
        }, 5000);
    }
    ;

    /* -- end -- make data update with interval*/

    viewAdminMenus() {
        this.ajaxAM = new XMLHttpRequest();
        this.ajaxAM.open(this.method, this.adminMenuURL, this.asynchronous);
        this.ajaxAM.send();

        //receiving response from ajax
        this.ajaxAM.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                //alert(this.responseText);
                /*converting back to array*/
                this.data = JSON.parse(this.responseText);
                //replaceing previous data
                this.htmlpad = Mishusoft.detectElement("adminMenus");

                //html value for <body>
                this.html = '';

                if (this.data.length !== 0) {
                    //looping through the data
                    for (this.a = 0; this.a < this.data.length; this.a++) {
                        this.name = this.data[this.a].am_name;
                        this.title = this.data[this.a].am_title;
                        this.url = this.data[this.a].am_url;
                        this.icon = this.data[this.a].am_icon;

                        //appeding at html
                        this.html += '<a href="' + _root_ + 'appManager/' + this.url + '" class="thumbnail box-shadow-light" title="' + this.title + '">';
                        this.html += '<div class="thumbnail-image"><i class="' + this.icon + '"></i></div>';
                        this.html += '<div class="thumbnail-text">' + this.name + '</div>';
                        this.html += '</a>';

                        if (this.htmlpad) {
                            this.htmlpad.innerHTML = this.html;
                        }
                    }
                } else {
                    //appeding at html
                    this.html += '<div class="thumbnail box-shadow-light" style="padding: 45px 25px;">';
                    this.html += 'No tool exists.';
                    this.html += '</div>';

                    if (this.htmlpad) {
                        this.htmlpad.innerHTML = this.html;
                    }
                }
            }
        };
    }
    ;

    // --------------------------------------------------
    // Permission

    viewPermissions() {
        this.ajax = new XMLHttpRequest();
        this.ajax.open(this.method, this.permissionsURL, this.asynchronous);
        this.ajax.send();

        //receiving response from ajax
        this.ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                /*converting back to array*/
                this.data = JSON.parse(this.responseText);
                //replaceing previous data
                this.htmlpad = Mishusoft.detectElement('permissions-data');
                //html value for <body>
                this.html = '';

                if (this.data.length !== 0) {
                    //looping through the data
                    for (let a = 0; a < this.data.length; a++) {
                        this.id = this.data[a].id_permission;
                        this.name = this.data[a].permission;
                        this.key = this.data[a].key;
                        this.pkid = this.data[a].PKID;

                        //appeding at html
                        this.html += '<tr>';
                        this.html += '<td class="text-align-center">';
                        this.html += '<label><input type="checkbox" id="permission-select" class="check_box" data-permissionID="' + this.id + '" data-permissionName="' +
                            this.name + '" data-permissionKey="' + this.key + '" data-permissionPKID="' + this.pkid + '"/></label></td>';
                        this.html += '<td class="text-align-center">' + this.id + '</td>';
                        this.html += '<td class="text-align-left">' + this.name + '</td>';
                        this.html += '<td class="text-align-left">' + this.key + '</td>';
                        this.html += '<td class="text-align-center">' + this.pkid + '</td>';
                        this.html += '<td class="text-align-center">';
                        this.html += '<a href="javascript:void(0);" id="permission-edit-btn" class="button button-xs button-success" data-permissionID="' + this.id + '" data-permissionName="' +
                            this.name + '" data-permissionKey="' + this.key + '" data-permissionPKID="' + this.pkid + '"> <i class="far fa-edit"></i></a>&nbsp;&nbsp;';
                        this.html += '<a href="javascript:void(0);" id="permission-delete-btn" class="button button-xs button-danger" data-permissionID="' + this.id + '"><i class="far fa-trash-alt"></i></a>';
                        this.html += '</td>';
                        this.html += '</tr>';

                        if (this.htmlpad) {
                            this.htmlpad.innerHTML = this.html;
                        }
                    }
                } else {
                    //appeding at html
                    this.html += '<tr>';
                    this.html += '<td class="text-align-center" colspan="6">No permission exists.</td>';
                    this.html += '</tr>';

                    if (this.htmlpad) {
                        this.htmlpad.innerHTML = this.html;
                    }
                }
            }
        };
    }
    ;

    savePermission() {
        let params = '';
        let command = Mishusoft.detectElement('permission-data-btn').innerHTML;

        if (command === 'Save') {
            // Form fields, see IDs above
            params = {
                security_code: 1,
                name: Mishusoft.detectElement('permissionName').value,
                key: Mishusoft.detectElement('permissionKey').value,
                PKID: Mishusoft.detectElement('permissionPKID').value,
                btnName: Mishusoft.detectElement('permission-data-btn').innerHTML
            };
        } else {
            // Form fields, see IDs above
            params = {
                security_code: 1,
                id: Mishusoft.detectElement('permissionID').value,
                name: Mishusoft.detectElement('permissionName').value,
                key: Mishusoft.detectElement('permissionKey').value,
                PKID: Mishusoft.detectElement('permissionPKID').value,
                btnName: Mishusoft.detectElement('permission-data-btn').innerHTML
            };
        }

        let ajax = new XMLHttpRequest();
        ajax.open("POST", _root_ + 'appmanager/addPermission', true);
        ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajax.send(JSON.stringify(params)); // Make sure to stringify
        //receiving response from ajax
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                //show message with another method
                Mishusoft.showMessage(this.responseText, Mishusoft.detectElement("message2"));
            }
        };
    }
    ;

    deletePermission() {
        // Form fields, see IDs above
        let params = {
            security_code: 1,
            id: $(this).attr('data-permissionID')
        };

        let ajax = new XMLHttpRequest();
        ajax.open("POST", _root_ + 'appmanager/deletePermission', true);
        ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajax.send(JSON.stringify(params)); // Make sure to stringify
        //receiving response from ajax
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                //show message with another method
                Mishusoft.showMessage(this.responseText, Mishusoft.detectElement("message"));
            }
        };
    }
    ;

    // --------------------------------------------------
    // Role

    viewRoles() {
        this.ajaxVR = new XMLHttpRequest();
        this.ajaxVR.open(this.method, this.rolesURL, this.asynchronous);
        this.ajaxVR.send();

        //receiving response from ajax
        this.ajaxVR.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                //console.log(this.responseText);
                /*converting back to array*/
                this.data = JSON.parse(this.responseText);
                //replaceing previous data
                this.htmlpad = Mishusoft.detectElement("roles-data");
                //html value for <body>
                this.html = '';

                if (this.data.length !== 0) {
                    //looping through the data
                    for (let a = 0; a < this.data.length; a++) {
                        this.id = this.data[a].id_role;
                        this.roleName = this.data[a].role;
                        this.permissionLink = 'appmanager/rolepermissions/';

                        //appeding at html
                        this.html += '<tr>';
                        this.html += '<td class="text-align-center">';
                        this.html += '<label><input type="checkbox" id="role-select" class="check_box" data-id="' + this.id + '" data-name="' + this.roleName + '"/></label></td>';
                        this.html += '<td class="text-align-center">' + this.id + '</td>';
                        this.html += '<td class="text-align-left">' + this.roleName + '</td>';
                        this.html += '<td class="text-align-center"> <a href="' + _root_ + this.permissionLink + this.id + '" class="action-button">View</a></td>';
                        this.html += '<td class="text-align-center">';
                        this.html += '<a href="javascript:void(0);" id="role-edit-btn" class="button button-xs button-success" data-id="' + this.id + '" data-name="' + this.roleName + '"> <i class="far fa-edit"></i></a>&nbsp;&nbsp;';
                        this.html += '<a href="javascript:void(0);" id="role-delete-btn" class="button button-xs button-danger" data-id="' + this.id + '"><i class="far fa-trash-alt"></i></a>';
                        this.html += '</td>';
                        this.html += '</tr>';

                        if (this.htmlpad) {
                            this.htmlpad.innerHTML = this.html;
                        }
                    }
                } else {
                    //appeding at html
                    this.html += '<tr>';
                    this.html += '<td class="text-align-center" colspan="5">No role exists.</td>';
                    this.html += '</tr>';

                    if (this.htmlpad) {
                        this.htmlpad.innerHTML = this.html;
                    }
                }
            }
        };
    }
    ;

    saveRole() {
        let command = Mishusoft.detectElement('role-data-btn').innerHTML;
        let params = '';
        if (command === 'Save') {
            // Form fields, see IDs above
            params = {
                security_code: 1,
                name: Mishusoft.detectElement('roleName').value,
                btnName: Mishusoft.detectElement('role-data-btn').innerHTML
            };
        } else {
            // Form fields, see IDs above
            params = {
                security_code: 1,
                id: Mishusoft.detectElement('roleID').value,
                name: Mishusoft.detectElement('roleName').value,
                btnName: Mishusoft.detectElement('role-data-btn').innerHTML
            };
        }

        let ajaxSR = new XMLHttpRequest();
        ajaxSR.open("POST", _root_ + 'appmanager/addRole', true);
        ajaxSR.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajaxSR.send(JSON.stringify(params)); // Make sure to stringify
        //receiving response from ajax
        ajaxSR.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                //show message with another method
                Mishusoft.showMessage(this.responseText, Mishusoft.detectElement("message2"));
            }
        };
    };

    deleteRole() {
        // Form fields, see IDs above
        let params = {
            security_code: 1,
            id: $(this).attr('data-id')
        };

        let ajaxDR = new XMLHttpRequest();
        ajaxDR.open("POST", _root_ + 'appmanager/deleteRole', true);
        ajaxDR.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajaxDR.send(JSON.stringify(params)); // Make sure to stringify
        //receiving response from ajax
        ajaxDR.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                //show message with another method
                Mishusoft.showMessage(this.responseText, Mishusoft.detectElement("message"));
            }
        };
    };

    updateRolePermission() {
        // Form fields, see IDs above
        let data = {
            security_code: 1,
            role: $(this).attr('data-roleid'),
            permission: $(this).attr('data-permissionid'),
            value: $(this).attr('data-value')
        };

        let ajax = new XMLHttpRequest();
        ajax.open("POST", _root_ + 'appmanager/updateRolePermission', true);
        ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajax.send(JSON.stringify(data)); // Make sure to stringify
        //receiving response from ajax
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                //show message with another method
                Mishusoft.showMessage(this.responseText, Mishusoft.detectElement("message"));
            }
        };
    };


    // --------------------------------------------------

    viewTools() {
        this.ajax = new XMLHttpRequest();
        this.ajax.open(this.method, this.AppToolsURL, this.asynchronous);
        this.ajax.send();

        //receiving response from ajax
        this.ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                /*converting back to array*/
                this.data = JSON.parse(this.responseText);
                //replaceing previous data
                this.htmlpad = Mishusoft.detectElement('tools-data');
                //html value for <body>
                this.html = '';

                if (this.data.length !== 0) {
                    //looping through the data
                    for (let a = 0; a < this.data.length; a++) {
                        this.id = this.data[a].id;
                        this.name = this.data[a].name;
                        this.title = this.data[a].title;
                        this.url = this.data[a].url;

                        //appeding at html
                        this.html += '<tr>';
                        this.html += '<td class="text-align-center">';
                        this.html += '<label><input type="checkbox" id="tool-select" class="check_box" data-id="' + this.id + '" data-name="' +
                            this.name + '" data-title="' + this.title + '" data-url="' + this.url + '"/></label></td>';
                        this.html += '<td class="text-align-center">' + this.id + '</td>';
                        this.html += '<td class="text-align-left">' + this.name + '</td>';
                        this.html += '<td class="text-align-left">' + this.title + '</td>';
                        this.html += '<td class="text-align-center"> <a href="' + _root_ + this.url + '" class="action-button">Visit</a></td>';
                        this.html += '<td class="text-align-center">';
                        this.html += '<a href="javascript:void(0);" id="tool-edit-btn" class="button button-xs button-success" data-id="' + this.id + '" data-name="' +
                            this.name + '" data-title="' + this.title + '" data-url="' + this.url + '"> <i class="far fa-edit"></i></a>&nbsp;&nbsp;';
                        this.html += '<a href="javascript:void(0);" id="tool-delete-btn" class="button button-xs button-danger" data-id="' + this.id + '"><i class="far fa-trash-alt"></i></a>';
                        this.html += '</td>';
                        this.html += '</tr>';

                        if (this.htmlpad) {
                            this.htmlpad.innerHTML = this.html;
                        }
                    }
                } else {
                    //appeding at html
                    this.html += '<tr>';
                    this.html += '<td class="text-align-center" colspan="7">No tool exists.</td>';
                    this.html += '</tr>';

                    if (this.htmlpad) {
                        this.htmlpad.innerHTML = this.html;
                    }
                }
            }
        };
    }
    ;

    // --------------------------------------------------

    saveUser() {
        let params = '';
        let command = Mishusoft.detectElement('user-data-btn').innerHTML;

        if (command === 'Save') {
            // Form fields, see IDs above
            params = {
                security_code: 1,
                FName: Mishusoft.detectElement('userFName').value,
                LName: Mishusoft.detectElement('userLName').value,
                email: Mishusoft.detectElement('userEmail').value,
                password: Mishusoft.detectElement('userPassword').value,
                username: Mishusoft.detectElement('userUsername').value,
                activity: Mishusoft.detectElement('userActivity').value,
                role: Mishusoft.detectElement('userRole').value,
                btnName: Mishusoft.detectElement('user-data-btn').innerHTML
            };
        } else {
            // Form fields, see IDs above
            params = {
                security_code: 1,
                id: Mishusoft.detectElement('userID').value,
                FName: Mishusoft.detectElement('userFName').value,
                LName: Mishusoft.detectElement('userLName').value,
                email: Mishusoft.detectElement('userEmail').value,
                password: Mishusoft.detectElement('userPassword').value,
                username: Mishusoft.detectElement('userUsername').value,
                activity: Mishusoft.detectElement('userActivity').value,
                role: Mishusoft.detectElement('userRole').value,
                btnName: Mishusoft.detectElement('user-data-btn').innerHTML
            };
        }

        let ajax = new XMLHttpRequest();
        ajax.open("POST", _root_ + 'appmanager/addUser', true);
        ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajax.send(JSON.stringify(params)); // Make sure to stringify
        //receiving response from ajax
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                //show message with another method
                Mishusoft.showMessage(this.responseText, Mishusoft.detectElement("message2"));
            }
        };
    }
    ;

    deleteUser() {
        // Form fields, see IDs above
        let params = {
            security_code: 1,
            id: $(this).attr('data-userID')
        };

        let ajax = new XMLHttpRequest();
        ajax.open('POST', _root_ + 'appmanager/deleteUser', true);
        ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajax.send(JSON.stringify(params)); // Make sure to stringify
        //receiving response from ajax
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                //show message with another method
                Mishusoft.showMessage(this.responseText, Mishusoft.detectElement("message"));
            }
        };
    }
    ;

    verifyUser() {
        //alert($(this).attr('data-userID') + ' | ' + $(this).attr('data-userCode') );
        // Form fields, see IDs above
        let params = {
            security_code: 1,
            id: $(this).attr('data-userID'),
            code: $(this).attr('data-userCode')
        };

        let ajax = new XMLHttpRequest();
        ajax.open('POST', _root_ + 'appmanager/verifyUser', true);
        ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajax.send(JSON.stringify(params)); // Make sure to stringify
        //receiving response from ajax
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                //show message with another method
                Mishusoft.showMessage(this.responseText, Mishusoft.detectElement("message"));
            }
        };
    };

    // --------------------------------------------------
    // --------------------------------------------------

}

let myApp = new AppManager();
myApp.updateDATA();


$('#permissions-data-table').on('click', '.page', function () {
    let url = 'appManager/permissionsPaginationAJAX';
    Mishusoft.pagination($(this).attr('page'), url, 'permissions-data-table');
});

$('#users-data-table').on('click', '.page', function () {
    let url = 'appManager/usersPaginationAJAX';
    Mishusoft.pagination($(this).attr('page'), url, 'users-data-table');
});


/*start of Permission sectin of app manager*/
//hide edit pad by default
if (Mishusoft.detectElement('permissionEditMode')) {
    Mishusoft.detectElement('permissionEditMode').innerHTML = 'Add new';
    Mishusoft.detectElement('permission-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('permission-reset-btn').innerHTML = 'Reset';
}
//save data by clicking data button
$(document).on('click', '#permission-data-btn', myApp.savePermission);
//reset inputbox by clicking reset button
$(document).on('click', '#permission-reset-btn', function () {
    Mishusoft.detectElement('permissionID').value = '';
    Mishusoft.detectElement('permissionName').value = '';
    Mishusoft.detectElement('permissionKey').value = '';
    Mishusoft.detectElement('permissionPKID').value = '';
});
//add data form by clicking add button
$(document).on('click', '#permission-add-btn', function () {
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('permissionEditMode').innerHTML = 'Add new';
    Mishusoft.detectElement('permission-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('permissionID').value = '';
    Mishusoft.detectElement('permissionName').value = '';
    Mishusoft.detectElement('permissionKey').value = '';
    Mishusoft.detectElement('permissionPKID').value = '';
});
//select data by clicking select button
$(document).on('click', '#permission-select', function () {
    if (this.checked) {
        Mishusoft.detectElement('message2').innerHTML = '';
        Mishusoft.detectElement('modal01').style.display = 'block';
        Mishusoft.detectElement('permissionEditMode').innerHTML = 'Edit';
        Mishusoft.detectElement('permission-data-btn').innerHTML = 'Update';
        Mishusoft.detectElement('permissionID').value = $(this).attr('data-permissionID');
        Mishusoft.detectElement('permissionName').value = $(this).attr('data-permissionName');
        Mishusoft.detectElement('permissionKey').value = $(this).attr('data-permissionKey');
        Mishusoft.detectElement('permissionPKID').value = $(this).attr('data-permissionPKID');
    }
});
//edit data by clicking edit button
$(document).on('click', '#permission-edit-btn', function () {
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('permissionEditMode').innerHTML = 'Edit';
    Mishusoft.detectElement('permission-data-btn').innerHTML = 'Update';
    Mishusoft.detectElement('permissionID').value = $(this).attr('data-permissionID');
    Mishusoft.detectElement('permissionName').value = $(this).attr('data-permissionName');
    Mishusoft.detectElement('permissionKey').value = $(this).attr('data-permissionKey');
    Mishusoft.detectElement('permissionPKID').value = $(this).attr('data-permissionPKID');
});
//delete data by clicking delete button
$(document).on('click', '#permission-delete-btn', myApp.deletePermission);
/*end of Permission section of app manager*/


/* start of role section of app manager*/
//hide edit pad by default
if (Mishusoft.detectElement('roleEditMode')) {
    Mishusoft.detectElement('roleEditMode').innerHTML = 'Add new';
    Mishusoft.detectElement('role-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('role-reset-btn').innerHTML = 'Reset';
}
//save data by clicking data button
$(document).on('click', '#role-data-btn', myApp.saveRole);
//reset inputbox by clicking reset button
$(document).on('click', '#role-reset-btn', function () {
    Mishusoft.detectElement('roleName').value = '';
});
//select data by clicking select button
$(document).on('click', '#role-select', function () {
    if (this.checked) {
        Mishusoft.detectElement('message2').innerHTML = '';
        Mishusoft.detectElement('modal01').style.display = 'block';
        Mishusoft.detectElement('roleEditMode').innerHTML = 'Edit';
        Mishusoft.detectElement('role-data-btn').innerHTML = 'Update';
        Mishusoft.detectElement('roleID').value = $(this).attr('data-id');
        Mishusoft.detectElement('roleName').value = $(this).attr('data-name');
    }
});
//add data form by clicking add button
$(document).on('click', '#role-add-btn', function () {
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('roleEditMode').innerHTML = 'Add new';
    Mishusoft.detectElement('role-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('roleID').value = '';
    Mishusoft.detectElement('roleName').value = '';
});
//edit data by clicking edit button
$(document).on('click', '#role-edit-btn', function () {
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('roleEditMode').innerHTML = 'Edit';
    Mishusoft.detectElement('role-data-btn').innerHTML = 'Update';
    Mishusoft.detectElement('roleID').value = $(this).attr('data-id');
    Mishusoft.detectElement('roleName').value = $(this).attr('data-name');
});
//delete data by clicking delete button
$(document).on('click', '#role-delete-btn', myApp.deleteRole);

//update role's permission data by clicking  button
$(document).on('click', '#rlprmValue', myApp.updateRolePermission);
/*end of role section of app manager*/



/*start of users sectin of app manager*/
//hide edit pad by default
if (Mishusoft.detectElement('userEditMode')) {
    Mishusoft.detectElement('userEditMode').innerHTML = 'Add new';
    Mishusoft.detectElement('user-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('user-reset-btn').innerHTML = 'Reset';
}

//verify user by clicking verify button
$(document).on('click', '#verfyUSER', myApp.verifyUser);

//set textbox value change dynamic after ability checked
$(document).on('keyup', '#userEmail', function () {
    let RequestURL = _root_ + "user/checkValidEmailAddress";
    let dataElement = Mishusoft.detectElement("userEmail");
    let htmlpad = Mishusoft.detectElement("message2");
    return Mishusoft.checkValidEmailAddress(RequestURL, dataElement, htmlpad);
});
//set textbox value change dynamic after ability checked
$(document).on('change', '#userEmail', function () {
    let RequestURL = _root_ + "user/checkValidEmailAddress";
    let dataElement = Mishusoft.detectElement("userEmail");
    let htmlpad = Mishusoft.detectElement("message2");
    return Mishusoft.checkValidEmailAddress(RequestURL, dataElement, htmlpad);
});

//set textbox value change dynamic after ability checked
$('#userEditPAD')
    .on('keyup', '#userUsername', function () {
        let RequestURL = _root_ + "user/checkValidUsername";
        let dataElement = Mishusoft.detectElement("userUsername");
        let htmlpad = Mishusoft.detectElement("message2");
        return Mishusoft.checkValidUsername(RequestURL, dataElement, htmlpad);
    })
    //set textbox value change dynamic after ability checked
    .on('change', '#userUsername', function () {
        let RequestURL = _root_ + "user/checkValidUsername";
        let dataElement = Mishusoft.detectElement("userUsername");
        let htmlpad = Mishusoft.detectElement("message2");
        return Mishusoft.checkValidUsername(RequestURL, dataElement, htmlpad);
    });
//save data by clicking data button
$(document).on('click', '#user-data-btn', myApp.saveUser);
//reset inputbox by clicking reset button
$(document).on('click', '#user-reset-btn', function () {
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('userID').value = '';
    Mishusoft.detectElement('userFName').value = '';
    Mishusoft.detectElement('userLName').value = '';
    Mishusoft.detectElement('userEmail').value = '';
    Mishusoft.detectElement('userPassword').value = '';
    Mishusoft.detectElement('userUsername').value = '';
    Mishusoft.detectElement('userActivity').value = '';
    Mishusoft.detectElement('userRole').value = '';
});
//add data form by clicking add button
$(document).on('click', '#user-add-btn', function () {
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('userEditMode').innerHTML = 'Add new';
    Mishusoft.detectElement('user-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('userID').value = '';
    Mishusoft.detectElement('userFName').value = '';
    Mishusoft.detectElement('userLName').value = '';
    Mishusoft.detectElement('userEmail').value = '';
    Mishusoft.detectElement('userPassword').value = '';
    Mishusoft.detectElement('userUsername').value = '';
    Mishusoft.detectElement('userActivity').value = '';
    Mishusoft.detectElement('userRole').value = '';
    //Mishusoft.detectElement('user-add-btn').style.display = 'none';
});
//select data by clicking select button
$(document).on('click', '#user-select', function () {
    if (this.checked) {
        Mishusoft.detectElement('message2').innerHTML = '';
        Mishusoft.detectElement('modal01').style.display = 'block';
        Mishusoft.detectElement('message2').innerHTML = '';
        Mishusoft.detectElement('userEditMode').innerHTML = 'Edit';
        Mishusoft.detectElement('user-data-btn').innerHTML = 'Update';
        Mishusoft.detectElement('userID').value = $(this).attr('data-userID');
        Mishusoft.detectElement('userFName').value = $(this).attr('data-userFName');
        Mishusoft.detectElement('userLName').value = $(this).attr('data-userLName');
        Mishusoft.detectElement('userEmail').value = $(this).attr('data-userEmail');
        Mishusoft.detectElement('userPassword').value = $(this).attr('data-userPassword');
        Mishusoft.detectElement('userUsername').value = $(this).attr('data-userUsername');
        Mishusoft.detectElement('userActivity').value = $(this).attr('data-userActivity');
        Mishusoft.detectElement('userRole').value = $(this).attr('data-userRole');
    }
});
//edit data by clicking edit button
$(document).on('click', '#user-edit-btn', function () {
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('userEditMode').innerHTML = 'Edit';
    Mishusoft.detectElement('user-data-btn').innerHTML = 'Update';
    Mishusoft.detectElement('userID').value = $(this).attr('data-userID');
    Mishusoft.detectElement('userFName').value = $(this).attr('data-userFName');
    Mishusoft.detectElement('userLName').value = $(this).attr('data-userLName');
    Mishusoft.detectElement('userEmail').value = $(this).attr('data-userEmail');
    Mishusoft.detectElement('userPassword').value = $(this).attr('data-userPassword');
    Mishusoft.detectElement('userUsername').value = $(this).attr('data-userUsername');
    Mishusoft.detectElement('userActivity').value = $(this).attr('data-userActivity');
    Mishusoft.detectElement('userRole').value = $(this).attr('data-userRole');
    // Mishusoft.detectElement('userCode').value = $(this).attr('data-userCode');
});
//delete data by clicking delete button
$(document).on('click', '#user-delete-btn', myApp.deleteUser);
/*end of users section of app manager*/
