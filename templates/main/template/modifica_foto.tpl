<table class="tabella" align="center" border="3" cellpadding="5" cellspacing="0">
    <tr class="contenuto">
            <td class="colonna1" width="900px" align="center">
                <h3 class="title">Foto da modificare:</h3><br/>
                   <div class="foto">
                        <img src={$foto}></p>
                   </div>

                <form method="post" action="index.php">
                    <div class="pulsante">
                    <p><input type="hidden" name="controller" value="upload" />
                        <input type="hidden" name="task" value="elimina" />
                        <input type="submit" name="elimina" class="button" value="Elimina"  /></p>
                    </div>
                </form>
            </td>
            <td class="colonna" width="900px" align="center">
                <h3 class="title">Dati foto </h3>
                <div class="modulo">
                <form method="post" action="index.php">
                      <p><label for="Title">Titolo:</label><br />
                          <input type="text" name="title" id="username" value="{$dati_foto.title}"/></p>
                      <p><label for="Description" >Descrizione</label><br />
                      <textarea type="text" name="Description" cols="20" rows="5">{$dati_foto.description}</textarea></p>
                      {*{if dati_utente.roles gt 1}*}
                          <p><label for="is_reserved">Riservata:</label><br />
                                {if "TRUE" eq $dati_foto.is_reserved}
                                    Si<input type="radio" name="is_reserved" value="TRUE" checked="checked"/>
                                    No<input type="radio" name="is_reserved" value="FALSE"/>
                                {else}
                                    Si<input type="radio" name="is_reserved" value="TRUE"/>
                                    No<input type="radio" name="is_reserved" value="FALSE" checked="checked"/>
                                {/if}
                      {*{/if}*}
                      <p><label for="Categories">Categoria</label><br />
                          <select name="Categories" multiple>
                            {foreach from=$array_categories item=categories}
                                {if $categories eq $dati_foto.categories}
                                    <option value="$categories" selected="selected">{$categories}</option>
                                {else} <option value="$categories">{$categories}</option>
                                {/if}
                            {/foreach}
                          </select>
                      <div class="pulsante"
                      <p><input type="hidden" name="controller" value="upload" />
                         <input type="hidden" name="task" value="salva" />
                         <input type="submit" name="salva" class="button" value="Salva"  /></p>
                      </div>
                </form>
                </div>
        </td>
    </tr>
</table>