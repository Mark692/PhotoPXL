<table class="tabella"  align="center" border="3" cellpadding="5" cellspacing="0"
    <tr>
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
	<td class="colonna ricerca" width="900px">
            <div class="metodo">
		<form method="POST" action="index.php">
                    <h3 class="title">Ricerca per categoria</h3>
                        <p><label for="Categories" class="top">Categoria</label><br />
                        <select name="Categories" multiple>
                            {foreach from=$Array_categories item=$categories}
                                <option value="$categories" checked>$catgories</option>
                            {/foreach}
                        </select>
                        <p><input type="hidden" name="controller" value="ricerca" />
                            <input type="hidden" name="task" value="carca" />
                            <input type="submit" name="cerca" class="button" value="Inizia a Cercare"  /></p>
            </div>
	</td>
    </tr>
</table>