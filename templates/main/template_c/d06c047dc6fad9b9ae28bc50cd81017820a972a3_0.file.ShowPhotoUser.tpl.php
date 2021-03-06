<?php
/* Smarty version 3.1.30, created on 2017-07-03 11:38:27
  from "/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/ShowPhotoUser.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_595a1093bb8323_17228209',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd06c047dc6fad9b9ae28bc50cd81017820a972a3' => 
    array (
      0 => '/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/ShowPhotoUser.tpl',
      1 => 1499074707,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_595a1093bb8323_17228209 (Smarty_Internal_Template $_smarty_tpl) {
?>

<!-- può essere fatto un solo template sfruttando foto altri user -->
<div class="container">
    <div class="row">
    <div class="col-md-6">
                    <p><h3 class="text-success">Titolo:</h3><br /></p>
                    <p><label for="Title"><?php echo $_smarty_tpl->tpl_vars['photo_details']->value['title'];?>
</p> </br>
                    <!-- vedere la grandezza della foto e come far vedere na foto-->
                    <?php echo $_smarty_tpl->tpl_vars['foto']->value;?>

                    <p><h3 class="text-success">Like:</h3><?php echo (($tmp = @$_smarty_tpl->tpl_vars['photo_details']->value['tot_like'])===null||$tmp==='' ? "0" : $tmp);?>
<br /></p>
                    <?php if ($_smarty_tpl->tpl_vars['attiva']->value == "1") {?>
                        <form method="post" action="index.php">  
                        <div class="form-group">
                               <button type="submit" class="btn btn-success">Non Mi Piace</button>
                        </div>
                        </form>
                    <?php } else { ?>
                        <form method="post" action="index.php">  
                        <div class="form-group">
                               <button type="submit" class="btn btn-success">Mi Piace</button>
                        </div>
                        </form>
                    <?php }?>
                    <!-- per attivare i tasti modifica e elimina foto -->
                    <?php if ($_smarty_tpl->tpl_vars['photo_details']->value['uploader'] == $_smarty_tpl->tpl_vars['username']->value) {?>
                     <!-- l'uploader della foto dove si trova -->
                        <form method="post" action="index.php">  
                        <div class="form-group">
                               <button type="submit" class="btn btn-success">Modifica Foto</button>
                        </div>
                        </form>
                        <form method="post" action="index.php">  
                        <div class="form-group">
                               <button type="submit" class="btn btn-success">Elimina Foto</button>
                        </div>
                        </form>
                    <?php }?>
                    
    </div>
    <div class="col-md-6">
                    <p><h3 class="text-success">Descrizione:</h3><br /><?php echo $_smarty_tpl->tpl_vars['photo_details']->value['description'];?>
</p>
                    <p><h3 class="text-success">Riservata:</h3><br /><?php echo $_smarty_tpl->tpl_vars['photo_details']->value['is_reserved'];?>
</p>   
                    <p><h3 class="text-success">Categoria:</h3><br />
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                                <?php echo $_smarty_tpl->tpl_vars['cat']->value['visualizzato'];?>
<br />
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    <p><h3 class="text-success">Data di pubblicazione:</h3><?php echo $_smarty_tpl->tpl_vars['photo_details']->value['Upload_Date'];?>
<br /></p>
    </div>
    </div>

                    
<!-- come mettere i commenti -->

    <div class="row">
            <form method="POST" action="index.php">
                <div class="form-group">
                <p><h3 class="text-success">Inserisci il tuo commento!!!</h3><br />
                <label for="textArea" class="col-lg-2 control-label"></label>
                    <div class="col-lg-10">
                <textarea class="form-control" rows="3" id="textArea"></textarea>
                <button type="submit" class="btn btn-success">Commenta</button>
                    </div>
                </div>
            </form>
    </div>
    <div class="row">
        <h2>Commenti...</h2>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['comments']->value, 'valore');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['valore']->value) {
?>
        <div class="col-md-6 col-md-offset-3">
            <div class="well">
                <p class="text-success"><?php echo $_smarty_tpl->tpl_vars['valore']->value['user'];?>
</p>
                <p><?php echo $_smarty_tpl->tpl_vars['valore']->value['text'];?>
</p>
                <?php if ($_smarty_tpl->tpl_vars['valore']->value['user'] == $_smarty_tpl->tpl_vars['username']->value) {?>
                <form method="POST" action="index.php">
                    <div class="form-group">
                    <button type="submit" class="btn btn-success">Elimina</button>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-success">Modifica</button>
                    </div>
                </form>
                <?php }?>
            </div>
        </div>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    
    </div>
    
    
<?php }
}
