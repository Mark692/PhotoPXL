<?php /* Smarty version 2.6.30, created on 2017-02-14 15:16:09
         compiled from login.tpl */ ?>
<table class="tabella" align="center" border="3" cellpadding="5" cellspacing="0">
    <tr class="contenuto">
        <td class="colonna1" width="900px" align="center">
            <fieldset>
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
                <p><label for="descrizione" class="top">descrizione del sito</label></p>
            </div>
        </td>
        <td class="colonna login" width="900px" align="center">
            <h1 class="title">Login</h1>
            <div class="modulo">
            <form method="post" action="index.php">
                      <p><label for="username" class="top">Nome utente:</label><br />
                          <input type="text" name="username" id="username" tabindex="15" class="field" value="" />
                      </p>
                      <p><label for="password" class="top">Password:</label><br />
                          <input type="password" name="password" id="password" tabindex="15" class="field" value="" /></p>
                      <div class="pulsante"
                      <p><input type="hidden" name="controller" value="login" />
                         <input type="hidden" name="task" value="autentica" />
                         <input type="submit" name="login" class="button" value="Login"  /> </p>
                      </div>
            </form>
            </div>
        </td>
    </tr>
</table>
