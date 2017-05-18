<div class="container">
    <div class="row">
    <div class="col-md-6">
                <h3 class="text-success">Foto da modificare:</h3><br/>
                        <img src={$foto}></p>
                <form method="POST" action="index.php">
                    <p><input type="hidden" name="controller" value="upload" />
                        <input type="hidden" name="task" value="elimina" />
                        <input type="submit" name="elimina" class="btn-success" value="Elimina"  /></p>
                </form>
    </div>
    <div class="col-md-6">
                <h3 class="text-success">Dati foto </h3><br/>
                <form method="POST" action="index.php">
                        <p><h3 class="text-success">Titolo:</h3><br />
                        <div class="form-group">
                                <input name="title" class="form-control" id="focusedInput" type="text" value="{$photo_deteils.title}">
                        </div>
                        <p><h3 class="text-success">Descrizione</h3>><br />
                        <div class="form-group">
                            <div class="col-lg-10">
                            <textarea name="description" class="form-control" rows="3" id="textArea"></textarea>
                            <span class="help-block">{$photo_deteils.description}</span>
                            </div>
                         </div>
                        {if $user_details.role gt "Standard"}
                          <p><label for="is_reserved">Riservata:</label><br />
                                {if "TRUE" eq $photo_deteils.is_reserved}
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
                        <h3 class="text-success">Categoria</h3><br />
                        <div class="col-lg-10">
                            <select name="categories" multiple="" class="form-control">
                                {foreach from=$array_categories item=categories}
                                    {if $categories eq $photo_deteils.categories}
                                            <option value="$categories" selected="selected">{$categories}</option>
                                    {else}  <option value="$categories">{$categories}</option>
                                    {/if}
                                {/foreach}
                            </select>
                        </div>
                        <input type="hidden" name="controller" value="upload" />
                        <input type="hidden" name="task" value="salva" />
                        <input type="submit" name="salva" class="btn-success" value="Salva"  />
                </form>
    </div>
    </div>
</div>