class ProductsView extends Mishusoft {
  constructor() {
    super();
    this.QuickaccessAppURL = this.AppHostAddress + "products/getForwardedProducts";
    this.viewProducts();
  }

  /* -- start -- make data update with interval*/
  updateDATA (){
    let self = this;
    this.dataInterval = setInterval(function(){
      self.viewProducts();
    }, 5000);
  }
  /* -- end -- make data update with interval*/

  viewProducts() {
    this.ajaxPV = new XMLHttpRequest();
    this.ajaxPV.open(this.method, this.QuickaccessAppURL, this.asynchronous);
    this.ajaxPV.send();

    //receiving response from ajax
    this.ajaxPV.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        /*converting back to array*/
        this.data = JSON.parse(this.responseText);
        //replaceing previous data
        this.htmlpad = document.getElementById("products");
        //html value for <body>
        this.html = "";

        if (this.data.length !== 0) {
          //looping through the data
          for (this.a = 0; this.a < this.data.length; this.a++) {
            this.title = this.data[this.a].app_name;
            this.url = this.data[this.a].app_url;
            this.icon = this.data[this.a].app_icon;
            this.c_status = this.data[this.a].c_status;

            //appeding at html
            this.html += "<div class=\"quick-access-app box-shadow-light\">";
            this.html += "<div class=\"quick-access-app-logo\">";
            if (this.icon !== null) {
              this.html += "<img src=\"" + _root_ + this.url + "\" alt=\"LOGO\" class=\"quick-access-app-logo-image\">";
            }
            else {
              this.html += "<span class=\"quick-access-app-logo-image-alt\"><i class=\"fab fa-app-store\"></i></span>";
            }

            this.html += "</div>";
            this.html += "<div class=\"quick-access-app-text\">";
            this.html += "<div class=\"quick-access-app-title-text\">" + this.title + "</div>";
            this.html += "<div class=\"quick-access-app-status-text\">" + this.c_status + "</div>";
            this.html += "<div class=\"quick-access-app-link\">";
            this.html += "<a href=\"" + _root_ + this.url + "\" class=\"quick-access-app-link-text link\">Preview</a>";
            this.html += "</div></div></div>";

            if (this.htmlpad) {
              this.htmlpad.innerHTML = this.html;
            }
          }
        }
        else {
          //appeding at html
          this.html += "<div class=\"thumbnail box-shadow-light\" style='padding: 45px 25px;'>";
          this.html += "No product exists.";
          this.html += "</div>";

          if (this.htmlpad) {
            this.htmlpad.innerHTML = this.html;
          }
        }
      }
    }
  };
}

let myApp = new ProductsView();
myApp.updateDATA();