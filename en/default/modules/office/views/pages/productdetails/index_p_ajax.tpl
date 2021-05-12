<div id="productdetails-data-table">
    <table class="table table-condensed table-striped">
        <thead class="text-notify">
        <tr>
            <th class="text-align-center" style="width: 20px;">
                <label><input id="checkAll" type="checkbox" class="check_box"/></label>
            </th>
            <th class="text-align-center" style="width: 30px;">S/N</th>
            <th class="text-align-left">Branch</th>
            <th class="text-align-left">Item</th>
            <th class="text-align-left">Brand</th>
            <th class="text-align-left">Model</th>
            <th class="text-align-center">Serial</th>
            <th class="text-align-center">Unit Price</th>
            <th class="text-align-center">warranty</th>
            <th class="text-align-center">ability</th>
            <th class="text-align-center" style="width: 80px;">Action</th>
        </tr>
        </thead>
        <tbody id="productdetails-data">
        {if isset($product_details) && count($product_details)}
            {foreach item = data  from = $product_details}
                <tr>
                    <td class="text-align-center">
                        <label>
                            <input type="checkbox" id="productdetails-select" class="check_box"
                                   data-id="{$data.id}" data-prd-detls-branch="{$data.branch}"
                                   data-prd-detls-item="{$data.itemId}"
                                   data-prd-detls-brand="{$data.brandId}"
                                   data-modelNumber="{$data.model}"
                                   data-serialNumber="{$data.serial}"
                                   data-unitPrice="{$data.price}"
                                   data-warrantyTime="{$data.warranty}"
                                   data-ability="{$data.ability}"/>
                        </label>
                    </td>
                    <td class="text-align-center">{$data.serialNumber}</td>
                    <td class="text-align-left">{$data.branch}</td>
                    <td class="text-align-left">{$data.item}</td>
                    <td class="text-align-left">{$data.brand}</td>
                    <td class="text-align-left">{$data.model}</td>
                    <td class="text-align-left">{$data.serial}</td>
                    <td class="text-align-center">{$data.price}</td>
                    <td class="text-align-center">{$data.warranty}</td>
                    <td class="text-align-center">
                        {if ($data.ability === 'available')}
                            <a href="javascript:void(0)" id="changeProductDetailAbility"
                               class="button button-xs button-success"
                               data-id="{$data.id}" data-curent_status="{$data.ability}"
                               title="Click to make unavailable">
                                <i class="far fa-check-circle"></i>
                            </a>
                        {else}
                            <a href="javascript:void(0)" id="changeProductDetailAbility"
                               class="button button-xs button-danger"
                               data-id="{$data.id}" data-curent_status="{$data.ability}"
                               title="Click to make available">
                                <i class="far fa-times-circle"></i>
                            </a>
                        {/if}
                    </td>
                    <td class="text-align-center">
                        <a href="javascript:void(0);" id="productdetails-edit-btn"
                           class="button button-xs button-success" data-id="{$data.id}"
                           data-prd-detls-branch="{$data.branch}"
                           data-prd-detls-item="{$data.itemId}"
                           data-prd-detls-brand="{$data.brandId}" data-modelNumber="{$data.model}"
                           data-serialNumber="{$data.serial}" data-unitPrice="{$data.price}"
                           data-warrantyTime="{$data.warranty}" data-ability="{$data.ability}"> <i
                                    class="far fa-edit"></i></a>&nbsp;&nbsp;
                        <a href="javascript:void(0);" id="productdetails-delete-btn"
                           class="button button-xs button-danger" data-id="{$data.id}"><i
                                    class="far fa-trash-alt"></i></i></a>
                    </td>
                </tr>
            {/foreach}
        {else}
            <tr>
                <td colspan="11" class="text-align-center"> No product exist.</td>
            </tr>
        {/if}
        </tbody>
        <tfoot class="text-notify">
        <tr>
            <th class="text-align-center">
                <label><input id="checkAll" type="checkbox" class="check_box"/></label>
            </th>
            <th class="text-align-center">S/N</th>
            <th class="text-align-left">Branch</th>
            <th class="text-align-left">Item</th>
            <th class="text-align-left">Brand</th>
            <th class="text-align-left">Model</th>
            <th class="text-align-center">Serial</th>
            <th class="text-align-center">Unit Price</th>
            <th class="text-align-center">warranty</th>
            <th class="text-align-center">ability</th>
            <th class="text-align-center" style="width: 80px;">Action</th>
        </tr>
        </tfoot>
    </table>
    {$pagination|default:""}
</div>