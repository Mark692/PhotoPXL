<div class="container">
    <div class="row">
    <div class="col-md-6">
            <div class="container">
                            {foreach from=$array_photo item=array1}
                            <div class="row">
                                {foreach from=$array1 item=valore}
                                    <div class="col-sm-1">
                                        <a href="http://www.html.it">
                                        {$valore}
                                        </a>
                                        <!--modo per mettere gli id nascoti-->
                                    </div>
                                {/foreach}
                            </div>
                            {/foreach}
            </div>
    </div>
        <div class="col-md-6">
            <form method="POST" action="index.php">
                    <h3 class="text-success">Ricerca per Categoria:</h3><br />
                        <div class="form-group">
                        <div class="col-lg-10">
                            <!-- select multiple -->
                            <select name="categories" multiple="" class="form-control">
                                {foreach from=$categories item=cat}
                                       <option value={$cat.riferimento}>{$cat.visualizzato}</option>
                                {/foreach}
                            </select>
                        </div>
                        </div>
                        &nbsp;
                        <input type="submit" name="cerca" class="btn btn-success" value="Inizia a Cercare" />
            </form>
        </div>
    </div>
</div>                
    
    
    