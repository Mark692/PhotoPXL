<?php
/* Smarty version 3.1.30, created on 2017-06-03 10:30:02
  from "/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/home_loggati.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5932738ad43180_60353100',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '72e1bb121f508ea4d6aaacb881cd86a48cded9f9' => 
    array (
      0 => '/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/home_loggati.tpl',
      1 => 1496478572,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5932738ad43180_60353100 (Smarty_Internal_Template $_smarty_tpl) {
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
                                        <!--QUA CI VA MESSO UN RIFERIMENTO ALLA FOTO, QUESTO è SOLO PROVVISORIO-->
                                        <a href="http://www.html.it">
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
            <form method="POST" action="index.php">
                    <h3 class="text-success">Ricerca per Categoria:</h3><br />
                        <div class="form-group">
                        <div class="col-lg-10">
                            <!-- select multiple -->
                            <select name="categories" multiple="" class="form-control">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                                       <option value=<?php echo $_smarty_tpl->tpl_vars['cat']->value['riferimento'];?>
><?php echo $_smarty_tpl->tpl_vars['cat']->value['visualizzato'];?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </select>
                        </div>
                        </div>
                        &nbsp;
                        <input type="submit" name="cerca" class="btn btn-success" value="Inizia a Cercare" />
            </form>
        </div>
    </div>
</div>                
    
    
    <?php }
}
