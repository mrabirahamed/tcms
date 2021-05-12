<?php
/* Smarty version 3.1.33, created on 2019-05-21 14:39:38
  from '/home/mishusoft/public_html/releases/tcms/en/default/themes/office/template.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5ce3b94a451a87_21034614',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5d0733dd78ed6f2d81ea063742172c3f80fd1600' => 
    array (
      0 => '/home/mishusoft/public_html/releases/tcms/en/default/themes/office/template.tpl',
      1 => 1557048672,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ce3b94a451a87_21034614 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title id="pageTitle">
        <?php echo (($tmp = @$_smarty_tpl->tpl_vars['title']->value)===null||$tmp==='' ? "Welcome to The ".((string)$_smarty_tpl->tpl_vars['layoutParams']->value['configs']['app_name']) : $tmp);?>
 || <?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['configs']['app_name'];?>

    </title>

    <!--meta http-equiv="refresh" content="0"/-->

    <meta name="title" content="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
"/>
    <meta name="Keywords" content="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
"/>
    <meta name="Company" content="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['configs']['app_company'];?>
"/>
    <meta name="Author" content="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['configs']['app_author'];?>
"/>

    <!-- favicon image files include here -->
    
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['logoFolder'];?>
apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['logoFolder'];?>
apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['logoFolder'];?>
apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['logoFolder'];?>
apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['logoFolder'];?>
apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['logoFolder'];?>
apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['logoFolder'];?>
apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['logoFolder'];?>
apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['logoFolder'];?>
apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['logoFolder'];?>
android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['logoFolder'];?>
favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['logoFolder'];?>
favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['logoFolder'];?>
favicon-16x16.png">
    <link rel="manifest" href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['logoFolder'];?>
manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['logoFolder'];?>
ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- StyleSheets -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['rootCSS'];?>
main.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['publicCSS'];?>
mishusoft.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['publicCSS'];?>
normalize.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['publicCSS'];?>
all.css" rel="stylesheet" type="text/css">

    <!-- Javascripts -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['rootJS'];?>
main.js" type="text/javascript"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['publicJqueryJS'];?>
jquery.min.js" type="text/javascript"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['publicMishusoftJS'];?>
mishusoft_FormValidation.js" type="text/javascript"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['publicJSPlugin'];?>
jquery.validate.js" type="text/javascript"><?php echo '</script'; ?>
>


</head>

<body id="Mishusoft" onload=Mishusoft.DigitalClock();>


<div id="container" class="container">

    <?php if (isset($_smarty_tpl->tpl_vars['widgets']->value['header'])) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['widgets']->value['header'], 'hdr');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['hdr']->value) {
?>
            <?php echo $_smarty_tpl->tpl_vars['hdr']->value;?>

        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>

    <div class="content_body">
        <?php if (isset($_smarty_tpl->tpl_vars['widgets']->value['left'])) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['widgets']->value['left'], 'lft');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['lft']->value) {
?>
                <?php echo $_smarty_tpl->tpl_vars['lft']->value;?>

            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <?php }?>

        <section id="content" class="content text-align-justify">

            
            <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['content']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

        </section>

        <?php if (isset($_smarty_tpl->tpl_vars['widgets']->value['right'])) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['widgets']->value['right'], 'ri');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ri']->value) {
?>
                <?php echo $_smarty_tpl->tpl_vars['ri']->value;?>

            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <?php }?>

    </div>

    <?php if (isset($_smarty_tpl->tpl_vars['widgets']->value['footer'])) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['widgets']->value['footer'], 'ftr');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ftr']->value) {
?>
            <?php echo $_smarty_tpl->tpl_vars['ftr']->value;?>

        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>
</div>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['publicMishusoftJS'];?>
mishusoft.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript"> let _root_ = '<?php echo $_smarty_tpl->tpl_vars['layoutParams']->value['root'];?>
'; <?php echo '</script'; ?>
>
<?php if (isset($_smarty_tpl->tpl_vars['layoutParams']->value['jsPlugin']) && count($_smarty_tpl->tpl_vars['layoutParams']->value['jsPlugin'])) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['layoutParams']->value['jsPlugin'], 'jsplg');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['jsplg']->value) {
?>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['jsplg']->value;?>
" type="text/javascript"><?php echo '</script'; ?>
>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
if (isset($_smarty_tpl->tpl_vars['layoutParams']->value['js']) && count($_smarty_tpl->tpl_vars['layoutParams']->value['js'])) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['layoutParams']->value['js'], 'js');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['js']->value) {
?>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
" type="text/javascript"><?php echo '</script'; ?>
>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>

</body>
</html>
<?php }
}
