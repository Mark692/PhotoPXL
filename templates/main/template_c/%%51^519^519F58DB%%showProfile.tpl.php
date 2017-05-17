<?php /* Smarty version 2.6.30, created on 2017-05-17 13:03:21
         compiled from showProfile.tpl */ ?>
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
" width="114" height="75" class="img-responsive" > 
                                        </td>
                                    <?php endforeach; endif; unset($_from); ?>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                        </table> 
    </div>
    <div class="col-md-6">
			<img src="<?php echo $this->_tpl_vars['pic_profile']; ?>
" class="thumbnail">
			<h3 class="text-success">Username:</h3><br /><?php echo $this->_tpl_vars['user_details']['username']; ?>

                        <h3 class="text-success">Email:</h3><br /><?php echo $this->_tpl_vars['user_details']['email']; ?>

                        <h3 class="text-success">Ruolo:</h3><br /><?php echo $this->_tpl_vars['role']; ?>

			
                        <form method="post" action="index.php">  
                            <p><input type="hidden" name="controller" value="profilo" />
                         <input type="hidden"  name="username" value="<?php echo $this->_tpl_vars['user_details']['username']; ?>
">
                         <input type="hidden" name="email" value"<?php echo $this->_tpl_vars['user_details']['email']; ?>
">
                         <input type="hidden" name="role" value"<?php echo $this->_tpl_vars['user_details']['role']; ?>
">
                         <input type="hidden" name="task" value="modifica" />
                         <input type="submit" name="Modifica" class="btn-success" value="Modifica Profilo"/></p>
                        </form>	
    </div>
    </div>                     
</div> 