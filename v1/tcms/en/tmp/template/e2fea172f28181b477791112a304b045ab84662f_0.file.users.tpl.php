<?php
/* Smarty version 3.1.33, created on 2019-02-20 13:50:56
  from '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/appmanager/users.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c6d06e0477c05_84114091',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e2fea172f28181b477791112a304b045ab84662f' => 
    array (
      0 => '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/appmanager/users.tpl',
      1 => 1550647154,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c6d06e0477c05_84114091 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row" style="margin: 5px;">
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
                                                        <?php if (isset($_smarty_tpl->tpl_vars['roles']->value) && count($_smarty_tpl->tpl_vars['roles']->value)) {?>
                                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['roles']->value, 'rl');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['rl']->value) {
?>
                                                                <option value="<?php echo $_smarty_tpl->tpl_vars['rl']->value['id_role'];?>
"><?php echo $_smarty_tpl->tpl_vars['rl']->value['role'];?>
</option>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                        <?php }?>
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
                                <?php if (isset($_smarty_tpl->tpl_vars['users']->value) && count($_smarty_tpl->tpl_vars['users']->value)) {?>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['users']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
                                        <tr>
                                            <td class="text-align-center">
                                                <label>
                                                    <input type="checkbox" id="user-select" class="check_box" data-userID="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_user'];?>
"
                                                   data-userFName="<?php echo $_smarty_tpl->tpl_vars['data']->value['f_name'];?>
" data-userLName="<?php echo $_smarty_tpl->tpl_vars['data']->value['l_name'];?>
" data-userEmail="<?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
" 
                                                   data-userPassword="<?php echo Hash::passwordDecrypt($_smarty_tpl->tpl_vars['data']->value['password']);?>
" data-userUsername="<?php echo $_smarty_tpl->tpl_vars['data']->value['username'];?>
" 
                                                   data-userActivity="<?php echo $_smarty_tpl->tpl_vars['data']->value['activity'];?>
" data-userRole="<?php echo $_smarty_tpl->tpl_vars['data']->value['role'];?>
"/>
                                                </label>
                                            </td>
                                            <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
</td>
                                            <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['data']->value['f_name'];?>
</td>
                                            <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['data']->value['l_name'];?>
</td>
                                            <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
</td>
                                            <td class="text-align-center"><?php echo Hash::passwordDecrypt($_smarty_tpl->tpl_vars['data']->value['password']);?>
</td>
                                            <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['username'];?>
</td>
                                            <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['activity'];?>
</td>
                                            <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['role'];?>
</td>
                                            <td class="text-align-center">
                                                <?php if (($_smarty_tpl->tpl_vars['data']->value['status'] === 1)) {?><a href="javascript:void(0)" class="button button-success">Verifed</a><?php } else { ?><a href="javascript:void(0)" id="verfyUSER" class="button button-danger" data-userID="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-userCode="<?php echo $_smarty_tpl->tpl_vars['data']->value['code'];?>
" >Unverifed</a><?php }?>
                                            </td>
                                            <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['r_date'];?>
</td>
                                            <td class="text-align-center">
                                                <a href="javascript:void(0);" id="user-edit-btn" class="button button-xs button-success" data-userID="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"
                                                   data-userFName="<?php echo $_smarty_tpl->tpl_vars['data']->value['f_name'];?>
" data-userLName="<?php echo $_smarty_tpl->tpl_vars['data']->value['l_name'];?>
" data-userEmail="<?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
" 
                                                   data-userPassword="<?php echo Hash::passwordDecrypt($_smarty_tpl->tpl_vars['data']->value['password']);?>
" data-userUsername="<?php echo $_smarty_tpl->tpl_vars['data']->value['username'];?>
" 
                                                   data-userActivity="<?php echo $_smarty_tpl->tpl_vars['data']->value['activity'];?>
" data-userRole="<?php echo $_smarty_tpl->tpl_vars['data']->value['role'];?>
" data-userCode="<?php echo $_smarty_tpl->tpl_vars['data']->value['code'];?>
" ><i class="far fa-edit"></i></a>&nbsp;&nbsp;
                                                <a href="javascript:void(0);" id="user-delete-btn" class="button button-xs button-danger" data-userID="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                <?php }?>
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
                        <?php echo (($tmp = @$_smarty_tpl->tpl_vars['pagination']->value)===null||$tmp==='' ? '' : $tmp);?>

                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div><?php }
}
