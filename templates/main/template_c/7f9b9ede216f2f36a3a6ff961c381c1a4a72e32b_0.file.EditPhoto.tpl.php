<?php
/* Smarty version 3.1.30, created on 2017-05-31 11:49:01
  from "/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/EditPhoto.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_592e918d715893_48299842',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7f9b9ede216f2f36a3a6ff961c381c1a4a72e32b' => 
    array (
      0 => '/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/EditPhoto.tpl',
      1 => 1496224141,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_592e918d715893_48299842 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">
    <div class="row">
    <div class="col-md-6">
                <h3 class="text-success">Foto da modificare:</h3><br/>
                <?php echo $_smarty_tpl->tpl_vars['foto']->value;?>

                &nbsp;
                <form method="POST" action="index.php">
                    <input type="submit" class="btn-success" value="Elimina"  /></p>
                </form>
    </div>
    <div class="col-md-6">
                <h3 class="text-success">Dati foto </h3><br/>
                <form method="POST" action="index.php">
                        <p><h3 class="text-success">Titolo:</h3><br />
                        <div class="form-group">
                                <input name="title" class="form-control" id="focusedInput" type="text" placeholder="<?php echo $_smarty_tpl->tpl_vars['photo_details']->value['title'];?>
">
                        </div>
                        <p><h3 class="text-success">Descrizione:</h3><br />
                        <div class="form-group">
                            <div class="col-lg-10">
                            <textarea name="description" class="form-control" rows="3" id="textArea" placeholder="<?php echo $_smarty_tpl->tpl_vars['photo_details']->value['description'];?>
"></textarea>
                            <span class="help-block"></span>
                            </div>
                         </div>
                        <div class="form-group">
                        <?php if ($_smarty_tpl->tpl_vars['role']->value > "1") {?>
                          <h3 class="text-success">Riservata:</h3><br />
                                <?php if ($_smarty_tpl->tpl_vars['photo_details']->value['is_reserved'] == "1") {?>
                                    <div class="form-group">
                                        <div class="col-lg-10">
                                            <div class="radio">
                                                <label>
                                                    <input name="is_reserved" type="radio" name="optionsRadios" id="optionsRadios1" value="TRUE" checked="">
                                                    Si
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input name="is_reserved" type="radio" name="optionsRadios" id="optionsRadios2" value="FALSE">
                                                    No
                                                </label>
                                            </div>
                                          </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group">
                                        <div class="col-lg-10">
                                            <div class="radio">
                                                <label>
                                                    <input name="is_reserved" type="radio" name="optionsRadios" id="optionsRadios1" value="TRUE">
                                                    Si
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input name="is_reserved" type="radio" name="optionsRadios" id="optionsRadios2" value="FALSE"  checked="">
                                                    No
                                                </label>
                                            </div>
                                          </div>
                                    </div>
                                <?php }?>
                        <?php }?>
                        </div>
                        <h3 class="text-success">Categoria:</h3><br />
                        <div class="form-group">
                        <div class="col-lg-10">
                            <!-- select multiple -->
                            <select name="categories" multiple="" class="form-control">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['array_categories']->value, 'categories');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['categories']->value) {
?>
                                       <option value="$categories"><?php echo $_smarty_tpl->tpl_vars['categories']->value;?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </select>
                        </div>
                        </div>
                        <!-- aggiustare sto pulsante -->
                        <div class="form-group">
                        <input type="submit" name="salva" class="btn-success" value="Salva"  />
                        </div>
                </form>
    </div>
    </div>
</div><?php }
}
