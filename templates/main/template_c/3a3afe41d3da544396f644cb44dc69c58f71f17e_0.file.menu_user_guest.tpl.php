<?php
/* Smarty version 3.1.30, created on 2017-05-24 16:35:08
  from "C:\xampp\htdocs\PhotoPXL\templates\main\template\menu_user_guest.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59259a1c34a501_25462372',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3a3afe41d3da544396f644cb44dc69c58f71f17e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PhotoPXL\\templates\\main\\template\\menu_user_guest.tpl',
      1 => 1495110445,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59259a1c34a501_25462372 (Smarty_Internal_Template $_smarty_tpl) {
?>
<nav class="navbar navbar-guest" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Espandi barra di navigazione</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <ul class="nav navbar-nav">
                      <li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
index.php">Home</a></li>		
                      <li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
index.php?controller=Registrazione&task=modulo_registrazione">Registrazione</a></li>
                      <li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
index.php?controller=Login&task=modulo_login">Login</a></li>
            </ul>
        </div>
    </div>
</nav>                               
                               <?php }
}
