<table class="tabella" align="center" border="3" cellpadding="5" cellspacing="0">
<tr class="contenuto">
<td class="colonna1" width="900px" align="center">
<fieldset>
<div class="foto">
<p>Foto da modificare:<br/>
<img src={$dati_foto.images}>
</p>
<form method="post" action="index.php">
<p><input type="hidden" name="controller" value="upload" />
              <p><input type="hidden" name="task" value="elimina" />
              <p><input type="submit" name="elimina" class="button" value="Elimina"  />
              </p>
</form>
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
              {if dati_utente.roles gt 1}
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