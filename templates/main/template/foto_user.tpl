<div class="container">
    <div class="row">
    <div class="col-md-6">
                <p><label for="Title">Titolo:</label><br /></p>
                <p><label for="Title">{$photo_deteils.title}</label></p> </br>
                <p><img src={$photo_deteils.photo}></p>
                <p><label for="like">like:{$total_like}></label><br /></p>
                {if $attiva==="TRUE"}
                    <form method="post" action="deve andare alla pagina di modifca">
                        <p><input type="hidden" name="controller" value="user" /></p>
                        <p><input type="hidden" name="task" value="add_like" /></p>
                        <p><input type="hidden" name="id" value="{$photo_deteils.id}" /></p>
                    <p><input type="submit" name="modifica" class="button" value="Mi Piace"  /></p>
                    </form>
                    {else}
                        <form method="post" action="deve andare alla pagina di modifca">
                            <p><input type="hidden" name="controller" value="user" /></p>
                            <p><input type="hidden" name="task" value="remove_like" /></p>
                            <p><input type="hidden" name="id" value="{$photo_deteils.id}" /></p>
                    <p><input type="submit" name="modifica" class="button" value="Non Piace Piu&grave;"  /></p>
                    </form>
                {/if}
                <p><label for="date">Data di pubblicazione:{$photo_deteils.upload_date}></label><br /></p>
                <p><label for="date">Album di appartenenza:{$name_album}></label><br /></p>
</p><br />
</div>
</td>
<td width="750px" align="center">
<h3 class="title">Dati foto </h3>
<div class="dati">
              <p><label for="Description" >Descrizione</label><br />
              <p><label for="Description" >{$photo_deteils.description}</label></p>
              <p><label for="is_reserved" >Riservata</label><br />
              <p><label for="is_reserved" >{$photo_deteils.is_reserved}</label></p>   
              <p><label for="categories" >Categoria</label><br />
              <p><label for="categories" >{$categories}</label></p>
              <form method="post" action="deve andare alla pagina di modifca">
                    <p><input type="hidden" name="controller" value="photo" />
                    <p><input type="hidden" name="task" value="modifca" />
                    <p><input type="hidden" name="id" value="{$photo_deteils.id}" />
                    <p><input type="submit" name="modifica" class="button" value="Modifica"  /></p>
              </form>
              {*aggiungere i commenti*}
</div>
</td>
</tr>
<tr width="1300px" align="center">
    <td>
        <form method="POST" action="da vedere">
        <p><label for="Description" class="top">Descrizione:</label><br />
        <p><textarea type="text" name="Description" cols="20" rows="5">{*da mettere in trasparte da vedere sulle cose di marco*}</textarea></p>
        <p><input type="hidden" name="controller" value="user" /></p>
        <p><input type="hidden" name="task" value="add_comments" /></p>
        <p><input type="hidden" name="id" value="{$foto_deteils.id}" /></p>
        <p><input type="submit" name="modifica" class="button" value="Aggiungi"></p>
        </form>
    </td>
</tr>
<tr>
<td width="1300px" align="center">
    <table>
    {foreach from=$commenti item=$valore}
        <tr>
            <td>
                <fieldset>
                   <p><label for="username" ><{$valore.username}</label></p>
                   <fieldset>
                   <p><label for="text">{$valore.username}</label> </p>
                   </fieldset>
                   {if $attiva_remove_comments==="TRUE"}
                    <form method="post" action="deve andare alla pagina di modifca">
                        <p><input type="hidden" name="controller" value="user" /></p>
                        <p><input type="hidden" name="task" value="remove_comments" /></p>
                        <p><input type="hidden" name="id" value="{$foto_deteils.id}" /></p>
                    <p><input type="submit" name="modifica" class="button" value="Rimuovi"  /></p>
                    </form>
                    {/if}
                </fieldset>
    
            
            </td>
        </tr>
                                
    {/foreach}
    </table>
</td>
</tr>
</table>