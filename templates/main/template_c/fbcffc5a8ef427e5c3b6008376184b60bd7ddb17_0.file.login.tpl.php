<?php
/* Smarty version 3.1.30, created on 2017-06-20 12:27:02
  from "/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5948f876c4eeb7_25107415',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fbcffc5a8ef427e5c3b6008376184b60bd7ddb17' => 
    array (
      0 => '/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/login.tpl',
      1 => 1496823289,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5948f876c4eeb7_25107415 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="templates/main/template/img/noimagefound.jpg" width="300" >
            <p><label for="descrizione">descrizione del sito</label><br />
        </div>
        <div class="col-md-6">
            <h1 class="text-success">Login</h1>
            <form method="post" action="">
                <h3 class="text-success">Username:</h3><br />
                <div class="form-group">
                    <input id="username" class="form-control" type="text" value="">
                </div>
                <h3 class="text-success">Password:</h3><br />
                <div class="form-group">
                    <input id="password" class="form-control" type="password" value="">
                </div>
               <input type="button" id="login" class="btn-success" value="Login"  /></p>
            </form>
        </div>
    </div>
</div>
<?php }
}
