<?php
/* Smarty version 3.1.30, created on 2017-07-07 14:26:48
  from "C:\xampp\htdocs\PhotoPXL\templates\main\template\home_default.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_595f7e0813f300_39720002',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'adc45ebab62c4861b6af7cf63673349b4996a733' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PhotoPXL\\templates\\main\\template\\home_default.tpl',
      1 => 1496746701,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_595f7e0813f300_39720002 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>PhotoPXL</title>

    <!-- Bootstrap -->
    <link href="templates/main/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="templates/main/template/css/Custom.css" rel="stylesheet">
   
    <?php echo '<script'; ?>
 src="http://code.jquery.com/jquery-2.2.0.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="templates/main/template/js/sha512.js"><?php echo '</script'; ?>
>
  </head>
<body>
        <!-- start header -->

        <div id="header">
        <div id="logo">
        <img src="templates/main/template/img/logo.png" width="250" height="150" align="top"></img>
        </div>	
        <div>

            <?php echo $_smarty_tpl->tpl_vars['menu_user']->value;?>

        </div>
        <!-- end header -->
            
            <?php echo (($tmp = @$_smarty_tpl->tpl_vars['banner']->value)===null||$tmp==='' ? "&nbsp;" : $tmp);?>

            
        <div>
    
            <?php echo $_smarty_tpl->tpl_vars['mainContent']->value;?>

    
    <!--fine -->
        </div>
</body>
<?php }
}
