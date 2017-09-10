
<!-- può essere fatto un solo template sfruttando foto altri user -->
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <p><h3 class="text-success">Titolo:</h3><br /></p>
            <p><label for="Title">{$photo_details.title}</label></p> </br>
            <!-- vedere la grandezza della foto e come far vedere na foto-->
            {$foto}
            <h3 class="text-success">Like:</h3><p id="likes">{$photo_details.tot_like|default:"0"}<br /></p>
                {if $attiva eq "1"}  
                <div class="form-group">
                    <input type="hidden" value="{$pid}" />
                    <button id="like" type="button" class="btn btn-success">Non Mi Piace</button>
                </div>
            {else} 
                <div class="form-group">
                    <input type="hidden" value="{$pid}" />
                    <button id="like" type="submit" class="btn btn-success">Mi Piace</button>
                </div>
            {/if}
            <!-- per attivare i tasti modifica e elimina foto -->
            {if $photo_details.uploader eq $username}
                <!-- l'uploader della foto dove si trova -->
                <div class="form-group">
                    <a href="edit_photo.php?id={$pid}" class="btn btn-success">Modifica Foto</a>
                </div>
                <form method="POST" action="Service/photoSync.php">
                    <input type="hidden" name="action" value="delete" />
                    <input type="hidden" name="id" value="{$pid}" />
                    <input type="submit" class="btn btn-success" value="Elimina"  /></p>
                </form>
            {/if}

        </div>
        <div class="col-md-6">
            <p><h3 class="text-success">Descrizione:</h3><br />{$photo_details.description}</p>
            <p><h3 class="text-success">Riservata:</h3><br />{$photo_details.is_reserved}</p>   
            <p><h3 class="text-success">Categoria:</h3><br />
            {foreach from=$categories item=cat}
                {$cat.visualizzato}<br />
            {/foreach}
            <p><h3 class="text-success">Data di pubblicazione:</h3>{$photo_details.Upload_Date}<br /></p>
        </div>
    </div>


    <!-- come mettere i commenti -->

    <div class="row">
        <div class="form-group">
            <p><h3 class="text-success">Inserisci il tuo commento!!!</h3><br />
            <label for="textArea" class="col-lg-2 control-label"></label>
            <div class="col-lg-10">
                <textarea class="form-control" rows="3" id="comment-body"></textarea>
                <input type="hidden" value="{$pid}" />
                <button type="button" id="comment-send" class="btn btn-success">Commenta</button>
            </div>
        </div>
    </div>
    <div id="comments" class="row">
        <h2>Commenti...</h2>
        {foreach from=$comments item=valore}
            <div id="c{$valore.id}" class="col-md-6 col-md-offset-3">
                <div class="well">
                    <p class="text-success">{$valore.user}</p>
                    <textarea disabled>{$valore.text}</textarea>
                    {if $valore.user eq $username}
                        <div class="form-group">
                            <input type="hidden" name="cid" value="{$valore.id}" />
                            <button type="submit" class="edit btn btn-success">Modifica</button>
                            <button type="submit" class="send btn btn-success">Invia</button>
                            <button type="submit" class="delete btn btn-success">Elimina</button>
                        </div>
                    {/if}
                </div>
            </div>
        {/foreach}
    </div>
    <script src="templates/main/template/js/photo.js"></script>