<?php
/* Smarty version 3.1.30, created on 2017-07-03 11:59:34
  from "/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/upload_standard.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_595a158619fd10_05892948',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '74f1328929a49388190cf897f303588c30f8d89e' => 
    array (
      0 => '/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/upload_standard.tpl',
      1 => 1499075973,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_595a158619fd10_05892948 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">
    <form method="post" action="index.php">
        <div class="row">
        <div class="col-md-6">
                    
                    <h3 class="text-success">Inserisci foto 1:</h3><br />
                        <div class="form-group">
                            <input name="photo" class="form-control" id="focusedInput" type="file" >
                        </div>
                    <h3 class="text-success">Titolo:</h3><br />
                    <div class="form-group">
                            <input name="title" class="form-control" id="focusedInput" type="text" placeholder="inserisci titolo..." >
                    </div>
        </div>
        <div class="col-md-6">
                    <h3 class="text-success">Descrizione</h3><br />
                    <div class="form-group">
                            <div class="col-lg-12">
                                <textarea name="description" class="form-control" rows="3" id="textArea" placeholder="inserisci descrizione..."></textarea>
                                <span class="help-block"></span>
                            </div>
                    </div>
                    <h3 class="text-success">Categoria</h3><br />
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
        </div>
        </div>
        <hr class="text-success">
        <div class="form-group">
                    <button type="submit" class="btn btn-success">Carica Foto</button>
        </div>
    </form>
</div>

<?php }
}
