<table class="tabella" align="center" border="3" cellpadding="5" cellspacing="0">
<form method="post" action="index.php">
      <tr class="contenuto">
          <td class="foto1" width="900px" align="center">
            <div class="foto1">
            <h3 class="title">Inserisci foto:</h3>
            <input type="file" name="foto_profilo" id="foto_profilo" class="field" value="">
            </p>
            </p><br />
            </div>
      </td>
<td class="colonna login" width="900px" align="center">
<h3 class="title">Dati foto </h3>
<div class="modulo">
  <form method="post" action="index.php">
              <p><label for="Title" class="top">Titolo:</label><br />
                  <input type="text" name="title" id="title" class="field" value=""/>
              </p>
              <p><label for="Description" class="top">Descrizione:</label><br />
              <textarea type="text" name="Description" cols="20" rows="5">inserisci...</textarea>
              </p>
              <p><label for="Categories" class="top">Categoria</label><br />
                  <select name="Categories" multiple>
                  {foreach from=$Array_categories item=$categories}
                    <option value="$categories" checked>$catgories</option>
                  {/foreach}
                  </select> 
</div>
</td>
</tr>
<tr class="contenuto">
          <td class="foto1" width="900px" align="center">
            <div class="foto1">
            <h3 class="title">Inserisci foto:</h3>
            <input type="file" name="foto_profilo" id="foto_profilo" class="field" value="">
            </p>
            </p><br />
            </div>
      </td>
<td class="colonna login" width="900px" align="center">
<h3 class="title">Dati foto </h3>
<div class="modulo">
  <form method="post" action="index.php">
              <p><label for="Title" class="top">Titolo:</label><br />
                  <input type="text" name="title" id="title" class="field" value=""/>
              </p>
              <p><label for="Description" class="top">Descrizione:</label><br />
              <textarea type="text" name="Description" cols="20" rows="5">inserisci...</textarea>
              </p>
              <p><label for="Categories" class="top">Categoria</label><br />
                  <select name="Categories" multiple>
                  {foreach from=$Array_categories item=$categories}
                    <option value="$categories" checked>$catgories</option>
                  {/foreach}
                  </select> 
</div>
</td>
</tr>
<tr class="contenuto">
          <td class="foto1" width="900px" align="center">
            <div class="foto1">
            <h3 class="title">Inserisci foto:</h3>
            <input type="file" name="foto_profilo" id="foto_profilo" class="field" value="">
            </p>
            </p><br />
            </div>
      </td>
<td class="colonna login" width="900px" align="center">
<h3 class="title">Dati foto </h3>
<div class="modulo">
  <form method="post" action="index.php">
              <p><label for="Title" class="top">Titolo:</label><br />
                  <input type="text" name="title" id="title" class="field" value=""/>
              </p>
              <p><label for="Description" class="top">Descrizione:</label><br />
              <textarea type="text" name="Description" cols="20" rows="5">inserisci...</textarea>
              </p>
              {if dati_utente.roles gt $standard}
                  <p><label for="is_reserved" class="top">Riservata</label><br />
                  <select name="is_reserved">
                  {foreach from=$Array_is_reserved key=key item=is_reserved}
                    <option value="$is_reserved">$key</option>
                  {/foreach}
                  </select>
              {/if}
              <p><label for="Categories" class="top">Categoria</label><br />
                  <select name="Categories" multiple>
                  {foreach from=$Array_categories item=$categories}
                    <option value="$categories" checked>$catgories</option>
                  {/foreach}
                  </select> 
</div>
</td>
</tr>
<td>
<tr>
<fieldset>
<div class="tasto">
<p><input type="hidden" name="controller" value="upload" /></p>
              <p><input type="hidden" name="task" value="salva" /></p>
              <p><input type="submit" name="salva" class="button" value="Salva"  /></p>
              </div>
</fieldset>
</tr>  
</td>            
</form>
</table>
