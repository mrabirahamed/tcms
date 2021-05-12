<div id="branch-data-table">
    <table class="table table-condensed table-striped">
        <thead class="text-notify">
        <tr>
            <th class="text-align-center">
                <label><input id="select_all" type="checkbox" class="check_box"/></label>
            </th>
            <th class="text-align-center">ID</th>
            <th class="text-align-left">Name</th>
            <th class="text-align-center">Status</th>
            <th class="text-align-center">Stuff</th>
            <th class="text-align-center">Action</th>
        </tr>
        </thead>
        <tbody id="branches-data">
        {if isset($branches) && count($branches)}
            {foreach item = data  from = $branches}
                <tr>
                    <td class="text-align-center">
                        <label>
                            <input type="checkbox" id="branches-select" class="check_box checkbox"
                                   data-branchesID="{$data.id}" data-name="{$data.name}"/>
                        </label>
                    </td>
                    <td class="text-align-center">{$data.id}</td>
                    <td class="text-align-left">{$data.name}</td>
                    <td class="text-align-center">{$data.status}</td>
                    <td class="text-align-center">{$data.name}</td>
                    <td class="text-align-center">
                        <a href="javascript:void(0);" id="branches-edit-btn" class="button button-xs button-success"
                           data-branchesID="{$data.id}" data-name="{$data.name}"><i class="far fa-edit"></i></i></a>&nbsp;&nbsp;
                        <a href="javascript:void(0);" id="branches-delete-btn" class="button button-xs button-danger"
                           data-branchesID="{$data.id}"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            {/foreach}

        {else}
            <tr>
                <td class="text-align-center" colspan="5"> No branch found.</td>
            </tr>
        {/if}
        {*<tr><td class="text-align-center" colspan="5">Loading.......</td></tr>*}
        <!-- only javascipt show action status -->
        </tbody>
        <tfoot class="text-notify">
        <tr>
            <th class="text-align-center">
                <label><input id="checkAll" type="checkbox" class="check_box"/></label>
            </th>
            <th class="text-align-center">ID</th>
            <th class="text-align-left">Name</th>
            <th class="text-align-center">Status</th>
            <th class="text-align-center">Stuff</th>
            <th class="text-align-center">Action</th>
        </tr>
        </tfoot>
    </table>
    {$pagination|default:""}
</div>