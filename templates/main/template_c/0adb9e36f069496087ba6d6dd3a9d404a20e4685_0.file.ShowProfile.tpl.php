<?php
/* Smarty version 3.1.30, created on 2017-07-03 09:24:46
  from "/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/ShowProfile.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5959f13eb98593_45218162',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0adb9e36f069496087ba6d6dd3a9d404a20e4685' => 
    array (
      0 => '/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/ShowProfile.tpl',
      1 => 1496823023,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5959f13eb98593_45218162 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">
    <div class="row">
    <div class="col-md-6">
			<?php if ((($tmp = @$_smarty_tpl->tpl_vars['no_result']->value)===null||$tmp==='' ? "FALSE" : $tmp) == "FALSE") {?>
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
                                    <div class="col-sm-1">
                                        <!--QUA CI VA MESSO UN RIFERIMENTO ALLA FOTO-->
                                        <a href="">
                                        <?php echo $_smarty_tpl->tpl_vars['valore']->value;?>

                                        </a>
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
                        <?php } else { ?>
                            <h3 class="text-success"><?php echo $_smarty_tpl->tpl_vars['no_result']->value;?>
</h3>
                        <?php }?>
    </div>
    <div class="col-md-6">
			<?php echo $_smarty_tpl->tpl_vars['pic_profile']->value;?>

                        <?php if ((($tmp = @$_smarty_tpl->tpl_vars['attiva']->value)===null||$tmp==='' ? "FALSE" : $tmp) == 'TRUE') {?>
                        <form method="post" action="profileSync.php">  
                        <div class="form-group">
                               <button type="submit" class="btn btn-success">Cambia Immagine Profilo</button>
                        </div>
                        </form>
                        <?php }?>
                        <h3 class="text-success">Username:</h3><br /><h4><?php echo $_smarty_tpl->tpl_vars['user_details']->value['username'];?>
</h4>
                        <h3 class="text-success">Email:</h3><br /><h4><?php echo $_smarty_tpl->tpl_vars['user_details']->value['email'];?>
</h4>
                        <h3 class="text-success">Ruolo:</h3><br /><h4><?php echo $_smarty_tpl->tpl_vars['user_details']->value['role'];?>
</h4>
                        <?php if ((($tmp = @$_smarty_tpl->tpl_vars['attiva']->value)===null||$tmp==='' ? "FALSE" : $tmp) == 'TRUE') {?>
			<form method="post" action="index.php">  
                        <div class="form-group">
                               <button type="submit" class="btn btn-success">Modifica dati</button>
                        </div>
                        </form>
                        <?php }?>
    </div>
    </div>                     
</div> <?php }
}
