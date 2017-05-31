<div class="container">
    <form method="post" action="index.php">
        <div class="row">
        <div class="col-md-6">
                    
                    <h3 class="text-success">Inserisci foto 1:</h3><br />
                        <div class="form-group">
                            <input name="photo" class="form-control" id="focusedInput" type="file" >
                        </div>
                    <h3 class="text-success">Titolo:</h3><br />
                    <div class="form-group">
                            <input name="title" class="form-control" id="focusedInput" type="text" placeholder="inserisci titolo..." >
                    </div>
        </div>
        <div class="col-md-6">
                    <h3 class="text-success">Descrizione</h3><br />
                    <div class="form-group">
                            <div class="col-lg-12">
                                <textarea name="description" class="form-control" rows="3" id="textArea" placeholder="inserisci descrizione..."></textarea>
                                <span class="help-block"></span>
                            </div>
                    </div>
                    <h3 class="text-success">Categoria</h3><br />
                    <div class="form-group">
                    <div class="col-lg-12">
                            <select name="categories" multiple="" class="form-control">
                                    {foreach from=$array_categories item=categories}
                                        {if $categories eq $photo_deteils.categories}
                                                <option value="$categories" selected="selected">{$categories}</option>
                                        {else}  <option value="$categories">{$categories}</option>
                                        {/if}
                                    {/foreach}
                            </select>
                    </div>
                    </div>
        </div>
        </div>
    </form>
</div>

