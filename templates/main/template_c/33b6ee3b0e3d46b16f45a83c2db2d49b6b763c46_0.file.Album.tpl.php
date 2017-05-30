<?php
/* Smarty version 3.1.30, created on 2017-05-30 15:42:30
  from "/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/Album.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_592d76c61bc184_90362747',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '33b6ee3b0e3d46b16f45a83c2db2d49b6b763c46' => 
    array (
      0 => '/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/Album.tpl',
      1 => 1496151323,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_592d76c61bc184_90362747 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">
    <div class="row">
    <div class="col-md-6">
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
    </div>
    <div class="col-md-6">                   
                    <h3 class="text-success">Titolo Album:</h3><br /><?php echo $_smarty_tpl->tpl_vars['album_details']->value['title'];?>

                    <h3 class="text-success">Descrizone:</h3><br /> <?php echo $_smarty_tpl->tpl_vars['album_details']->value['description'];?>
 <!-- come metterlo in box -->
                    <h3 class="text-success">Categoria:</h3><br />
                              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['album_details']->value['categories'], 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                                  <label><?php echo $_smarty_tpl->tpl_vars['cat']->value;?>
</label>
                              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                     <?php if ($_smarty_tpl->tpl_vars['album_details']->value['username'] == $_smarty_tpl->tpl_vars['username']->value) {?>
                    <form method="post" action="index.php">  
                        <div class="form-group">
                               <button type="submit" class="btn btn-success">Modifica Album</button>
                        </div>
                    </form>	
                    <form method="post" action="index.php">  
                        <div class="form-group">
                               <button type="submit" class="btn btn-success">Elimina Album</button>
                        </div>
                    </form>	
                    <form method="post" action="index.php">  
                        <div class="form-group">
                               <button type="submit" class="btn btn-success">Aggiungi Foto</button>
                        </div>
                    </form>
                    <?php }?>
    </div>
    </div>
</div>

<?php }
}
