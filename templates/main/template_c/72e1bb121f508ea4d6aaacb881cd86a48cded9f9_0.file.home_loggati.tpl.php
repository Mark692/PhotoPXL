<?php
/* Smarty version 3.1.30, created on 2017-05-22 12:19:11
  from "/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/home_loggati.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5922bb1f2214b1_06931312',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '72e1bb121f508ea4d6aaacb881cd86a48cded9f9' => 
    array (
      0 => '/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/home_loggati.tpl',
      1 => 1495369705,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5922bb1f2214b1_06931312 (Smarty_Internal_Template $_smarty_tpl) {
?>
<table>
    <tr>
        <td align="center">
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
        </td>
        <td class="colonna" align="center">
            <form method="POST" action="index.php">
                    <h3 class="title">Ricerca per categoria</h3>
                    <p><label for="Categories">Categoria</label><br />
                    <select multiple="" class="form-control">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['array_categories']->value, 'categories');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['categories']->value) {
?>
                                <option value="$categories" checked><?php echo $_smarty_tpl->tpl_vars['categories']->value;?>
</option>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    </select>
                            <input type="hidden" name="controller" value="cerca" />
                            <input type="hidden" name="task" value="search_photo_by_categories" />
                            <input type="submit" name="cerca" class="btn btn-success" value="Inizia a Cercare" />
            </form>

        </td>
    </tr>
</table>
    
    
    <?php }
}
