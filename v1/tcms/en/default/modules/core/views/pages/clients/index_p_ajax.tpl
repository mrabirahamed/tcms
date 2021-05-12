<div id="clients-data-table">
    <table class="table table-condensed table-striped">
        <thead class="text-notify">
        <tr>
            <th class="text-align-center" style="width: 20px;">
                <label><input id="checkAll" type="checkbox" class="check_box"/></label>
            </th>
            <th class="text-align-center" style="width: 30px;">S/N</th>
            <th class="text-align-left" style="width: 250px;">Name</th>
            <th class="text-align-left" style="width: 100px;">Mob. Number</th>
            <th class="text-align-left" style="width: 250px;">Address</th>
            <th class="text-align-center" style="width: 80px;">Action</th>
        </tr>
        </thead>
        <tbody id="clients-data">
        {if isset($clients) && count($clients)}
            {foreach item = data  from = $clients}
                <tr>
                    <td class="text-align-center">
                        <label>
                            <input type="checkbox" id="clients-select" class="check_box" data-id="{$data.id}" data-name="{$data.name}"
                                   data-mobile-number="{$data.mobile_number}" data-address="{$data.address}"/>
                        </label>
                    </td>
                    <td class="text-align-center">{$data.serialNumber}</td>
                    <td class="text-align-left">{$data.name}</td>
                    <td class="text-align-left">{$data.mobile_number}</td>
                    <td class="text-align-left">{$data.address}</td>
                    <td class="text-align-center">
                        <a href="javascript:void(0);" id="clients-edit-btn" class="button button-xs button-success" data-id="{$data.id}" data-name="{$data.name}"
                           data-mobile-number="{$data.mobile_number}" data-address="{$data.address}"> <i class="far fa-edit"></i></a>&nbsp;&nbsp;
                        <a href="javascript:void(0);" id="clients-delete-btn" class="button button-xs button-danger" data-id="{$data.id}"><i class="far fa-trash-alt"></i></i></a>
                    </td>
                </tr>
            {/foreach}
        {/if}
        </tbody>
        <tfoot class="text-notify">
        <tr>
        <tr>
            <th class="text-align-center" style="width: 20px;">
                <label><input id="checkAll" type="checkbox" class="check_box"/></label>
            </th>
            <th class="text-align-center" style="width: 30px;">S/N</th>
            <th class="text-align-left" style="width: 250px;">Name</th>
            <th class="text-align-left" style="width: 100px;">Mob. Number</th>
            <th class="text-align-left" style="width: 250px;">Address</th>
            <th class="text-align-center" style="width: 80px;">Action</th>
        </tr>
        </tfoot>
    </table>
    {$pagination|default:""}
</div>