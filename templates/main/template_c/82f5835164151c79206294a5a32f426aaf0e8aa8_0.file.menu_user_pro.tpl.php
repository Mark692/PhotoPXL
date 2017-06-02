<?php
/* Smarty version 3.1.30, created on 2017-05-31 11:13:13
  from "/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/menu_user_pro.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_592e89290c7868_34535226',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '82f5835164151c79206294a5a32f426aaf0e8aa8' => 
    array (
      0 => '/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/menu_user_pro.tpl',
      1 => 1496055954,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_592e89290c7868_34535226 (Smarty_Internal_Template $_smarty_tpl) {
?>
<nav class="navbar navbar-pro" role="navigation">
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
index.php?controller=photo&task=modulo_upload">Carica Foto</a></li>
                      <li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
index.php?controller=login&task=logout">Logout</a></li>	
            </ul>
            <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
index.php?controller=Profilo&task=riepilogo"><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a></li>
            </ul>
        </div>
    </div>
</nav><?php }
}
