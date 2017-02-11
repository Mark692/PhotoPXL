<div class="table">
<table class="tabella"  align="center" border="3" cellpadding="5" cellspacing="0"
	<tr class="contenuto">
			<td class="colonna foto">
			<table class="tabella" width="900px" align="center" cellpadding="5" cellspacing="0">
			{for $iter=1 to $MAX_RIGHE}
				<tr class="riga foto">
			 	{for $iter=1 to $MAX_COLONNE}
					<td class="colonna foto"><img src={$dati_foto.images[]}></td>
				{/for}
				</tr>
			{/for}
			</table>
			</td>
		<td class="colonna dati album" width="900px">
			<p><label for="Title" class="top">Titolo:</label< /br> {$dati_album.title}</label></p>
			<p><label for="Title" class="top">Descrizione</label< /br> {$dati_album.description}</label></p>
			//altre cose
		</td>
	</tr>
</div>
</table>


