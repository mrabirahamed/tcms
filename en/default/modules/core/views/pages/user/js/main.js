/* global _root_, Mishusoft */

class UserManager extends Mishusoft {
    constructor() {
        super();
    }
}

let usrApp = new UserManager();

$('#notificationsAll').on('click', '.page', function () {
    let url = 'user/activitiesPaginationAJAX';
    Mishusoft.pagination($(this).attr('page'), url, 'notificationsAll');
});

//set textbox value change dynamic after ability checked
$('#registrationForm').on('keyup', '#email', function () {
    let RequestURL = _root_ + "user/checkValidEmailAddress";
    let dataElement = Mishusoft.detectElement("email");
    let htmlpad = Mishusoft.detectElement("showmessage");
    return Mishusoft.checkValidEmailAddress(RequestURL, dataElement, htmlpad);
});