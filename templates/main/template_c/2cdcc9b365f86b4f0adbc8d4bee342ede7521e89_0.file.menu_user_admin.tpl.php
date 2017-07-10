<?php
/* Smarty version 3.1.30, created on 2017-07-07 14:26:48
  from "C:\xampp\htdocs\PhotoPXL\templates\main\template\menu_user_admin.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_595f7e080a6d66_78788392',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2cdcc9b365f86b4f0adbc8d4bee342ede7521e89' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PhotoPXL\\templates\\main\\template\\menu_user_admin.tpl',
      1 => 1499429843,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_595f7e080a6d66_78788392 (Smarty_Internal_Template $_smarty_tpl) {
?>
<nav class="navbar navbar-admin" role="navigation">
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
              <li><a href="">Home</a></li>   
              <li><a href="">Carica Foto</a></li>
              <li><a href="">Crea Album</a></li>
              <li><a href="">Logout</a></li>  
              <li><a href="">Banna Utenti</a></li>
              <li><a href="">Cambia Ruoli</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
              <li><a href=""><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a></li>
      </ul>
  </div>
</div>
</nav>
<?php }
}
