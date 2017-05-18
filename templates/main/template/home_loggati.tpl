<table>
    <tr>
        <td align="center">
            <table>
                        {foreach from=$thumbanil item=array1}
                            <tr>
                                {foreach from=$array1 item=valore}
                                    <td>
                                        <img src="{$valore}" > </img>
                                    </td>
                                {/foreach}
                            </tr>
                        {/foreach}
            </table> 
        </td>
        <td class="colonna" align="center">
            <form method="POST" action="index.php">
                    <h3 class="title">Ricerca per categoria</h3>
                    <p><label for="Categories">Categoria</label><br />
                    <select multiple="" class="form-control">
                            {foreach from=$array_categories item=categories}
                                <option value="$categories" checked>{$categories}</option>
                            {/foreach}
                    </select>
                            <input type="hidden" name="controller" value="cerca" />
                            <input type="hidden" name="task" value="search_photo_by_categories" />
                            <input type="submit" name="cerca" class="btn btn-success" value="Inizia a Cercare" />
            </form>

        </td>
    </tr>
</table>
    
    
    