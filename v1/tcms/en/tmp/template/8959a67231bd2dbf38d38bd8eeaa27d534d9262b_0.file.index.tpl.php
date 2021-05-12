<?php
/* Smarty version 3.1.33, created on 2019-02-20 19:30:53
  from '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/productdetails/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c6d568d9d49b9_96754946',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8959a67231bd2dbf38d38bd8eeaa27d534d9262b' => 
    array (
      0 => '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/productdetails/index.tpl',
      1 => 1550664232,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c6d568d9d49b9_96754946 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row" style="margin: 5px;">
    <div style="margin: 0 auto; width: 100%;">
        <fieldset class="box-shadow-light">
            <legend class="box-shadow-light">Product details with price</legend>
            <div class="row">
                <div id="message"> <!-- only javascript show message --> </div>
                <div class="row">
                    <div id="modal01" class="modal">
                        <div class="row md-modal-content animate">
                            <div class="modal-header">
                                <span id="productdetailsEditMode"> <!-- only javascript show action status --> </span>&nbsp;product details with price
                            </div>
                            <div class='modal-body'>
                                <div id="message2"> <!-- only javascript show message --> </div>
                                <div id="productdetailsEditPAD">
                                    <span class="text-danger">An asterisk (*) marked field must filled up.</span>
                                    <form name="form1" id="productdetailsform1" method="post">
                                        <input id="productdetailsID" type="hidden" value=""/>
                                        <table class="table table-condensed">
                                            <tr>
                                                <td style="width: 50%;">
                                                    Item:<span class="text-danger">(*)</span>
                                                    <select id="prd-detls-item" class="input-control" title="Choose a item from this select box">
                                                        <option value=""> -- Select One </option>
                                                        <option value="addNew" id="item-add-btn"> New Item </option>
                                                        <!-- only javascript show option -->
                                                    </select>
                                                </td>
                                                <td style="width: 50%;">
                                                    Brand:<span class="text-danger">(*)</span>
                                                    <select id="prd-detls-brand" class="input-control" title="Choose a brand from this select box">
                                                        <option value=""> -- Select One -- </option>
                                                        <option value="addNew" id="brand-add-btn"> New brand </option>
                                                        <!-- only javascript show option -->
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">
                                                    Model:<span class="text-danger">(*)</span>
                                                    <input id="modelNumber" type="text" class="input-control" placeholder="Model number" maxlength="30"/>
                                                </td>
                                                <td style="width: 50%;">
                                                    Serial:
                                                    <input id="serialNumber" type="text" class="input-control" placeholder="Serial number" maxlength="30"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">
                                                    Unit price:<span class="text-danger">(*)</span>
                                                    <input id="unitPrice" type="text" class="input-control" placeholder="Unit price" maxlength="30"/>
                                                </td>
                                                <td style="width: 50%;">
                                                    Warrenty:
                                                    <input id="warrantyTime" type="text" class="input-control" placeholder="Warranty (Days)" maxlength="30"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">
                                                    Stock Ability:<span class="text-danger">(*)</span>
                                                    <select id="ability" class="input-control" title="Choose ability from this select box">
                                                        <option value=""> -- Select One </option>
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
                                <a href="javascript:void(0);"
                                   onclick="Mishusoft.detectElement('modal01').style.display = 'none'"
                                   class="button button-danger float-left">Cancel</a>
                                <a href="javascript:void(0);" id="productdetails-data-btn"
                                   class="button button-primary float-right">
                                    <!-- only javascipt show button name --> </a>
                                <a href="javascript:void(0);" id="productdetails-reset-btn"
                                   class="button button-danger float-right">
                                    <!-- only javascipt show button name --> </a>
                            </div>
                        </div>
                    </div>

                    <!-- item dialog box -->
                    <div id="modal02" class="modal">
                        <div class="row md-modal-content animate">
                            <div class="modal-header">
                                <span id="itemEditMode"> <!-- only javascript show action status --> </span>&nbsp;item
                            </div>
                            <div class='modal-body'>
                                <div id="message3"> <!-- only javascript show message --> </div>
                                <div id="itemEditPAD">
                                    <form name="form1" id="itemform1" method="post">
                                        <table class="table table-condensed">
                                            <tr>
                                                <td style="width: 50%;">
                                                    Name:
                                                    <input id="itemName" type="text" class="input-control" value="" placeholder="Name" maxlength="30"/>
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
                                    <!-- only javascipt show button name --> </a>
                                <a href="javascript:void(0);" id="item-reset-btn"
                                   class="button button-danger float-right">
                                    <!-- only javascipt show button name --> </a>
                            </div>
                        </div>
                    </div>


                    <!-- start brand section -->
                    <div id="modal03" class="modal">
                        <div class="row md-modal-content animate">
                            <div class="modal-header">
                                <span id="brandEditMode"> <!-- only javascript show action status --> </span>&nbsp;brand
                            </div>
                            <div class='modal-body'>
                                <div id="message4"> <!-- only javascript show message --> </div>
                                <div id="brandEditPAD">
                                    <form name="form1" id="brandform1" method="post">
                                        <input id="brandID" type="hidden" value=""/>
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
                                    <!-- only javascipt show button name --> </a>
                                <a href="javascript:void(0);" id="brand-reset-btn"
                                   class="button button-danger float-right">
                                    <!-- only javascipt show button name --> </a>
                            </div>
                        </div>
                    </div>

                    <div id="PopUpDialogBox" class="modal">
                        <div class="row md-modal-content animate">
                            <div class="modal-header">
                                <span id="PopUpDialogBoxTitle"> <!-- only javascript show action status --> </span>
                            </div>
                            <div class='modal-body'>
                                <div id="message5"> <!-- only javascipt show message --> </div>
                            </div>
                            <div class='row2 modal-footer'>
                                <a href="javascript:void(0);" id="message-done-btn"
                                   class="button button-primary float-right">
                                    <!-- only javascipt show button name --> </a>
                                <a href="javascript:void(0);"
                                   onclick="Mishusoft.detectElement('PopUpDialogBox').style.display = 'none'"
                                   class="button button-danger float-right">Cancel</a>
                            </div>
                        </div>
                    </div>


                    <table class="table">
                        <tr>
                            <td>
                                <a href="javascript:void(0);" onclick="window.location = _root_"
                                   class="button button-danger float-left">
                                    <i class="fas fa-arrow-left" aria-hidden="true"></i> Back
                                </a>
                            </td>
                            <td>
                                <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('add_product_details')) {?>
                                    <a href="javascript:void(0);" id="productdetails-add-btn"
                                       class="button button-success float-right">
                                        <i class="fas fa-plus-circle"></i> Add New
                                    </a>
                                <?php }?>

                            </td>
                        </tr>
                    </table>
                    <div id="productdetails-data-table">
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
"/></label>
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

                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>
<?php }
}
