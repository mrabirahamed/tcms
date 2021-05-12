<?php
/* Smarty version 3.1.33, created on 2019-02-26 10:50:36
  from '/home/mishusoft/public_html/releases/tcms/en/default/modules/core/views/pages/index/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c74c59c89f5a7_91173798',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '83f70dda964daf111a8cf9c0b5bd499b033b126a' => 
    array (
      0 => '/home/mishusoft/public_html/releases/tcms/en/default/modules/core/views/pages/index/index.tpl',
      1 => 1550922703,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c74c59c89f5a7_91173798 (Smarty_Internal_Template $_smarty_tpl) {
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
            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('edit_product_item')) {?>
                <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
items">
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
brands">
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
productDetails">
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
invoices">
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
clients">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-users"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Clients</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['acl']->value->permission('edit_app_developer')) {?>
                <a class="quick-access-app box-shadow-light" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
developers">
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
</div>

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
user/activities" class="button button-success float-right"><i class="fas fa-list-ul"></i> See more</a>
    </fieldset>
</div>

<?php }
}
