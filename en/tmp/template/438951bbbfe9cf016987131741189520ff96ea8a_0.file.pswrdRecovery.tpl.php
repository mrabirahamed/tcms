<?php
/* Smarty version 3.1.33, created on 2019-06-23 11:28:45
  from '/home/mishusoft/public_html/releases/tcms/en/default/modules/core/views/pages/user/pswrdRecovery.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d0f0e0d006f06_51721004',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '438951bbbfe9cf016987131741189520ff96ea8a' => 
    array (
      0 => '/home/mishusoft/public_html/releases/tcms/en/default/modules/core/views/pages/user/pswrdRecovery.tpl',
      1 => 1557234976,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d0f0e0d006f06_51721004 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="logInBox">
    <img src="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['publicIMG'];?>
img_avatar3.png" class="userIconImage">
    <div class="messageZone">
        <?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
            <div class="box-message box-danger box-shadow-light"><b class="text-danger">Error: </b><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
 </div>
        <?php }?>
        <?php if (isset($_smarty_tpl->tpl_vars['success']->value)) {?>
            <div class="box-message box-success box-shadow-light"><b class="text-success">Message: </b><?php echo $_smarty_tpl->tpl_vars['success']->value;?>
 </div>
        <?php }?>
    </div>

    <form role="form" name="PasswrodRecoveryForm" method="post" action="">
        <input type="hidden" name="enviar" value="1">
        <div class="row">
            <div class="row text-align-left">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" class="input-control"
                       placeholder="Your email address.."/>
            </div>

            <div class="row">
                <div class="float-right text-right">
                    <input type="submit" id="recovery-mail-button" name="recovery-account" class="button button-primary"
                           value="Send Recovery Code"/>
                </div>
            </div>
        </div>
        <div class="row">
            <a href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
user/login" class="link"><span class="fa fa-user"></span> Log In</a>            <br/> <br/>
            <a href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
" class="link"> <span class="fa fa-arrow-left"></span> Go back home.</a>
        </div>
    </form>

</div>


<?php }
}
