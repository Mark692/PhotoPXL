<table class="tabella" align="center" border="3" cellpadding="5" cellspacing="0">
<tr class="contenuto">
<td class="colonna1" width="900px" align="center">
<fieldset>
<div class="foto">
                <p><label for="Title" class="top">Titolo:</label><br /></p>
                <p><label for="Title" class="top">{$dati_foto.title}</label></p> </br>
                <p><img src={$dati_foto.fullsize}></p>
                <p><label for="like" class="top">like:{$total_like}><br /></p>
                <form class="modulo" action="index.php">
                    {if {$attiva}=='TRUE'}
                    <p><input type="hidden" name="controller" value="Like" />
                       <input type="hidden" name="task" value="Add_like" />
                       <input type="submit" name="like" class="button" value="Mi Piace"  /></p>
                    {else}
                    <p><input type="hidden" name="controller" value="Like" />
                       <input type="hidden" name="task" value="Remove_like" />
                       <input type="submit" name="like" class="button" value="Non Mi Piace Pi&ugrave;"  /></p>
                    {/if}
                </form>
                <p><label for="date" class="top">Data di pubblicazione:{$upload_date}><br /></p>
                <p><label for="date" class="top">Album di appartenenza:{$name_album}><br /></p>
                
</fieldset>
</p><br />
</fieldset>
</div>
</td>
<td class="colonna login" width="900px" align="center">
<h3 class="title">Dati foto </h3>
<div class="dati">
              <p><label for="Description" class="top">Descrizione</label><br />
              <p><label for="Description" class="top"><{$dati_foto.description}</label></p>
              <p><label for="is_reserved" class="top">Riservata</label><br />
              <p><label for="Description" class="top"><{$dati_foto.is_reserved}</label></p>   
              <p><label for="Categories" class="top">Categoria</label><br />
              <p><label for="Description" class="top"><{$dati_foto.categories}</label></p>
              <form method="post" action="deve andare alla pagina di modifca">
                  <p><label for="commento" class="top">Commento:</label><br />
                  <textarea name="commento"rows="4" cols="50">.....</textarea>
      
                    <p><input type="hidden" name="controller" value="commento" />
                    <p><input type="hidden" name="task" value="inserisci" />
                    <p><input type="submit" name="modifica" class="button" value="Commenta"  /></p>
              </form>
</div>
</td>
</tr>
</table>