<?php
/* Smarty version 3.1.33, created on 2019-02-23 11:15:52
  from '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/appmanager/r_permissions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c70d7080539c7_19750556',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4ca368e2beaab99bf564467d9d760e4a4401b7e4' => 
    array (
      0 => '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/appmanager/r_permissions.tpl',
      1 => 1550383293,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c70d7080539c7_19750556 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row" style="margin: 5px;">
    <div style="margin: 0 auto; width: 700px;">
        <fieldset class="box-shadow-light">
            <legend class="box-shadow-light"> Role : <?php if (isset($_smarty_tpl->tpl_vars['role']->value) && count($_smarty_tpl->tpl_vars['role']->value)) {?> <?php echo $_smarty_tpl->tpl_vars['role']->value['role'];
}?></legend>
            <div class="row">
                <div id="message"> <!-- only javascipt show message --> </div>
                <div class="row">
                    <table class="table">
                        <tr>
                            <td>
                                <a href="javascript:void(0);" onclick="window.location = _root_ + 'appmanager/roles'"
                                   class="button button-danger float-left">
                                    <i class="fas fa-arrow-left" aria-hidden="true"></i> Back
                                </a>
                            </td>
                        </tr>
                    </table>

                    <div id="permissions-data-table">
                        <table class="table table-condensed table-striped">
                            <thead class="text-notify">
                            <tr>
                                <th class="text-align-center"> Id</th>
                                <th class="text-align-left"> Permission</th>
                                <th class="text-align-left"> Key</th>
                                <th class="text-align-center"> PKID</th>
                                <th class="text-align-center"> Status</th>
                                <th class="text-align-center"> Enable</th>
                                <th class="text-align-center"> Reject</th>
                                <th class="text-align-center"> Ignore</th>
                            </tr>
                            </thead>
                            <tbody id="permissions-data2">
                            <?php if (isset($_smarty_tpl->tpl_vars['rolePermissions']->value) && count($_smarty_tpl->tpl_vars['rolePermissions']->value)) {?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rolePermissions']->value, 'rlprm');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['rlprm']->value) {
?>
                                    <tr>
                                        <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['rlprm']->value['id'];?>
</td>
                                        <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['rlprm']->value['name'];?>
</td>
                                        <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['rlprm']->value['key'];?>
</td>
                                        <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['rlprm']->value['PKID'];?>
</td>
                                        <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['rlprm']->value['value'];?>
</td>
                                        <td class="text-align-center">
                                            <label><input id="rlprmValue" type="radio" data-roleid="<?php echo $_smarty_tpl->tpl_vars['role']->value['id_role'];?>
"
                                                          data-permissionid="<?php echo $_smarty_tpl->tpl_vars['rlprm']->value['id'];?>
"
                                                          data-value="1" <?php if ($_smarty_tpl->tpl_vars['rlprm']->value['value'] === 1) {?> checked <?php }?>/></label>
                                        </td>
                                        <td class="text-align-center">
                                            <label><input id="rlprmValue" type="radio" data-roleid="<?php echo $_smarty_tpl->tpl_vars['role']->value['id_role'];?>
"
                                                          data-permissionid="<?php echo $_smarty_tpl->tpl_vars['rlprm']->value['id'];?>
"
                                                          data-value="0" <?php if ($_smarty_tpl->tpl_vars['rlprm']->value['value'] === 0) {?> checked <?php }?>/></label>
                                        </td>
                                        <td class="text-align-center">
                                            <label><input id="rlprmValue" type="radio" data-roleid="<?php echo $_smarty_tpl->tpl_vars['role']->value['id_role'];?>
"
                                                          data-permissionid="<?php echo $_smarty_tpl->tpl_vars['rlprm']->value['id'];?>
"
                                                          data-value="x" <?php if ($_smarty_tpl->tpl_vars['rlprm']->value['value'] === 'x') {?> checked <?php }?>/></label>
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
                                <th class="text-align-center"> Id</th>
                                <th class="text-align-left"> Permission</th>
                                <th class="text-align-left"> Key</th>
                                <th class="text-align-center"> PKID</th>
                                <th class="text-align-center"> Status</th>
                                <th class="text-align-center"> Enable</th>
                                <th class="text-align-center"> Reject</th>
                                <th class="text-align-center"> Ignore</th>
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
