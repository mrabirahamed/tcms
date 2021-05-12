{if isset($data) && count($data)}
    {foreach item = d  from = $data}
        <table class="table table-condensed table-striped">
            <tr>
                <td class="text-align-center" colspan="9" style="font-size: 30px">
                    <u><b>Invoice/Bill</b></u><br/>
                </td>
            </tr>
            <tr>
                <td colspan="9"> &nbsp;</td>
            </tr>
            <tr>
                <td class="text-align-left" style="width:120px"><b>Invoice No</b></td>
                <td class="text-align-left">:</td>
                <td class="text-align-left" style="width:80px">{$d.id}</td>
                <td class="text-align-left" style="width:50px"><b>Dtate</b></td>
                <td class="text-align-left">:</td>
                <td class="text-align-left">{$d.invoice_created_time}</td>
                <td class="text-align-left" style="width:100px"><b>Salesman</b></td>
                <td class="text-align-left">:</td>
                <td class="text-align-left">{$d.salesman}</td>
            </tr>
            <tr>
                <td class="text-align-left" style="width:120px"><b>Customer Name</b></td>
                <td class="text-align-left">:</td>
                <td class="text-align-left" colspan="4">{$d.client_name}</td>
                <td class="text-align-left" style="width:100px"><b>Mobile</b></td>
                <td class="text-align-left">:</td>
                <td class="text-align-left">{$d.client_mobile_number}</td>
            </tr>
            <tr>
                <td class="text-align-left"><b>Address</b></td>
                <td class="text-align-left">:</td>
                <td class="text-align-left" colspan="7">{$d.client_address}</td>
            </tr>
            <tr>
                <td colspan="9">
                    <div style="width: 990px;height: 5px;border-bottom: 4px solid grey;position: absolute;"></div>
                    <br/>
                    <table class="table table-condensed table-striped table-bordered table-bordered-black"
                           style="border-color: black">
                        <tr>
                            <td class="text-align-center" style="width:30px">S/N</td>
                            <td class="text-align-left">Description</td>
                            <td class="text-align-center" style="width:50px">Qty</td>
                            <td class="text-align-center" style="width:100px">Unit price</td>
                            <td class="text-align-center" style="width:100px">Total price</td>
                        </tr>
                        {*$d|print_r*}
                        {if isset($d.sell_items) && count($d.sell_items)}
                            {foreach item = dsi  from = $d.sell_items}

                                <tr>
                                    <td class="text-align-center">
                                        {$dsi.serialNumber}
                                    </td>
                                    <td class="text-align-left">
                                        {$dsi.brandName}&nbsp;{$dsi.itemName}&nbsp;{$dsi.model}&nbsp; <br/>
                                        Serial:&nbsp;{$dsi.serial} <br/>
                                        Warranty:&nbsp;{$dsi.warrentyTime} days
                                    </td>
                                    <td class="text-align-center">{$dsi.quantity}</td>
                                    <td class="text-align-right">{$dsi.unitPrice}.00</td>
                                    <td class="text-align-right">{$dsi.totalPrice}.00</td>
                                </tr>
                            {/foreach}
                        {/if}

                        <tr>
                            <td class="text-align-left" colspan=3">In word: {$d.sold_total_price_text} Taka only</td>
                            <td class="text-align-right">Total:</td>
                            <td class="text-align-right"><span id="soldTotalPriceInNumber">{$d.sold_total_price}</span>.00
                            </td>
                        </tr>
                    </table>
                    <br/>
                    <div style="width: 990px;height: 5px;border-bottom: 4px solid grey;position: absolute;"></div>
                </td>
            </tr>
            <tr>
                <td colspan="9" class="text-align-center">
                    <table class="table table-condensed table-striped">
                        <tr>
                            <td class="text-align-center"><br/>&nbsp;..................................<br/><b>Customer
                                    Signature</b></td>
                            <td class="text-align-center"><br/>{$d.salesman}<br/>..................................<br/><b>Prepared
                                    by</b></td>
                            <td class="text-align-center"><br/>&nbsp;..................................<br/><b>Authorized
                                    Signature</b></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="9">Thanks for buying our goods. see you again.</td>
                {*<td colspan="2">Print:<span id="ct"></span></td>*}
            </tr>
            <tr id="cmd-btn-area">
                <td colspan="9" class="text-align-center">
                    <a href="javascript:void(0);" id="print-btn"
                       class="button button-success float-right">Print</a>
                    <a href="javascript:void(0);" id="close-btn"
                       class="button button-danger float-right">Close </a>
                </td>
            </tr>
            {*<tr><td></td></tr>*}
        </table>
    {/foreach}
{/if}


<style>
    .topnav, header, .footer {
        display: none;
    }

    @media print {
        body {
            margin-top: 100px;
        }
    }
</style>
<script>
    Mishusoft.detectElement('SoldPriceInText').innerHTML = Mishusoft.NumberToText(Mishusoft.detectElement('soldTotalPriceInNumber').innerHTML);
    //close page
    $(document).on('click', '#SoldPriceInTextBtn', function () {
        Mishusoft.detectElement('SoldPriceInText').innerHTML = Mishusoft.NumberToText(Mishusoft.detectElement('soldTotalPriceInNumber').innerHTML);
    });
</script>

