<?php /* Smarty version 2.6.30, created on 2017-02-16 09:41:09
         compiled from album.tpl */ ?>
<div class="table">
    <table class="tabella"  align="center" border="3" cellpadding="5" cellspacing="0">
	<tr class="contenuto">
			<td>
			<table class="colonna foto" cellpadding="5" cellspacing="2">
                            <?php $_from = $this->_tpl_vars['thumbnail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['array1']):
?>
                                <tr>
                                <?php $_from = $this->_tpl_vars['array1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['valore']):
?>
                                    <td>
                                <img src=<?php echo $this->_tpl_vars['valore']; ?>
 width="100" height="100" > 
                                    </td>
                                <?php endforeach; endif; unset($_from); ?>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                </table> 
			</td>
		<td class="colonna dati album" width="900px">
			<p><label for="Title" class="top">Titolo:</ br> <?php echo $this->_tpl_vars['dati_album']['title']; ?>
</label></p>
                        <p><label for="Title" class="top">Descrizione</ br> <?php echo $this->_tpl_vars['dati_album']['description']; ?>
</label></p>
                        <p><label for="categories" class="top">Categoria</ b>
                              <?php $_from = $this->_tpl_vars['dati_album']['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cat']):
?>
                                  <label><?php echo $this->_tpl_vars['cat']; ?>
</label>
                              <?php endforeach; endif; unset($_from); ?>
                            </label></p>
                            <form class="modulo" action="index.php">
                                <p><input type="hidden" name="controller" value="album" />
                                <input type="hidden" name="task" value="modifica" />
                                <input type="submit" name="Modifica" class="button" value="Modifica Album"  /></p>
                            </form>
                            <form class="modulo" action="index.php">
                                <p><input type="hidden" name="controller" value="album" />
                                <input type="hidden" name="task" value="elimina album" />
                                <input type="submit" name="Elimina" class="button" value="Elimina Album"  /></p>
                            </form>
                            <form class="modulo" action="index.php">
                                <p><input type="hidden" name="controller" value="album" />
                                <input type="hidden" name="task" value="elimina album" />
                                <input type="submit" name="Aggiungi" class="button" value="Aggiungi Foto"  /></p>
                            </form>
                            
                            
                               
		</td>
	</tr>

    </table>
</div>
