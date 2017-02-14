<?php /* Smarty version 2.6.30, created on 2017-02-14 17:27:25
         compiled from diventa_pro.tpl */ ?>
<table class="tabella"  align="center" border="3" cellpadding="5" cellspacing="0"
    <tr>
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
	<td class="colonna ricerca" width="900px">
            <div class="metodo">
		<form method="POST" action="index.php">
                    <h1 class="title">Diventa Pro Adesso!!!</h1>
                        <p><label for="Categories" class="top">I vantaggi nel diventare PRO:</label></ br>
                        <ul>
                            <li>Potrai caricare foto illimitate</li>
                            <li>Potrai impostare la visibilità delle tue foto e album</li>
                            <li>Potrai caricare fino a 3 foto contemporaneamente</li>
                        </ul>
                        <p><input type="hidden" name="controller" value="Profilo" />
                            <input type="hidden" name="task" value="Cambia_ruolo" />
                            <input type="submit" name="cerca" class="button" value="Diventa Pro"  /></p>
                </form>
            </div>
	</td>
    </tr>
</table>