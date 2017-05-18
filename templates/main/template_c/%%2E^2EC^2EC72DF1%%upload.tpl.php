<?php /* Smarty version 2.6.30, created on 2017-05-10 20:25:54
         compiled from upload.tpl */ ?>
<form method="post" action="index.php">
<table class="tabella" align="center" border="3" cellpadding="5" cellspacing="0">
        <tr class="contenuto">
                  <td class="foto" width="900px" align="center">
                        <div class="foto1">
                            <h3 class="title">Inserisci foto:</h3><br />
                            <p><input type="file" name="foto_profilo" id="foto_profilo" class="field" value=""></p>
                        </div>
                  </td>
                  <td class="colonna login" width="900px" align="center">
                        <div class="modulo">
                            <h3 class="title">Dati foto </h3>
                            <p><label for="Title" class="top">Titolo:</label><br />
                            <input type="text" name="title" id="title" class="field" value=""/></p>
                            <p><label for="Description" class="top">Descrizione:</label><br />
                            <textarea type="text" name="Description" cols="20" rows="5">inserisci...</textarea></p>
                            <select name="is_reserved">
                                <option value="FALSE">No</option>
                                <option value="TRUE">Si</option>
                            </select>
                            <p><label for="Categories" class="top">Categoria</label><br />
                        <select name="Categories" multiple>
                            <?php $_from = $this->_tpl_vars['array_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['categories']):
?>
                                <option value="$categories" checked><?php echo $this->_tpl_vars['categories']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select></p> 
                        </div>
                   </td>
        </tr>
        <tr class="contenuto">
                  <td class="foto1" width="900px" align="center">
                        <div class="foto">
                            <h3 class="title">Inserisci foto:</h3><br />
                            <p><input type="file" name="foto_profilo" id="foto_profilo" class="field" value=""></p>
                        </div>
                  </td>
                  <td class="colonna login" width="900px" align="center">
                        <div class="modulo">
                            <h3 class="title">Dati foto </h3>
                            <p><label for="Title" class="top">Titolo:</label><br />
                            <p><input type="text" name="title" id="title" class="field" value=""/></p>
                            <p><label for="Description" class="top">Descrizione:</label><br />
                            <p><textarea type="text" name="Description" cols="20" rows="5">inserisci...</textarea></p>
                            <select name="is_reserved">
                                <option value="FALSE">No</option>
                                <option value="TRUE">Si</option>
                            </select>
                            <p><label for="Categories" class="top">Categoria</label><br /></p>
                                <select name="Categories" multiple>
                            <?php $_from = $this->_tpl_vars['array_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['categories']):
?>
                                <option value="$categories" checked><?php echo $this->_tpl_vars['categories']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                            </select>
                    </div>
                  </td>
        </tr>
        <tr class="contenuto">
                    <td class="foto1" width="900px" align="center">
                        <div class="foto">
                            <h3 class="title">Inserisci foto:</h3></p><br />
                            <p><input type="file" name="foto_profilo" id="foto_profilo" class="field" value=""></p>
                        </div>
                    </td>
                    <td class="colonna login" width="900px" align="center">
                        <div class="modulo">
                            <h3 class="title">Dati foto </h3>
                            <p><label for="Title" class="top">Titolo:</label><br />
                            <P><input type="text" name="title" id="title" class="field" value=""/></p>
                            <p><label for="Description" class="top">Descrizione:</label><br />
                            <textarea type="text" name="Description" cols="20" rows="5">inserisci...</textarea></p>
                            <p><label for="is_reserved" class="top">Riservata</label><br />
                            <select name="is_reserved">
                                <option value="FALSE">No</option>
                                <option value="TRUE">Si</option>
                            </select>
                            <p><label for="Categories" class="top">Categoria</label><br />
                            <select name="Categories" multiple>
                            <?php $_from = $this->_tpl_vars['array_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['categories']):
?>
                                <option value="$categories" checked><?php echo $this->_tpl_vars['categories']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </div>
                    </td>
        </tr>
        <tr>
                    <td>

                        <fieldset>
                            <div class="tasto">
                            <p><input type="hidden" name="controller" value="upload" /></p>
                                          <p><input type="hidden" name="task" value="salva" /></p>
                                          <p><input type="submit" name="salva" class="button" value="Salva"  /></p>
                            </div>
                        </fieldset>
                    </td>
        </tr>             
</table>
</form>
