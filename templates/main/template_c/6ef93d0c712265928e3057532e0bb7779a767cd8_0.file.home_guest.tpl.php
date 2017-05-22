<?php
/* Smarty version 3.1.30, created on 2017-05-22 12:52:48
  from "/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/home_guest.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5922c3001ed7f7_38136788',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6ef93d0c712265928e3057532e0bb7779a767cd8' => 
    array (
      0 => '/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/home_guest.tpl',
      1 => 1495369705,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5922c3001ed7f7_38136788 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">
    <div class="row">
    <div class="col-md-6">
        <h1 class="text-success">Foto da mostrare</h1><br/>
			<div class="container">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['array_photo']->value, 'array1');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['array1']->value) {
?>
                            <div class="row">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['array1']->value, 'valore');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['valore']->value) {
?>
                                    <div class="col-md-3">
                                        <img src="data:".<?php echo $_smarty_tpl->tpl_vars['valore']->value['type'];?>
.";base64,'.base64_encode( <?php echo $_smarty_tpl->tpl_vars['valore']->value['thumbanil'];?>
 ).'">
                                        <!--modo per mettere gli id nascoti-->
                                    </div>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </div>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                        </div>
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
