<?php /* Smarty version 2.6.30, created on 2017-05-10 12:01:03
         compiled from login.tpl */ ?>
<table>
    <tr >
        <td class="colonna" align="center">
                <table>
                    <?php $_from = $this->_tpl_vars['ultime_foto']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['array1']):
?>
                        <tr>
                            <?php $_from = $this->_tpl_vars['array1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['valore']):
?>
                                <td>
                                    <img src="<?php echo $this->_tpl_vars['valore']; ?>
" class="thumbnail">  
                                </td>
                            <?php endforeach; endif; unset($_from); ?>
                        </tr>
                    <?php endforeach; endif; unset($_from); ?>
                </table> 
                <p><label for="descrizione" class="top">descrizione del sito</label></p>
        </td>
        <td class="colonna" align="center">
            <h1 class="title">Login</h1>
            <form method="POST" action="index.php">
                      <p><label for="username" class="top">Nome utente:</label><br />
                          <input type="text" name="username" class="input" value="" />
                      </p>
                      <p><label for="password" class="top">Password:</label><br />
                          <input type="password" name="password" class="input" value="" /></p>
                      
                      <p><input type="hidden" name="controller" value="login" />
                         <input type="hidden" name="task" value="autentica" />
                         <input type="submit" name="login" class="button" value="Login"  /> </p>
            </form>
            </div>
        </td>
    </tr>
</table>
