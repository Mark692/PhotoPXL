<?php
/* Smarty version 3.1.30, created on 2017-06-01 10:29:41
  from "/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/home_guest.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_592fd075801448_65977103',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6ef93d0c712265928e3057532e0bb7779a767cd8' => 
    array (
      0 => '/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/home_guest.tpl',
      1 => 1496305781,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_592fd075801448_65977103 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">
    <div class="row">
    <div class="col-md-6">
                <h1 class="text-success">Foto da mostrare</h1><br/>
                <img src="<?php echo $_smarty_tpl->tpl_vars['photo']->value;?>
">
                <p><label for="descrizione">descrizione del sito</label><br />
    </div>
    <div class="col-md-6">
                <h1 class="text-success">Registrazione</h1>
		<form metod="POST" action="index.php">
                            <h3 class="text-success">Username:</h3><br />
                            <div class="form-group">
                                <input name="username" class="form-control" id="focusedInput" type="text" value="">
                            </div>
                            <h3 class="text-success">Password:</h3><br />
                            <div class="form-group">
                                <input name="password" class="form-control" id="focusedInput" type="password" value="">
                            </div>
                            <h3 class="text-success">Email:</h3><br />
                            <div class="form-group">
                                <input name="email" class="form-control" id="focusedInput" type="text" value="">
                            </div>
                            <input type="hidden" name="controller" value="profilo" /> <!-- in value ci andranno in seguito -->
                            <input type="hidden" name="task" value="update" />
                            <input type="submit" name="Salva" class="btn-success" value="Registrati"/>
                </form>
                <h1 class="text-success">Login</h1>
                <form method="post" action="index.php">
                            <h3 class="text-success">Username:</h3><br />
                            <div class="form-group">
                                <input name="username" class="form-control" id="focusedInput" type="text" value="">
                            </div>
                            <h3 class="text-success">Password:</h3><br />
                            <div class="form-group">
                                <input name="password" class="form-control" id="focusedInput" type="password" value="">
                            </div>
                            <input type="hidden" name="controller" value="login" />
                            <input type="hidden" name="task" value="login" />
                            <input type="submit" name="login" class="btn-success" value="Login"  /></p>
                </form>
    </div>
    </div>
</div><?php }
}
