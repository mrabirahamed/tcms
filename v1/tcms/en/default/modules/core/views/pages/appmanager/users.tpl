<div class="row" style="margin: 5px;">
    <div style="margin: 0 auto; width: 100%;">
        <fieldset class="box-shadow-light">
            <legend class="box-shadow-light"> Users</legend>
            <div class="row">
                <div id="message"> <!-- only javascipt show message --> </div>
                <div class="row">
                    <div id="modal01" class="modal">
                        <div class="row md-modal-content animate">
                            <div class="modal-header">
                                <span id="userEditMode"></span> user
                            </div>
                            <div class='modal-body'>
                                <div id="message2"> <!-- only javascipt show message --> </div>
                                <div id="userEditPAD">
                                    <form name="userform1" id="userform1" method="post">
                                        <input id="userID" type="hidden" value=""/>
                                        <table class="table table-condensed">
                                            <tr>
                                                <td style="width: 50%;">
                                                    First Name:
                                                    <input id="userFName" type="text" class="input-control" placeholder="First name:" maxlength="30" />
                                                </td>
                                                <td style="width: 50%;">
                                                    Last Name:
                                                    <input id="userLName" type="text" class="input-control" placeholder="Last name" maxlength="30" />
                                                </td>
                                            <tr>
                                                <td colspan="2" style="width: 100%;">
                                                    Email:
                                                    <input id="userEmail" type="email" class="input-control" placeholder="Email address" maxlength="60" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">
                                                    Username:
                                                    <input id="userUsername" type="text" class="input-control" placeholder="Username" maxlength="30" autocomplete="stop" />
                                                </td>
                                                <td style="width: 50%;">
                                                    Password:
                                                    <input id="userPassword" type="password" class="input-control" placeholder="Password" maxlength="30" autocomplete="stop" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">
                                                    Role:
                                                    <select id="userRole" class="input-control" title="select">
                                                        <option value=""> -- select one -- </option>
                                                        {if isset($roles) && count($roles)}
                                                            {foreach item = rl  from = $roles}
                                                                <option value="{$rl.id_role}">{$rl.role}</option>
                                                            {/foreach}
                                                        {/if}
                                                    </select>
                                                </td>
                                                <td style="width: 50%;">
                                                    Activity:
                                                    <select id="userActivity" class="input-control" title="Activity">
                                                        <option value=""> -- select one -- </option>
                                                        <option value="active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <div class='row2 modal-footer'>
                                <a href="javascript:void(0);" onclick="Mishusoft.detectElement('modal01').style.display = 'none'" class="button button-danger float-left">Cancel</a>	
                                <a href="javascript:void(0);" id="user-data-btn" class="button button-primary float-right"> <!-- only javascipt show button name --> </a>
                                <a href="javascript:void(0);" id="user-reset-btn" class="button button-danger float-right"> <!-- only javascipt show button name --> </a>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <tr>
                            <td>
                                <a href="javascript:void(0);" onclick="window.location = _root_ + 'appmanager'" class="button button-danger">
                                    <i class="fas fa-arrow-left" aria-hidden="true"></i> Back
                                </a>
                            </td>
                            <td><a href="javascript:void(0);" id="user-add-btn" class="button button-success float-right"><i class="fas fa-user-plus"></i>&nbsp;New user</a></td>
                        </tr>
                    </table>
                    <div id="users-data-table">
                        <table class="table table-condensed table-striped table-xs">
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
                                                {if ($data.status === 1)}<a href="javascript:void(0)" class="button button-success">Verifed</a>{else}<a href="javascript:void(0)" id="verfyUSER" class="button button-danger" data-userID="{$data.id}" data-userCode="{$data.code}" >Unverifed</a>{/if}
                                            </td>
                                            <td class="text-align-center">{$data.r_date}</td>
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
                </div>
            </div>
        </fieldset>
    </div>
</div>