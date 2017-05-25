<?php
/* Smarty version 3.1.30, created on 2017-05-25 13:36:42
  from "/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/prova.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5926c1ca212c68_47137121',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '08e9ef01faa7c6ffe22dd20c43b129d8eef0dc3c' => 
    array (
      0 => '/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/prova.tpl',
      1 => 1495712201,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5926c1ca212c68_47137121 (Smarty_Internal_Template $_smarty_tpl) {
?>

<img src="data:<?php echo $_smarty_tpl->tpl_vars['valore']->value['type'];?>
";base64,'base64_encode( <?php echo $_smarty_tpl->tpl_vars['valore']->value['thumbanil'];?>
 )'">

<?php }
}
