<div class="container">
    <div class="row">
    <div class="col-md-6">
			<div class="container">
                            {foreach from=$array_photo item=array1}
                            <div class="row">
                                {foreach from=$array1 item=valore}
                                    <div class="col-md-3">
                                        <img src="data:".{$valore.type}.";base64,'.base64_encode( {$valore.thumbanil} ).'">
                                        <!--modo per mettere gli id nascoti-->
                                    </div>
                                {/foreach}
                            </div>
                            {/foreach}
                        </div>
    </div>
    <div class="col-md-6">
			<img src="{$pic_profile}" class="thumbnail">
			<h3 class="text-success">Username:</h3><br />{$user_details.username}
                        <h3 class="text-success">Email:</h3><br />{$user_details.email}
                        <h3 class="text-success">Ruolo:</h3><br />{$role}
			
                        <form method="post" action="index.php">  
                            <div class="form-group">
                               <button type="submit" class="btn btn-success">Modifica</button>
                            </div>
                        </form>	
    </div>
    </div>                     
</div> 