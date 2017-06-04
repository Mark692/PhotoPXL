<div class="container">
    <div class="row">
    <div class="col-md-6">
            <div class="container">
                            {if $no_result|default:"FALSE" eq "FALSE"}
			<div class="container">
                            {foreach from=$array_photo item=array1}
                            <div class="row">
                                {foreach from=$array1 item=valore}
                                    <div class="col-sm-1">
                                        <!--QUA CI VA MESSO UN RIFERIMENTO ALLA FOTO, QUESTO è SOLO PROVVISORIO-->
                                        <a href="http://www.html.it">
                                        {$valore}
                                        </a>
                                        <!--modo per mettere gli id nascoti-->
                                    </div>
                                {/foreach}
                            </div>
                            {/foreach}
                        </div>
                        {else}
                            <h3 class="text-success">{$no_result}</h3>
                        {/if}
            </div>
    </div>
        <div class="col-md-6">
                    <h2 class="text-success">Risultato della ricerca per la cateroria:</h2><br />
                    {foreach from=$categories item=cat}
                        <h3 class="text-success">{$cat.visualizzato}<br /></h3>
                    {/foreach}
        </div>
    </div>
</div>