<?php /* Smarty version 2.6.30, created on 2017-02-14 16:14:25
         compiled from profilo.tpl */ ?>
<div class="table">
    <table class="tabella"  align="center" border="3" cellpadding="5" cellspacing="0">
	<tr class="contenuto">
			<td class="colonna foto">
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
			</td>
		<td class="colonna dati album" width="900px">
			<img src=<?php echo $this->_tpl_vars['immagine_profilo']; ?>
>
			<p><label for="Title" class="top">Username:</label< /br> <?php echo $this->_tpl_vars['utente']['username']; ?>
</label></p>
                        <p><label for="Title" class="top">email:</label< /br> <?php echo $this->_tpl_vars['utente']['email']; ?>
</label></p>
                        <p><label for="Title" class="top">Ruolo:</label< /br> <?php echo $this->_tpl_vars['utente']['role']; ?>
</label></p>
			
                        <form method="post" action="templates/main/template/modifica_profilo.tpl">
                            <div class="pulsante">   
                            <p><input type="hidden" name="controller" value="profilo" />
                         <input type="hidden"  name="username" value="<?php echo $this->_tpl_vars['utente']['username']; ?>
">
                         <input type="hidden" name="email" value"<?php echo $this->_tpl_vars['utente']['email']; ?>
">
                         <input type="hidden" name="role" value"<?php echo $this->_tpl_vars['utente']['role']; ?>
">
                         <input type="hidden" name="task" value="modifica" />
                         <input type="submit" name="Modifica" class="button" value="Modifica Profilo"/></p>
                        </div> 
                        </form>	
            
		</td>
	</tr>

</table>
</div>