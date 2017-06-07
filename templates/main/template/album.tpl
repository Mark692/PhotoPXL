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
                    <h3 class="text-success">Titolo Album:</h3><br />{$album_details.title}
                    <h3 class="text-success">Descrizone:</h3><br /> {$album_details.description} 
                    <h3 class="text-success">Categoria:</h3><br />
                        {foreach from=$categories item=cat}
                            <p> {$cat.visualizzato} </p><br />
                        {/foreach}
                            </select>
                    {if $user_album eq $username}
                    <form method="post" action="">  
                        <div class="form-group">
                               <button type="submit" class="btn btn-success">Modifica Album</button>
                        </div>
                    </form>	
                    <form method="post" action="">  
                        <div class="form-group">
                               <button type="submit" class="btn btn-success">Elimina Album</button>
                        </div>
                    </form>	
                    <form method="post" action="">  
                        <div class="form-group">
                               <button type="submit" class="btn btn-success">Aggiungi Foto</button>
                        </div>
                    </form>
                    {/if}
    </div>
    </div>
</div>

