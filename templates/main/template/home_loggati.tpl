<table>
    <tr>
	<td width="750px" align="center">
		<table>
                    {foreach from=$foto_home item=array1}
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
	<td width="750px" align="center">
            <div class="metodo">
		<form method="POST" action="index.php">
                    <h3 class="title">Ricerca per categoria</h3>
                        <p><label for="Categories" class="top">Categoria</label><br />
                        <select name="Categories" multiple>
                            {foreach from=$Array_categories item=$categories}
                                <option value="$categories" checked>$catgories</option>
                            {/foreach}
                        </select></p>
                        <p><input type="hidden" name="controller" value="cerca" />
                            <input type="hidden" name="task" value="search_photo_by_categories" />
                            <input type="submit" name="cerca" class="button" value="Inizia a Cercare"  /></p>
                </form>
            </div>
	</td>
    </tr>
</table>