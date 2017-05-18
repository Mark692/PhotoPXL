<?php /* Smarty version 2.6.30, created on 2017-05-12 11:21:33
         compiled from modifica_profilo.tpl */ ?>
<table>
                    <tr>
			<td class="colonna" align="center">
			<table cellpadding="5" cellspacing="2">
                            <?php $_from = $this->_tpl_vars['thumbnail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['array1']):
?>
                                <tr>
                                <?php $_from = $this->_tpl_vars['array1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['valore']):
?>
                                    <td>
                                <img src="<?php echo $this->_tpl_vars['valore']; ?>
" class="thumbnail" > 
                                    </td>
                                <?php endforeach; endif; unset($_from); ?>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                        </table> 
                        </td>
		</td>
		<td class="colonna" align="center">
		<form class="modulo" action="index.php">
			<img src=<?php echo $this->_tpl_vars['immagine_profilo']; ?>
>
                        <div class="pulsante"
                            <p><input type="hidden" name="controller" value="profilo" />
                             <input type="hidden" name="task" value="update" />
                             <input type="submit" name="Salva" class="button" value="Modifica"/></p>
                        </div>
			<p><label for="Title">Username:</ br> </label>
			<input type="text" name="Username" id="title" value="<?php echo $this->_tpl_vars['utente']['username']; ?>
"/></p>
			<p><label for="Title">Password:</ br> </label>
			<input type="Password" name="title" id="title" value="<?php echo $this->_tpl_vars['utente']['password']; ?>
"/></p>
			<p><label for="Title">email:</ br></label>
			<input type="text" name="email" id="title" value="<?php echo $this->_tpl_vars['utente']['email']; ?>
"/></p>
			<p><label for="Title">Ruolo:</ br> <?php echo $this->_tpl_vars['utente']['role']; ?>
</label></p>
			<div class="pulsante"
                      <p><input type="hidden" name="controller" value="profilo" />
                         <input type="hidden" name="task" value="update" />
                         <input type="submit" name="Salva" class="button" value="Salva Modifiche"/></p>
                </div>
            </form>
            
		</td>
	</tr>

    </table>
</div>