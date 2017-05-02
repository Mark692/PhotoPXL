
<!-- può essere fatto un solo template sfruttando foto altri user -->


<table>
<tr>
<td class="colonna" align="center">
<fieldset>
    <p><label for="Title" class="top"><h2>Titolo:</h2></label><br /></p>
                <p><label for="Title">{$dati_foto.title}</label></p> </br>
                <p><img src="{$dati_foto.fullsize}" width="300px" height="300px"></p>
                <p><label for="like"><h2>like:</h2>{$dati_foto.total_like}<br /></label></p>
                <form class="modulo" action="index.php">
                    {if $attiva eq "TRUE"}
                    <p><input type="hidden" name="controller" value="Like" />
                       <input type="hidden" name="task" value="Add_like" />
                       <input type="submit" name="like" class="button" value="Mi Piace"  /></p>
                    {else}
                    <p><input type="hidden" name="controller" value="Like" />
                       <input type="hidden" name="task" value="Remove_like" />
                       <input type="submit" name="like" class="button" value="Non Mi Piace Pi&ugrave;"  /></p>
                    {/if}
                </form>
                <p><label for="date"><h2>Data di pubblicazione:</h2>{$dati_foto.upload_date}<br /></label></p>
                <p><label for="album"><h2>Album di appartenenza:</h2>{$dati_foto.name_album}<br /></label></p>
                
</fieldset>
</td>
<td class="colonna" align="center">
    <p><label for="Description"><h2>Descrizione:</h2><br />{$dati_foto.description}</label></p>
              <p><label for="is_reserved"><h2>Riservata:</h2></label><br />{$dati_foto.is_reserved}</label></p>   
              <p><label for="Categories" ><h2>Categoria:</h2></label><br />{$dati_foto.categories}</label></p>
              <form method="post" action="index.php">
                  <p><label for="commento"><h2>Commento:</h2></label><br />
                  <textarea name="commento"rows="4" cols="50">.....</textarea>
      
                    <p><input type="hidden" name="controller" value="commento" />
                    <p><input type="hidden" name="task" value="inserisci" />
                    <p><input type="submit" name="modifica" class="button" value="Commenta"  /></p>
              </form>
</td>
</tr>
<!-- come mettere i commenti già esistenti -->
</table>