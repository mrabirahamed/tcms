<?php
/* Smarty version 3.1.33, created on 2019-02-20 16:29:52
  from '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/productdetails/index_p_ajax.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c6d2c2009c803_83432327',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ea9cc94fa18899dd176c5ef14d51ea8f1e145be1' => 
    array (
      0 => '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/productdetails/index_p_ajax.tpl',
      1 => 1550658580,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c6d2c2009c803_83432327 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="productdetails-data-table">
    <table class="table table-condensed table-striped">
        <thead class="text-notify">
        <tr>
            <th class="text-align-center" style="width: 20px;">
                <label><input id="checkAll" type="checkbox" class="check_box"/></label>
            </th>
            <th class="text-align-center" style="width: 30px;">S/N</th>
            <th class="text-align-left">Item</th>
            <th class="text-align-left">Brand</th>
            <th class="text-align-left">Model</th>
            <th class="text-align-center">Serial</th>
            <th class="text-align-center">Unit Price</th>
            <th class="text-align-center">warrenty</th>
            <th class="text-align-center">ability</th>
            <th class="text-align-center" style="width: 80px;">Action</th>
        </tr>
        </thead>
        <tbody id="productdetails-data">
        <?php if (isset($_smarty_tpl->tpl_vars['product_details']->value) && count($_smarty_tpl->tpl_vars['product_details']->value)) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_details']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
                <tr>
                    <td class="text-align-center">
                        <label><input type="checkbox" id="productdetails-select" class="check_box" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-prd-detls-item="<?php echo $_smarty_tpl->tpl_vars['data']->value['itemId'];?>
" data-prd-detls-brand="<?php echo $_smarty_tpl->tpl_vars['data']->value['brandId'];?>
" data-modelNumber="<?php echo $_smarty_tpl->tpl_vars['data']->value['model'];?>
" data-serialNumber="<?php echo $_smarty_tpl->tpl_vars['data']->value['serial'];?>
" data-unitPrice="<?php echo $_smarty_tpl->tpl_vars['data']->value['price'];?>
" data-warrantyTime="<?php echo $_smarty_tpl->tpl_vars['data']->value['warrenty'];?>
" data-ability="<?php echo $_smarty_tpl->tpl_vars['data']->value['ability'];?>
"/></label></td>
                    </td>
                    <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['serialNumber'];?>
</td>
                    <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['data']->value['item'];?>
</td>
                    <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['data']->value['brand'];?>
</td>
                    <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['data']->value['model'];?>
</td>
                    <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['data']->value['serial'];?>
</td>
                    <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['price'];?>
</td>
                    <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['warrenty'];?>
</td>
                    <td class="text-align-center">
                        <?php if (($_smarty_tpl->tpl_vars['data']->value['ability'] === 'available')) {?><a href="javascript:void(0)" id="changeProductDetailAbility" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-curent_status="<?php echo $_smarty_tpl->tpl_vars['data']->value['ability'];?>
" class="button button-xs button-success" title="Click to make unavailable"><i class="far fa-check-circle"></i></a><?php } else { ?><a href="javascript:void(0)" id="changeProductDetailAbility" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-curent_status="<?php echo $_smarty_tpl->tpl_vars['data']->value['ability'];?>
" class="button button-xs button-danger" title="Click to make available"><i class="far fa-times-circle"></i></a><?php }?>
                    </td>
                    <td class="text-align-center">
                        <a href="javascript:void(0);" id="productdetails-edit-btn" class="button button-xs button-success" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-prd-detls-item="<?php echo $_smarty_tpl->tpl_vars['data']->value['itemId'];?>
" data-prd-detls-brand="<?php echo $_smarty_tpl->tpl_vars['data']->value['brandId'];?>
" data-modelNumber="<?php echo $_smarty_tpl->tpl_vars['data']->value['model'];?>
" data-serialNumber="<?php echo $_smarty_tpl->tpl_vars['data']->value['serial'];?>
" data-unitPrice="<?php echo $_smarty_tpl->tpl_vars['data']->value['price'];?>
" data-warrantyTime="<?php echo $_smarty_tpl->tpl_vars['data']->value['warrenty'];?>
" data-ability="<?php echo $_smarty_tpl->tpl_vars['data']->value['ability'];?>
"> <i class="far fa-edit"></i></a>&nbsp;&nbsp;
                        <a href="javascript:void(0);" id="productdetails-delete-btn" class="button button-xs button-danger" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
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
            <th class="text-align-center">
                <label><input id="checkAll" type="checkbox" class="check_box"/></label>
            </th>
            <th class="text-align-center">S/N</th>
            <th class="text-align-left">Item</th>
            <th class="text-align-left">Brand</th>
            <th class="text-align-left">Model</th>
            <th class="text-align-center">Serial</th>
            <th class="text-align-center">Unit Price</th>
            <th class="text-align-center">warrenty</th>
            <th class="text-align-center">ability</th>
            <th class="text-align-center" style="width: 80px;">Action</th>
        </tr>
        </tfoot>
    </table>
    <?php echo (($tmp = @$_smarty_tpl->tpl_vars['pagination']->value)===null||$tmp==='' ? '' : $tmp);?>

</div><?php }
}
