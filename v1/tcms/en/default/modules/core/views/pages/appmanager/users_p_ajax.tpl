<div id="users-data-table">
    <table class="table table-condensed table-striped">
        <thead class="text-notify">
            <tr>
                <th class="text-align-center" style="width: 20px">
                    <label><input id="checkAll" type="checkbox" class="check_box"/></label>
                </th>
                <th class="text-align-center" style="width: 20px">ID</th>
                <th class="text-align-left">First name</th>
                <th class="text-align-left">Last name</th>
                <th class="text-align-center">Email addess</th>
                <th class="text-align-center">Password</th>
                <th class="text-align-center">Username</th>
                <th class="text-align-center">Activity</th>
                <th class="text-align-center">Role</th>
                <th class="text-align-center">Status</th>
                <th class="text-align-center">Code</th>
                <th class="text-align-center" style="width: 80px;">Action</th>
            </tr>
        </thead>
        <tbody id="users-data2">
            {if isset($users) && count($users)}
                {foreach item = data  from = $users}
                    <tr>
                        <td class="text-align-center">
                            <label>
                                <input type="checkbox" id="user-select" class="check_box" data-userID="{$data.id_user}"
                                       data-userFName="{$data.f_name}" data-userLName="{$data.l_name}" data-userEmail="{$data.email}" 
                                       data-userPassword="{Hash::passwordDecrypt($data.password)}" data-userUsername="{$data.username}" 
                                       data-userActivity="{$data.activity}" data-userRole="{$data.role}"/>
                            </label>
                        </td>
                        <td class="text-align-center">{$data.id}</td>
                        <td class="text-align-left">{$data.f_name}</td>
                        <td class="text-align-left">{$data.l_name}</td>
                        <td class="text-align-center">{$data.email}</td>
                        <td class="text-align-center">{Hash::passwordDecrypt($data.password)}</td>
                        <td class="text-align-center">{$data.username}</td>
                        <td class="text-align-center">{$data.activity}</td>
                        <td class="text-align-center">{$data.role}</td>
                        <td class="text-align-center">
                            {if ($data.status === 1)}<a href="javascript:void(0)" class="button button-success">Verifed</a>{else}<a href="javascript:void(0)" id="verfyUSER" class="button button-danger" data-userID="{$data.id}">Unverifed</a>{/if}
                        </td>
                        <td class="text-align-center">{$data.code}</td>
                        <td class="text-align-center">
                            <a href="javascript:void(0);" id="user-edit-btn" class="button button-xs button-success" data-userID="{$data.id}"
                               data-userFName="{$data.f_name}" data-userLName="{$data.l_name}" data-userEmail="{$data.email}"
                               data-userPassword="{Hash::passwordDecrypt($data.password)}" data-userUsername="{$data.username}"
                               data-userActivity="{$data.activity}" data-userRole="{$data.role}" data-userCode="{$data.code}" ><i class="far fa-edit"></i></a>&nbsp;&nbsp;
                            <a href="javascript:void(0);" id="user-delete-btn" class="button button-xs button-danger" data-userID="{$data.id}"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                {/foreach}
            {/if}
            <!--tr><td class="text-align-center" colspan="6">Loading.......</td></tr-->
            <!-- only javascipt show action status -->
        </tbody>
        <tfoot class="text-notify">
            <tr>
                <th class="text-align-center" style="width: 20px">
                    <label><input id="checkAll" type="checkbox" class="check_box"/></label>
                </th>
                <th class="text-align-center" style="width: 20px">ID</th>
                <th class="text-align-left">First name</th>
                <th class="text-align-left">Last name</th>
                <th class="text-align-center">Email addess</th>
                <th class="text-align-center">Password</th>
                <th class="text-align-center">Username</th>
                <th class="text-align-center">Activity</th>
                <th class="text-align-center">Role</th>
                <th class="text-align-center">Status</th>
                <th class="text-align-center">Code</th>
                <th class="text-align-center" style="width: 80px;">Action</th>
            </tr>
        </tfoot>
    </table>
    {$pagination|default:""}
</div>