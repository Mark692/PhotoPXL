<?php /* Smarty version 2.6.30, created on 2017-05-10 10:42:33
         compiled from home_loggati.tpl */ ?>
<table>
    <tr>
	<td class="colonna" align="center">
		<table>
                    <?php $_from = $this->_tpl_vars['foto_home']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['array1']):
?>
                        <tr>
                            <?php $_from = $this->_tpl_vars['array1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['valore']):
?>
                                <td>
                                    <img src="<?php echo $this->_tpl_vars['valore']; ?>
" class="thumbnail" > </img>
                                </td>
                            <?php endforeach; endif; unset($_from); ?>
                        </tr>
                    <?php endforeach; endif; unset($_from); ?>
                </table> 
	</td>
	<td class="colonna" align="center">
            <div class="metodo">
		<form method="POST" action="index.php">
                    <h3 class="title">Ricerca per categoria</h3>
                        <p><label for="Categories" class="top">Categoria</label><br />
                        <select name="Categories" multiple>
                            <?php $_from = $this->_tpl_vars['array_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['categories']):
?>
                                <option value="$categories" checked><?php echo $this->_tpl_vars['categories']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select></p>
                        <p><input type="hidden" name="controller" value="cerca" />
                            <input type="hidden" name="task" value="search_photo_by_categories" />
                            <input type="submit" name="cerca" class="button" value="Inizia a Cercare"  /></p>
                </form>
            </div>
	</td>
    </tr>
</table>
    
    
    