<?php
/* Smarty version 3.1.33, created on 2019-02-21 00:05:50
  from '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/appmanager/permissions_p_ajax.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c6d96fe882c00_15349844',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8261a77b1421c2090135f7325cda443919c204de' => 
    array (
      0 => '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/appmanager/permissions_p_ajax.tpl',
      1 => 1550383291,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c6d96fe882c00_15349844 (Smarty_Internal_Template $_smarty_tpl) {
?><table class="table table-condensed table-striped">
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

<?php echo (($tmp = @$_smarty_tpl->tpl_vars['pagination']->value)===null||$tmp==='' ? '' : $tmp);
}
}
