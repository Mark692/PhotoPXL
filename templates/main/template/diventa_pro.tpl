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
		
                    <h1 class="text-success">Diventa Pro Adesso!!!</h1>
                    <p> <label>I vantaggi nel diventare PRO:</label></ br>
                    <ul>
                        <li>Potrai caricare foto illimitate</li>
                        <li>Potrai impostare la visibilità delle tue foto e album</li>
                        <li>Potrai caricare fino a 3 foto contemporaneamente</li>
                    </ul>
                    <form method="post" action="">  
                        <div class="form-group">
                               <button type="submit" class="btn btn-success">Diventa Pro</button>
                        </div>
                    </form>
    </div>
    </div>
</div>