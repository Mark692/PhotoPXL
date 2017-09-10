<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="container">
                {if $no_result|default:"FALSE" eq "FALSE"}
                    <div class="container">
                        {foreach from=$array_photo item=array1}
                            <div class="row">
                                {foreach $array1 as $valore}
                                    <div class="col-sm-1">
                                        {$valore}
                                    </div>
                                {/foreach}
                            </div>
                        {/foreach}
                    </div>
                {else}
                    <h3 class="text-success">{$no_result}</h3>
                {/if}
            </div>
        </div>
        <div class="col-md-6">
            <form method="POST" action="search.php">
                <h3 class="text-success">Ricerca per Categoria:</h3><br />
                <div class="form-group">
                    <!-- select multiple -->
                    <select name="categories[]" multiple="" class="form-control">
                        {foreach from=$categories item=cat}
                            <option value={$cat.riferimento}>{$cat.visualizzato}</option>
                        {/foreach}
                    </select>
                    <input id="search_cat" type="submit" name="cerca" class="btn btn-success" value="Inizia a Cercare" />
                </div>
            </form>
        </div>
    </div>
</div>                
<script src="templates/main/template/js/home.js"></script>

