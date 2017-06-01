<div class="container">
    <h2 class="text-success">Carica fino a tre foto conteporanemante:</h2><br />
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
                    <h3 class="text-success">Riservata:</h3><br />
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
                                                    <input name="is_reserved" type="radio" name="optionsRadios" id="optionsRadios2" value="FALSE">
                                                    No
                                                </label>
                                            </div>
                                          </div>
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
        <hr class="text-success">
        <div class="row">
        <div class="col-md-6">
                    
                    <h3 class="text-success">Inserisci foto 2:</h3><br />
                        <div class="form-group">
                            <input name="photo" class="form-control" id="focusedInput" type="file" >
                        </div>
                    <h3 class="text-success">Titolo:</h3><br />
                    <div class="form-group">
                            <input name="title" class="form-control" id="focusedInput" type="text" placeholder="inserisci titolo..." >
                    </div>
                    <h3 class="text-success">Riservata:</h3><br />
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
                                                    <input name="is_reserved" type="radio" name="optionsRadios" id="optionsRadios2" value="FALSE">
                                                    No
                                                </label>
                                            </div>
                                          </div>
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
        <hr class="text-success">
        <div class="row">
        <div class="col-md-6">
                    
                    <h3 class="text-success">Inserisci foto 3:</h3><br />
                        <div class="form-group">
                            <input name="photo" class="form-control" id="focusedInput" type="file" >
                        </div>
                    <h3 class="text-success">Titolo:</h3><br />
                    <div class="form-group">
                            <input name="title" class="form-control" id="focusedInput" type="text" placeholder="inserisci titolo..." >
                    </div>
                    <h3 class="text-success">Riservata:</h3><br />
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
                                                    <input name="is_reserved" type="radio" name="optionsRadios" id="optionsRadios2" value="FALSE">
                                                    No
                                                </label>
                                            </div>
                                          </div>
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
        <hr class="text-success">
        <div class="form-group">
                    <button type="submit" class="btn btn-success">Carica Foto</button>
        </div>
    </form>
</div>

