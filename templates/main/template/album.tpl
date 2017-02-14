<div class="table">
    <table class="tabella"  align="center" border="3" cellpadding="5" cellspacing="0">
	<tr class="contenuto">
			<td>
			<table class="colonna foto" cellpadding="5" cellspacing="2">
                            {foreach from=$thumbnail_utente item=array1}
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
		</td>
	</tr>

    </table>
</div>

