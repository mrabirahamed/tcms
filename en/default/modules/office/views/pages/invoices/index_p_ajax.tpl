<div id="invoices-data-table">
    <table class="table table-condensed table-striped">
        <thead class="text-notify">
        <tr>
            <th class="text-align-center" style="width: 20px;">
                <label><input id="checkAll" type="checkbox" class="check_box"/></label>
            </th>
            <th class="text-align-center" style="width: 30px;">S/N</th>
            <th class="text-align-left" style="width: 100px;">Branch</th>
            <th class="text-align-left" style="width: 180px;">Name</th>
            <th class="text-align-left" style="width: 100px;">Mobile</th>
            <th class="text-align-left" style="width: 200px;">Items</th>
            <th class="text-align-center" style="width: 100px;">Total price</th>
            <th class="text-align-center" style="width: 100px;">Date</th>
            <th class="text-align-center" style="width: 80px;">Invoice</th>
            <th class="text-align-center" style="width: 120px;">Action</th>
        </tr>
        </thead>
        <tbody id="invoices-data">
        {if isset($invoices) && count($invoices)}
            {foreach item = data  from = $invoices}
                <tr>
                    <td class="text-align-center">
                        <label>
                            <input type="checkbox" id="invoice-select" class="check_box"
                                   data-id="{$data.id}" data-clntFlNm="{$data.clientId}"
                                   data-clntCntctNmbr="{$data.client_mobile_number}"
                                   data-clientAddress="{$data.client_address}"
                                   data-slsMn="{$data.salesman}"/>
                        </label>
                    </td>
                    <td class="text-align-center">{$data.serialNumber}</td>
                    <td class="text-align-left">{$data.branch_name}</td>
                    <td class="text-align-left">{$data.client_name}</td>
                    <td class="text-align-left">{$data.client_mobile_number}</td>
                    <td class="text-align-left">
                        {if isset($data.sell_items) && count($data.sell_items)}
                            {foreach item = dsi  from = $data.sell_items}
                                {$dsi.brandName}&nbsp;{$dsi.itemName}&nbsp;{$dsi.model}&nbsp;
                                <br/>
                            {/foreach}
                        {else}No item exists.
                        {/if}
                    </td>
                    <td class="text-align-center">{$data.sold_total_price}</td>
                    <td class="text-align-center">{$data.invoice_created_time}</td>
                    <td class="text-align-center">{$data.id}</td>
                    <td class="text-align-center">
                        <a href="javascript:void(0);" id="invoice-print-btn"
                           class="button button-xs button-primary" data-id="{$data.id}"> <i
                                    class="fas fa-print"></i></a>&nbsp;
                        <a href="javascript:void(0);" id="invoice-edit-btn"
                           class="button button-xs button-success" data-id="{$data.id}"
                           data-clntFlNm="{$data.clientId}"
                           data-clntCntctNmbr="{$data.client_mobile_number}"
                           data-clientAddress="{$data.client_address}"
                           data-slsMn="{$data.salesman}">&nbsp;<i class="far fa-edit"></i></a>&nbsp;
                        <a href="javascript:void(0);" id="invoice-delete-btn"
                           class="button button-xs button-danger" data-id="{$data.id}"><i
                                    class="far fa-trash-alt"></i></i></a>
                    </td>
                </tr>
            {/foreach}
        {else}
            <tr>
                <td colspan="10" class="text-align-center">
                    No invoice exist.
                </td>
            </tr>
        {/if}
        </tbody>
        <tfoot class="text-notify">
        <tr>
            <th class="text-align-center">
                <label><input id="checkAll" type="checkbox" class="check_box"/></label>
            </th>
            <th class="text-align-center" style="width: 30px;">S/N</th>
            <th class="text-align-left" style="width: 100px;">Branch</th>
            <th class="text-align-left" style="width: 180px;">Name</th>
            <th class="text-align-left" style="width: 100px;">Mobile</th>
            <th class="text-align-left" style="width: 200px;">Items</th>
            <th class="text-align-center" style="width: 100px;">Total price</th>
            <th class="text-align-center" style="width: 100px;">Date</th>
            <th class="text-align-center" style="width: 80px;">Invoice</th>
            <th class="text-align-center" style="width: 120px;">Action</th>
        </tr>
        </tfoot>
    </table>
    {$pagination|default:""}
</div>