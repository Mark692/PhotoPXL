<table class="tabella" align="center" border="3" cellpadding="5" cellspacing="0">
<tr class="contenuto">
<td class="colonna1" width="900px" align="center">
<fieldset>
<div class="foto">
                <p><label for="Title" class="top">Titolo:</label><br /></p>
                <p><label for="Title" class="top">{$dati_foto.title}</label></p> </br>
                <p><img src={$dati_foto.fullsize}></p>
                <p><label for="like" class="top">like:{$numero_di_like}><br /></p>
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
              <p><label for="is_reserved" class="top"><{$dati_foto.is_reserved}</label></p>   
              <p><label for="categories" class="top">Categoria</label><br />
              <p><label for="categories" class="top"><{$dati_foto.categories}</label></p>
              <form method="post" action="deve andare alla pagina di modifca">
                    <p><input type="hidden" name="controller" value="modifica_foto da definire" />
                    <p><input type="hidden" name="task" value="modifca" />
                    <p><input type="submit" name="modifica" class="button" value="Modifica"  /></p>
              </form>
              {*aggiungere i commenti*}
</div>
</td>
</tr>
</table>