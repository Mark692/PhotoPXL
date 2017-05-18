<?php /* Smarty version 2.6.30, created on 2017-05-12 11:26:54
         compiled from profilo.tpl */ ?>
<table>
	<tr>
            <td class="colonna" align="center">
			<table>
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
		 <td class="colonna" align="center">
			<img src="<?php echo $this->_tpl_vars['immagine_profilo']; ?>
" class="thumbnail">
			<p><label for="Title"><h2>Username:</h2><br /><?php echo $this->_tpl_vars['utente']['username']; ?>
</label></p>
                        <p><label for="Title"><h2>Email:</h2><br /><?php echo $this->_tpl_vars['utente']['email']; ?>
</label></p>
                        <p><label for="Title"><h2>Ruolo:</h2><br /><?php echo $this->_tpl_vars['utente']['role']; ?>
</label></p>
			
                        <form method="post" action="index.php">  
                            <p><input type="hidden" name="controller" value="profilo" />
                         <input type="hidden"  name="username" value="<?php echo $this->_tpl_vars['utente']['username']; ?>
">
                         <input type="hidden" name="email" value"<?php echo $this->_tpl_vars['utente']['email']; ?>
">
                         <input type="hidden" name="role" value"<?php echo $this->_tpl_vars['utente']['role']; ?>
">
                         <input type="hidden" name="task" value="modifica" />
                         <input type="submit" name="Modifica" class="button" value="Modifica Profilo"/></p>
                        </form>	
                 </td>
		
	</tr>

</table>
    