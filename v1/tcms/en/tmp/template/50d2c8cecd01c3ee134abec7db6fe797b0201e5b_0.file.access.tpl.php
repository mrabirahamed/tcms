<?php
/* Smarty version 3.1.33, created on 2019-02-19 12:50:26
  from '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/error/access.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c6ba73272da28_32991381',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '50d2c8cecd01c3ee134abec7db6fe797b0201e5b' => 
    array (
      0 => '/home/mishusoft/public_html/project/tcms/default/modules/core/views/pages/error/access.tpl',
      1 => 1550383301,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c6ba73272da28_32991381 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row" style="margin-top: 5px; ">
    <?php if (isset($_smarty_tpl->tpl_vars['title']->value)) {?>
        <div class="box-message box-danger box-shadow-light">
            <div class="text-danger" style="font-size: 20px; font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</div>
            <?php if (isset($_smarty_tpl->tpl_vars['message']->value)) {?> <?php echo $_smarty_tpl->tpl_vars['message']->value['Description'];?>
 <?php }?>
        </div>
    <?php }?>
    </div>
<?php }
}
