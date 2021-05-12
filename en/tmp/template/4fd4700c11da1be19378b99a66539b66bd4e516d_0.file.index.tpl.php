<?php
/* Smarty version 3.1.33, created on 2019-05-29 12:16:39
  from '/home/mishusoft/public_html/releases/tcms/en/default/modules/office/views/pages/invoices/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5cee23c7ec4139_53385475',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4fd4700c11da1be19378b99a66539b66bd4e516d' => 
    array (
      0 => '/home/mishusoft/public_html/releases/tcms/en/default/modules/office/views/pages/invoices/index.tpl',
      1 => 1559110557,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cee23c7ec4139_53385475 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row" style="margin: 5px;">
    <div style="margin: 0 auto; width: 100%;">
        <fieldset class="box-shadow-light">
            <legend class="box-shadow-light">Invoices</legend>
            <div class="row">
                <div id="message"> <!-- only javascript show message --> </div>
                <div class="row">
                    <div id="modal01" class="modal">
                        <div class="row md-modal-content animate">
                            <div class="modal-header">
                                <span id="invoiceEditMode"> <!-- only javascript show action status --> </span>&nbsp;
                                <div id="newInvoiceNumber"> <!-- only javascript show message --> </div>
                            </div>
                            <div class='modal-body'>
                                <div id="message2"> <!-- only javascript show message --> </div>
                                <div id="invoiceEditPAD">
                                    <span class="text-danger">An asterisk (*) marked field must filled up.</span>
                                    <form name="form1" id="invoiceForm1" method="post">
                                        <input id="invoiceID" type="hidden" value=""/>
                                        <input id="invoiceBranchId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['branch']->value['id'];?>
"/>
                                        <input id="invoiceBranchName" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['branch']->value['name'];?>
"/>
                                        <div class="row">
                                            <fieldset class="box-shadow-light" id="client_zone">
                                                <legend class="box-shadow-light"><i class="far fa-user"></i> Client
                                                </legend>
                                                <div class="row">
                                                    <table class="table table-condensed">
                                                        <tr>
                                                            <td style="width: 30%;">
                                                                <label>
                                                                    Name:<span class="text-danger">(*)</span>
                                                                    <select id="clnt_fl_nm" class="input-control"
                                                                            title="Choose a Client's name from this select box">
                                                                        <option value=""> -- Select One --</option>
                                                                        <option value="addNew" id="clients-add-btn"
                                                                                title="Click to add new client"> New
                                                                            client
                                                                        </option>
                                                                        <!-- only javascript show option -->
                                                                    </select>
                                                                </label>
                                                            </td>
                                                            <td style="width: 30%;">
                                                                <label>
                                                                    Mobile/Phone Number:
                                                                    <input id="clnt_cntct_nmbr" type="text"
                                                                           class="input-control"
                                                                           title="Client's mobile number."
                                                                           placeholder="+8801234567890" readonly/>
                                                                </label>
                                                            </td>
                                                            <td style="width: 30%;">
                                                                <label>
                                                                    Salesman:                                                                    <input id="sls_mn" type="text" class="input-control"
                                                                           title="Salesman's name."
                                                                           placeholder="Salesman's name." readonly/>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3">
                                                                <label>
                                                                    Address:
                                                                    <textarea id="clnt_cntct_addrs"
                                                                              class="input-control"
                                                                              title="Client's address."
                                                                              placeholder="Client's address."
                                                                              readonly></textarea>
                                                                </label>
                                                            </td>
                                                        </tr>

                                                    </table>

                                                </div>
                                            </fieldset>
                                            <fieldset class="box-shadow-light" id="product_zone">
                                                <legend class="box-shadow-light"><i class="fas fa-clipboard-list"></i>
                                                    Item
                                                </legend>
                                                <div class="row">
                                                    <input id="sld-itm-id" type="hidden"/>
                                                    <table class="table table-condensed">
                                                        <tr>
                                                            <td style="width: 25%;">
                                                                <label>
                                                                    Item:<span class="text-danger">(*)</span>
                                                                    <select id="inv-prd-item" class="input-control"
                                                                            title="Choose a item from this select box">
                                                                        <option value=""> -- Select One</option>
                                                                        <option value="addNew"
                                                                                id="inv-prd-item-add-btn">
                                                                            New Item
                                                                        </option>
                                                                        <!-- only javascript show option -->
                                                                    </select>
                                                                </label>
                                                            </td>
                                                            <td style="width: 25%;">
                                                                <label>
                                                                    Brand:<span class="text-danger">(*)</span>
                                                                    <select id="inv-prd-brand" class="input-control"
                                                                            title="Choose a brand from this select box">
                                                                        <option value=""> -- Select One --</option>
                                                                        <!-- only javascript show option -->
                                                                    </select>
                                                                </label>
                                                            </td>
                                                            <td style="width: 25%;">
                                                                <label>
                                                                    Model:<span class="text-danger">(*)</span>
                                                                    <select id="inv-prd-modelNumber"
                                                                            class="input-control"
                                                                            title="Choose a model from this select box">
                                                                        <option value=""> -- Select One --</option>
                                                                        <!-- only javascript show option -->
                                                                    </select>
                                                                </label>
                                                            </td>
                                                            <td style="width: 25%;">
                                                                <label>
                                                                    Serial:
                                                                    <input id="inv-prd-serialNumber" type="text"
                                                                           class="input-control"
                                                                           placeholder="Serial number"
                                                                           maxlength="30" readonly/>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 25%;">
                                                                <LABEL>
                                                                    Warranty:
                                                                    <input id="inv-prd-warrantyTime" type="text"
                                                                           class="input-control"
                                                                           placeholder="Warranty (Days)" maxlength="30"
                                                                           readonly/>
                                                                </LABEL>
                                                            </td>
                                                            <td style="width: 25%;">
                                                                <label>
                                                                    Unit price:<span class="text-danger">(*)</span>
                                                                    <input id="inv-prd-unitPrice" type="text"
                                                                           class="input-control"
                                                                           placeholder="Unit price"
                                                                           maxlength="30" />
                                                                </label>
                                                            </td>
                                                            <td style="width: 25%;">
                                                                <label>
                                                                    Quantity:<span class="text-danger">(*)</span>
                                                                    <input id="inv-prd-quantity" type="text"
                                                                           class="input-control" placeholder="Quantity"
                                                                           maxlength="30"/>
                                                                </label>
                                                            </td>
                                                            <td style="width: 25%;">
                                                                <LABEL>
                                                                    Total price:
                                                                    <input id="inv-prd-TotalPrice" type="text"
                                                                           class="input-control"
                                                                           placeholder="Total price"
                                                                           maxlength="30" readonly/>
                                                                </LABEL>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 25%;">
                                                                <label>
                                                                    Discount:
                                                                    <input id="inv-prd-Discount" type="number"
                                                                           class="input-control" placeholder="Discount"
                                                                           maxlength="30" />
                                                                </label>
                                                            </td>
                                                            <td style="width: 25%;">
                                                                <label>
                                                                    Vat:
                                                                    <span style="display:inline">
                                                                        <input id="inv-prd-VAT" type="number"
                                                                           class="input-control" placeholder="VAT"
                                                                           maxlength="30" />%
                                                                    </span>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class='row2'>
                                                        <a href="javascript:void(0);" id="cart-add-btn"
                                                           class="button button-success float-right">
                                                            <!-- only javascript show button name --></a>
                                                        <a href="javascript:void(0);" id="cart-reset-btn"
                                                           class="button button-danger float-right">
                                                            <!-- only javascript show button name --> </a>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="box-shadow-light" id="ordered_product_zone">
                                                <legend class="box-shadow-light"><i class="fas fa-clipboard-list"></i>
                                                    Ordered
                                                </legend>
                                                <div class="row">
                                                    <table class="table table-condensed table-striped table-bordered">
                                                        <thead class="text-notify">
                                                        <tr>
                                                            <th class="text-align-center" style="width: 20px;">S/N</th>
                                                            <th class="text-align-left">Product details</th>
                                                            <th class="text-align-center" style="width: 40px;">Qty</th>
                                                            <th class="text-align-center" style="width: 80px;">Unit price</th>
                                                            <th class="text-align-center" style="width: 80px;">Total price</th>
                                                            <th class="text-align-center" style="width: 80px;">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="ordered_product_details">
                                                        <tr>
                                                            <td class="text-align-center" colspan="6">Loading.......
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                        <tbody id="ordered_product_total_area">
                                                        <tr style="border-top-style: solid; border-top-color: black">
                                                            <td class="text-align-center" style="width: 20px;">&nbsp;
                                                            </td>
                                                            <td class="text-align-left">&nbsp;</td>
                                                            <td class="text-align-center" style="width: 40px;">&nbsp;
                                                            </td>
                                                            <td class="text-align-right" style="width: 80px;">Total</td>
                                                            <td class="text-align-center" style="width: 80px;"><span
                                                                        id="ordered_product_total_price">0</span>.00
                                                            </td>
                                                            <td class="text-align-center" style="width: 80px;">&nbsp;
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                        <thead class="text-notify">
                                                        <tr>
                                                            <th class="text-align-center" style="width: 20px;">S/N</th>
                                                            <th class="text-align-left">Product details</th>
                                                            <th class="text-align-center" style="width: 40px;">Qty</th>
                                                            <th class="text-align-center" style="width: 80px;">Unit price</th>
                                                            <th class="text-align-center" style="width: 80px;">Total price</th>
                                                            <th class="text-align-center" style="width: 80px;">Action</th>
                                                        </tr>
                                                        </thead>
                                                    </table>

                                                </div>
                                            </fieldset>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div class='row2 modal-footer'>
                                <a href="javascript:void(0);" id="invoice-close-btn"
                                   class="button button-danger float-left">Cancel</a>
                                <a href="javascript:void(0);" id="popup-invoice-print-btn"
                                   class="button button-primary float-right">Print</a>
                                <a href="javascript:void(0);" id="invoice-data-btn"
                                   class="button button-success float-right">
                                    <!-- only javascript show button name --> </a>
                                <a href="javascript:void(0);" id="invoice-reset-btn"
                                   class="button button-danger float-right">
                                    <!-- only javascript show button name --> </a>
                            </div>
                        </div>
                    </div>

                    <!-- client dialog box -->
                    <div id="modal02" class="modal">
                        <div class="row md-modal-content animate">
                            <div class="modal-header">
                                <span id="clientsEditMode"> <!-- only javascript show action status --> </span>&nbsp;client
                            </div>
                            <div class='modal-body'>
                                <div id="message3"> <!-- only javascript show message --> </div>
                                <div id="clientsEditPAD">
                                    <span class="text-danger">An asterisk (*) marked field must filled up.</span>
                                    <form name="form1" id="ClientsForm1" method="post">
                                        <table class="table table-condensed">
                                            <tr>
                                                <td style="width: 50%;">
                                                    Name:<span class="text-danger">(*)</span>
                                                    <input id="fl_nm" type="text" class="input-control"
                                                           title="Client's name." placeholder="Client's name."/>
                                                </td>
                                                <td style="width: 50%;">
                                                    Mobile/Phone Number:<span class="text-danger">(*)</span>
                                                    <input id="cntct_nmbr" type="text" class="input-control"
                                                           title="Client's mobile number."
                                                           placeholder="Client's mobile number."/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    Address:<span class="text-danger">(*)</span>
                                                    <textarea id="cntct_addrs" class="input-control"
                                                              title="Client's address."
                                                              placeholder="Client's address."></textarea>
                                                </td>
                                            </tr>

                                        </table>
                                    </form>
                                </div>
                            </div>
                            <div class='row2 modal-footer'>
                                <a href="javascript:void(0);" id="clients-close-btn"
                                   class="button button-danger float-left">Cancel</a>
                                <a href="javascript:void(0);" id="clients-data-btn"
                                   class="button button-primary float-right">
                                    <!-- only javascript show button name --> </a>
                                <a href="javascript:void(0);" id="clients-reset-btn"
                                   class="button button-danger float-right">
                                    <!-- only javascript show button name --> </a>
                            </div>
                        </div>
                    </div>

                    <!-- item dialog box -->
                    <div id="modal03" class="modal">
                        <div class="row md-modal-content animate">
                            <div class="modal-header">
                                <span id="itemEditMode"> <!-- only javascript show action status --> </span>&nbsp;item
                            </div>
                            <div class='modal-body'>
                                <div id="message4"> <!-- only javascript show message --> </div>
                                <div id="itemEditPAD">
                                    <form name="form1" id="itemform1" method="post">
                                        <table class="table table-condensed">
                                            <tr>
                                                <td style="width: 50%;">
                                                    Name:
                                                    <input id="itemName" type="text" class="input-control" value=""
                                                           placeholder="Name" maxlength="30"/>
                                                </td>
                                                <td style="width: 50%;">
                                                    Current Status:
                                                    <select id="current_status" class="input-control"
                                                            title="Current Status">
                                                        <option value=""> -- select one --</option>
                                                        <option value="available"> Available</option>
                                                        <option value="unavailable"> Unavailable</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <div class='row2 modal-footer'>
                                <a href="javascript:void(0);" id="item-close-btn"
                                   class="button button-danger float-left">Cancel</a>
                                <a href="javascript:void(0);" id="item-data-btn"
                                   class="button button-primary float-right">
                                    <!-- only javascript show button name --> </a>
                                <a href="javascript:void(0);" id="item-reset-btn"
                                   class="button button-danger float-right">
                                    <!-- only javascript show button name --> </a>
                            </div>
                        </div>
                    </div>


                    <!-- start brand section -->
                    <div id="modal04" class="modal">
                        <div class="row md-modal-content animate">
                            <div class="modal-header">
                                <span id="brandEditMode"> <!-- only javascript show action status --> </span>&nbsp;brand
                            </div>
                            <div class='modal-body'>
                                <div id="message5"> <!-- only javascript show message --> </div>
                                <div id="brandEditPAD">
                                    <form name="form1" id="brandform1" method="post">
                                        <table class="table table-condensed">
                                            <tr>
                                                <td style="width: 50%;">
                                                    Name:
                                                    <input id="brandName" type="text" class="input-control" value=""
                                                           placeholder="Name" maxlength="30"/>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <div class='row2 modal-footer'>
                                <a href="javascript:void(0);" id="brand-close-btn"
                                   class="button button-danger float-left">Cancel</a>
                                <a href="javascript:void(0);" id="brand-data-btn"
                                   class="button button-primary float-right">
                                    <!-- only javascript show button name --> </a>
                                <a href="javascript:void(0);" id="brand-reset-btn"
                                   class="button button-danger float-right">
                                    <!-- only javascript show button name --> </a>
                            </div>
                        </div>
                    </div>

                                        <div id="modal05" class="modal">
                        <div class="row md-modal-content animate">
                            <div class="modal-header">
                                <span id="productdetailsEditMode"> <!-- only javascript show action status --> </span>&nbsp;product
                                details with price
                            </div>
                            <div class='modal-body'>
                                <div id="message6"> <!-- only javascript show message --> </div>
                                <div id="productdetailsEditPAD">
                                    <span class="text-danger">An asterisk (*) marked field must filled up.</span>
                                    <form name="form1" id="productdetailsform1" method="post">
                                        <input id="productdetailsID" type="hidden" value=""/>
                                        <table class="table table-condensed">
                                            <tr>
                                                <td style="width: 50%;">
                                                    Item:<span class="text-danger">(*)</span>
                                                    <select id="prd-detls-item" class="input-control"
                                                            title="Choose a item from this select box">
                                                        <option value=""> -- Select One</option>
                                                        <!-- only javascript show option -->
                                                    </select>
                                                </td>
                                                <td style="width: 50%;">
                                                    Brand:<span class="text-danger">(*)</span>
                                                    <select id="prd-detls-brand" class="input-control"
                                                            title="Choose a brand from this select box">
                                                        <option value=""> -- Select One --</option>
                                                        <!-- only javascript show option -->
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">
                                                    Model:<span class="text-danger">(*)</span>
                                                    <input id="modelNumber" type="text" class="input-control"
                                                           placeholder="Model number" maxlength="30"/>
                                                </td>
                                                <td style="width: 50%;">
                                                    Serial:
                                                    <input id="serialNumber" type="text" class="input-control"
                                                           placeholder="Serial number" maxlength="30"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">
                                                    Unit price:<span class="text-danger">(*)</span>
                                                    <input id="unitPrice" type="text" class="input-control"
                                                           placeholder="Unit price" maxlength="30"/>
                                                </td>
                                                <td style="width: 50%;">
                                                    Warranty:
                                                    <input id="warrantyTime" type="text" class="input-control"
                                                           placeholder="Warranty (Days)" maxlength="30"/>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <div class='row2 modal-footer'>
                                <a href="javascript:void(0);" id="productdetails-close-btn"
                                   class="button button-danger float-left">Cancel</a>
                                <a href="javascript:void(0);" id="productdetails-data-btn"
                                   class="button button-primary float-right">
                                    <!-- only javascript show button name --> </a>
                                <a href="javascript:void(0);" id="productdetails-reset-btn"
                                   class="button button-danger float-right">
                                    <!-- only javascript show button name --> </a>
                            </div>
                        </div>
                    </div>

                                        <div id="modal06" class="modal">
                        <div class="row modal-content animate">
                            <div class="modal-header">
                                Search
                            </div>
                            <div class='modal-body'>
                                <div id="message7"> <!-- only javascript show message --> </div>
                                <div id="invoice-search-edit-pad">
                                    <span class="text-danger">An asterisk (*) marked field must filled up.</span>
                                    <form name="form1" id="productdetailsform1" method="post">
                                        <table class="table table-condensed">
                                            <tr>
                                                <td style="width: 25%;">
                                                    Branch:
                                                    <select id="inv_srh_branch" class="input-control"
                                                            title="Choose a branch from this select box">
                                                        <option value=""> -- Select One</option>

                                                        <?php if (isset($_smarty_tpl->tpl_vars['branches']->value) && count($_smarty_tpl->tpl_vars['branches']->value)) {?>
                                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['branches']->value, 'brcs');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['brcs']->value) {
?>
                                                                <option value="<?php echo $_smarty_tpl->tpl_vars['brcs']->value['id'];?>
"> <?php echo $_smarty_tpl->tpl_vars['brcs']->value['name'];?>
 </option>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                        <?php }?>

                                                    </select>
                                                </td>
                                                <td style="width: 25%;">
                                                    Invoice no:
                                                    <input id="inv_srh_inv_id" type="number" class="input-control" step="1" max="999999999999" maxlength="10" value="">
                                                </td>
                                                <td style="width: 25%;">
                                                    Client Name:
                                                    <input id="inv_srh_clnt_nm" type="text" class="input-control" placeholder="Client name"
                                                           title="Please write client name here.">
                                                </td>
                                                <td style="width: 25%;">
                                                    Mobile Number:
                                                    <input id="inv_srh_clnt_nmbr" type="tel" class="input-control" placeholder="017234567891">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>

                                    <div style="width: 97%;height: 5px;border-bottom: 4px solid grey;"></div>
                                    <br>

                                    <div id="invoices-data-table">
                                        <table class="table table-condensed table-striped">
                                            <thead class="text-notify">
                                            <tr>
                                                <th class="text-align-center" style="width: 20px;">
                                                    <label><input id="checkAll" type="checkbox"
                                                                  class="check_box"/></label>
                                                </th>
                                                <th class="text-align-center" style="width: 30px;">S/N</th>
                                                <th class="text-align-left" style="width: 200px;">Name</th>
                                                <th class="text-align-left" style="width: 100px;">Mob. Number</th>
                                                <th class="text-align-center" style="width: 100px;">Total price</th>
                                                <th class="text-align-center" style="width: 130px;">Date</th>
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
                                                                <input type="checkbox" id="invoice-select"
                                                                       class="check_box"
                                                                       data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"
                                                                       data-clntFlNm="<?php echo $_smarty_tpl->tpl_vars['data']->value['clientId'];?>
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
                                                        <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['sold_total_price'];?>
</td>
                                                        <td class="text-align-center"><?php echo $_smarty_tpl->tpl_vars['data']->value['invoice_created_time'];?>
</td>
                                                        <td class="text-align-center">
                                                            <a href="javascript:void(0);" id="invoice-print-btn"
                                                               class="button button-xs button-primary"
                                                               data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"> <i
                                                                        class="fas fa-print"></i></a>&nbsp;
                                                            <a href="javascript:void(0);" id="invoice-edit-btn"
                                                               class="button button-xs button-success"
                                                               data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"
                                                               data-clntFlNm="<?php echo $_smarty_tpl->tpl_vars['data']->value['clientId'];?>
"
                                                               data-clntCntctNmbr="<?php echo $_smarty_tpl->tpl_vars['data']->value['client_mobile_number'];?>
"
                                                               data-clientAddress="<?php echo $_smarty_tpl->tpl_vars['data']->value['client_address'];?>
"
                                                               data-slsMn="<?php echo $_smarty_tpl->tpl_vars['data']->value['salesman'];?>
">&nbsp;<i
                                                                        class="far fa-edit"></i></a>&nbsp;
                                                            <a href="javascript:void(0);" id="invoice-delete-btn"
                                                               class="button button-xs button-danger"
                                                               data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
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
                                                    <label><input id="checkAll" type="checkbox"
                                                                  class="check_box"/></label>
                                                </th>
                                                <th class="text-align-center" style="width: 30px;">S/N</th>
                                                <th class="text-align-left" style="width: 200px;">Name</th>
                                                <th class="text-align-left" style="width: 100px;">Mob. Number</th>
                                                <th class="text-align-center" style="width: 100px;">Total price</th>
                                                <th class="text-align-center" style="width: 130px;">Date</th>
                                                <th class="text-align-center" style="width: 120px;">Action</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                        <?php echo (($tmp = @$_smarty_tpl->tpl_vars['pagination']->value)===null||$tmp==='' ? '' : $tmp);?>

                                    </div>
                                </div>
                            </div>
                            <div class='row2 modal-footer'>
                                <a href="javascript:void(0);" id="invoice-search-close-btn"
                                   class="button button-danger float-left">Cancel</a>
                                <a href="javascript:void(0);" id="invoice-search-data-btn"
                                   class="button button-primary float-right">
                                    <!-- only javascript show button name --> </a>
                                <a href="javascript:void(0);" id="invoice-search-reset-btn"
                                   class="button button-danger float-right">
                                    <!-- only javascript show button name --> </a>
                            </div>
                        </div>
                    </div>

                    <div id="PopUpDialogBox" class="modal">
                        <div class="row md-modal-content animate">
                            <div class="modal-header">
                                <span id="PopUpDialogBoxTitle"> <!-- only javascript show action status --> </span>
                            </div>
                            <div class='modal-body'>
                                <div id="PopUpDialogBoxMessage"> <!-- only javascript show message --> </div>
                            </div>
                            <div class='row2 modal-footer'>
                                <a href="javascript:void(0);" id="message-done-btn"
                                   class="button button-primary float-right">
                                    <!-- only javascript show button name --> </a>
                                <a href="javascript:void(0);"
                                   onclick="Mishusoft.detectElement('PopUpDialogBox').style.display = 'none'"
                                   class="button button-danger float-right">Cancel</a>
                            </div>
                        </div>
                    </div>


                    <table class="table">
                        <tr>
                            <td>
                                <a href="javascript:void(0);" onclick="window.location = _root_ + 'office/'"
                                   class="button button-danger float-left">
                                    <i class="fas fa-arrow-left" aria-hidden="true"></i> Back
                                </a>
                            </td>
                            <td>

                                <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('add_clients_invoice')) {?>
                                    <a href="javascript:void(0);" id="invoice-add-btn"
                                       class="button button-outline-success float-right">
                                        <i class="fas fa-plus-circle"></i> Create new Invoice
                                    </a>
                                <?php }?>

                                <a href="javascript:void(0);" id="invoice-search-btn"
                                   class="button button-outline-info float-right">
                                    <i class="fas fa-search"></i> Search invoice
                                </a>
                            </td>
                        </tr>
                    </table>
                    <div id="invoices-data-table">
                        <table class="table table-condensed table-striped">
                            <thead class="text-notify">
                            <tr>
                                <th class="text-align-center" style="width: 20px;">
                                    <label><input id="checkAll" type="checkbox" class="check_box"/></label>
                                </th>
                                <th class="text-align-center" style="width: 30px;">S/N</th>
                                <th class="text-align-left" style="width: 100px;">Branch</th>
                                <th class="text-align-left" style="width: 180px;">Name</th>
                                <th class="text-align-left" style="width: 100px;">Mobile</th>
                                <th class="text-align-left" style="width: 200px;">Items</th>
                                <th class="text-align-center" style="width: 100px;">Total price</th>
                                <th class="text-align-center" style="width: 100px;">Date</th>
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
                                        <td class="text-align-left"><?php echo $_smarty_tpl->tpl_vars['data']->value['branch_name'];?>
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
                                                        class="fas fa-eye"></i></a>&nbsp;
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
                            <?php } else { ?>
                                <tr>
                                    <td colspan="10" class="text-align-center">
                                        No invoice exist.
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                            <tfoot class="text-notify">
                            <tr>
                                <th class="text-align-center">
                                    <label><input id="checkAll" type="checkbox" class="check_box"/></label>
                                </th>
                                <th class="text-align-center" style="width: 30px;">S/N</th>
                                <th class="text-align-left" style="width: 100px;">Branch</th>
                                <th class="text-align-left" style="width: 180px;">Name</th>
                                <th class="text-align-left" style="width: 100px;">Mobile</th>
                                <th class="text-align-left" style="width: 200px;">Items</th>
                                <th class="text-align-center" style="width: 100px;">Total price</th>
                                <th class="text-align-center" style="width: 100px;">Date</th>
                                <th class="text-align-center" style="width: 80px;">Invoice</th>
                                <th class="text-align-center" style="width: 120px;">Action</th>
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
