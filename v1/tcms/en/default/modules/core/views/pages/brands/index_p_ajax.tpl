<div id="brands-data-table">
    <table class="table table-condensed table-striped">
        <thead class="text-notify">
        <tr>
            <th class="text-align-center" style="width: 20px;">
                <label><input id="checkAll" type="checkbox" class="check_box"/></label>
            </th>
            <th class="text-align-center" style="width: 30px;">S/N</th>
            <th class="text-align-left">Name</th>
            <th class="text-align-center" style="width: 80px;">Action</th>
        </tr>
        </thead>
        <tbody id="brands-data">
        {if isset($brands) && count($brands)}
            {foreach item = data  from = $brands}
                <tr>
                    <td class="text-align-center">
                        <label><input type="checkbox" id="brand-select" class="check_box" data-id="{$data.id}" data-name="{$data.name}"/></label>
                    </td>
                    <td class="text-align-center">{$data.serialNumber}</td>
                    <td class="text-align-left">{$data.name}</td>
                    <td class="text-align-center">
                        <a href="javascript:void(0);" id="brand-edit-btn" class="button button-xs button-success" data-id="{$data.id}" data-name="{$data.name}">&nbsp;<i class="far fa-edit"></i></i></a>&nbsp;&nbsp;
                        <a href="javascript:void(0);" id="brand-delete-btn" class="button button-xs button-danger" data-id="{$data.id}"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            {/foreach}
        {/if}
        </tbody>
        <tfoot class="text-notify">
        <tr>
            <th class="text-align-center">
                <label><input id="checkAll" type="checkbox" class="check_box"/></label>
            </th>
            <th class="text-align-center">S/N</th>
            <th class="text-align-left">Name</th>
            <th class="text-align-center" style="width: 80px;">Action</th>
        </tr>
        </tfoot>
    </table>
    {$pagination|default:""}
</div>