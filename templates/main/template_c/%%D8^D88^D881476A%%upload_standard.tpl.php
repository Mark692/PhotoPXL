<?php /* Smarty version 2.6.30, created on 2017-05-10 20:33:43
         compiled from upload_standard.tpl */ ?>
<form method="post" action="index.php">
    <table class="tabella" align="center" border="3" cellpadding="5" cellspacing="0">
    
        <tr class="contenuto">
            <td class="foto1" width="900px" align="center">
                <h3 class="title">Inserisci foto:</h3><br />
                <div class="foto1">
                    <p><input type="file" name="foto" id="foto_profilo" class="field" value=""></p>
                </div>
            </td>
            <td class="colonna login" width="900px" align="center">
                <h3 class="title">Dati foto </h3>
                <div class="modulo">
                <p><label for="Title" class="top">Titolo:</label><br />
                   <input type="text" name="title" id="title" class="field" value=""/></p>
                <p><label for="Description" class="top">Descrizione:</label><br />
                    <textarea type="text" name="Description" cols="20" rows="5">inserisci...</textarea></p>
                <p><label for="Categories" class="top">Categoria</label><br />
                   <select name="Categories" multiple>
                            <?php $_from = $this->_tpl_vars['array_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['categories']):
?>
                                <option value="$categories" checked><?php echo $this->_tpl_vars['categories']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                   </select> 
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="tasto">
                    <p><input type="hidden" name="controller" value="upload" />
                    <input type="hidden" name="task" value="salva" />
                    <input type="submit" name="salva" class="button" value="Salva"  /></p>
                </div>
            </td> 
        </tr>            

    </table>
</form>