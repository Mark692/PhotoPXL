<table class="tabella" align="center" border="3" cellpadding="5" cellspacing="0">
<tr class="contenuto">
<td class="colonna1" width="900px" align="center">
<fieldset>
<div class="foto">
                <p><label for="Title" class="top">Titolo:</label><br /></p>
                <p><input type="text" name="title" id="title" class="field" value="{$dati_foto.title}"/></p> </br>
                <p><img src={$dati_foto.fullsize}></p>
                <p><label for="like" class="top">like:{$numero_di_like}><br /></p>
                <p><label for="date" class="top">Data di pubblicazione:{$upload_date}><br /></p>
                <p><label for="date" class="top">Album di appartenenza:{$name_album}><br /></p>
                {if "se si tratta dell'utente a cui appartiene la foto"}
                <form method="post" action="deve andare alla pagina di modifca">
                    <p><input type="hidden" name="controller" value="modifica_foto da definire" />
                    <p><input type="hidden" name="task" value="modifca" />
                    <p><input type="submit" name="modifica" class="button" value="Modifica"  /></p>
                </form>
                {/if}
</fieldset>
</p><br />
</fieldset>
</div>
</td>
<td class="colonna login" width="900px" align="center">
<h3 class="title">Dati foto </h3>
<div class="modulo">
  <form method="post" action="index.php">
              <p><label for="Title" class="top">Titolo:</label><br />
                  <input type="text" name="title" id="username" class="field" value="{$dati_foto.title}"/>
              </p>
              <p><label for="Description" class="top">Descrizione</label><br />
              <textarea type="text" name="Description" cols="20" rows="5">{$dati_foto.description}</textarea>
              </p>
              {if dati_utente.roles gt $standard}
                  <p><label for="is_reserved" class="top">Riservata</label><br />
                  <select name="is_reserved">
                  {foreach from=$Array_is_reserved key=key item=is_reserved}
                  {if $is_reserved eq $utente.is_reserved}
                    <option value="$is_reserved" checked>$key</option>
                  {else}<option value="$is_reserved">$key</option>
                  {/if}
                  {/foreach}
                  </select>
                    
              {/if}
              <p><label for="Categories" class="top">Categoria</label><br />
                  <select name="Categories" multiple>
                  {foreach from=$Array_categories item=$categories}
                  {if $categories eq $utente.categories}
                    <option value="$categories" checked>$catgories</option>
                  {else} <option value="$categories">$catgories</option>
                  {/if}
                  }
                  {/foreach}
                  </select>
              <p><input type="hidden" name="controller" value="upload" />
              <p><input type="hidden" name="task" value="salva" />
              <p><input type="submit" name="salva" class="button" value="Salva"  />
              </p>
  </form>
</div>
</td>
</tr>
</table>