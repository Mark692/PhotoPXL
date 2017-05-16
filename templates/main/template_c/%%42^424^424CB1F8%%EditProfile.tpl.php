<?php /* Smarty version 2.6.30, created on 2017-05-16 13:02:30
         compiled from EditProfile.tpl */ ?>
<div class="container">
    <div class="row">
    <div class="col-md-6">
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
" class="thumbnail" > <!-- sistemare il css per le thumb -->
                                    </td>
                                <?php endforeach; endif; unset($_from); ?>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                        </table> 
    </div>
    <div class="col-md-6">
		<form metod="POST" action="index.php">
			<img src="<?php echo $this->_tpl_vars['user_details']['pic']; ?>
" class="thumbnail">
                            <input type="hidden" name="controller" value="profilo" />
                            <input type="hidden" name="task" value="update" />
                            <input type="submit" name="Salva" class="btn-success" value="Modifica"/>
                            <h3 class="text-success">Username:</h3><br />
                            <div class="form-group">
                                <input class="form-control" id="focusedInput" type="text" value=<?php echo $this->_tpl_vars['user_details']['username']; ?>
>
                            </div>
                            <h3 class="text-success">Password:</h3><br />
                            <div class="form-group">
                                <input class="form-control" id="focusedInput" type="text" value="<?php echo $this->_tpl_vars['user_details']['password']; ?>
">
                            </div>
                            <h3 class="text-success">Email:</h3><br />
                            <div class="form-group">
                                <input class="form-control" id="focusedInput" type="text" value="<?php echo $this->_tpl_vars['user_details']['email']; ?>
">
                            </div>
                            <h3 class="text-success">Ruolo:</h3><br /><?php echo $this->_tpl_vars['user_details']['role']; ?>

                            <input type="hidden" name="controller" value="profilo" />
                            <input type="hidden" name="task" value="update" />
                            <input type="submit" name="Salva" class="btn-success" value="Salva Modifiche"/>
                </form>
    </div>
    </div>
</div>