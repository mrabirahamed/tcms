class InvoicePrintPageManager {
    constructor() { }

    static detectElementById(id) {
        return document.getElementById(id);
    }

    static viewReadyInvoicesSellItems() {
        let data = { security_code: 1, invoice: _InvoiceNumber_ };
        let ReadyInvoiceURL = _root_ + 'office/invoices/getReadyInvoicesSellItems';
        let ajax = new XMLHttpRequest();
        ajax.open('POST', ReadyInvoiceURL, true);
        ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
        ajax.send(JSON.stringify(data)); // Make sure to stringify

        //receiving response from ajax
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let data = JSON.parse(this.responseText);
                let htmlpad = InvoicePrintPageManager.detectElementById('print-page-pad-sell-items');
                let html = '';

                if (data.length !== 0) {
                    for (let a = 0; a < data.length; a++) {
                        let SellItemsId = data[a].id;
                        let SellItemsSerialNumber = data[a].serialNumber;
                        let SellItemsBrandName = data[a].brandName;
                        let SellItemsItemName = data[a].itemName;
                        let SellItemsModelName = data[a].model;
                        let SellItemsSerialCode = data[a].serial;
                        let SellItemsWarrantyTime = data[a].warrantyTime;
                        let SellItemsQuantity = data[a].quantity;
                        let SellItemsUnitPrice = data[a].unitPrice;
                        let SellItemsTotalPrice = data[a].totalPrice;

                        //appending data in new table
                        html += '<tr id="' + SellItemsId + '"><td class="text-align-center index">' + SellItemsSerialNumber + '</td><td class="text-align-left">' + SellItemsBrandName + '&nbsp;' + SellItemsItemName + '&nbsp;' + SellItemsModelName + '&nbsp; <br/>Serial:&nbsp;' + SellItemsSerialCode + ' <br/>Warranty:&nbsp;' + SellItemsWarrantyTime + ' days</td>';
                        html += '<td class="text-align-center">' + SellItemsQuantity + '</td><td class="text-align-right">' + SellItemsUnitPrice + '.00</td><td class="text-align-right">' + SellItemsTotalPrice + '.00</td></tr>';

                        if (htmlpad) {
                            htmlpad.innerHTML = html;
                        }
                    }
                } else {
                    html += '<tr><td class="text-align-center index" colspan="5"> No item found. </td></tr>';
                    
                    if (htmlpad) {
                        htmlpad.innerHTML = html;
                    }
                }
            }
        }
    }

    static makeReorderSellItems(){
        let sortableTable = $('#print-page-pad-sort > tbody');
        sortableTable.sortable({
            stop: function (event, ui) {
                let paramiters = sortableTable.sortable('toArray');
                $.post(_root_ + 'office/invoices/reorderSellItems', { value : paramiters}, function () {
                    InvoicePrintPageManager.viewReadyInvoicesSellItems();
                });


            }
        });
    }
}


//print page
$(document).on('click', '#print-with-btn', function () {
    window.print();
    window.close();
});
//print page
$(document).on('click', '#print-without-btn', function () {
    document.getElementById('print-page-pad-header').style.display = 'none';
    document.getElementById('print-page-pad-footer').style.display = 'none';
    document.getElementById('print-page-pad-body').style.marginTop = '150px';
    window.print();
    window.close();
});
//close page
$(document).on('click', '#close-btn', function () {
    window.close();
});


