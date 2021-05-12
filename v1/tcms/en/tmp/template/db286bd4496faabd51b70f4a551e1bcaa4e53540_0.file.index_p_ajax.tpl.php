<?php
/* Smarty version 3.1.33, created on 2019-02-20 19:17:30
  from '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/clients/index_p_ajax.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c6d536a632547_61414935',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db286bd4496faabd51b70f4a551e1bcaa4e53540' => 
    array (
      0 => '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/clients/index_p_ajax.tpl',
      1 => 1550667503,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c6d536a632547_61414935 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="clients-data-table">
    <table class="table table-condensed table-striped">
        <thead class="text-notify">
        <tr>
            <th class="text-align-center" style="width: 20px;">
                <label><input id="checkAll" type="checkbox" class="check_box"/></label>
            </th>
            <th class="text-align-center" style="width: 30px;">S/N</th>
            <th class="text-align-left" style="width: 250px;">Name</th>
            <th class="text-align-left" style="width: 100px;">Mob. Number</th>
            <th class="text-align-left" style="width: 250px;">Address</th>
            <th class="text-align-center" style="width: 80px;">Action</th>
        </tr>
        </thead>
        <tbody id="clients-data">
        <?php if (isset($_smarty_tpl->tpl_vars['clients']->value) && count($_smarty_tpl->tpl_vars['clients']->value)) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['clients']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
                <tr>
                    <td class="text-align-center">
                        <label>
                            <input type="checkbox" id="clients-select" class="check_box" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
"
                                   data-mobile-number="<?php echo $_smarty_tpl->tpl_vars['data']->value['mobile_number'];?>
" data-address="<?php echo $_smarty_tpl->tpl_vars['data']->value['address'];?>
"/>
                        </label>
                    </td>
                    <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['serialNumber'];?>
</td>
                    <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
</td>
                    <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['data']->value['mobile_number'];?>
</td>
                    <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['data']->value['address'];?>
</td>
                    <td class="text-align-center">
                        <a href="javascript:void(0);" id="clients-edit-btn" class="button button-xs button-success" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
"
                           data-mobile-number="<?php echo $_smarty_tpl->tpl_vars['data']->value['mobile_number'];?>
" data-address="<?php echo $_smarty_tpl->tpl_vars['data']->value['address'];?>
"> <i class="far fa-edit"></i></a>&nbsp;&nbsp;
                        <a href="javascript:void(0);" id="clients-delete-btn" class="button button-xs button-danger" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"><i class="far fa-trash-alt"></i></i></a>
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
        <tr>
            <th class="text-align-center" style="width: 20px;">
                <label><input id="checkAll" type="checkbox" class="check_box"/></label>
            </th>
            <th class="text-align-center" style="width: 30px;">S/N</th>
            <th class="text-align-left" style="width: 250px;">Name</th>
            <th class="text-align-left" style="width: 100px;">Mob. Number</th>
            <th class="text-align-left" style="width: 250px;">Address</th>
            <th class="text-align-center" style="width: 80px;">Action</th>
        </tr>
        </tfoot>
    </table>
    <?php echo (($tmp = @$_smarty_tpl->tpl_vars['pagination']->value)===null||$tmp==='' ? '' : $tmp);?>

</div><?php }
}
