<div id="busers-data-table">
    <table class="table table-condensed table-striped">
        <thead class="text-notify">
        <tr>
            <th class="text-align-center"> S/N</th>
            <th class="text-align-left"> Name</th>
            <th class="text-align-left"> Role</th>
            <th class="text-align-left"> Email</th>
            <th class="text-align-center"> Activity</th>
            <th class="text-align-center"> Working time</th>
            <th class="text-align-center"> Action</th>
        </tr>
        </thead>
        <tbody id="busers-data">
        {if isset($users) && count($users)}
            {foreach item = usr  from = $users}
                <tr>
                    <td class="text-align-center">{$usr.serialNumber}</td>
                    <td class="text-align-left">{$usr.full_name}</td>
                    <td class="text-align-left">{$usr.role}</td>
                    <td class="text-align-left">{$usr.email}</td>
                    <td class="text-align-center">{$usr.activity}</td>
                    <td class="text-align-center">{$usr.working_time}</td>
                    <td class="text-align-center">
                        {if $branch.id === $usr.branch}
                            <button id="transferBranchStuff" class="button button-danger" type="button"
                                    data-user="{$usr.id}" data-branch="{$branch.id}" data-method="remove">Remove
                            </button>
                        {else}
                            <button id="transferBranchStuff" class="button button-primary" type="button"
                                    data-user="{$usr.id}" data-branch="{$branch.id}" data-method="add">Add
                            </button>
                        {/if}

                    </td>
                </tr>
            {/foreach}
        {else}
            <tr>
                <td class="text-align-center" colspan="7"> No user found.</td>
            </tr>
        {/if}
        <!--tr><td class="text-align-center" colspan="6">Loading.......</td></tr-->
        <!-- only javascript show action status -->
        </tbody>
        <tfoot class="text-notify">
        <tr>
            <th class="text-align-center"> S/N</th>
            <th class="text-align-left"> Name</th>
            <th class="text-align-left"> Role</th>
            <th class="text-align-left"> Email</th>
            <th class="text-align-center"> Activity</th>
            <th class="text-align-center"> Working time</th>
            <th class="text-align-center"> Action</th>
        </tr>
        </tfoot>
    </table>
    {$pagination|default:""}
</div>