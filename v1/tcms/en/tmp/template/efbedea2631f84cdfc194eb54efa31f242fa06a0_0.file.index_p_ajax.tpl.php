<?php
/* Smarty version 3.1.33, created on 2019-02-20 14:59:15
  from '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/items/index_p_ajax.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c6d16e397db62_78072094',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'efbedea2631f84cdfc194eb54efa31f242fa06a0' => 
    array (
      0 => '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/items/index_p_ajax.tpl',
      1 => 1550653138,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c6d16e397db62_78072094 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="item-data-table">
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
        <?php if (isset($_smarty_tpl->tpl_vars['items']->value) && count($_smarty_tpl->tpl_vars['items']->value)) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
                <tr>
                    <td class="text-align-center">
                        <label><input type="checkbox" id="item-select" class="check_box" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
" data-c_status="<?php echo $_smarty_tpl->tpl_vars['data']->value['c_status'];?>
"/></label>
                    </td>
                    <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['serialNumber'];?>
</td>
                    <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
</td>
                    <td class="text-align-center">
                        <?php if (($_smarty_tpl->tpl_vars['data']->value['c_status'] === 'available')) {?><a href="javascript:void(0)" id="changeItemAbility" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-curent_status="<?php echo $_smarty_tpl->tpl_vars['data']->value['c_status'];?>
" class="button button-xs button-success" title="Click to make unavailable"><i class="far fa-check-circle"></i></a><?php } else { ?><a href="javascript:void(0)" id="changeItemAbility" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-curent_status="<?php echo $_smarty_tpl->tpl_vars['data']->value['c_status'];?>
" class="button button-xs button-danger" title="Click to make available"><i class="far fa-times-circle"></i></a><?php }?>
                    </td>
                    <td class="text-align-center">
                        <a href="javascript:void(0);" id="item-edit-btn" class="button button-xs button-success" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
" data-c_status="<?php echo $_smarty_tpl->tpl_vars['data']->value['c_status'];?>
"><i class="far fa-edit"></i></i></a>&nbsp;&nbsp;
                        <a href="javascript:void(0);" id="item-delete-btn" class="button button-xs button-danger" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
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
    <?php echo (($tmp = @$_smarty_tpl->tpl_vars['pagination']->value)===null||$tmp==='' ? '' : $tmp);?>

</div><?php }
}
