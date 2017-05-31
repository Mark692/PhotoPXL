<?php
/* Smarty version 3.1.30, created on 2017-05-31 11:52:37
  from "/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/upload.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_592e9265e26211_29708084',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '137d5694e12ae60ded728e89932a780015462d9e' => 
    array (
      0 => '/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/upload.tpl',
      1 => 1496224357,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_592e9265e26211_29708084 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">
    <h2 class="text-success">Carica fino a tre foto conteporanemante:</h2><br />
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
                    <h3 class="text-success">Riservata:</h3><br />
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
                                                    <input name="is_reserved" type="radio" name="optionsRadios" id="optionsRadios2" value="FALSE">
                                                    No
                                                </label>
                                            </div>
                                          </div>
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
                    <div class="col-lg-12">
                            <select name="categories" multiple="" class="form-control">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['array_categories']->value, 'categories');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['categories']->value) {
?>
                                        <?php if ($_smarty_tpl->tpl_vars['categories']->value == $_smarty_tpl->tpl_vars['photo_deteils']->value['categories']) {?>
                                                <option value="$categories" selected="selected"><?php echo $_smarty_tpl->tpl_vars['categories']->value;?>
</option>
                                        <?php } else { ?>  <option value="$categories"><?php echo $_smarty_tpl->tpl_vars['categories']->value;?>
</option>
                                        <?php }?>
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
        <div class="row">
        <div class="col-md-6">
                    
                    <h3 class="text-success">Inserisci foto 2:</h3><br />
                        <div class="form-group">
                            <input name="photo" class="form-control" id="focusedInput" type="file" >
                        </div>
                    <h3 class="text-success">Titolo:</h3><br />
                    <div class="form-group">
                            <input name="title" class="form-control" id="focusedInput" type="text" placeholder="inserisci titolo..." >
                    </div>
                    <h3 class="text-success">Riservata:</h3><br />
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
                                                    <input name="is_reserved" type="radio" name="optionsRadios" id="optionsRadios2" value="FALSE">
                                                    No
                                                </label>
                                            </div>
                                          </div>
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
                    <div class="col-lg-12">
                            <select name="categories" multiple="" class="form-control">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['array_categories']->value, 'categories');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['categories']->value) {
?>
                                        <?php if ($_smarty_tpl->tpl_vars['categories']->value == $_smarty_tpl->tpl_vars['photo_deteils']->value['categories']) {?>
                                                <option value="$categories" selected="selected"><?php echo $_smarty_tpl->tpl_vars['categories']->value;?>
</option>
                                        <?php } else { ?>  <option value="$categories"><?php echo $_smarty_tpl->tpl_vars['categories']->value;?>
</option>
                                        <?php }?>
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
        <div class="row">
        <div class="col-md-6">
                    
                    <h3 class="text-success">Inserisci foto 3:</h3><br />
                        <div class="form-group">
                            <input name="photo" class="form-control" id="focusedInput" type="file" >
                        </div>
                    <h3 class="text-success">Titolo:</h3><br />
                    <div class="form-group">
                            <input name="title" class="form-control" id="focusedInput" type="text" placeholder="inserisci titolo..." >
                    </div>
                    <h3 class="text-success">Riservata:</h3><br />
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
                                                    <input name="is_reserved" type="radio" name="optionsRadios" id="optionsRadios2" value="FALSE">
                                                    No
                                                </label>
                                            </div>
                                          </div>
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
                    <div class="col-lg-12">
                            <select name="categories" multiple="" class="form-control">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['array_categories']->value, 'categories');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['categories']->value) {
?>
                                        <?php if ($_smarty_tpl->tpl_vars['categories']->value == $_smarty_tpl->tpl_vars['photo_deteils']->value['categories']) {?>
                                                <option value="$categories" selected="selected"><?php echo $_smarty_tpl->tpl_vars['categories']->value;?>
</option>
                                        <?php } else { ?>  <option value="$categories"><?php echo $_smarty_tpl->tpl_vars['categories']->value;?>
</option>
                                        <?php }?>
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
