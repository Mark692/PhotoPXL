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
			{$pic_profile}
                        {if $attiva|default:"FALSE" eq 'TRUE'}
                        <form method="post" action="profileSync.php">  
                        <div class="form-group">
                               <button type="submit" class="btn btn-success">Cambia Immagine Profilo</button>
                        </div>
                        </form>
                        {/if}
                        <h3 class="text-success">Username:</h3><br /><h4>{$profile_user}</h4>
                        <h3 class="text-success">Email:</h3><br /><h4>{$profile_email}</h4>
                        <h3 class="text-success">Ruolo:</h3><br /><h4>{$profile_role}</h4>
                        {if $attiva|default:"FALSE" eq 'TRUE'}
			<form method="post" action="index.php">  
                        <div class="form-group">
                               <button type="submit" class="btn btn-success">Modifica dati</button>
                        </div>
                        </form>
                        {/if}
    </div>
    </div>                     
</div> 