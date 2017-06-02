<?php
/* Smarty version 3.1.30, created on 2017-06-02 10:34:29
  from "C:\xampp\htdocs\PhotoPXL\templates\main\template\Album.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59312315b8f1a6_62607562',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4fb01ec99804c96ae1e8aba311e676cf163a6c1f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PhotoPXL\\templates\\main\\template\\Album.tpl',
      1 => 1496392322,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59312315b8f1a6_62607562 (Smarty_Internal_Template $_smarty_tpl) {
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
                                    <div class="col-sm-1">
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
    </div>
    <div class="col-md-6">                   
                    <h3 class="text-success">Titolo Album:</h3><br /><?php echo $_smarty_tpl->tpl_vars['album_details']->value['title'];?>

                    <h3 class="text-success">Descrizone:</h3><br /> <?php echo $_smarty_tpl->tpl_vars['album_details']->value['description'];?>
 <!-- come metterlo in box -->
                    <h3 class="text-success">Categoria:</h3><br />
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                            <p> <?php echo $_smarty_tpl->tpl_vars['cat']->value['visualizzato'];?>
 </p><br />
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </select>
                     <?php if ($_smarty_tpl->tpl_vars['user_album']->value == $_smarty_tpl->tpl_vars['username']->value) {?>
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
