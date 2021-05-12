<?php
/* Smarty version 3.1.33, created on 2019-02-20 13:32:41
  from '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/appmanager/permissions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c6d029936a823_27158881',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8a18f5efa5d4262891cd6d828cff9cc96aec42ec' => 
    array (
      0 => '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/appmanager/permissions.tpl',
      1 => 1550647111,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c6d029936a823_27158881 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row" style="margin: 5px;">
    <div style="margin: 0 auto; width: 600px;">
        <fieldset class="box-shadow-light">
            <legend class="box-shadow-light"> Permissions</legend>
            <div class="row">
                <div id="message"> <!-- only javascipt show message --> </div>
                <div class="row">
                    <div id="modal01" class="modal">
                        <div class="row md-modal-content animate">
                            <div class="modal-header">
                                <span id="permissionEditMode"> <!-- only javascipt show action status --> </span>&nbsp;permission
                            </div>
                            <div class='modal-body'>
                                <div id="message2"> <!-- only javascipt show message --> </div>
                                <div id="permissionEditPAD">
                                    <form name="form1" id="permissionform1" method="post">
                                        <input id="permissionID" type="hidden" value=""/>
                                        <table class="table table-condensed">
                                            <tr>
                                                <td style="width: 50%;">
                                                    Name:
                                                    <input id="permissionName" type="text" class="input-control" placeholder="Permission's name" maxlength="30" />
                                                </td>
                                                <td style="width: 50%;">
                                                    Key:
                                                    <input id="permissionKey" type="text" class="input-control" placeholder="Permission key" maxlength="30"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">
                                                    PKID:
                                                    <input id="permissionPKID" type="text" class="input-control" placeholder="Permission key Id" maxlength="30"/>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <div class='row2 modal-footer'>
                                <a href="javascript:void(0);" onclick="Mishusoft.detectElement('modal01').style.display = 'none'" class="button button-danger float-left">Cancel</a>
                                <a href="javascript:void(0);" id="permission-data-btn" class="button button-primary float-right">
                                    <!-- only javascipt show button name --> </a>
                                <a href="javascript:void(0);" id="permission-reset-btn" class="button button-danger float-right">
                                    <!-- only javascipt show button name --> </a>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <tr>
                            <td>
                                <a href="javascript:void(0);" onclick="window.location = _root_ + 'appManager'" class="button button-danger float-left">
                                    <i class="fas fa-arrow-left" aria-hidden="true"></i> Back
                                </a>
                            </td>
                            <td><a href="javascript:void(0);" id="permission-add-btn" class="button button-success float-right">
                                    <i class="fas fa-plus-circle"></i> Add New</a></td>
                        </tr>
                    </table>
                    <div id="permissions-data-table">
                        <table class="table table-condensed table-striped">
                            <thead class="text-notify">
                            <tr>
                                <th class="text-align-center" style="width: 20px">
                                    <label><input id="checkAll" type="checkbox" class="check_box"/></label>
                                </th>
                                <th class="text-align-center" style="width: 20px">ID</th>
                                <th class="text-align-left">Name</th>
                                <th class="text-align-left">Key</th>
                                <th class="text-align-center">PKID</th>
                                <th class="text-align-center" style="width: 80px;">Action</th>
                            </tr>
                            </thead>
                            <tbody id="permissions-data2">
                            <?php if (isset($_smarty_tpl->tpl_vars['permissions']->value) && count($_smarty_tpl->tpl_vars['permissions']->value)) {?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['permissions']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
                                    <tr>
                                        <td class="text-align-center">
                                            <label>
                                                <input type="checkbox" id="permission-select" class="check_box" data-permissionID="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_permission'];?>
"
                                                       data-permissionName="<?php echo $_smarty_tpl->tpl_vars['data']->value['permission'];?>
" data-permissionKey="<?php echo $_smarty_tpl->tpl_vars['data']->value['key'];?>
" data-permissionPKID="<?php echo $_smarty_tpl->tpl_vars['data']->value['PKID'];?>
"/>
                                            </label>
                                        </td>
                                        <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['id_permission'];?>
</td>
                                        <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['data']->value['permission'];?>
</td>
                                        <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['data']->value['key'];?>
</td>
                                        <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['PKID'];?>
</td>
                                        <td class="text-align-center">
                                            <a href="javascript:void(0);" id="permission-edit-btn" class="button button-xs button-success" data-permissionID="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_permission'];?>
"
                                               data-permissionName="<?php echo $_smarty_tpl->tpl_vars['data']->value['permission'];?>
" data-permissionKey="<?php echo $_smarty_tpl->tpl_vars['data']->value['key'];?>
" data-permissionPKID="<?php echo $_smarty_tpl->tpl_vars['data']->value['PKID'];?>
"><i class="far fa-edit"></i></i></a>&nbsp;&nbsp;
                                            <a href="javascript:void(0);" id="permission-delete-btn" class="button button-xs button-danger" data-permissionID="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_permission'];?>
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
                                <th class="text-align-left">Name</th>
                                <th class="text-align-left">Key</th>
                                <th class="text-align-center">PKID</th>
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
