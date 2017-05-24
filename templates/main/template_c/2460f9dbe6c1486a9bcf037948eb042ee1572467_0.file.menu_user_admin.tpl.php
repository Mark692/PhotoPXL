<?php
/* Smarty version 3.1.30, created on 2017-05-24 15:20:21
  from "/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/menu_user_admin.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59258895dd2d16_84276606',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2460f9dbe6c1486a9bcf037948eb042ee1572467' => 
    array (
      0 => '/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/menu_user_admin.tpl',
      1 => 1495632021,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59258895dd2d16_84276606 (Smarty_Internal_Template $_smarty_tpl) {
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
              <li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
index.php">Home</a></li>   
              <li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
index.php?controller=Photo&task=modulo_upload">Carica Foto</a></li>
              <li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
index.php?controller=Login&task=logout">Logout</a></li>  
              <li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
index.php?controller=amministratore&task=modulo_banna">Banna Utenti</a></li>
              <li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
index.php?controller=amministratore&task=modulo_cambia_ruolo">Cambia Ruoli</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
              <li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
index.php?controller=Profilo&task=riepilogo"><?php echo $_smarty_tpl->tpl_vars['user_datails']->value['username'];?>
</a></li>
      </ul>
  </div>
</div>
</nav>
<?php }
}
