<?php
/* Smarty version 3.1.33, created on 2019-02-22 12:34:23
  from '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/invoices/doprint.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c6f97efdf7ff3_81850488',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ba2aff56d273de1e2a7145db29932de62c64c55a' => 
    array (
      0 => '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/invoices/doprint.tpl',
      1 => 1550741604,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c6f97efdf7ff3_81850488 (Smarty_Internal_Template $_smarty_tpl) {
if (isset($_smarty_tpl->tpl_vars['data']->value) && count($_smarty_tpl->tpl_vars['data']->value)) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'd');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['d']->value) {
?>
        <table class="table table-condensed table-striped">
            <tr>
                <td class="text-align-center" colspan="9" style="font-size: 30px">
                    <u><b>Invoice/Bill</b></u><br/>
                </td>
            </tr>
            <tr>
                <td colspan="9"> &nbsp;</td>
            </tr>
            <tr>
                <td class="text-align-left" style="width:120px"><b>Invoice No</b></td>
                <td class="text-align-left">:</td>
                <td class="text-align-left" style="width:80px"><?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
</td>
                <td class="text-align-left" style="width:50px"><b>Dtate</b></td>
                <td class="text-align-left">:</td>
                <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['d']->value['invoice_created_time'];?>
</td>
                <td class="text-align-left" style="width:100px"><b>Salesman</b></td>
                <td class="text-align-left">:</td>
                <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['d']->value['salesman'];?>
</td>
            </tr>
            <tr>
                <td class="text-align-left" style="width:120px"><b>Customer Name</b></td>
                <td class="text-align-left">:</td>
                <td class="text-align-left" colspan="4"><?php echo $_smarty_tpl->tpl_vars['d']->value['client_name'];?>
</td>
                <td class="text-align-left" style="width:100px"><b>Mobile</b></td>
                <td class="text-align-left">:</td>
                <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['d']->value['client_mobile_number'];?>
</td>
            </tr>
            <tr>
                <td class="text-align-left"><b>Address</b></td>
                <td class="text-align-left">:</td>
                <td class="text-align-left" colspan="7"><?php echo $_smarty_tpl->tpl_vars['d']->value['client_address'];?>
</td>
            </tr>
            <tr>
                <td colspan="9">
                    <div style="width: 990px;height: 5px;border-bottom: 4px solid grey;position: absolute;"></div>
                    <br/>
                    <table class="table table-condensed table-striped table-bordered table-bordered-black"
                           style="border-color: black">
                        <tr>
                            <td class="text-align-center" style="width:30px">S/N</td>
                            <td class="text-align-left">Description</td>
                            <td class="text-align-center" style="width:50px">Qty</td>
                            <td class="text-align-center" style="width:100px">Unit price</td>
                            <td class="text-align-center" style="width:100px">Total price</td>
                        </tr>
                                                <?php if (isset($_smarty_tpl->tpl_vars['d']->value['sell_items']) && count($_smarty_tpl->tpl_vars['d']->value['sell_items'])) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['d']->value['sell_items'], 'dsi');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['dsi']->value) {
?>

                                <tr>
                                    <td class="text-align-center">
                                        <?php echo $_smarty_tpl->tpl_vars['dsi']->value['serialNumber'];?>

                                    </td>
                                    <td class="text-align-left">
                                        <?php echo $_smarty_tpl->tpl_vars['dsi']->value['brandName'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['dsi']->value['itemName'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['dsi']->value['model'];?>
&nbsp; <br/>
                                        Serial:&nbsp;<?php echo $_smarty_tpl->tpl_vars['dsi']->value['serial'];?>
 <br/>
                                        Warranty:&nbsp;<?php echo $_smarty_tpl->tpl_vars['dsi']->value['warrentyTime'];?>
 days
                                    </td>
                                    <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['dsi']->value['quantity'];?>
</td>
                                    <td class="text-align-right"><?php echo $_smarty_tpl->tpl_vars['dsi']->value['unitPrice'];?>
.00</td>
                                    <td class="text-align-right"><?php echo $_smarty_tpl->tpl_vars['dsi']->value['totalPrice'];?>
.00</td>
                                </tr>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php }?>

                        <tr>
                            <td class="text-align-left" colspan=3">In word: <?php echo $_smarty_tpl->tpl_vars['d']->value['sold_total_price_text'];?>
 Taka only</td>
                            <td class="text-align-right">Total:</td>
                            <td class="text-align-right"><span id="soldTotalPriceInNumber"><?php echo $_smarty_tpl->tpl_vars['d']->value['sold_total_price'];?>
</span>.00
                            </td>
                        </tr>
                    </table>
                    <br/>
                    <div style="width: 990px;height: 5px;border-bottom: 4px solid grey;position: absolute;"></div>
                </td>
            </tr>
            <tr>
                <td colspan="9" class="text-align-center">
                    <table class="table table-condensed table-striped">
                        <tr>
                            <td class="text-align-center"><br/>&nbsp;..................................<br/><b>Customer
                                    Signature</b></td>
                            <td class="text-align-center"><br/><?php echo $_smarty_tpl->tpl_vars['d']->value['salesman'];?>
<br/>..................................<br/><b>Prepared
                                    by</b></td>
                            <td class="text-align-center"><br/>&nbsp;..................................<br/><b>Authorized
                                    Signature</b></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="9">Thanks for buying our goods. see you again.</td>
                            </tr>
            <tr id="cmd-btn-area">
                <td colspan="9" class="text-align-center">
                    <a href="javascript:void(0);" id="print-btn"
                       class="button button-success float-right">Print</a>
                    <a href="javascript:void(0);" id="close-btn"
                       class="button button-danger float-right">Close </a>
                </td>
            </tr>
                    </table>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>


<style>
    .topnav, header, .footer {
        display: none;
    }

    @media print {
        body {
            margin-top: 100px;
        }
    }
</style>
<?php echo '<script'; ?>
>
    Mishusoft.detectElement('SoldPriceInText').innerHTML = Mishusoft.NumberToText(Mishusoft.detectElement('soldTotalPriceInNumber').innerHTML);
    //close page
    $(document).on('click', '#SoldPriceInTextBtn', function () {
        Mishusoft.detectElement('SoldPriceInText').innerHTML = Mishusoft.NumberToText(Mishusoft.detectElement('soldTotalPriceInNumber').innerHTML);
    });
<?php echo '</script'; ?>
>

<?php }
}
