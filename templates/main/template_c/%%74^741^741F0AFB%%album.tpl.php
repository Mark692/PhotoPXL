<?php /* Smarty version 2.6.30, created on 2017-02-14 14:50:41
         compiled from album.tpl */ ?>
<div class="table">
    <table class="tabella"  align="center" border="3" cellpadding="5" cellspacing="0">
	<tr class="contenuto">
			<td>
			<table class="colonna foto" cellpadding="5" cellspacing="2">
                            <?php $_from = $this->_tpl_vars['thumbnail_utente']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['array1']):
?>
                                <tr>
                                <?php $_from = $this->_tpl_vars['array1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['valore']):
?>
                                    <td>
                                <?php echo $this->_tpl_vars['valore']; ?>
  
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
		</td>
	</tr>

    </table>
</div>
