<div class="container">
                            {foreach from=$array_photo item=array1}
                            <div class="row">
                                {foreach from=$array1 item=valore}
                                    <div class="col-md-3">
                                        {foto}
                                        <!--modo per mettere gli id nascoti-->
                                    </div>
                                {/foreach}
                            </div>
                            {/foreach}
</div>