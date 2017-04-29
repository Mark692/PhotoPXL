<table>
        <tr>
			<td class="colonna" align="center">
			<table cellpadding="5" cellspacing="2">
                            {foreach from=$thumbnail item=array1}
                                <tr>
                                {foreach from=$array1 item=valore}
                                    <td>
                                <img src="{$valore}" class="thumbnail" > 
                                    </td>
                                {/foreach}
                                </tr>
                            {/foreach}
                        </table> 
			</td>
		<td class="colonna" align="center">
                    <p><label for="Title"><h2>Titolo:</h2></ br> {$dati_album.title}</label></p>
                    <p><label for="descrption"><h2>Descrizione</h2></ br> {$dati_album.description}</label></p>
                    <p><label for="categories"><h2>Categoria</h2></ b>
                              {foreach from=$dati_album.categories item=cat}
                                  <label>{$cat}</label>
                              {/foreach}
                            </label></p>
                            <form class="modulo" action="index.php">
                                <p><input type="hidden" name="controller" value="album" />
                                <input type="hidden" name="task" value="modifica" />
                                <input type="submit" name="Modifica" class="button" value="Modifica Album"  /></p>
                            </form>
                            <form class="modulo" action="index.php">
                                <p><input type="hidden" name="controller" value="album" />
                                <input type="hidden" name="task" value="elimina album" />
                                <input type="submit" name="Elimina" class="button" value="Elimina Album"  /></p>
                            </form>
                            <form class="modulo" action="index.php">
                                <p><input type="hidden" name="controller" value="album" />
                                <input type="hidden" name="task" value="elimina album" />
                                <input type="submit" name="Aggiungi" class="button" value="Aggiungi Foto"  /></p>
                            </form>
                </td>
	</tr>
</table>
</div>

