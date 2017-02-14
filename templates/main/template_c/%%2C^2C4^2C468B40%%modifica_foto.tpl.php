<?php /* Smarty version 2.6.30, created on 2017-02-14 15:58:18
         compiled from modifica_foto.tpl */ ?>
<table class="tabella" align="center" border="3" cellpadding="5" cellspacing="0">
    <tr class="contenuto">
            <td class="colonna1" width="900px" align="center">
                <h3 class="title">Foto da modificare:</h3><br/>
                   <div class="foto">
                        <img src=<?php echo $this->_tpl_vars['foto']; ?>
></p>
                   </div>

                <form method="post" action="index.php">
                    <div class="pulsante">
                    <p><input type="hidden" name="controller" value="upload" />
                        <input type="hidden" name="task" value="elimina" />
                        <input type="submit" name="elimina" class="button" value="Elimina"  /></p>
                    </div>
                </form>
            </td>
            <td class="colonna" width="900px" align="center">
                <h3 class="title">Dati foto </h3>
                <div class="modulo">
                <form method="post" action="index.php">
                      <p><label for="Title" class="top">Titolo:</label><br />
                          <input type="text" name="title" id="username" class="field" value="<?php echo $this->_tpl_vars['dati_foto']['title']; ?>
"/></p>
                      <p><label for="Description" class="top">Descrizione</label><br />
                      <textarea type="text" name="Description" cols="20" rows="5"><?php echo $this->_tpl_vars['dati_foto']['description']; ?>
</textarea></p>
                                                <p><label for="is_reserved" class="top">Riservata:</label><br />
                                <?php if ('TRUE' == $this->_tpl_vars['dati_foto']['is_reserved']): ?>
                                    Si<input type="radio" name="is_reserved" value="TRUE" checked="checked"/>
                                    No<input type="radio" name="is_reserved" value="FALSE"/>
                                <?php else: ?>
                                    Si<input type="radio" name="is_reserved" value="TRUE"/>
                                    No<input type="radio" name="is_reserved" value="FALSE" checked="checked"/>
                                <?php endif; ?>
                                            <p><label for="Categories" class="top">Categoria</label><br />
                          <select name="Categories" multiple>
                            <?php $_from = $this->_tpl_vars['array_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['categories']):
?>
                                <?php if ($this->_tpl_vars['categories'] == $this->_tpl_vars['dati_foto']['categories']): ?>
                                    <option value="$categories" selected="selected"><?php echo $this->_tpl_vars['categories']; ?>
</option>
                                <?php else: ?> <option value="$categories"><?php echo $this->_tpl_vars['categories']; ?>
</option>
                                <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?>
                          </select>
                      <div class="pulsante"
                      <p><input type="hidden" name="controller" value="upload" />
                         <input type="hidden" name="task" value="salva" />
                         <input type="submit" name="salva" class="button" value="Salva"  /></p>
                      </div>
                </form>
                </div>
        </td>
    </tr>
</table>