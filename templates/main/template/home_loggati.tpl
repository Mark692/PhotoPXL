<table class="tabella"  align="center" border="3" cellpadding="5" cellspacing="0"
    <tr>
	<td class="colonna foto">
		<table>
                    {foreach from=$ultime_foto item=array1}
                        <tr>
                            {foreach from=$array1 item=valore}
                                <td>
                            {$valore}  
                                </td>
                            {/foreach}
                        </tr>
                    {/foreach}
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
                        </select></p>
                        <p><input type="hidden" name="controller" value="ricerca" />
                            <input type="hidden" name="task" value="carca" />
                            <input type="submit" name="cerca" class="button" value="Inizia a Cercare"  /></p>
                </form>
            </div>
	</td>
    </tr>
</table>