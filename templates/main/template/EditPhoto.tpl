<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3 class="text-success">Foto da modificare:</h3><br/>
            {$foto}
            &nbsp;
            <form method="POST" action="Service/photoSync.php">
                <input type="hidden" name="action" value="delete" />
                <input type="hidden" name="id" value="{$pid}" />
                <input type="submit" class="btn btn-success" value="Elimina"  /></p>
            </form>
        </div>
        <div class="col-md-6">
            <h3 class="text-success">Dati foto </h3><br/>
            <form method="POST" action="Service/photoSync.php">
                <p><h3 class="text-success">Titolo:</h3><br />
                <div class="form-group">
                    <input id="title" name="title" maxlength="30" class="form-control" type="text" placeholder="{$photo_details.title}">
                </div>
                <p><h3 class="text-success">Descrizione:</h3><br />
                <div class="form-group">
                    <div class="col-lg-10">
                        <textarea id="description" name="description" maxlength="500"  class="form-control" rows="3" placeholder="{$photo_details.description}"></textarea>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    {if $role gt "1"}
                        <h3 class="text-success">Riservata:</h3><br />
                        {if $photo_details.is_reserved eq "1"}
                            <div class="form-group">
                                <div class="col-lg-10">
                                    <div class="radio">
                                        <label>
                                            <input name="is_reserved" type="radio" name="optionsRadios" id="optionsRadios1" value="TRUE" checked="">
                                            Si
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input name="is_reserved" type="radio" name="optionsRadios" id="optionsRadios2" value="FALSE">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        {else}
                            <div class="form-group">
                                <div class="col-lg-10">
                                    <div class="radio">
                                        <label>
                                            <input name="is_reserved" type="radio" name="optionsRadios" id="optionsRadios1" value="TRUE">
                                            Si
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input name="is_reserved" type="radio" name="optionsRadios" id="optionsRadios2" value="FALSE"  checked="">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        {/if}
                    {/if}
                </div>
                <h3 class="text-success">Categoria:</h3><br />
                <div class="form-group">
                    <div class="col-lg-10">
                        <!-- select multiple -->
                        <select name="categories[]" multiple="" class="form-control">
                            {foreach from=$categories item=cat}
                                <option value={$cat.riferimento}>{$cat.visualizzato}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <input type="hidden" name="action" value="edit"/>
                <input type="hidden" name="id" value="{$pid}"/>
                <!-- aggiustare sto pulsante -->
                <div class="form-group">
                    <input type="submit" name="salva" class="btn btn-success" value="Salva"  />
                </div>
            </form>
        </div>
    </div>
</div>
<script src="templates/main/template/js/check_photo.js"></script>