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
                        {foreach from=$Array_categories item=$catgories_scritte}
                             <option value="$categories" checked>$catgories_scritte</option>
                        {/foreach}
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
