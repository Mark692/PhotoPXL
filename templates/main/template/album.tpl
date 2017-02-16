<div class="table">
    <table class="tabella"  align="center" border="3" cellpadding="5" cellspacing="0">
	<tr class="contenuto">
			<td>
			<table class="colonna foto" cellpadding="5" cellspacing="2">
                            {foreach from=$thumbnail item=array1}
                                <tr>
                                {foreach from=$array1 item=valore}
                                    <td>
                                <img src={$valore} width="100" height="100" > 
                                    </td>
                                {/foreach}
                                </tr>
                            {/foreach}
                </table> 
			</td>
		<td class="colonna dati album" width="900px">
			<p><label for="Title" class="top">Titolo:</ br> {$dati_album.title}</label></p>
                        <p><label for="Title" class="top">Descrizione</ br> {$dati_album.description}</label></p>
                        <p><label for="categories" class="top">Categoria</ b>
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

