/* global _root_ */

class Mishusoft {
    constructor() {
        this.author = 'Mr. Abir Ahamed';
        this.Company = 'MISHU Software Inc';
        this.AppHostAddress = _root_;
        this.method = "POST";
        this.asynchronous = true;
        this.contentType = "application/json;charset=UTF-8";
        this.security_code = 1;
        this.dataInterval = null;

        /*data storage link*/
        this.notifyDataURl = this.AppHostAddress + "backdoor/getNotify";
        this.checkUserAuthTimeURL = this.AppHostAddress + "user/checkLogStatus";
        //console.log("Mishusoft is running...");
    };

    /* -- start -- make data update with interval*/
    updateDATA() {
        let self = this;
        this.dataInterval = setInterval(function () {
            self.notificaitions();
            self.checkUserAuthTime();
            console.clear();
        }, 5000);
    };

    stopUpdate() {
        clearInterval(this.dataInterval);
    };

    /* -- end -- make data update with interval*/

    startUpdate() {
    };

    showNotify() {
    };

    static createAttributeWithValue(element, attr, value) {
        var h1 = Mishusoft.detectElement(element);   // Get the first <h1> element in the document
        var att = document.createAttribute(attr);       // Create a "class" attribute
        att.value = value;                           // Set the value of the class attribute
        h1.setAttributeNode(att);                          // Add the class attribute to <h1> ;
    };

    static NumberToText(value) {
        var fraction = Math.round(Mishusoft.frac(value) * 100);
        var f_text = "";

        if (fraction > 0) {
            f_text = "AND " + Mishusoft.convert_number(fraction) + " PAISA";
        }

        return Mishusoft.convert_number(value) + " Taka " + f_text + " ONLY";
    };

    static frac(f) {
        return f % 1;
    };

    static convert_number(number) {
        if ((number < 0) || (number > 999999999)) {
            return "NUMBER OUT OF RANGE!";
        }
        var Gn = Math.floor(number / 10000000);  /* Crore */
        number -= Gn * 10000000;
        var kn = Math.floor(number / 100000);     /* lakhs */
        number -= kn * 100000;
        var Hn = Math.floor(number / 1000);      /* thousand */
        number -= Hn * 1000;
        var Dn = Math.floor(number / 100);       /* Tens (deca) */
        number = number % 100;               /* Ones */
        var tn = Math.floor(number / 10);
        var one = Math.floor(number % 10);
        var res = "";

        if (Gn > 0) {
            res += (Mishusoft.convert_number(Gn) + " CRORE");
        }
        if (kn > 0) {
            res += (((res == "") ? "" : " ") +
                Mishusoft.convert_number(kn) + " LAKH");
        }
        if (Hn > 0) {
            res += (((res == "") ? "" : " ") +
                Mishusoft.convert_number(Hn) + " THOUSAND");
        }

        if (Dn) {
            res += (((res == "") ? "" : " ") +
                Mishusoft.convert_number(Dn) + " HUNDRED");
        }


        var ones = Array("", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX", "SEVEN", "EIGHT", "NINE", "TEN", "ELEVEN", "TWELVE", "THIRTEEN", "FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN", "NINETEEN");
        var tens = Array("", "", "TWENTY", "THIRTY", "FOURTY", "FIFTY", "SIXTY", "SEVENTY", "EIGHTY", "NINETY");

        if (tn > 0 || one > 0) {
            if (!(res == "")) {
                res += " AND ";
            }
            if (tn < 2) {
                res += ones[tn * 10 + one];
            } else {

                res += tens[tn];
                if (one > 0) {
                    res += ("-" + ones[one]);
                }
            }
        }

        if (res == "") {
            res = "zero";
        }
        return res;
    };

    static PopUpWindowCenterPosition(url, title, w, h) {
        // Fixes dual-screen position                         Most browsers      Firefox
        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

        let width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        let height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        var left = ((width / 2) - (w / 2)) + dualScreenLeft;
        var top = ((height / 2) - (h / 2)) + dualScreenTop;
        var newWindow = window.open(url, title, 'scrollbars=yes,resizable=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

        // Puts focus on the newWindow
        if (window.focus) {
            newWindow.focus();
        }
    };

    static refreshDigitalClock() {
        var refresh = 1000; // Refresh rate in milli seconds
        let mytime = setTimeout('Mishusoft.DigitalClock()', refresh)
    };

    static DigitalClock() {

        let date = new Date();
        let days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
        let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        let toDayNumber = date.getDate();
        let toDayName = days[date.getDay()];
        let thisMonth = months[date.getMonth()];
        let thisYear = date.getFullYear();
        let hour = date.getHours();
        let minute = date.getMinutes();
        let second = date.getSeconds();
        let session = "AM";
        let text = '';
        /*
        getFullYear()	Get the year as a four digit number (yyyy)
        getMonth()	Get the month as a number (0-11)
        getDate()	Get the day as a number (1-31)
        getHours()	Get the hour (0-23)
        getMinutes()	Get the minute (0-59)
        getSeconds()	Get the second (0-59)
        getMilliseconds()	Get the millisecond (0-999)
        getTime()	Get the time (milliseconds since January 1, 1970)
        getDay()	Get the weekday as a number (0-6)
        Date.now()	Get the time. ECMAScript 5.
        */

        if (hour == 0) {
            hour = 12;
        }
        if (hour > 12) {
            hour = hour - 12;
            session = "PM";
        }

        hour = (hour < 10) ? "0" + hour : hour;
        minute = (minute < 10) ? "0" + minute : minute;
        second = (second < 10) ? "0" + second : second;
        text += toDayName + ',&nbsp;' + toDayNumber + '&nbsp;' + thisMonth + '&nbsp;' + thisYear + '&nbsp;&nbsp;';
        text += hour + '&nbsp;:&nbsp;' + minute + '&nbsp;:&nbsp;' + second + '&nbsp;' + session;
        let tag = Mishusoft.detectElement('ct');
        if (tag) {
            tag.innerHTML = text;
            Mishusoft.refreshDigitalClock();
        }
    };

    checkUserAuthTime() {
        let ajaxQA = new XMLHttpRequest();
        ajaxQA.open('POST', _root_ + 'user/checkLogStatus', true);
        ajaxQA.send();

        //receiving response from ajax
        ajaxQA.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                /*converting back to array*/
                let data = this.responseText;
                if (data === 0) {
                    location.replace(_root_ + 'user/login');
                }
            }
        }
    };

