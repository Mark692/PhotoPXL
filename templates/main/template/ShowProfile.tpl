<div class="container">
    <div class="row">
        <div class="col-md-6">
            {if $no_result|default:"FALSE" eq "FALSE"}
                <div class="container">
                    {foreach from=$array_photo item=array1}
                        <div class="row">
                            {foreach from=$array1 item=valore}
                                <div class="col-sm-1">
                                    <!--QUA CI VA MESSO UN RIFERIMENTO ALLA FOTO-->
                                    <a href="">
                                        {$valore}
                                    </a>
                                </div>
                            {/foreach}
                        </div>
                    {/foreach}
                </div>
            {else}
                <h3 class="text-success">{$no_result}</h3>
            {/if}
        </div>
        <div class="col-md-6">
            {$pic_profile}
            {if $attiva|default:"FALSE" eq 'TRUE'}
                <form method="post" action="index.php">  
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Cambia Immagine Profilo</button>
                    </div>
                </form>
            {/if}
            <h3 class="text-success">Username:</h3><br /><h4>{$user_details.username}</h4>
            <h3 class="text-success">Email:</h3><br /><h4>{$user_details.email}</h4>
            <h3 class="text-success">Ruolo:</h3><br /><h4>{$user_details.role}</h4>
                {if $attiva|default:"FALSE" eq 'TRUE'}
                <form method="post" action="index.php">  
                    <div class="form-group">
                        <a href="edit_profile.php" class="btn btn-success">Modifica Profilo</a>
                    </div>
                </form>
            {/if}
        </div>
    </div>                     
</div> 
<script src="templates/main/template/js/profile.js"></script>