<?php
/* Smarty version 3.1.30, created on 2017-05-31 11:58:37
  from "/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/registration.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_592e93cdb65138_47438151',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e925111cfdff17cdfa93a417aad3bdcfc737e255' => 
    array (
      0 => '/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/registration.tpl',
      1 => 1496224717,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_592e93cdb65138_47438151 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">
    <div class="row">
    <div class="col-md-6">
        <h1 class="text-success">Foto da mostrare</h1><br/>
            <img src=<?php echo $_smarty_tpl->tpl_vars['foto']->value;?>
>
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
    </div>
    </div>
</div>
<?php }
}
