<div class="container">
    <div class="row">
        <div class="col-md-6">
            {if $no_result|default:"FALSE" eq "FALSE"}
                <div class="container">
                    {foreach from=$array_photo item=array1}
                        <div class="row">
                            {foreach from=$array1 item=valore}
                                <div class="col-sm-1">
                                    <!--QUA CI VA MESSO UN RIFERIMENTO ALLA FOTO, QUESTO è SOLO PROVVISORIO-->
                                    <a href="ShowProfile.tpl"></a>
                                    {$valore}
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
        <div class="col-md-6">
            <form metod="POST" action="">
                {$pic_profile}
                <input type="hidden" name="controller" value="profilo" />
                <input type="hidden" name="task" value="update" />
                <input type="submit" name="Salva" class="btn-success" value="Modifica"/>
                <h3 class="text-success">Username:</h3><br />
                <div class="form-group">
                    <input name="username" class="form-control" id="focusedInput" type="text" value={$user_details.username}>
                </div>
                <h3 class="text-success">Password:</h3><br />
                <div class="form-group">
                    <input name="password" class="form-control" id="focusedInput" type="password" value="{$user_details.password}">
                </div>
                <h3 class="text-success">Email:</h3><br />
                <div class="form-group">
                    <input name="email" class="form-control" id="focusedInput" type="text" value="{$user_details.email}">
                </div>
                <h3 class="text-success">Ruolo:</h3><br />{$user_details.role}
                <input type="submit" name="Salva" class="btn-success" value="Salva Modifiche"/>
            </form>
        </div>
    </div>
</div>