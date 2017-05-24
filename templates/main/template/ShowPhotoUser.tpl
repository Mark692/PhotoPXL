
<!-- può essere fatto un solo template sfruttando foto altri user -->
<div class="container">
    <div class="row">
    <div class="col-md-6">
                    <p><h3 class="text-success">Titolo:</h3><br /></p>
                    <p><label for="Title">{$photo_deteils.title}</p> </br>
                    <!-- vedere la grandezza della foto -->
                    <p><img src="{$photo.fullsize}" width="300px" height="300px"></p>
                    <p><h3 class="text-success">Like:</h3>{$photo_deteils.total_like}<br /></p>
                    <!-- serve per attivare i like -->
                    {if $attiva eq "TRUE"}
                        <form method="post" action="index.php">  
                        <div class="form-group">
                               <button type="submit" class="btn btn-success">Mi Piace</button>
                        </div>
                        </form>
                    {else}
                        <form method="post" action="index.php">  
                        <div class="form-group">
                               <button type="submit" class="btn btn-success">Non Mi Piace</button>
                        </div>
                        </form>
                    {/if}
                    <!-- per attivare i tasti modifica e elimina foto -->
                    {if $photo.username eq $user_details.username}
                        <form method="post" action="index.php">  
                        <div class="form-group">
                               <button type="submit" class="btn btn-success">Modifica Foto</button>
                        </div>
                        </form>
                        <form method="post" action="index.php">  
                        <div class="form-group">
                               <button type="submit" class="btn btn-success">Elimina Foto</button>
                        </div>
                        </form>
                    {/if}
                    
    </div>
    <div class="col-md-6">
                    <p><h3 class="text-success">Descrizione:</h3><br />{$photo_deteils.description}</p>
                    <p><h3 class="text-success">Riservata:</h3><br />{$photo_deteils.is_reserved}</p>   
                    <p><h3 class="text-success">Categoria:</h3><br />{$photo_deteils.categories}</p>
                    <p><h3 class="text-success">Data di pubblicazione:</h3>{$photo_deteils.upload_date}<br /></p>
                    <p><h3 class="text-success">Album di appartenenza:</h3>{$photo_deteils.name_album}<br /></p>
    </div>
    </div>

                    
<!-- come mettere i commenti -->

    <div class="row">
            <form method="POST" action="index.php">
                <div class="form-group">
                <label for="textArea" class="col-lg-2 control-label">Inserisci il tuo commento!!!</label>
                    <div class="col-lg-10">
                <textarea class="form-control" rows="3" id="textArea"></textarea>
                    </div>
                </div>
            </form>
    </div>
    <div class="row">
        <h2>Commenti...</h2>
        <!--vedere nel caso sia vuoto $comments -->
        {foreach from=$comments item=valore}
        <div class="col-md-6 col-md-offset-3">
            <div class="well">
                <p class="text-success">{$valore.username}</p>
                <p>{$valore.text}</p>
            </div>
        </div>
        {/foreach}
    
    </div>
    
    
