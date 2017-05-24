<table>
    <tr>
        <td align="center">
            <div class="container">
                            {foreach from=$array_photo item=array1}
                            <div class="row">
                                {foreach from=$array1 item=valore}
                                    <div class="col-md-3">
                                        <img src="data:".{$valore.type}.";base64,'.base64_encode( {$valore.thumbanil} ).'">
                                        <!--modo per mettere gli id nascoti-->
                                    </div>
                                {/foreach}
                            </div>
                            {/foreach}
            </div>
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
    
    
    