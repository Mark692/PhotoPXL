<?php /* Smarty version 2.6.30, created on 2017-02-14 13:46:48
         compiled from prova.tpl */ ?>
<p>Ecco i quattro componenti degli ABBA:</p>
<table>
<?php $_from = $this->_tpl_vars['abba']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['array1']):
?>
    <tr>
    <?php $_from = $this->_tpl_vars['array1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['valoredelporcodio']):
?>
        <td>
    <?php echo $this->_tpl_vars['valoredelporcodio']; ?>
  
        </td>
<?php endforeach; endif; unset($_from); ?>
    </tr>
<?php endforeach; endif; unset($_from); ?>
</table> 
