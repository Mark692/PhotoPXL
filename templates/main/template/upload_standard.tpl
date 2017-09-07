<div class="container">
    <form enctype="multipart/form-data" method="post" action="Service/photoSync.php">
        <div class="row">
            <div class="col-md-6">

                <h3 class="text-success">Inserisci foto:</h3><br />
                <div class="form-group">
                    <input name="photo" class="form-control" type="file" >
                </div>
                <h3 class="text-success">Titolo:</h3><br />
                <div class="form-group">
                    <input name="title" class="form-control" type="text" placeholder="inserisci titolo..." >
                </div>
            </div>
            <div class="col-md-6">
                <h3 class="text-success">Descrizione</h3><br />
                <div class="form-group">
                    <div class="col-lg-12">
                        <textarea name="description" class="form-control" rows="3" placeholder="inserisci descrizione..."></textarea>
                        <span class="help-block"></span>
                    </div>
                </div>
                <h3 class="text-success">Categoria</h3><br />
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
            </div>
        </div>
        <input type="hidden" name="action" value="upload" />
        <hr class="text-success">
        <div class="form-group">
            <button type="submit" class="btn btn-success">Carica Foto</button>
        </div>
    </form>
</div>
<script src="templates/main/template/js/upload.js"></script>

