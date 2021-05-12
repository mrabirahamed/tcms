/* global Mishusoft, _root_ */

class AppManager extends Mishusoft {
    constructor() {
        super();
        this.permissionsURL = this.AppHostAddress + 'appmanager/getPermissions';
        this.permissionsAllURL = this.AppHostAddress + 'appmanager/getPermissionsAll';
        this.rolesURL = this.AppHostAddress + 'appmanager/getRoles';
        this.adminMenuURL = this.AppHostAddress + "appmanager/getAdminMenus";

        this.viewAdminMenus();
        this.viewRoles();
    }

    /* -- start -- make data update with interval*/
    updateDATA() {
        let self = this;
        this.dataInterval = setInterval(function () {
            self.viewAdminMenus();
            self.viewRoles();
            console.clear();
        }, 5000);
    }


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

                        //appending at html
                        this.html += '<a href="' + _root_ + 'appmanager/' + this.url + '" class="thumbnail box-shadow-light" title="' + this.title + '">';
                        this.html += '<div class="thumbnail-image"><i class="' + this.icon + '"></i></div>';
                        this.html += '<div class="thumbnail-text">' + this.name + '</div>';
                        this.html += '</a>';

                        if (this.htmlpad) {
                            this.htmlpad.innerHTML = this.html;
                        }
                    }
                } else {
                    //appending at html
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


    // --------------------------------------------------

    //Branch

    saveBranch() {
        let command = Mishusoft.detectElement('branch-data-btn').innerHTML;
        let params = '';
        if (command === 'Save') {
            // Form fields, see IDs above
            params = {
                security_code: 1,
                name: Mishusoft.detectElement('branchName').value,
                status: Mishusoft.detectElement('branchStatus').value,
                location: Mishusoft.detectElement('branchLocation').value,
                btnName: Mishusoft.detectElement('branch-data-btn').innerHTML
            };
        } else {
            // Form fields, see IDs above
            params = {
                security_code: 1,
                id: Mishusoft.detectElement('branchID').value,
                name: Mishusoft.detectElement('branchName').value,
                status: Mishusoft.detectElement('branchStatus').value,
                location: Mishusoft.detectElement('branchLocation').value,
                btnName: Mishusoft.detectElement('branch-data-btn').innerHTML
            };
        }

        let ajaxSR = new XMLHttpRequest();
        ajaxSR.open("POST", _root_ + 'appmanager/addBranch', true);
        ajaxSR.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajaxSR.send(JSON.stringify(params)); // Make sure to stringify
        //receiving response from ajax
        ajaxSR.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                //show message with another method
                Mishusoft.showMessage(this.responseText, Mishusoft.detectElement("message2"));
            }
        };
    }

    // Permission
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

                        //appending at html
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
                    //appending at html
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
    }

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
    }

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
    }


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

                        //appending at html
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
                    //appending at html
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


    // --------------------------------------------------

    verifyIsUserAlreadyExists() {
        let dataB = {
            security_code: 1,
            user: Mishusoft.detectElement('userDetailsID').value
        };

        let ajaxB = new XMLHttpRequest();
        ajaxB.open("POST", _root_ + 'appmanager/isUserCreatedCheckedByUserId', true);
        ajaxB.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajaxB.send(JSON.stringify(dataB)); // Make sure to stringify
        ajaxB.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                if (Mishusoft.IsJsonString(this.responseText)) {
                    let dataC = JSON.parse(this.responseText);
                    if (dataC.length !== 0) {
                        //looping through the data
                        for (let a = 0; a < dataC.length; a++) {
                            let status = dataC[a].status;
                            if (status === 'yes') {
                                Mishusoft.detectElement('message3').innerHTML = '';
                                Mishusoft.detectElement('modal01').style.display = 'none';
                                AppManager.UploadWindowView('Upload profile picture');
                            }
                        }
                    }
                } else {
                    alert(this.responseText)
                }
            }
        };
    }

    static UploadWindowView(title) {
        Mishusoft.detectElement('modal02').style.display = 'block';
        Mishusoft.detectElement('imageFile').src = '';
        Mishusoft.detectElement('UploadStatusBoard').style.display = 'none';
        Mishusoft.detectElement('userProfilePictureUploadMode').innerHTML = title;
        Mishusoft.detectElement('user-picture-data-btn').innerHTML = 'Close';
    }

    saveUser() {
        let data = '';
        let command = Mishusoft.detectElement('user-data-btn').innerHTML;

        if (command === 'Save') {
            data = {
                security_code: 1,
                FName: Mishusoft.detectElement('userFName').value,
                LName: Mishusoft.detectElement('userLName').value,
                email: Mishusoft.detectElement('userEmail').value,
                password: Mishusoft.detectElement('userPassword').value,
                username: Mishusoft.detectElement('userUsername').value,
                activity: Mishusoft.detectElement('userActivity').value,
                role: Mishusoft.detectElement('userRole').value,
                dateOfBirth: Mishusoft.detectElement('userDateOfBirth').value,
                gender: Mishusoft.detectElement('userGender').value,
                profession: Mishusoft.detectElement('userProfession').value,
                btnName: Mishusoft.detectElement('user-data-btn').innerHTML
            };
        } else {
            data = {
                security_code: 1,
                id: Mishusoft.detectElement('userID').value,
                FName: Mishusoft.detectElement('userFName').value,
                LName: Mishusoft.detectElement('userLName').value,
                email: Mishusoft.detectElement('userEmail').value,
                password: Mishusoft.detectElement('userPassword').value,
                username: Mishusoft.detectElement('userUsername').value,
                activity: Mishusoft.detectElement('userActivity').value,
                role: Mishusoft.detectElement('userRole').value,
                dateOfBirth: Mishusoft.detectElement('userDateOfBirth').value,
                gender: Mishusoft.detectElement('userGender').value,
                profession: Mishusoft.detectElement('userProfession').value,
                btnName: Mishusoft.detectElement('user-data-btn').innerHTML
            };
        }

        let ajax = new XMLHttpRequest();
        ajax.open("POST", _root_ + 'appmanager/addUser', true);
        ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajax.send(JSON.stringify(data)); // Make sure to stringify
        //receiving response from ajax
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                if (Mishusoft.IsJsonString(this.responseText)) {
                    // converting back to array
                    let d = JSON.parse(this.responseText);
                    //html value for <body>
                    let html = "";
                    let htmlpad = Mishusoft.detectElement("message2");
                    //looping through the data
                    for (let a = 0; a < d.length; a++) {
                        let user = d[a].user;
                        let type = d[a].type;
                        let message = d[a].message;
                        let errClass = '';
                        let symbol = '';

                        if (type === "error") {
                            errClass += 'danger';
                            symbol += "&times;";
                        }
                        if (type === "success") {
                            errClass += 'success';
                            symbol += "&radic;";
                        }

                        //appending at html
                        html += '<div class="box-message box-' + errClass + ' box-shadow-light">';
                        html += '<span class="box-' + errClass + '-symbol">' + symbol + '</span>';
                        html += '&nbsp;&nbsp;' + message + '';
                        html += '</div>';

                        if (htmlpad) {
                            htmlpad.innerHTML = html;
                            Mishusoft.detectElement('userDetailsID').value = user;
                            myApp.verifyIsUserAlreadyExists();
                        }
                    }
                } else {
                    alert(this.responseText);
                }
            }
        };
    }


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


    verifyUser() {
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
    }

    // --------------------------------------------------
    // --------------------------------------------------

}