    static showMessage(data, ElementId) {
        if (Mishusoft.IsJsonString(data)) {
            // converting back to array
            let d = JSON.parse(data);
            //html value for <body>
            let html = "";
            //looping through the data
            for (let a = 0; a < d.length; a++) {
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

                //appeding at html
                html += '<div class="box-message box-' + errClass + ' box-shadow-light">';
                html += '<span class="box-' + errClass + '-symbol">' + symbol + '</span>';
                html += '&nbsp;&nbsp;' + message + '';
                html += '</div>';

                if (ElementId) {
                    ElementId.innerHTML = html;
                }
            }
        } else {
            alert(data.toSource());
        }
    };

    static viewEditPad(ElementId) {
        if (ElementId) {
            if (Mishusoft.detectElement(ElementId + 'EditPAD').style.display === 'none') {
                Mishusoft.detectElement(ElementId + 'EditPAD').style.display = 'block';
            } else {
                Mishusoft.detectElement(ElementId + 'EditPAD').style.display = 'none';
            }
        }
    };

    static checkValidUsername(RequestURL, dataElementId, viewElementId) {
        //receiving all code from database
        // call new request
        let ajax = new XMLHttpRequest();
        let method = 'POST';
        let asynchronous = true;
        let data = new FormData();
        data.append('username', dataElementId.value);
        // Sets the request method, request URL, and synchronous flag.
        ajax.open(method, RequestURL, asynchronous);
        //sending ajax request
        ajax.send(data);
        //receiving response from alldata
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                //show message with another method
                Mishusoft.showMessage(this.responseText, viewElementId);
            }
        };
    };

    static checkValidEmailAddress(RequestURL, dataElementId, viewElementId) {
        //receiving all code from database
        // call new request
        let ajax = new XMLHttpRequest();
        let method = 'POST';
        let asynchronous = true;
        let data = new FormData();
        data.append('email', dataElementId.value);
        // Sets the request method, request URL, and synchronous flag.
        ajax.open(method, RequestURL, asynchronous);
        //sending ajax request
        ajax.send(data);
        //receiving response from alldata
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                //show message with another method
                Mishusoft.showMessage(this.responseText, viewElementId);
            }
        };
    };

    static checkInputDataAbility(url, value, ElementId) {
        //declare all required variable
        let method = "POST";
        let asynchronous = true;

        // call new request
        let ajax = new XMLHttpRequest();
        // Sets the request method, request URL, and synchronous flag.
        ajax.open(method, url, asynchronous);
        ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        //sending ajax request
        ajax.send(JSON.stringify({
            security_code: 1,
            name: value
        })); // Make sure to stringify

        //receiving response from alldata
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                //show message with another method
                Mishusoft.showMessage(this.responseText, ElementId);
            }
        };
    };

    static pagination(page, url, ElementId) {
        //declare all required variable
        let method = "POST";
        let asynchronous = true;

        let pageNumber = new FormData();
        pageNumber.append('page', page);

        // call new request
        let ajax = new XMLHttpRequest();
        ajax.open(method, _root_ + url, asynchronous);
        //sending ajax request
        ajax.send(pageNumber);

        //receiving response from alldata
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let htmlpad = Mishusoft.detectElement(ElementId);
                if (htmlpad) {
                    htmlpad.innerHTML = this.responseText;
                } else {
                    alert('Data element id not found.');
                }
            }
        };
    };

    static detectElement(id) {
        return document.getElementById(id);
    }

    static detectElementByClass(cls) {
        return document.getElementsByClassName(cls);
    }

    static uploadModuleFile(ElementName, ElementID, URL) {
        Mishusoft.detectElement('UploadStatusBorad').style.display = 'block';
        Mishusoft.detectElement('progressbar').style.display = 'block';

        let file = Mishusoft.detectElement(ElementID).files[0];
        let data = new FormData();
        data.append(ElementName, file);
        let ajax = new XMLHttpRequest();
        ajax.upload.addEventListener('progress', Mishusoft.progressHandler, false);
        ajax.addEventListener('load', Mishusoft.completeHandler, false);
        ajax.addEventListener('error', Mishusoft.errorHandler, false);
        ajax.addEventListener('abort', Mishusoft.abortHandler, false);
        ajax.open('POST', _root_ + URL, true);
        ajax.send(data);
    }

    static progressHandler(event) {
        let loadedSize = (event.loaded / 1024) / 1024;
        let totalSize = (event.total / 1024) / 1024;
        Mishusoft.detectElement('loaded_n_total').innerHTML = 'Uploaded ' + loadedSize.toFixed(2) + ' MB of ' + totalSize.toFixed(2) + ' MB';
        let percent = (event.loaded / event.total) * 100;
        Mishusoft.detectElement('progressbar').value = Math.round(percent);
        Mishusoft.detectElement('upload_status').innerHTML = Math.round(percent) + '% uploaded..';
    }

    static completeHandler(event) {
        Mishusoft.detectElement('upload_status').innerHTML = event.target.responseText;
        Mishusoft.detectElement('progressbar').value = 0;
        Mishusoft.detectElement('progressbar').style.display = 'none';
    }

    static errorHandler() {
        Mishusoft.detectElement('upload_status').innerHTML = 'Upload failed';
    }

    static abortHandler() {
        Mishusoft.detectElement('upload_status').innerHTML = 'Upload aborted';
    }

    static isNumber(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    static IsJsonString(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }

    static PopUpDialogBox(titleText, messageText, actionBtn, command, proccessURL) {
        Mishusoft.detectElement('PopUpDialogBox').style.display = 'block';
        Mishusoft.detectElement('PopUpDialogBoxTitle').innerHTML = titleText;
        Mishusoft.detectElement('message3').innerHTML = messageText;
        Mishusoft.detectElement('message-done-btn').innerHTML = command;

        //let dataId = $(this).attr('data-id');
        let dataId = actionBtn.attr('data-id');
        let commandBtn = Mishusoft.detectElement('message-done-btn').innerHTML;
        let URL = _root_ + proccessURL;

        $(document).on('click', '#message-done-btn', function () {
            if (commandBtn === command) {
                // Form fields, see IDs above
                let data = {
                    security_code: 1,
                    id: dataId
                };

                let ajax = new XMLHttpRequest();
                ajax.open("POST", URL, true);
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
        })
    }
}


// When the user clicks on div, open the popup
function togglePOPUP() {
    let popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}


function openTopNAV() {
    let x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

function createDatabase() {

    console.log("----value test----");
    console.log("db name: " + document.getElementById("cr_db_name").value);
    console.log("db host: " + document.getElementById("cr_db_host").value);
    console.log("db user: " + document.getElementById("cr_db_user").value);
    console.log("db pass: " + document.getElementById("cr_db_user_pass").value);
    console.log("----value test----");

    let mysql = require('MySQL');
    let db = document.getElementById("cr_db_name").value;

    let con = mysql.createConnection({
        host: document.getElementById("cr_db_host").value,
        user: document.getElementById("cr_db_user").value,
        password: document.getElementById("cr_db_user_pass").value
    });

    con.connect(function (err) {
        if (err) throw err;
        console.log("Connected!");
        /*Create a database named "mydb":*/
        con.query("CREATE DATABASE " + db, function (err, result) {
            if (err) throw err;
            console.log("Database created");
        });
    });

}

// Get the modal
let modal = Mishusoft.detectElement('modal01');

// Get the button that opens the modal
let btnView = Mishusoft.detectElement("viewModal");

// Get the button that opens the modal
let btnClose = Mishusoft.detectElement("modalCloseButton");

// Get the <span> element that closes the modal
let span = document.getElementsByClassName("close")[0];

// When the user click the button view, open the modal
if (btnView) {
    btnView.onclick = function () {
        modal.style.display = "block";
    };
}

// When the user clicks on <span> (x), close the modal
if (span) {
    span.onclick = function () {
        modal.style.display = "none";
    };
}

// When the user click the button close, close the modal
if (btnClose) {
    btnClose.onclick = function () {
        modal.style.display = "none";
    };
}


// Get the button that opens the side nav
let openSideMenu = Mishusoft.detectElement('openSideMenu');

// Get the button that close the side nav
let closeSideMenu = Mishusoft.detectElement('closeSideMenu');

// When the user click the button open Side Menu, open the side nav
if (openSideMenu) {
    openSideMenu.onclick = function () {
        document.getElementById("mySidenav").style.width = "200px";
        //document.getElementById("container").style.marginLeft = "200px";
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
    };
}


// When the user click the button close Side Menu, close the side nav
if (closeSideMenu) {
    closeSideMenu.onclick = function () {
        document.getElementById("mySidenav").style.width = "0";
        //document.getElementById("container").style.marginLeft= "0";
        document.body.style.backgroundColor = "white";
    };
}


/* function videoPlayer(){
     barSize = 600;
     myMovie = document.getElementById('movie');
     playButton = document.getElementById('playButton');
     bar = document.getElementById('defaultBar');
     progressBar = document.getElementById('progressBar');

     playButton.addEventListener('click', playOrPause, false);
     bar.addEventListener('click', clickedBar, false);
 }

 function playOrPause (){
     if (!myMovie.paused && !myMovie.ended){
         myMovie.pause();
         playButton.innerHTML = 'Play';
         window.clearInterval(updateBar);
     }
     else {
         myMovie.play();
         playButton.innerHTML = 'Pause';
         updateBar = setInterval(update, 500)
     }
 }

 function update (){
     if(!myMovie.ended){
         var size = parseInt(myMovie.currentTime*barSize/myMovie.duration);
         progressBar.style.width = size + 'px';
     } else {
         progressBar.style.width = '0px';
         playButton.innerHTML = 'Play';
         window.clearInterval(updateBar);
     }
 }

 function clickedBar(e){
     if (!myMovie.paused && !myMovie.ended){
         var mouseX = e.pageX-bar.offsetLeft;
         var newTime = mouseX*myMovie.duration/barSize;
         myMovie.currentTime = newTime;
         progressBar.style.width = mouseX + 'px';
     }
 }

 window.addEventListener('load', videoPlayer, false); */
