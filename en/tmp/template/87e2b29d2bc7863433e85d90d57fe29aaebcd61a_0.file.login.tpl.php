<?php
/* Smarty version 3.1.33, created on 2019-05-22 11:09:47
  from '/home/mishusoft/public_html/releases/tcms/en/default/modules/core/views/pages/user/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5ce4d99b0b5be5_72795382',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '87e2b29d2bc7863433e85d90d57fe29aaebcd61a' => 
    array (
      0 => '/home/mishusoft/public_html/releases/tcms/en/default/modules/core/views/pages/user/login.tpl',
      1 => 1557234972,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ce4d99b0b5be5_72795382 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="logInBox">
    <img src="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['publicIMG'];?>
img_avatar3.png" class="userIconImage">
    <div class="messageZone">
        <?php if (isset($_smarty_tpl->tpl_vars['notify']->value)) {?>
            <div class="box-message box-notify box-shadow-light"><?php echo $_smarty_tpl->tpl_vars['notify']->value;?>
</div>
        <?php }?>
        <?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
            <div class="box-message box-danger box-shadow-light"><b class="text-danger">Error: </b><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
 </div>
        <?php }?>
        <?php if (isset($_smarty_tpl->tpl_vars['success']->value)) {?>
            <div class="box-message box-success box-shadow-light"><b class="text-success">Message: </b><?php echo $_smarty_tpl->tpl_vars['success']->value;?>
 </div>
        <?php }?>
    </div>

    <form role="form" name="LogInForm" method="post" action="">
        <input type="hidden" name="logged" value="1">
        <div class="row">
            <div class="row text-align-left">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="input-control"
                       placeholder="Your username.." autofocus required
                       value="<?php if (isset($_smarty_tpl->tpl_vars['datas']->value)) {
echo $_smarty_tpl->tpl_vars['datas']->value['username'];
}?>"/>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="input-control"
                       placeholder="***********" autocomplete="off" required/>
            </div>

            <div class="row">
                <div class="float-left text-left">
                    <label class="input-container">Remember me.
                        <input type="checkbox" id="remember" name="RememberMe"/>
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="float-right text-right">
                    <input type="submit" id="login-button" name="login" class="button button-primary" value="Log In"/>
                </div>
            </div>
        </div>
        <div class="row">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
user/pswrdRecovery" class="link"><span class="fa fa-user-times"></span> Forget
                password?</a>
            <br/> <br/>
            <a href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
" class="link"> <span class="fa fa-arrow-left"></span> Go back home.</a>
        </div>
    </form>

</div>
<?php }
}