let myApp = new AppManager();
//myApp.updateDATA();


$('#permissions-data-table').on('click', '.page', function () {
    let url = 'appmanager/permissionsPaginationAJAX';
    Mishusoft.pagination($(this).attr('page'), url, 'permissions-data-table');
});


$('#users-data-table').on('click', '.page', function () {
    let url = 'appmanager/usersPaginationAJAX';
    Mishusoft.pagination($(this).attr('page'), url, 'users-data-table');
});


$('#branch-data-table').on('click', '.page', function () {
    let brnch = Mishusoft.detectElement('branchId').attr('data-value');
    let url = 'appmanager/branchesPaginationAJAX/' + brnch;
    Mishusoft.pagination($(this).attr('page'), url, 'branch-data-table');
});

/*start of branch sectin of app manager*/
//hide edit pad by default
if (Mishusoft.detectElement('branchEditMode')) {
    Mishusoft.detectElement('branchEditMode').innerHTML = 'New';
    Mishusoft.detectElement('branch-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('branch-reset-btn').innerHTML = 'Reset';
}
//set textbox value change dynamic after dropbox had changed.
$(document).on('keyup', '#branchName', function () {
    //alert(_root_ + "appmanager/checkBranchNameInputAbility");
    let checkBranchNameInputAbilityURL = _root_ + "appmanager/checkBranchNameInputAbility";
    let value = Mishusoft.detectElement("branchName").value;
    let htmlpad = Mishusoft.detectElement("message2");
    return Mishusoft.checkInputDataAbility(checkBranchNameInputAbilityURL, value, htmlpad);
});
//save data by clicking data button
$(document).on('click', '#branch-data-btn', myApp.saveBranch);
//reset inputbox by clicking reset button
$(document).on('click', '#branch-reset-btn', function () {
    Mishusoft.detectElement('branchID').value = '';
    Mishusoft.detectElement('branchName').value = '';
    Mishusoft.detectElement('branchStatus').value = '';
    Mishusoft.detectElement('branchLocation').value = '';
});
//add data form by clicking add button
$(document).on('click', '#branch-add-btn', function () {
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('branchEditMode').innerHTML = 'New';
    Mishusoft.detectElement('branch-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('branchID').value = '';
    Mishusoft.detectElement('branchName').value = '';
    Mishusoft.detectElement('branchStatus').value = '';
    Mishusoft.detectElement('branchLocation').value = '';
});
//select data by clicking select button
$(document).on('click', '#branch-select', function () {
    if (this.checked) {
        Mishusoft.detectElement('message2').innerHTML = '';
        Mishusoft.detectElement('modal01').style.display = 'block';
        Mishusoft.detectElement('branchEditMode').innerHTML = 'Edit';
        Mishusoft.detectElement('branch-data-btn').innerHTML = 'Update';
        Mishusoft.detectElement('branchID').value = $(this).attr('data-id');
        Mishusoft.detectElement('branchName').value = $(this).attr('data-name');
        Mishusoft.detectElement('branchStatus').value = $(this).attr('data-status');
        Mishusoft.detectElement('branchLocation').value = $(this).attr('data-location');
    }
});
//edit data by clicking edit button
$(document).on('click', '#branch-edit-btn', function () {
    Mishusoft.detectElement('message2').innerHTML = '';
    Mishusoft.detectElement('modal01').style.display = 'block';
    Mishusoft.detectElement('branchEditMode').innerHTML = 'Edit';
    Mishusoft.detectElement('branch-data-btn').innerHTML = 'Update';
    Mishusoft.detectElement('branchID').value = $(this).attr('data-id');
    Mishusoft.detectElement('branchName').value = $(this).attr('data-name');
    Mishusoft.detectElement('branchStatus').value = $(this).attr('data-status');
    Mishusoft.detectElement('branchLocation').value = $(this).attr('data-location');
});
//delete data by clicking delete button
$(document).on('click', '#branch-delete-btn', function () {
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
            ajax.open("POST", _root_ + 'appmanager/deleteBranch', true);
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

// change ability by clicking this button
$(document).on('click', '#transferBranchStuff', function () {
    Mishusoft.detectElement('PopUpDialogBox').style.display = 'block';
    Mishusoft.detectElement('PopUpDialogBoxTitle').innerHTML = 'Message';
    Mishusoft.detectElement('message3').innerHTML = '<div style="font-size:15px;">Are you want to change this?</div>';
    Mishusoft.detectElement('message-done-btn').innerHTML = 'Change';

    let commandBtn = Mishusoft.detectElement('message-done-btn').innerHTML;
    let user = $(this).attr('data-user');
    let branch = $(this).attr('data-branch');
    let method = $(this).attr('data-method');


    $(document).on('click', '#message-done-btn', function () {
        if (commandBtn === 'Change') {
            let data = {
                security_code: 1,
                user: user,
                branch: branch,
                method: method
            };

            let ajax = new XMLHttpRequest();
            ajax.open("POST", _root_ + 'appmanager/transferBranchStuff', true);
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
/*end of branch section of app manager*/


/*start of Permission section of app manager*/
//hide edit pad by default
if (Mishusoft.detectElement('permissionEditMode')) {
    Mishusoft.detectElement('permissionEditMode').innerHTML = 'New';
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
    Mishusoft.detectElement('permissionEditMode').innerHTML = 'New';
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
    Mishusoft.detectElement('roleEditMode').innerHTML = 'New';
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
    Mishusoft.detectElement('roleEditMode').innerHTML = 'New';
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
    Mishusoft.detectElement('userEditMode').innerHTML = 'New';
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
$('#userEditPAD').on('keyup', '#userUsername', function () {
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
    Mishusoft.detectElement('userEditMode').innerHTML = 'New';
    Mishusoft.detectElement('user-data-btn').innerHTML = 'Save';
    Mishusoft.detectElement('userID').value = '';
    Mishusoft.detectElement('userFName').value = '';
    Mishusoft.detectElement('userLName').value = '';
    Mishusoft.detectElement('userEmail').value = '';
    Mishusoft.detectElement('userPassword').value = '';
    Mishusoft.detectElement('userUsername').value = '';
    Mishusoft.detectElement('userActivity').value = '';
    Mishusoft.detectElement('userRole').value = '';
    Mishusoft.detectElement('userDateOfBirth').value = '';
    Mishusoft.detectElement('userGender').value = '';
    Mishusoft.detectElement('userProfession').value = '';
});
//select data by clicking select button
$(document).on('click', '#user-select', function () {
    if (this.checked) {
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
        Mishusoft.detectElement('userGender').value = $(this).attr('data-gender');
        Mishusoft.detectElement('userDateOfBirth').value = $(this).attr('data-dob');
        Mishusoft.detectElement('userProfession').value = $(this).attr('data-profession');
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
    Mishusoft.detectElement('userGender').value = $(this).attr('data-gender');
    Mishusoft.detectElement('userDateOfBirth').value = $(this).attr('data-dob');
    Mishusoft.detectElement('userProfession').value = $(this).attr('data-profession');
});
//delete data by clicking delete button
$(document).on('click', '#user-delete-btn', myApp.deleteUser);

//add data form by clicking add button
$(document).on('click', '#user-picture-change-btn', function () {
    Mishusoft.detectElement('userDetailsID').value = $(this).attr('data-user');
    Mishusoft.detectElement('profile_picture_preview').src = $(this).attr('src');
    AppManager.UploadWindowView('Change profile picture');
});


//show select file name on status bar
$(document).on('change', '#imageFile', function () {
    let file = Mishusoft.detectElement('imageFile').files[0];
    let totalSize = (file.size / 1024) / 1024;
    Mishusoft.detectElement('UploadStatusBoard').style.display = 'block';
    Mishusoft.detectElement('progressbar').style.display = 'none';
    Mishusoft.detectElement('upload_status').innerHTML = 'File: ' + file.name + ' (' + totalSize.toFixed(2) + ' Mb)';
    Mishusoft.previewImage(this, '#profile_picture_preview');
});
//upload file by clicking button
$(document).on('click', '#uploadImageFile', function () {
    let user = Mishusoft.detectElement('userDetailsID').value;
    Mishusoft.uploadFile('imageFile', 'imageFile', 'appmanager/uploadUserProfilePicture/' + user);
});

//close window data form by clicking add button
$(document).on('click', '#user-picture-data-btn', function () {
    Mishusoft.detectElement('modal02').style.display = 'none';
});
/*end of users section of app manager*/
