<?php
/* Smarty version 3.1.30, created on 2017-05-24 16:30:45
  from "/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_592599151db716_91110861',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fbcffc5a8ef427e5c3b6008376184b60bd7ddb17' => 
    array (
      0 => '/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/login.tpl',
      1 => 1495636242,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_592599151db716_91110861 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">
    <div class="row">
    <div class="col-md-6">
        <img src="templates/main/template/img/noimagefound.jpg" width="300" >
	<p><label for="descrizione">descrizione del sito</label><br />
    </div>
    <div class="col-md-6">
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
</div>
<?php }
}
