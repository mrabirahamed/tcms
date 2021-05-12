<?php
/* Smarty version 3.1.33, created on 2019-02-20 18:28:05
  from '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/invoices/index_p_ajax.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c6d47d5b0dd49_91110939',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fc3e1cf8ac1127abd1e670dac540070975326302' => 
    array (
      0 => '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/invoices/index_p_ajax.tpl',
      1 => 1550665591,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c6d47d5b0dd49_91110939 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="invoices-data-table">
    <table class="table table-condensed table-striped">
        <thead class="text-notify">
        <tr>
            <th class="text-align-center" style="width: 20px;">
                <label><input id="checkAll" type="checkbox" class="check_box"/></label>
            </th>
            <th class="text-align-center" style="width: 30px;">S/N</th>
            <th class="text-align-left" style="width: 200px;">Name</th>
            <th class="text-align-left" style="width: 100px;">Mob. Number</th>
            <th class="text-align-left" style="width: 200px;">Items</th>
            <th class="text-align-center" style="width: 100px;">Total price</th>
            <th class="text-align-center" style="width: 130px;">Date</th>
            <th class="text-align-center" style="width: 80px;">Invoice</th>
            <th class="text-align-center" style="width: 120px;">Action</th>
        </tr>
        </thead>
        <tbody id="invoices-data">
        <?php if (isset($_smarty_tpl->tpl_vars['invoices']->value) && count($_smarty_tpl->tpl_vars['invoices']->value)) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['invoices']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
                <tr>
                    <td class="text-align-center">
                        <label>
                            <input type="checkbox" id="invoice-select" class="check_box"
                                   data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-clntFlNm="<?php echo $_smarty_tpl->tpl_vars['data']->value['clientId'];?>
"
                                   data-clntCntctNmbr="<?php echo $_smarty_tpl->tpl_vars['data']->value['client_mobile_number'];?>
"
                                   data-clientAddress="<?php echo $_smarty_tpl->tpl_vars['data']->value['client_address'];?>
"
                                   data-slsMn="<?php echo $_smarty_tpl->tpl_vars['data']->value['salesman'];?>
"/>
                        </label>
                    </td>
                    <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['serialNumber'];?>
</td>
                    <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['data']->value['client_name'];?>
</td>
                    <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['data']->value['client_mobile_number'];?>
</td>
                    <td class="text-align-left">

                        <?php if (isset($_smarty_tpl->tpl_vars['data']->value['sell_items']) && count($_smarty_tpl->tpl_vars['data']->value['sell_items'])) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['sell_items'], 'dsi');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['dsi']->value) {
?>
                                <?php echo $_smarty_tpl->tpl_vars['dsi']->value['brandName'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['dsi']->value['itemName'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['dsi']->value['model'];?>
&nbsp;
                                <br/>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php } else { ?>No item exists.
                        <?php }?>
                    </td>
                    <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['sold_total_price'];?>
</td>
                    <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['invoice_created_time'];?>
</td>
                    <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
</td>
                    <td class="text-align-center">
                        <a href="javascript:void(0);" id="invoice-print-btn"
                           class="button button-xs button-primary" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"> <i
                                    class="fas fa-print"></i></a>&nbsp;
                        <a href="javascript:void(0);" id="invoice-edit-btn"
                           class="button button-xs button-success" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"
                           data-clntFlNm="<?php echo $_smarty_tpl->tpl_vars['data']->value['clientId'];?>
"
                           data-clntCntctNmbr="<?php echo $_smarty_tpl->tpl_vars['data']->value['client_mobile_number'];?>
"
                           data-clientAddress="<?php echo $_smarty_tpl->tpl_vars['data']->value['client_address'];?>
"
                           data-slsMn="<?php echo $_smarty_tpl->tpl_vars['data']->value['salesman'];?>
">&nbsp;<i class="far fa-edit"></i></a>&nbsp;
                        <a href="javascript:void(0);" id="invoice-delete-btn"
                           class="button button-xs button-danger" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"><i
                                    class="far fa-trash-alt"></i></i></a>
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
            <th class="text-align-center" style="width: 30px;">S/N</th>
            <th class="text-align-left" style="width: 200px;">Name</th>
            <th class="text-align-left" style="width: 100px;">Mob. Number</th>
            <th class="text-align-left" style="width: 200px;">Items</th>
            <th class="text-align-center" style="width: 100px;">Total price</th>
            <th class="text-align-center" style="width: 130px;">Date</th>
            <th class="text-align-center" style="width: 80px;">Invoice</th>
            <th class="text-align-center" style="width: 120px;">Action</th>
        </tr>
        </tfoot>
    </table>
    <?php echo (($tmp = @$_smarty_tpl->tpl_vars['pagination']->value)===null||$tmp==='' ? '' : $tmp);?>

</div><?php }
}
