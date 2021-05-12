class QuickApp extends Mishusoft {
    constructor() {
        super();
        this.notificaitions();
        this.checkUserAuthTime();
    }

    /* -- start -- make data update with interval*/
    updateDATA() {
        let self = this;
        this.dataInterval = setInterval(function () {
            self.notificaitions();
            self.checkUserAuthTime();
        }, 1000);
    }

    /* -- end -- make data update with interval*/

    notificaitions() {
        let ajaxQA = new XMLHttpRequest();
        ajaxQA.open('POST', _root_ + 'backdoor/getNotify', true);
        ajaxSR.setRequestHeader("Access-Control-Allow-Origin", "*");
        ajaxQA.send();

        //receiving response from ajax
        ajaxQA.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let r = this.responseText;
                if (r.length !== 0) {
                    /*converting back to array*/
                    let data = JSON.parse(this.responseText);
                    //replaceing previous data
                    let htmlpad = Mishusoft.detectElement("notifications");
                    //html value for <body>
                    let html = '';

                    if (data.length !== 0) {
                        //looping through the data
                        for (let a = 0; a < data.length; a++) {
                            let id = data[a].id;
                            let author = data[a].author;
                            let ip = data[a].ip;
                            let browser = data[a].browser;
                            let vstatus = data[a].vstatus;
                            let message_type = data[a].message_type;
                            let message = data[a].message;
                            let page = data[a].page;
                            let page_title = data[a].page_title;
                            let time = data[a].time;
                            let status = data[a].status;
                            let msgType = '';
                            let msgIcon = '';

                            if (message_type === 'error' || message_type === 'Error' || message_type === 'ERROR') {
                                msgType += 'danger';
                                msgIcon += '<i class="far fa-times-circle"></i>';
                            }
                            if (message_type === 'success' || message_type === 'Success' || message_type === 'SUCCESS') {
                                msgType += 'success';
                                msgIcon += '<i class="far fa-check-circle"></i>';
                            }
                            if (message_type === 'notify' || message_type === 'Notify' || message_type === 'NOTIFY') {
                                msgType += 'notify';
                                msgIcon += '<i class="fas fa-info-circle"></i>';
                            }

                            //appending at html
                            html += '<div class="box-message box-' + msgType + ' box-shadow-light">';
                            html += '<span class="notify-icon">' + msgIcon + '</span>&nbsp;';
                            html += '<span class="notify-content"><a href="http://' + ip + '">' + author + '</a>&nbsp;[' + ip + ']&nbsp;[' + browser + ']&nbsp;';
                            html += '[' + time + ']&nbsp;<a href="' + page + '">' + message + '</a></span>';
                            html += '<span class="notify-action"><i class="fas fa-trash-alt"></i> </span>';
                            html += '</div>';

                            if (htmlpad) {
                                htmlpad.innerHTML = html;
                            }
                        }
                    }
                    else {
                        //appending at html
                        html += '<div class="box-message box-danger box-shadow-light">';
                        html += '<span class="notify-icon"><i class="far fa-times-circle"></i></span>&nbsp;';
                        html += '<span class="notify-content">No notification found in database.</span>';
                        html += '<span class="notify-action"><i class="fas fa-trash-alt"></i></span>';
                        html += '</div>';

                        if (htmlpad) {
                            htmlpad.innerHTML = html;
                        }
                    }
                }
            }
        }
    };

}

//let myApp = new QuickApp();
//myApp.updateDATA();