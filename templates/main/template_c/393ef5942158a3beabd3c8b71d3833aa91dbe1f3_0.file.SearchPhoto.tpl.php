<?php
/* Smarty version 3.1.30, created on 2017-07-03 09:40:03
  from "/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/SearchPhoto.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5959f4d3ba0035_55270561',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '393ef5942158a3beabd3c8b71d3833aa91dbe1f3' => 
    array (
      0 => '/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/SearchPhoto.tpl',
      1 => 1496822964,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5959f4d3ba0035_55270561 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">
    <div class="row">
    <div class="col-md-6">
            <div class="container">
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
                                        <!--QUA CI VA MESSO UN RIFERIMENTO ALLA FOTO -->
                                        <a href="">
                                        <?php echo $_smarty_tpl->tpl_vars['valore']->value;?>

                                        </a>
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
                        <?php } else { ?>
                            <h3 class="text-success"><?php echo $_smarty_tpl->tpl_vars['no_result']->value;?>
</h3>
                        <?php }?>
            </div>
    </div>
        <div class="col-md-6">
                    <h2 class="text-success">Risultato della ricerca:</h2><br />
        </div>
    </div>
</div><?php }
}
