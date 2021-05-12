<div id="item-data-table">
    <table class="table table-condensed table-striped">
        <thead class="text-notify">
        <tr>
            <th class="text-align-center" style="width: 20px;">
                <label><input id="checkAll" type="checkbox" class="check_box"/></label>
            </th>
            <th class="text-align-center" style="width: 25px;">S/N</th>
            <th class="text-align-left">Name</th>
            <th class="text-align-center" style="width: 50px;">Ability</th>
            <th class="text-align-center" style="width: 80px;">Action</th>
        </tr>
        </thead>
        <tbody id="items-data2">
        {if isset($items) && count($items)}
            {foreach item = data  from = $items}
                <tr>
                    <td class="text-align-center">
                        <label><input type="checkbox" id="item-select" class="check_box" data-id="{$data.id}"
                                      data-name="{$data.name}" data-c_status="{$data.c_status}"/></label>
                    </td>
                    <td class="text-align-center">{$data.serialNumber}</td>
                    <td class="text-align-left">{$data.name}</td>
                    <td class="text-align-center">
                        {if ($data.c_status === 'available')}<a href="javascript:void(0)" id="changeItemAbility"
                                                                data-id="{$data.id}"
                                                                data-curent_status="{$data.c_status}"
                                                                class="button button-xs button-success"
                                                                title="Click to make unavailable"><i
                                    class="far fa-check-circle"></i></a>{else}<a href="javascript:void(0)"
                                                                                 id="changeItemAbility"
                                                                                 data-id="{$data.id}"
                                                                                 data-curent_status="{$data.c_status}"
                                                                                 class="button button-xs button-danger"
                                                                                 title="Click to make available"><i
                                    class="far fa-times-circle"></i></a>{/if}
                    </td>
                    <td class="text-align-center">
                        <a href="javascript:void(0);" id="item-edit-btn" class="button button-xs button-success"
                           data-id="{$data.id}" data-name="{$data.name}" data-c_status="{$data.c_status}"><i
                                    class="far fa-edit"></i></i></a>&nbsp;&nbsp;
                        <a href="javascript:void(0);" id="item-delete-btn" class="button button-xs button-danger"
                           data-id="{$data.id}"><i class="far fa-trash-alt"></i></a>
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
            <th class="text-align-center">Ability</th>
            <th class="text-align-center" style="width: 80px;">Action</th>
        </tr>
        </tfoot>
    </table>
    {$pagination|default:""}
</div>