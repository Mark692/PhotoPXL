<?php
/* Smarty version 3.1.30, created on 2017-05-24 16:35:08
  from "C:\xampp\htdocs\PhotoPXL\templates\main\template\login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59259a1c356086_57578773',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c8f25a5cb47b699e0fab26febb829c5790cf9930' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PhotoPXL\\templates\\main\\template\\login.tpl',
      1 => 1495636507,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59259a1c356086_57578773 (Smarty_Internal_Template $_smarty_tpl) {
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
