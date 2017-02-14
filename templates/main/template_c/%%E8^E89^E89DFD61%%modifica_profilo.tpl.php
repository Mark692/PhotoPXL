<?php /* Smarty version 2.6.30, created on 2017-02-14 16:09:46
         compiled from modifica_profilo.tpl */ ?>
<div class="table">
    <table class="tabella"  align="center" border="3" cellpadding="5" cellspacing="0">
	<tr class="contenuto">
		<td class="colonna foto">
			<div class="foto">
                            <table>
                                <?php $_from = $this->_tpl_vars['ultime_foto']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
                        </div>
		</td>
		<td class="colonna dati album" width="900px">
		<form class="modulo" action="index.php">
			<img src=<?php echo $this->_tpl_vars['immagine_profilo']; ?>
>
                        <div class="pulsante"
                            <p><input type="hidden" name="controller" value="profilo" />
                             <input type="hidden" name="task" value="update" />
                             <input type="submit" name="Salva" class="button" value="Modifica"/></p>
                        </div>
			<p><label for="Title" class="top">Username:</ br> </label>
			<input type="text" name="Username" id="title" class="field" value="<?php echo $this->_tpl_vars['utente']['username']; ?>
"/></p>
			<p><label for="Title" class="top">Password:</ br> </label>
			<input type="Password" name="title" id="title" class="field" value="<?php echo $this->_tpl_vars['utente']['password']; ?>
"/></p>
			<p><label for="Title" class="top">email:</ br></label>
			<input type="text" name="email" id="title" class="field" value="<?php echo $this->_tpl_vars['utente']['email']; ?>
"/></p>
			<p><label for="Title" class="top">Ruolo:</ br> <?php echo $this->_tpl_vars['utente']['role']; ?>
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