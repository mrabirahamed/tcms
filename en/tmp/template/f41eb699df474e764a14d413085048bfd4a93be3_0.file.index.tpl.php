<?php
/* Smarty version 3.1.33, created on 2019-05-22 11:12:49
  from '/home/mishusoft/public_html/releases/tcms/en/default/modules/office/views/pages/index/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5ce4da51eaa3a4_99280355',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f41eb699df474e764a14d413085048bfd4a93be3' => 
    array (
      0 => '/home/mishusoft/public_html/releases/tcms/en/default/modules/office/views/pages/index/index.tpl',
      1 => 1557235047,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ce4da51eaa3a4_99280355 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row">
    <fieldset class="box-shadow-light">
        <legend class="box-shadow-light"> Quick access</legend>

        <!--div class="row" id="Quickaccess">
            <div class="quick-access-app box-shadow-light">
                <div class="quick-access-app-logo">
                    <span class="quick-access-app-logo-image-alt"><i class="fab fa-app-store"></i></span>
                </div>
                <div class="quick-access-app-text">
                    <div class="quick-access-app-title-text">Loading...</div>
                    <div class="quick-access-app-status-text">&nbsp;</div>
                </div>
            </div>
        </div-->
        <div class="row">

            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('edit_product_details')) {?>
                <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
office/productDetails">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-info"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Product Details</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('edit_clients_invoice')) {?>
                <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
office/invoices">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-file-invoice"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Invoices</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('system_access')) {?>
                <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
office/clients">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-users"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Clients</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('system_access')) {?>
                <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
office/moneyreceipt">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="far fa-credit-card"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Money receipt</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            <?php }?>
        </div>
    </fieldset>
    <fieldset class="box-shadow-light">
        <legend class="box-shadow-light"> Manage Products</legend>

        <!--div class="row" id="Quickaccess">
            <div class="quick-access-app box-shadow-light">
                <div class="quick-access-app-logo">
                    <span class="quick-access-app-logo-image-alt"><i class="fab fa-app-store"></i></span>
                </div>
                <div class="quick-access-app-text">
                    <div class="quick-access-app-title-text">Loading...</div>
                    <div class="quick-access-app-status-text">&nbsp;</div>
                </div>
            </div>
        </div-->
        <div class="row">
            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('edit_product_item')) {?>
                <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
office/items">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-clipboard-list"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Items</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('edit_product_brand')) {?>
                <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
office/brands">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt">B</span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Brands</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('edit_product_details')) {?>
                <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
office/productDetails">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-info"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Product Details</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('edit_product_item')) {?>
                <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
office/items/photos">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-images"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Items Photos</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('edit_product_brand')) {?>
                <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
office/brands/photos">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-images"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Brands Photos</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('edit_product_details')) {?>
                <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
office/productDetails/photos">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-images"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Products Photos</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            <?php }?>
        </div>
    </fieldset>
    <fieldset class="box-shadow-light">
        <legend class="box-shadow-light"> Manage Stock</legend>

        <!--div class="row" id="Quickaccess">
            <div class="quick-access-app box-shadow-light">
                <div class="quick-access-app-logo">
                    <span class="quick-access-app-logo-image-alt"><i class="fab fa-app-store"></i></span>
                </div>
                <div class="quick-access-app-text">
                    <div class="quick-access-app-title-text">Loading...</div>
                    <div class="quick-access-app-status-text">&nbsp;</div>
                </div>
            </div>
        </div-->
        <div class="row">
            <a class="quick-access-app box-shadow-light" href="#">
                <div class="quick-access-app-logo">
                    <span class="quick-access-app-logo-image-alt"><i class="fas fa-clipboard-list"></i></span>
                </div>
                <div class="quick-access-app-text">
                    <div class="quick-access-app-title-text">Product categories</div>
                    <div class="quick-access-app-status-text">&nbsp;</div>
                </div>
            </a>
            <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
#">
                <div class="quick-access-app-logo">
                    <span class="quick-access-app-logo-image-alt"><i class="fas fa-info"></i></span>
                </div>
                <div class="quick-access-app-text">
                    <div class="quick-access-app-title-text">Products</div>
                    <div class="quick-access-app-status-text">&nbsp;</div>
                </div>
            </a>
        </div>
    </fieldset>
    <fieldset class="box-shadow-light">
        <legend class="box-shadow-light"> Developers</legend>

        <!--div class="row" id="Quickaccess">
            <div class="quick-access-app box-shadow-light">
                <div class="quick-access-app-logo">
                    <span class="quick-access-app-logo-image-alt"><i class="fab fa-app-store"></i></span>
                </div>
                <div class="quick-access-app-text">
                    <div class="quick-access-app-title-text">Loading...</div>
                    <div class="quick-access-app-status-text">&nbsp;</div>
                </div>
            </div>
        </div-->
        <div class="row">
            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('system_access')) {?>
                                <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
office/developers">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fab fa-connectdevelop"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Developers</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            <?php }?>
        </div>
    </fieldset>

    <!--<fieldset class="box-shadow-light">
        <legend class="box-shadow-light"> Manage Products</legend>

        <!--div class="row" id="Quickaccess">
            <div class="quick-access-app box-shadow-light">
                <div class="quick-access-app-logo">
                    <span class="quick-access-app-logo-image-alt"><i class="fab fa-app-store"></i></span>
                </div>
                <div class="quick-access-app-text">
                    <div class="quick-access-app-title-text">Loading...</div>
                    <div class="quick-access-app-status-text">&nbsp;</div>
                </div>
            </div>
        </div-->
    <!--<div class="row">
            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('edit_product_item')) {?>
                <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
office/items">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-clipboard-list"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Items</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('edit_product_brand')) {?>
                <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
office/brands">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt">B</span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Brands</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('edit_product_details')) {?>
                <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
office/productDetails">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-info"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Product Details</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('edit_clients_invoice')) {?>
                <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
office/invoices">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-file-invoice"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Invoices</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('system_access')) {?>
                <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
office/clients">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-users"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Clients</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('system_access')) {?>
                <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
office/moneyreceipt">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-users"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Money receipt</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('system_access')) {?>
                            <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
office/developers">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fab fa-connectdevelop"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Developers</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            <?php }?>
        </div>
    </fieldset>-->
</div>

<?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('edit_content')) {?>
    <div class="row">
        <fieldset class="box-shadow-light">
            <legend class="box-shadow-light"> Notifications</legend>
            <div class="row" id="notifications">
                                <!--div class="box-message box-success box-shadow-light">
                    <span class="notify-icon float-left"></span>&nbsp;
                    <span class="notify-content">Loading</span>
                    <span class="notify-action float-right"><i class="fa fa-trash"></i> </span>
                </div-->
            </div>
            <a href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
user/activities" class="button button-success float-right"><i
                        class="fas fa-list-ul"></i> See more</a>
        </fieldset>
    </div>
<?php }?>



<?php }
}
