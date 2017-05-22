<?php
/* Smarty version 3.1.30, created on 2017-05-22 12:54:38
  from "/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/menu_user_guest.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5922c36ee33c22_82941181',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cc029160b26aa529521844ad144cac737fc25532' => 
    array (
      0 => '/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/menu_user_guest.tpl',
      1 => 1495020909,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5922c36ee33c22_82941181 (Smarty_Internal_Template $_smarty_tpl) {
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
