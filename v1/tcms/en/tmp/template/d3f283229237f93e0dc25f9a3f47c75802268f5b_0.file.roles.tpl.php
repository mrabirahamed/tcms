<?php
/* Smarty version 3.1.33, created on 2019-02-20 13:32:36
  from '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/appmanager/roles.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c6d0294563ae8_06623933',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd3f283229237f93e0dc25f9a3f47c75802268f5b' => 
    array (
      0 => '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/appmanager/roles.tpl',
      1 => 1550647172,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c6d0294563ae8_06623933 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row" style="margin: 5px;">
    <div style="margin: 0 auto; width: 400px;">
        <fieldset class="box-shadow-light">
            <legend class="box-shadow-light"> Roles</legend>
            <div class="row">
                <div id="message"> <!-- only javascipt show message --> </div>
                <div class="row">
                    <div id="modal01" class="modal">
                        <div class="row md-modal-content animate">
                            <div class="modal-header">
                                <span id="roleEditMode"> <!-- only javascipt show action status --> </span>&nbsp;role
                            </div>
                            <div class='modal-body'>
                                <div id="message2"> <!-- only javascipt show message --> </div>
                                <div id="roleEditPAD">
                                    <form name="form1" id="roleform1" method="post">
                                        <input id="roleID" type="hidden" value=""/>
                                        <table class="table table-condensed">
                                            <tr>
                                                <td>
                                                    Name:
                                                    <input id="roleName" type="text" class="input-control" value="" placeholder="New role name" maxlength="30"/>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <div class='row2 modal-footer'>
                                <a href="javascript:void(0);" onclick="Mishusoft.detectElement('modal01').style.display = 'none'" class="button button-danger float-left">Cancel</a>
                                <a href="javascript:void(0);" id="role-data-btn" class="button button-primary float-right">
                                    <!-- only javascipt show button name --> </a>
                                <a href="javascript:void(0);" id="role-reset-btn" class="button button-danger float-right">
                                    <!-- only javascipt show button name --> </a>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <tr>
                            <td>
                                <a href="javascript:void(0);" onclick="window.location = _root_ + 'appmanager'" class="button button-danger float-left">
                                    <i class="fas fa-arrow-left" aria-hidden="true"></i> Back
                                </a>
                            </td>
                            <td><a href="javascript:void(0);" id="role-add-btn" class="button button-success float-right">
                                    <i class="fas fa-plus-circle"></i> Add New</a></td>
                        </tr>
                    </table>
                    <div id="data-table">
                        <table class="table table-condensed table-striped">
                            <thead class="text-notify">
                            <tr>
                                <th class="text-align-center">
                                    <label><input id="checkAll" type="checkbox" class="check_box"/></label>
                                </th>
                                <th class="text-align-center">ID</th>
                                <th class="text-align-left">Role</th>
                                <th class="text-align-center">Permissions</th>
                                <th class="text-align-center">Action</th>
                            </tr>
                            </thead>
                            <tbody id="roles-data">
                                <tr><td class="text-align-center" colspan="5">Loading.......</td></tr>
                                <!-- only javascipt show action status -->
                            </tbody>
                            <tfoot class="text-notify">
                            <tr>
                                <th class="text-align-center">
                                    <label><input id="checkAll" type="checkbox" class="check_box"/></label>
                                </th>
                                <th class="text-align-center">ID</th>
                                <th class="text-align-left">Role</th>
                                <th class="text-align-center">Permissions</th>
                                <th class="text-align-center">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>
<?php }
}
